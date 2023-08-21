<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class More extends Core {
    public $goTo = 'pages/more.list';

    public function list()
    {
        parent::__construct('private');
        $sql = $this->data->query("SELECT * FROM `tb_moreContents`");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(array('data' => $data));
        exit(0);
    }

    public function add($post)
    {
        parent::__construct('private');
        parent::privileges('more', 'cru');
        $post = parent::clean($post);

        $idMore = ($sql = mysqli_fetch_assoc($this->data->query("SELECT `idMore` FROM `tb_moreContents` ORDER BY `idMore` DESC LIMIT 1"))) ? $new = 'more-'.date('jnygis').'-'.sprintf('%05d', (intval(substr($sql['idMore'], -5)) + 1)) : 'more-'.date('jnygis').'-00001';

        $img = NULL;
        if($post['img']['tmp_name']){
            $img = $idMore.'.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
            $this->upload($post['img'], dirBase.'assets/img/'.$img, $this->goTo);
        }

        $this->data->query("INSERT INTO `tb_moreContents` VALUES('$idMore', '$img', '{$post['title']}', '{$post['content']}', '{$post['visibility']}', NOW(), NOW())");

        if($this->data->affected_rows === 1){
            $this->log($idMore, 'Add More Content');
            $this->toast('success', 'New more content added successfully!', $this->goTo);
        } else {
            $this->toast('error', 'New more content failed to added!', $this->goTo, __FILE__);
        }
    }

    public function edit($post)
    {
        parent::__construct('private');
        parent::privileges('more', 'cru');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_moreContents` WHERE `idMore` = '{$post['idMore']}'"));

        if($post['img']['tmp_name']){
            $img = $post['idMore'].'.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
            $this->upload($post['img'], dirBase.'assets/img/'.$img, $this->goTo);
            $this->data->query("UPDATE `tb_moreContents` SET `img` = '$img' WHERE `idMore` = '{$post['idMore']}'");
        }

        if($this->data->query("UPDATE `tb_moreContents` SET `title` = '{$post['title']}', `content` = '{$post['content']}', `visibility` = '{$post['visibility']}' WHERE `idMore` = '{$post['idMore']}'")){
            $this->log($post['idMore'], 'Edit More Content', json_encode($old));
            $this->toast('success', 'More content has been saved successfully!', $this->goTo);
        } else {
            $this->toast('error', 'More content failed to save!', $this->goTo, __FILE__);
        }
    }
}

$action = new More;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array(array_merge($_POST, $_FILES)));