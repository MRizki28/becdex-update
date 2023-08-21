<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Why extends Core {
    public $goTo = 'pages/why.edit';

    public function edit($post)
    {
        parent::__construct('private');
        parent::privileges('why', 'cru');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_why` WHERE idWhy = 1"));
        if($this->data->query("UPDATE `tb_why` SET `title` = '{$post['title']}', `content` = '{$post['content']}', `visibility` = '{$post['visibility']}' WHERE `idWhy` = 1")){
            $this->log($post['title'], 'Edit Why', json_encode($old));
            $this->toast('success', 'Why data has been saved successfully!', $this->goTo);
        } else {
            $this->toast('error', 'Why data failed to saved!', $this->goTo, __FILE__);
        }
    }
}

$action = new Why;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array($_POST));