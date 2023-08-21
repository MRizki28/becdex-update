<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Setting extends Core{
    public $goTo = 'pages/setting.edit';

    public function edit($post)
    {
        parent::__construct('private');
        parent::privileges('setting', 'cru');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_settings` LIMIT 1"));

        if($post['img']['tmp_name']){
            $img = 'logo.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
            $this->upload($post['img'], dirBase.'assets/img/'.$img, $this->goTo);
            $this->data->query("UPDATE tb_settings SET `img` = '$img' WHERE idSet = 1");
        }

        if($this->data->query("UPDATE tb_settings SET `tagline` = '{$post['tagline']}', `company` = '{$post['company']}', `trademark` = '{$post['trademark']}', `maintenance` = '{$post['maintenance']}', `address` = '{$post['address']}', `email` = '{$post['email']}', `phone` = '{$post['phone']}', `whatsapp` = '{$post['whatsapp']}', `youtube` = '{$post['youtube']}', `facebook` = '{$post['facebook']}', `instagram` = '{$post['instagram']}', `latitude` = '{$post['latitude']}', `longitude` = '{$post['longitude']}', `googleMaps` = '{$post['googleMaps']}', `officeOpen` = '{$post['officeOpen']}', `officeClose` = '{$post['officeClose']}', `desc` = '{$post['desc']}', `modified` = NOW() WHERE idSet = 1")){
            setcookie('company', '', time() - 3600, '/');
            $this->log($post['company'], 'Edit Setting', json_encode($old));
            $this->toast('success', 'Setting data has been saved successfully!', $this->goTo);
        }

        $this->toast('error', 'Setting data failed to save!', $this->goTo, __FILE__);
    }
}

$action = new Setting;
call_user_func_array(array($action, $_GET['method']), array(array_merge($_POST, $_FILES)));