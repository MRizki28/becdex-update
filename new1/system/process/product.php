<?php require dirname(__FILE__, 3).'/root.php';
require dirBase.'vendor/autoload.php';
require dirBase.'system/main.php';

class Product extends Main {
    public function methods($post)
    {
        parent::__construct();
        $post = parent::clean($post);

        $nominal = $this->data->query("SELECT `sellPrice` FROM `tb_nominals` WHERE `idNom` = '{$post['idNom']}'")->fetch_row()[0];

        $sql = $this->data->query("SELECT `idMethod`, `img`, `name`, `minimum`, `feeType`, `fee` FROM `tb_pay_methods` WHERE `visibility` = 'y' ORDER BY `name`");

        $data = array();
        while($db = mysqli_fetch_assoc($sql)){
            $total = ($db['feeType'] == 'amount') ? $nominal + $db['fee'] : $nominal + ($nominal * $db['fee'] / 100);
            
            if($db['minimum'] > $total){
                continue;
            }

            $db['total'] = 'Rp '.number_format($total,0,',','.');
            $data[] = $db;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
        exit(0);
    }

    public function confirm($post)
    {
        parent::__construct();
        $post = parent::clean($post);

        $data = array();
        $data['userid'] = 'empty';

        $pay = mysqli_fetch_assoc($this->data->query("SELECT `idMethod`, `img`, `name`, `nameType`, `feeType`, `fee` FROM `tb_pay_methods` WHERE `idMethod` = '{$post['idMethod']}'"));

        $nominal = mysqli_fetch_assoc($this->data->query("SELECT `name`, `sellPrice` FROM `tb_nominals` WHERE `idNom` = '{$post['idNom']}'"));

        $data['nominal'] = $nominal['name'];
        $data['price'] = ($pay['feeType'] == 'amount') ? $nominal['sellPrice'] + $pay['fee'] : $nominal['sellPrice'] + ($nominal['sellPrice'] * $pay['fee'] / 100);
        $data['method'] = $pay['name'].' ('.$pay['nameType'].')';
        $data['nameType'] = $pay['nameType'];
        $data['img'] = $pay['img'];

        /* Mobile Legends */
        if($post['idPro'] == 'pro-2392135607-00004'){
            $pro = mysqli_fetch_assoc($this->data->query("SELECT `service`, `cid` FROM `tb_products` WHERE `idPro` = '{$post['idPro']}'"));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://argamingshop.com/ajax/order_confirm.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "data=".$post['user1']."&service=".$pro['service']."&zoneid=".$post['user2']."&method=TRANSFER+BANK+BCA&nohp=087871894997&cid=".$pro['cid']."",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            unset($pro);

            if(!$err){
                $response = str_replace('<font color="black">Data Pesanan <hr>Nama Panggilan : ', '', preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $response));
                $response = explode('<br>', $response);
                $data['userid'] = $response[0];
            }
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
        exit(0);
    }

    public function pay($post)
    {
        parent::__construct();
        $post = parent::clean($post);
        $cookie = parent::clean($_COOKIE);

        $fee = mysqli_fetch_assoc($this->data->query("SELECT `feeType`, `fee` FROM `tb_pay_methods` WHERE `idMethod` = '{$post['user']['idMethod']}'"));

        $sellPrice = $this->data->query("SELECT `sellPrice` FROM `tb_nominals` WHERE `idNom` = '{$post['user']['idNom']}'")->fetch_row()[0];
        
        $total = ($fee['feeType'] == 'amount') ? $sellPrice + $fee['fee'] : $sellPrice + ($sellPrice * $fee['fee'] / 100);

        $data = array();
        $cust = mysqli_fetch_assoc($this->data->query("SELECT `name`, `email`, `phone` FROM `tb_customers` WHERE `idCust` = '{$cookie['idCust']}'"));

        \Midtrans\Config::$serverKey = 'Mid-server-cjQvsGl-kComVXjLoGhm3Q2E';
        \Midtrans\Config::$isProduction = true;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => 'order-'.date('jnygis'),
                'gross_amount' => $total,
            ),
            "enabled_payments" => array($post['user']['nameType']),
            "credit_card" => array('secure' => true),
            'customer_details' => array(
                'first_name' => $cust['name'],
                'last_name' => '',
                'email' => $cust['email'],
                'phone' => $cust['phone']
            ),
        );

        $data['token'] = \Midtrans\Snap::getSnapToken($params);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit(0);

    }

    public function order($post)
    {
        parent::__construct();
        $post = parent::clean($post);
        $cookie = parent::clean($_COOKIE);

        $nominal = mysqli_fetch_assoc($this->data->query("SELECT `name`, `sellPrice` FROM `tb_nominals` WHERE `idNom` = '{$post['user']['idNom']}'"));

        $product = $this->data->query("SELECT `name` FROM `tb_products` WHERE `idPro` = '{$post['user']['idPro']}'")->fetch_row()[0];

        $customer = $this->data->query("SELECT `name` FROM `tb_customers` WHERE `idCust` = '{$cookie['idCust']}'")->fetch_row()[0];

        $pdf = (isset($post['pdf_url'])) ? $post['pdf_url'] : 'empty';

        $other = json_encode($post);
        $forms = json_encode($post['form']);
        
        if($post['transaction_status'] == 'pending'){
            $status = 'waiting';
        } elseif($post['transaction_status'] == 'capture' || $post['transaction_status'] == 'settlement'){
            $status = 'process';
        } elseif($post['transaction_status'] == 'deny' || $post['transaction_status'] == 'cancel' || 
            $post['transaction_status'] == 'expired'){
            $status = 'failed';
        }

        $this->data->query("INSERT INTO `tb_orders` VALUES('{$post['order_id']}', '{$cookie['idCust']}', '{$post['user']['idPro']}', '{$nominal['name']}', '{$nominal['sellPrice']}', '{$post['gross_amount']}', '{$post['user']['nameType']}', '$pdf', '{$post['transaction_id']}', '{$post['transaction_status']}', '$status', '$other', '$forms', NULL, NOW(), NOW())");

        if($this->data->affected_rows > 0){
            $this->notification('New Order ['.$post['order_id'].']', 'new transaction with a value of IDR '.number_format($post['gross_amount'],0,',','.').' With the name of the customer '.$customer.' for '.$product.'.', 'all', urlFlex.'pages/order.edit/'.$post['order_id']);

            echo $post['order_id'];
            exit(0);
        }

        echo 0; exit(0);
    }
}

$action = new Product;
call_user_func_array(array($action, $_GET['mthd']), array(json_decode(file_get_contents('php://input'), true)));