<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class MainPage extends Core {
	public $goTo = 'pages/mainpage.list';

	public function list()
	{
		parent::__construct('private');
		$sql = $this->data->query("SELECT * FROM `tb_pages` ORDER BY `modified` DESC");

		$data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(array('data' => $data));
        exit(0);
	}

	public function goUp($post)
	{
		parent::__construct('private');
		$post = parent::clean($post);

		$order = $this->data->query("SELECT `order` FROM `tb_pages` WHERE `idPage` = '{$post['idPage']}'")->fetch_row()[0] + 1; $this->data->query("UPDATE `tb_pages` SET `order` = '$order' WHERE idPage = '{$post['idPage']}'");
		echo 1;
		exit(0);
	}

	public function goDown($post)
	{
		parent::__construct('private');
		$post = parent::clean($post);

		$order = $this->data->query("SELECT `order` FROM `tb_pages` WHERE `idPage` = '{$post['idPage']}'")->fetch_row()[0] - 1; $this->data->query("UPDATE `tb_pages` SET `order` = '$order' WHERE idPage = '{$post['idPage']}'");
		echo 1;
		exit(0);
	}

	public function add($post)
	{
		parent::__construct('private');
		parent::privileges('p_subpage', 'cru');
		$post = parent::clean($post);

		$idPage = ($sql = mysqli_fetch_assoc($this->data->query("SELECT `idPage` FROM `tb_pages` ORDER BY `idPage` DESC LIMIT 1"))) ? $new = 'page-'.date('jnygis').'-'.sprintf('%05d', (intval(substr($sql['idPage'], -5)) + 1)) : 'page-'.date('jnygis').'-00001';

		$img = NULL;
		if($post['img']['tmp_name']){
			$img = $idPage.'.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
			$this->upload($post['img'], dirBase.'assets/img/pages/'.$img, $this->goTo);
		}

		$content = htmlentities($post['content']);
		$this->data->query("INSERT INTO tb_pages VALUES('$idPage', 0, '$img', '{$post['name']}', '{$post['onMenu']}', '{$post['url']}', '{$post['section']}', '{$post['title']}', '$content', '{$post['desc']}', '{$post['parent']}', '{$post['visibility']}', NOW(), NOW())");

		if($this->data->affected_rows > 0){
			$this->log($post['name'], 'Add New Page');
			$this->toast('success', 'New web page added successfully!', $this->goTo);
		}

		$this->toast('error', 'New web page failed to added!', $this->goTo, __FILE__);
	}

	public function edit($post)
	{
		parent::__construct('private');
		parent::privileges('p_subpage', 'cru');
		$post = parent::clean($post);

		$old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_pages` WHERE idPage = '{$post['idPage']}'"));

		if($post['img']['tmp_name']){
			$img = $post['idPage'].'.'.pathinfo($post['img']['name'], PATHINFO_EXTENSION);
			$this->upload($post['img'], dirBase.'assets/img/pages/'.$img, $this->goTo);
			$this->data->query("UPDATE `tb_pages` SET `img` = '$img' WHERE `idPage` = '{$post['idPage']}'");
		}

		$content = htmlentities($post['content']);
		if($this->data->query("UPDATE `tb_pages` SET `name` = '{$post['name']}', `onMenu` = '{$post['onMenu']}', `url` = '{$post['url']}', `section` = '{$post['section']}', `title` = '{$post['title']}', `content` = '$content', `desc` = '{$post['desc']}', `parent` = '{$post['parent']}', `visibility` = '{$post['visibility']}' WHERE `idPage` = '{$post['idPage']}'")){
			$this->log($post['name'], 'Edit Page', json_encode($old));
			$this->toast('success', 'Page data has been saved successfully!', $this->goTo);
		}

		$this->toast('error', 'Page data failed to save!', $this->goTo, __FILE__);
	}

	public function delete($post)
	{
		parent::__construct('private');
		parent::privileges('p_subpage', 'delete');
		$post = parent::clean($post);

		$old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_pages` WHERE idPage = '{$post['data']}'"));
		$this->data->query("DELETE FROM `tb_pages` WHERE idPage = '{$post['data']}'");

		if($this->data->affected_rows > 0){
			$this->log($old['name'], 'Delete Page', json_encode($old));
			echo 1; exit(0);
		}

		$this->error('error', 'Page failed to delete!', __FILE__);
		echo 0; exit(0);
	}
}

$action = new MainPage;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array(array_merge($_POST, $_FILES)));