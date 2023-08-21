<?php session_start();
require dirname(__FILE__, 3).'/root.php';
require dirBase.'system/main.php';

class Message extends Main {
	public $goTo = 'pages/contact';

	public function send($post)
	{
		parent::__construct();
		$post = parent::clean($post);

		try{
			if($_SESSION['captcha'] != $post['captcha']){
				throw new Exception('Karakter Captcha tidak sesuai, silahkan coba kembali!');
			}

			$this->data->query("INSERT INTO tb_messages(`name`, `email`, `phone`, `content`, `created`, `modified`) VALUES('{$post['name']}', '{$post['email']}', '{$post['phone']}', '{$post['content']}', NOW(), NOW())");

			if($this->data->affected_rows > 0){
				$this->toast('success', 'Pesan Anda telah berhasil kami terima!', $this->goTo);
			} else {
				throw new Exception('Pesan gagal kami terima, mohon coba kembali!');	
			}

		} catch(Exception $e){
			toast('error', $e->getMessage(), $this->goTo);
		}

	}
}

$action = new Message;
call_user_func_array(array($action, $_GET['mthd']), array($_POST));