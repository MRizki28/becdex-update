<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Errors extends Core {
    public $goTo = 'pages/error.list';

    public function list()
    {
        parent::__construct('protected');
        $sql = $this->data->query("SELECT * FROM `tb_errors` ORDER BY `modified` DESC");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(array('data' => $data));
        exit(0);
    }

    public function edit($post)
    {
        parent::__construct('protected');
        $post = parent::clean($post);

        $this->data->query("UPDATE `tb_errors` SET `status` = '{$post['status']}', `desc` = '{$post['desc']}' WHERE `idErr` = '{$post['idErr']}'");

        if($this->data->affected_rows > 0) $this->toast('success', 'Error data has been saved successfully!', $this->goTo); 

        $this->toast('error', 'Error data has failed to save!', $this->goTo, __FILE__);
    }
}

$action = new Errors;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array($_POST));