<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class General extends Core {

    public function cities($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);
        $sql = $this->data->query("SELECT `id`,`name` FROM `tb_cities` WHERE province_id = '{$post['province']}'");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data);
        return false;
    }
}

$action = new General;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array($_POST));