<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Developer extends Core {
    public $goTo = 'pages/overview';

    public function turnOff()
    {
        parent::__construct('private');
        setcookie('developerMode', 'HERE', time() + (6 * 30 * 24 * 3600), '/', null, null, true);
    }
}

$action = new Developer;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array($_POST));