<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Log extends Core {

    public function list($post)
    {
        parent::__construct('private');
        parent::privileges('p_log', 'cru');
        $post = parent::clean($post);

        $sql = (!empty($post['from']) && !empty($post['to'])) ? $this->data->query(($post['options'] == 'all') ? "SELECT tb_logs.*, tb_users.name AS `name` FROM tb_logs, tb_users WHERE tb_logs.idUser = tb_users.idUser AND DATE(tb_logs.created) BETWEEN '".date("Y-m-d", strtotime($post['from']))."' AND '".date("Y-m-d", strtotime($post['to']))."' ORDER BY `created` DESC" : "SELECT tb_logs.*, tb_users.name AS `name` FROM tb_logs, tb_users WHERE tb_logs.idUser = tb_users.idUser AND tb_logs.idUser = '{$post['options']}' AND DATE(tb_logs.created) BETWEEN '".date("Y-m-d", strtotime($post['from']))."' AND '".date("Y-m-d", strtotime($post['to']))."' ORDER BY `created` DESC") : $this->data->query(($post['options'] == 'all') ? "SELECT tb_logs.*, tb_users.name AS `name` FROM tb_logs, tb_users WHERE tb_logs.idUser = tb_users.idUser ORDER BY `created` DESC" : "SELECT tb_logs.*, tb_users.name AS `name` FROM tb_logs, tb_users WHERE tb_logs.idUser = tb_users.idUser AND tb_logs.idUser = '{$post['options']}' ORDER BY `created` DESC");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(array('data' => $data));
        exit(0);
    }
}

$action = new Log;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array(array_merge($_POST, $_GET)));