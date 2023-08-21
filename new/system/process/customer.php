<?php session_start();
require dirname(__FILE__, 3).'/root.php';
require dirBase.'system/main.php';

class Customer extends Main {
    public function register($post)
    {
        parent::__construct('public');
        $post = parent::clean($post);

        try {
            if($post['captcha'] != $_SESSION['captcha']){
                throw new Exception('Karakter Captcha tidak sesuai, silahkan coba kembali!');
            }

            if(mysqli_num_rows($this->data->query("SELECT `name` FROM `tb_customers` WHERE `email` = '{$post['email']}'"))){
                throw new Exception('Alamat email tidak dapat digunakan!');
            }

            $password = hash('ripemd256', $post['password']);
            $idCust = ($sql = mysqli_fetch_assoc($this->data->query("SELECT `idCust` FROM `tb_customers` ORDER BY `idCust` DESC LIMIT 1"))) ? 'cust-'.date('jnygis').'-'.sprintf('%05d', (intval(substr($sql['idCust'], -5)) + 1)) : 'cust-'.date('jnygis').'-00001';

            $this->data->query("INSERT INTO `tb_customers` VALUES('$idCust', NULL, '{$post['name']}', '{$post['phone']}', '{$post['email']}', '$password', NULL, NULL, NULL, NULL, NOW(), NOW())");

            if($this->data->affected_rows > 0){
                $this->toast("success", "Registrasi berhasil, silahkan cek email untuk verifikasi!", 'process/email/register/'.$idCust);
            } else {
                throw new Exception('Registrasi gagal, silahkan mencoba kembali!');
            }
        } catch (Exception $e){
            $this->toast('error', $e->getMessage(), 'pages/register');
        }
    }
    
    public function login($post)
    {
        parent::__construct('public');
        $post = parent::clean($post);

        $password = hash('ripemd256', $post['password']);

        if($cust = mysqli_fetch_assoc($this->data->query("SELECT `idCust` FROM `tb_customers` WHERE `email` = '{$post['email']}' AND `password` = '$password'"))){
            $key = substr(md5(mt_rand()), 0, 10);
            $token = $this->token2($key, $cust['idCust']);
            $this->data->query("UPDATE `tb_customers` SET `key` = '$key' WHERE idCust = '{$cust['idCust']}'");

            setcookie('idCust', $cust['idCust'], time() + (6 * 30 * 24 * 3600), '/', null, null, true);
            setcookie('accessCust', $token, time() + (6 * 30 * 24 * 3600), '/', null, null, true);
            $this->toast("success", "Selamat Datang!", 'pages/dashboard');
        }

        $this->toast("error", "Email atau kata sandi tidak sesuai, silahkan coba kembali", 'pages/login');
    }

    public function forgot($post)
    {
        parent::__construct('public');
        $post = parent::clean($post);

        try {
            if($_SESSION['captcha'] != $post['captcha']){
                throw new Exception('Karakter Captcha tidak sesuai, silahkan coba kembali!');
            }

            if(!mysqli_num_rows($this->data->query("SELECT `created` FROM `tb_customers` WHERE `email` = '{$post['email']}'"))){
                throw new Exception('Alamat email tidak ditemukan!');
            }

            if($this->data->affected_rows > 0){
                $this->toast('success', 'Cek email Anda untuk atur ulang kata sandi!', 'process/email/forgot/'.$post['email']);
            }

        } catch (Exception $e){
            $this->toast('error', $e->getMessage(), 'pages/forgot');
        }
    }

    public function reset($post)
    {
        parent::__construct('public');
        $post = parent::clean($post);

        try{
            if(!mysqli_num_rows($this->data->query("SELECT `created` FROM `tb_customers` WHERE `fgtToken` = '{$post['token']}' AND `idCust` = '{$post['idCust']}'"))){
                throw new Exception('Data tidak sesuai, gagal atur ulang kata sandi!');
            }

            if($post['password1'] != $post['password2']){
                throw new Exception('Kata sandi tidak sama!');
            }

            $password = hash('ripemd256', $post['password2']);
            $this->data->query("UPDATE `tb_customers` SET `fgtToken` = NULL, `password` = '$password' WHERE `idCust` = '{$post['idCust']}'");

            if($this->data->affected_rows > 0){
                $this->toast('success', 'Atur ulang kata sandi berhasil, silahkan login!', 'pages/login');
            } else {
                throw new Exception('Gagal atur ulang kata sandi, silahkan hubungi kami untuk bantuan!');
            }

        } catch (Exception $e){
            $this->toast('error', $e->getMessage(), 'pages/reset');
        }
    }

    public function edit($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);
        $cookie = parent::clean($_COOKIE);

        try {
            if($post['password1'] != $post['password2']) {
                throw new Exception('Kata sandi baru tidak sama!');
            }

            if(!empty($post['password1']) && !empty($post['password2'])){
                $password = hash('ripemd256', $post['password2']);
                $this->data->query("UPDATE `tb_customers` SET `password` = '$password' WHERE `idCust` = '{$cookie['idCust']}'");

                if($this->data->affected_rows <= 0){
                    throw new Exception("Terjadi kesalahan saat ubah kata sandi, silahkan coba kembali!");
                }
            }

            if($post['img']['tmp_name']){
                $img = $cookie['idCust'].'.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
                $this->compressImg($post['img']['tmp_name'], dirBase.'assets/img/customers/'.$img, 80);
                $this->data->query("UPDATE `tb_customers` SET `img` = '$img' WHERE `idCust` = '{$cookie['idCust']}'");
            }

            $check = mysqli_fetch_assoc($this->data->query("SELECT `email` FROM `tb_customers` WHERE `idCust` = '{$cookie['idCust']}'"));

            if($check['email'] == $post['email']){
                if($this->data->query("UPDATE `tb_customers` SET `name` = '{$post['name']}', `phone` = '{$post['phone']}' WHERE `idCust` = '{$cookie['idCust']}'")){
                    $this->toast('success', 'Ubah profil berhasil!', 'pages/profile.edit');
                } else {
                    throw new Exception('Terjadi kesalahan saat ubah profil, silahkan coba kembali!');
                }
            } else {
                $this->data->query("UPDATE `tb_customers` SET `name` = '{$post['name']}', `phone` = '{$post['phone']}', `email` = '{$post['email']}'  WHERE `idCust` = '{$cookie['idCust']}'");

                if($this->data->affected_rows > 0){
                    $this->toast('success', 'Ubah profil berhasil cek email baru Anda untuk verifikasi', 'process/email/new/'.$post['email']);
                } else {
                    throw new Exception('terjadi kesalahan saat ubah profil, silahkan coba kembali');
                }
            }
 
        } catch (Exception $e){
            $this->toast('error', $e->getMessage(), 'pages/dashboard');
        }
    }

    public function checkEmail($post)
    {
        parent::__construct(); $post = parent::clean($post);
        echo mysqli_num_rows($this->data->query("SELECT `created` FROM `tb_customers` WHERE `email` = '{$post['email']}'"));
    }
}

$action = new Customer;
call_user_func_array(array($action, $_GET['mthd']), array(array_merge($_POST, $_FILES)));