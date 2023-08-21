<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Profile extends Core{
    public $goTo = 'pages/profile.view';

    public function edit($post)
    {
        parent::__construct('private');
        parent::privileges('profile', 'cru');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_users` WHERE `idUser` = '{$post['idUser']}'"));

        if($post['profile']['tmp_name']){
            $img = $post['idUser'].'.'.pathinfo($post['profile']['name'], PATHINFO_EXTENSION);
            $this->upload($post['profile'], dirFlex.'assets/img/profile/'.$img, $this->goTo);
            $this->data->query("UPDATE `tb_users` SET `img` = '$img' WHERE `idUser` = '{$post['idUser']}'");
        }

        if(!empty($post['passOld']) && !empty($post['passNew1'])){
            $passOld = hash('ripemd256', $post['passOld']);
            if($this->data->query("SELECT `name` FROM tb_users WHERE `idUser` = '{$post['idUser']}' AND `password` = '$passOld'")->num_rows){
                if($post['passNew1'] == $post['passNew2']){
                    $password = hash('ripemd256', $post['passNew2']);
                    if(!$this->data->query("UPDATE `tb_users` SET `password` = '$password', `fgtDate` = NOW() WHERE `idUser` = '{$post['idUser']}'")){
                        $this->toast('error', 'An error occurred while updating the password!', $this->goTo, __FILE__);
                    }
                } else {
                    $this->toast('warning', 'New password are not the same!', $this->goTo);
                }
            } else {
                $this->toast('warning', 'Old password incorrect!', $this->goTo);
            }
        }

        if($this->data->query("UPDATE `tb_users` SET `name` = '{$post['name']}', `idNo` = '{$post['idNo']}', `lang` = '{$post['lang']}', `province` = '{$post['province']}', `city` = '{$post['city']}', `address` = '{$post['address']}', `phone` = '{$post['phone']}', `email` = '{$post['email']}' WHERE `idUser` = '{$post['idUser']}'")){
            $this->log($post['email'], 'Edit Profile', json_encode($old));
            $this->toast('success', 'Profile data has been saved successfully!', $this->goTo);
        }

        $this->toast('error', 'Profile data failed to save!', $this->goTo, __FILE__);
    }
}

$action = new Profile;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array(array_merge($_POST, $_FILES)));