<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class SubPage extends Core {
    public $goTo = 'pages/subpage.list';

    public function list()
    {
        parent::__construct('private');
        $sql = $this->data->query("SELECT tb_subpages.*, tb_pages.name as mainPage FROM `tb_subpages`, `tb_pages` WHERE tb_subpages.idPage = tb_pages.idPage ORDER BY tb_subpages.modified DESC");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(array('data' => $data));
        exit(0);
    }

    public function goUp($post)
	{
		parent::__construct('private');
		$post = parent::clean($post);

		$order = $this->data->query("SELECT `order` FROM `tb_subpages` WHERE `idSubPage` = '{$post['idSubPage']}'")->fetch_row()[0] + 1; $this->data->query("UPDATE `tb_subpages` SET `order` = '$order' WHERE idSubPage = '{$post['idSubPage']}'");
		echo 1;
		exit(0);
	}

	public function goDown($post)
	{
		parent::__construct('private');
		$post = parent::clean($post);

		$order = $this->data->query("SELECT `order` FROM `tb_subpages` WHERE `idSubPage` = '{$post['idSubPage']}'")->fetch_row()[0] - 1; $this->data->query("UPDATE `tb_subpages` SET `order` = '$order' WHERE idSubPage = '{$post['idSubPage']}'");
		echo 1;
		exit(0);
	}

    public function add($post)
    {
        parent::__construct('private');
        parent::privileges('p_subpage', 'cru');
        $post = parent::clean($post);

        $idSubPage = ($sql = mysqli_fetch_assoc($this->data->query("SELECT `idSubPage` FROM `tb_subpages` ORDER BY `idSubPage` DESC LIMIT 1"))) ? $new = 'sub-'.date('jnygis').'-'.sprintf('%05d', (intval(substr($sql['idSubPage'], -5)) + 1)) : 'sub-'.date('jnygis').'-00001';

        $img = NULL;
        if($post['img']['tmp_name']){
            $img = $idSubPage.'.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
            $this->upload($post['img'], dirBase.'assets/img/services/'.$img, $this->goTo);
        } else {
            $this->toast('warning', 'Page image cannot be empty!', $this->goTo);
        }

        $icon = NULL;
        if($post['icon']['tmp_name']){
            $icon = $idSubPage.'.'.pathinfo($post['icon']['name'], PATHINFO_EXTENSION);
            $this->upload($post['icon'], dirBase.'assets/img/services/icons/'.$icon, $this->goTo);
        } else {
            $this->toast('warning', 'Service icon cannot be empty!', $this->goTo);
        }

        $content = htmlentities($post['content']);
        $url = str_replace(' ', '-', preg_replace("/[^A-Za-z0-9- ]\s+/", '', strtolower($post['title'])));
        $this->data->query("INSERT INTO `tb_subPages` VALUES('$idSubPage', '{$post['idPage']}', 0, '$img', '$icon', '$url', '{$post['title']}', '$content', '{$post['desc']}', '{$post['visibility']}', NOW(), NOW())");

        if($this->data->affected_rows === 1){
            $this->log($idSubPage, 'Add New Sub Page');
            $this->toast('success', 'New sub page added successfully!', $this->goTo);
        } else {
            $this->toast('error', 'New sub page failed to added!', $this->goTo, __FILE__);
        }
    }

    public function edit($post)
    {
        parent::__construct('private');
        parent::privileges('p_subpage', 'cru');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_subpages` WHERE `idSubPage` = '{$post['idSubPage']}'"));

        if($post['img']['tmp_name']){
            $img = $post['idSubPage'].'.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
            $this->upload($post['img'], dirBase.'assets/img/services/'.$img, $this->goTo);
            $this->data->query("UPDATE `tb_subpages` SET `img` = '$img' WHERE `idSubPage` = '{$post['idSubPage']}'");
        }

        if($post['icon']['tmp_name']){
            $icon = $post['idSubPage'].'.'.pathinfo($post['icon']['name'], PATHINFO_EXTENSION);
            $this->upload($post['icon'], dirBase.'assets/img/services/icons/'.$icon, $this->goTo);
            $this->data->query("UPDATE `tb_subpages` SET `icon` = '$icon' WHERE `idSubPage` = '{$post['idSubPage']}'");
        }

        $content = htmlentities($post['content']);
        $url = str_replace(' ', '-', preg_replace("/[^A-Za-z0-9- ]\s+/", '', strtolower($post['title'])));
        if($this->data->query("UPDATE `tb_subpages` SET `idpage` = '{$post['idPage']}', `url` = '$url', `title` = '{$post['title']}', `content` = '$content', `desc` = '{$post['desc']}', `visibility` = '{$post['visibility']}', `modified` = NOW()WHERE `idSubPage` = '{$post['idSubPage']}'")){
            $this->log($post['idSubPage'], 'Edit Sub Page', json_encode($old));
            $this->toast('success', 'Sub page data has been saved successfully!', $this->goTo);
        } else {
            $this->toast('error', 'Sub page data failed to saved!', $this->goTo, __FILE__);
        }
    }

    public function insertImage($post)
    {
        parent::__construct('private');
        parent::privileges('p_subpage', 'cru');
        $post = parent::clean($post);

        if($post['upload']['tmp_name']){
            $img = rand().'.'.pathinfo($post['upload']['name'], PATHINFO_EXTENSION);
            $this->upload($post['upload'], dirBase.'assets/img/services/contents/'.$img, $this->goTo);

            $funcNumber = $_GET['CKEditorFuncNum'];
            $url = urlBase.'assets/img/services/contents/'.$img;
            $message = '';

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('$funcNumber', '$url', '$message');</script>";
        } else {
            echo 'there is no upload!';
        }
    }

    public function delete($post){
        parent::__construct('private');
        parent::privileges('p_subpage', 'delete');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_subpages` WHERE `idSubPage` = '{$post['data']}'"));
        $this->data->query("DELETE FROM `tb_subpages` WHERE `idSubPage` = '{$post['data']}'");

        if($this->data->affected_rows === 1){
            $this->log($post['data'], 'Delete Sub Page', json_encode($old));
            echo 1; exit(0);
        }

        $this->error('error', 'Sub page failed to delete!', __FILE__);
        echo 0; exit(0);
    }
}

$action = new SubPage;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array(array_merge($_POST, $_FILES)));