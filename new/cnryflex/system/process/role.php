<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Role extends Core {
    public $goTo = 'pages/role.list';

    public function list()
    {
        parent::__construct('private');
        $sql = $this->data->query("SELECT * FROM tb_roles ORDER BY modified DESC");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $row['users'] = $this->data->query("SELECT count(modified) AS total FROM tb_users WHERE idRole = '{$row['idRole']}'")->fetch_object()->total;
            $data[] = $row;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(array('data' => $data));
        exit(0);
    }

    public function add($post)
    {
        parent::__construct('private');
        parent::privileges('p_role', 'cru');
        $post = parent::clean($post);

        $idRole = ($sql = mysqli_fetch_assoc($this->data->query("SELECT idRole FROM tb_roles ORDER BY idRole DESC LIMIT 1"))) ? $new = 'role-'.date('jnygis').'-'.sprintf('%05d', (intval(substr($sql['idRole'], -5)) + 1)) : 'role-'.date('jnygis').'-00001';

        $this->data->query("INSERT INTO `tb_roles` VALUES('$idRole', '{$post['name']}', '{$post['desc']}', NOW(), NOW())");

        if($this->data->affected_rows > 0){
            $this->log($idRole, 'Add New Role');
            $this->toast('success', 'New role added successfully!', $this->goTo);
        }

        $this->toast('error', 'New role failed to added!', $this->goTo, __FILE__);
    }

    public function edit($post)
    {
        parent::__construct('private');
        parent::privileges('p_role', 'cru');
        $post = parent::clean($post);

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_roles` WHERE `idRole` = '{$post['idRole']}'"));

        if($this->data->query("UPDATE `tb_roles` SET `name` = '{$post['name']}', `desc` = '{$post['desc']}', `modified` = NOW() WHERE `idRole` = '{$post['idRole']}'")){
            $this->log($post['idRole'], 'Edit Role', json_encode($old));
            $this->toast('success', 'Role data has been saved successfully!', $this->goTo);
        }

        $this->toast('error', 'Role data failed to save!', $this->goTo, __FILE__);
    }

    public function delete($post)
    {
        parent::__construct('private');
        parent::privileges('p_role', 'delete');
        $post = parent::clean($post);

        if($post['data'] == 'role-0000000000-00001'){
            echo 0; exit(0);
        }

        $old = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_roles` WHERE `idRole` = '{$post['data']}'"));
        $this->data->query("DELETE FROM `tb_roles` WHERE idRole = '{$post['data']}'");

        if($this->data->affected_rows > 0){
            $this->log($post['data'], 'Delete Role', json_encode($old));
            echo 1; exit(0);
        }

        $this->error('error', 'Role failed to delete!', __FILE__);
        echo 0; exit(0);
    }
}

$action = new Role;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array($_POST));