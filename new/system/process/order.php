<?php require dirname(__FILE__, 3).'/root.php';
require dirBase.'system/main.php';

class Order extends Main {
    public function detail($post)
    {
        parent::__construct();
        $post = parent::clean($post);

        $data = mysqli_fetch_assoc($this->data->query("SELECT tb_orders.*, tb_customers.name as customer, tb_products.name as product, tb_products.img FROM tb_orders, tb_customers, tb_products WHERE tb_orders.idOrder = '{$post['idOrder']}' AND tb_orders.idCust = tb_customers.idCust AND tb_orders.idPro = tb_products.idPro"));

        unset($data['other']);
        $data['created'] = date('d F Y G:i:s', strtotime($data['created']));
        $data['paymentType'] = str_replace("_", " ", $data['paymentType']);

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data);
        exit(0);
    }

    public function message($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(mysqli_fetch_assoc($this->data->query("SELECT `desc` FROM `tb_orders` WHERE idOrder = '{$post['idOrder']}'")));
        exit(0);
    }

    public function testimonial($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);

        $idTes = ($sql = mysqli_fetch_assoc($this->data->query("SELECT idTes FROM `tb_testimonials` ORDER BY idTes DESC LIMIT 1"))) ? 'tes-'.date('jnygis').'-'.sprintf('%05d', (intval(substr($sql['idTes'], -5)) + 1)) : 'tes-'.date('jnygis').'-00001';

        $order = mysqli_fetch_assoc($this->data->query("SELECT `idCust`, `idPro` FROM `tb_orders` WHERE `idOrder` = '{$post['idOrder']}'"));

        $this->data->query("INSERT INTO `tb_testimonials` VALUES('$idTes', '{$post['idOrder']}', '{$order['idCust']}', '{$order['idPro']}', '{$post['testimonial']}', 0, 'n', NOW(), NOW())");

        header('Content-Type: application/json; charset=UTF-8');
        echo ($this->data->affected_rows > 0) ? 1 : 0;
        exit(0);
    }
}

$action = new Order;
call_user_func_array(array($action, $_GET['mthd']), array($_POST));