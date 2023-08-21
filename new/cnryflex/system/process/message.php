<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Message extends Core {
	public $goTo = 'pages/nominal.list';

    public function list()
    {
        parent::__construct('private');
        $sql = $this->data->query("SELECT * FROM `tb_messages` ORDER BY `modified` DESC");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(array('data' => $data));
        exit(0);
    }
}

$action = new Message;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array($_POST));