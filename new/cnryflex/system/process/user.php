<?php require dirname(__FILE__, 4).'/root.php';
require dirBase.'vendor/autoload.php';
require dirFlex.'system/core.php';

class User extends Core{
    public $goTo = 'pages/user.list';

    public function list()
    {
        parent::__construct('private');
        $sql = $this->data->query("SELECT tb_users.*, tb_roles.name as role FROM tb_users, tb_roles WHERE tb_users.idRole = tb_roles.idRole ORDER BY tb_users.modified DESC");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            unset($row['password'], $row['key'], $row['fgtToken']);
            $data[] = $row;

        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(array('data' => $data));
        exit(0);
    }

    public function add($post)
    {
        parent::__construct('private');
        parent::privileges('p_user', 'cru');
        $post = parent::clean($post);

        $idUser = ($sql = mysqli_fetch_assoc($this->data->query("SELECT `idUser` FROM `tb_users` ORDER BY `idUser` DESC LIMIT 1"))) ? 'user-'.date('jnygis').'-'.sprintf('%05d', (intval(substr($sql['idUser'], -5)) + 1)) : 'user-'.date('jnygis').'-00001';

        $img = NULL;
        if($post['profile']['tmp_name']){
            $img = $idUser.'.'.pathinfo($post['profile']['name'], PATHINFO_EXTENSION);
            $this->upload($post['profile'], dirFlex.'assets/img/profile/'.$img, $this->goTo);
        }

        if(mysqli_num_rows($this->data->query("SELECT modified FROM tb_users WHERE email = '{$post['email']}' OR phone = '{$post['phone']}'"))){
            $this->toast('warning', 'Email or phone number has been used!', $this->goTo);
        }

        if($post['pass1'] != $post['pass2']){
            $this->toast('warning', 'Password are not the same!', $this->goTo);
        }

        $password = hash('ripemd256', $this->data->real_escape_string(trim($post['pass2'])));
        $insert = $this->data->prepare("INSERT INTO tb_users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL, NOW(), NOW())"); $insert->bind_param('sssssssssssss', $idUser, $post['role'], $img, $post['name'], $post['lang'], $post['idNo'], $post['province'], $post['city'], $post['address'], $post['phone'], $post['email'], $password, $post['status']); $insert->execute();

        if($insert->affected_rows > 0){
            if(isset($post['page'])){
                for($i = 0; $i < count($post['page']); $i++){
                    $this->data->query("INSERT INTO tb_privileges(`idUser`, `namePage`, `type`, `created`) VALUES('$idUser', '{$post['page'][$i]}', '{$post['type'][$i]}', NOW())");
                }
            }
            $this->log($idUser, 'Add New User');
            $this->toast('success', 'New user added successfully!', $this->goTo);
        }

        $this->toast('error', 'New user failed to added!', $this->goTo, __FILE__);
    }

    public function edit($post)
    {
        parent::__construct('private');
        parent::privileges('p_user', 'cru');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_users` WHERE `idUser` = '{$post['idUser']}'"));

        if($post['profile']['tmp_name']){
            $img = $post['idUser'].'.'.pathinfo($post['profile']['name'], PATHINFO_EXTENSION);
            $this->upload($post['profile'], dirFlex.'assets/img/profile/'.$img, $this->goTo);
            $this->data->query("UPDATE `tb_users` SET `img` = '$img' WHERE `idUser` = '{$post['idUser']}'");
        }

        if(!empty($post['pass1']) && !empty($post['pass2'])){
            if($post['pass1'] == $post['pass2']){
                $password = hash('ripemd256', $post['pass2']);
                $this->data->query("UPDATE `tb_users` SET `password` = '$password', `fgtDate` = NOW() WHERE idUser = '{$post['idUser']}'");
            } else {
                $this->toast('warning', 'New password are not the same!', $this->goTo);
            }
        }

        if($this->data->query("UPDATE `tb_users` SET `idRole` = '{$post['role']}', `name` = '{$post['name']}', `idNo` = '{$post['idNo']}', `lang` = '{$post['lang']}', `province` = '{$post['province']}', `city` = '{$post['city']}', `address` = '{$post['address']}', `phone` = '{$post['phone']}', `email` = '{$post['email']}', `status` = '{$post['status']}' WHERE `idUser` = '{$post['idUser']}'")){
            $this->data->query("DELETE FROM `tb_privileges` WHERE `idUser` = '{$post['idUser']}'");
            if(isset($post['page'])){
                for($i = 0; $i < count($post['page']); $i++){
                    $this->data->query("INSERT INTO tb_privileges(`idUser`, `namePage`, `type`, `created`) VALUES('{$post['idUser']}', '{$post['page'][$i]}', '{$post['type'][$i]}', NOW())");
                }
            }
            $this->log($post['idUser'], 'Edit User', json_encode($old));
            $this->toast('success', 'User Data has been saved successfully!', $this->goTo);
        }

        $this->toast('error', 'User data failed to save!', $this->goTo, __FILE__);
    }

    public function check($post)
    {
        $post = parent::clean($post);
        echo (mysqli_num_rows($this->data->query("SELECT modified FROM `{$post['table']}` WHERE `{$post['field']}` = '{$post['value']}'"))) ? 'no' : 'yes';
    }

    public function pass($post)
    {
        if(strlen($post['pass1']) >= 8 && strlen($post['pass2']) >= 8){
            echo ($post['pass1'] == $post['pass2']) ? 'yes' : 'no';
        }
    }

    public function login($post)
    {
        session_start();
        parent::__construct('public');
        $post = parent::clean($post);

        if($post['captcha'] == $_SESSION['captcha']){
            $password = hash('ripemd256', $post['password']);
            if($user = mysqli_fetch_assoc($this->data->query("SELECT tb_users.email, tb_users.idUser, tb_users.status, tb_users.name as nameUser, tb_roles.idRole, tb_roles.name AS `role` FROM tb_users, tb_roles WHERE `email` = '{$post['email']}' AND `password` = '$password' AND tb_roles.idRole = tb_users.idRole")))
            {
                if($user['status'] == 'blocked'){
                    echo 'blocked'; 
                    unset($user);
                    exit(0);
                }

                $key = substr(md5(mt_rand()), 0, 10);
                $token = $this->token($key, $user['idUser'], $user['idRole']);
                $this->data->query("UPDATE tb_users SET `key` = '$key' WHERE idUser = '{$user['idUser']}'");

                setcookie('clientId', 'CNRY-004', $this->cookie_options);
                setcookie('email', $user['email'], $this->cookie_options);
                setcookie('idUser', $user['idUser'], $this->cookie_options);
                setcookie('idRole', $user['idRole'], $this->cookie_options);
                setcookie('user', $user['nameUser'], $this->cookie_options);
                setcookie('role', $user['role'], $this->cookie_options);
                setcookie('access', $token, $this->cookie_options);
                setcookie('developerMode', 'COPY HERE', $this->cookie_options);

                $_COOKIE['idUser'] = $user['idUser'];
                $Browser = new foroco\BrowserDetection();
                $this->log('Login', 'Login as '.$user['role'], $Browser->getAll($_SERVER['HTTP_USER_AGENT'], 'JSON'));
                echo 1; exit(0);
            }
        }

        $_SESSION['captcha'] = substr(md5(mt_rand()), 0, 4);
        echo 0;
    }

    public function delete($post)
    {
        parent::__construct('private');
        parent::privileges('p_user', 'delete');
        $post = parent::clean($post);

        if($post['data'] == 'user-0000000000-00001'){
            echo 0; exit(0);
        }

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_users` WHERE `idUser` = '{$post['data']}'"));
        $this->data->query("DELETE FROM `tb_users` WHERE `idUser` = '{$post['data']}'");

        if($this->data->affected_rows > 0){
            if(!empty($old['img'])) unlink(dirBase.'assets/img/profile/'.$old['img']);
            $this->log($post['data'], 'Delete User', json_encode($old));
            echo 1; exit(0);
        }

        $this->error('error', 'User failed to delete!', __FILE__);
        echo 0; exit(0);
    }
}

$action = new User;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array(array_merge($_POST, $_FILES)));