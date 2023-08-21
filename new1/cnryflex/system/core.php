<?php require dirBase.'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Core {
    public $data, $type, $cookie_options;

    public function __call($meth, $args)
    {
        $this->toast('warning', 'Method not found!: '.$meth, 'pages/overview');
    }

    public function readenv($file){
        $lines = file($file);
        foreach($lines as $line){
            list($name, $value) = explode('=', $line, 2);
            putenv(sprintf('%s=%s', trim($name), trim($value)));
        }
    }

    public function token($key, $user, $role)
    {
        $this->readenv(dirFlex.'.env');
        return hash('ripemd256', $key.crc32($user.$role).getenv('TOKEN'));
    }

    public function __construct($type = NULL)
    {
        $this->connect();
        $this->type = $type;
        $this->cookie_options = array(
            'expires' => time() + (6 * 30 * 24 * 3600),
            'path' => '/',
            'domain' => $_SERVER['SERVER_NAME'],
            'secure' => false,
            'httponly' => true
        );

        if($type == 'public'){
            if(isset($_COOKIE['idUser']) && isset($_COOKIE['idRole'])){
                header("Location: ".urlFlex.'pages/overview');
                exit(0);
            }
        } else if($type == 'private' || $type == 'protected'){
            if($this->data->connect_error){
                $this->toast('', '', 'pages/logout');
                exit(0);
            }

            if(isset($_COOKIE['idUser']) && isset($_COOKIE['idRole'])){
                $sql = mysqli_fetch_assoc($this->data->query("SELECT `key` FROM `tb_users` WHERE idUser = '{$_COOKIE['idUser']}'"));
                $token = $this->token($sql['key'], $_COOKIE['idUser'], $_COOKIE['idRole']);

                if($token != $_COOKIE['access']){
                    header("Location: ".urlFlex.'pages/logout');
                    exit(0);
                }
            } else {
                if(isset($_SERVER['HTTP_COOKIE'])){
                    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                    foreach($cookies as $cookie){
                        $parts = explode('=', $cookie);
                        $name = trim($parts[0]);
                        if($name != 'PHPSESSID'){
                            setcookie($name, '', time() - 3600, '/');
                        }
                    }
                }
                header("Location: ".urlFlex);
                exit(0);
            }
        }
    }

    public function connect()
    {
        $this->readenv(dirFlex.'.env');
        $this->data = new mysqli(getenv('DB_SERVER'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    }

    public function clean($post)
    {
        return array_map(function($p){ return (is_array($p)) ? array_map(array($this->data, 'real_escape_string'), $p) : $this->data->real_escape_string($p); }, $post);
    }

    public function privileges($name, $for)
    {
        $sql = mysqli_fetch_assoc($this->data->query("SELECT `type` FROM tb_privileges WHERE namePage = '$name' AND idUser = '{$_COOKIE['idUser']}'"));

        if(($for == 'cru' && $sql['type'] == 'read') || ($for == 'delete' && $sql['type'] != 'all')){
            $this->toast('warning', "Don't have permission for that action.", 'pages/overview');
        }
        return $sql['type'];
    }

    public function log($target, $desc, $old = NULL)
    {
        $ip = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

        $this->data->query("INSERT INTO tb_logs(`idUser`, `ip`, `target`, `desc`, `old`, `created`) VALUES('{$_COOKIE['idUser']}', '$ip', '$target', '$desc', '$old', NOW())");
    }

	public function open(array $set, $css = [], $js = [])
    {
        if(!isset($_COOKIE['company']) || !isset($_COOKIE['trademark'])){
            $sql = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_settings` LIMIT 1"));

            setcookie('tagline', $sql['tagline'], $this->cookie_options);
            setcookie('company', $sql['company'], $this->cookie_options);
            setcookie('trademark', $sql['trademark'], $this->cookie_options);

            $_COOKIE['tagline'] = $sql['tagline'];
            $_COOKIE['company'] = $sql['company'];
            $_COOKIE['trademark'] = $sql['trademark'];
        }

        echo "<!DOCTYPE HTML><html lang='en'><head>
        <meta charset='UTF-8'/>
        <meta name='language' content='en'/>
        <meta name='title' content='".$_COOKIE['trademark']."'/>
        <meta name='description' content='Cnryflex. Content Management System for all purposes.'/>
        <meta name='author' content='conary.id'/>
        <meta name='robots' content='noindex nofollow'/>
        <meta name='googlebot' content='noindex nofollow'/>
        <meta name='google' content='notranslate'/>
        <meta name='theme-color' content='#ffffff'/>
        <meta name='msapplication-TileColor' content='#ffffff'/>
        <meta name='apple-mobile-web-app-status-bar' content='#ffffff'/>
        <meta name='apple-mobile-web-app-capable' content='yes'/>
        <meta name='mobile-web-app-capable' content='yes'/>
        <meta http-equiv='X-AU-Compatible' content='IE=edge, chrome=1'/>
        <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'/>
        <title>", $_COOKIE['trademark'], ' | ', $set[1], " | Cnryflex.</title>

        <link rel='manifest' href='".urlFlex."manifest.json'/>
        <link rel='icon' type='image/png' href='".urlFlex."assets/img/favicon/icon-72x72.png'/>
        <link rel='apple-touch-icon' href='".urlFlex."assets/img/favicon/icon-96x96.png'/>

        <link rel='stylesheet' href='".urlFlex."assets/css/standard.css'/>
        <link rel='stylesheet' href='".urlFlex."assets/css/lib/balloon.css'/>
        <link rel='stylesheet' href='".urlFlex."assets/css/pages.css'/>

        <script src='".urlFlex."assets/js/lib/jquery.js'></script>
        <script src='".urlFlex."assets/js/lib/moment.js'></script>
        <script src='".urlFlex."assets/js/lib/sweet.js'> </script>
        <script src='".urlFlex."assets/js/standard.js'>  </script>";

        if(!empty($css)){
            foreach($css as $file){
                echo "<link rel='stylesheet' href='".urlFlex."assets/css/$file.css'/>";
            }
        }

        if(!empty($js)){
            foreach($js as $file){
                echo "<script src='".urlFlex."assets/js/$file.js'></script>";
            }
        }

        if($this->type == 'public'){
            echo '</head><body>';
        } elseif($this->type == 'protected'){
            if($_COOKIE['developerMode'] != $_COOKIE['access'] || $_COOKIE['idRole'] != 'role-0000000000-00001'){ $this->toast('warning', "Don't have access to that area!", 'pages/overview'); } require dirFlex.'system/parts/header.php';
        } elseif($this->type == 'private'){
            if(!mysqli_num_rows($this->data->query("SELECT created FROM tb_privileges WHERE namePage = '{$set[0]}' AND idUser = '{$_COOKIE['idUser']}'"))){ if($set[0] == 'p_overview'){ $this->toast('', '', 'pages/profile.view'); } $this->toast('warning', "Don't have access to that area!", 'pages/overview'); } require dirFlex.'system/parts/header.php';
        }
    }

    public function close()
    {
        if($this->data->connect_error){
            echo "<div class='cx-noDb'>Connection to database failed: ".$this->data->connect_error."'</div>";
        }

        $time_end = microtime(true);
        if($this->type == 'public'){
            echo "<script src='".urlFlex."assets/js/app.js'></script></section></body></html>";
            $this->data->close();
            exit(0);
        }

        echo "<footer> <div class='left'><span class='copy'>&copy; ", date("Y"), ' by Conary.', "<br/> Made in Bogor, Indonesia</span> <a target='_blank' href='https://conary.id/clients/docs/", $_COOKIE['clientId'], "'><i class='micon' aria-label='User Manual' data-balloon-pos='up'>lightbulb</i></a></div><div class='right'><div class='execution'>Execution Time: ", round(($time_end - time_start) * 1000), " ms</div><div class='version' pop-target='version' aria-label='Release Notes' data-balloon-pos='up'>Version 0.1</div><a href='javascript:void(0)' open-feedback aria-label='Feedback' data-balloon-pos='left'><i class='micon'>feedback</i></a></div></footer><script src='".urlFlex."assets/js/app.js'></script></section></body></html>";
        $this->data->close();
    }

    public function formTitle($icon, $title)
    {
        $ip = getenv('HTTP_CLIENT_IP')?: getenv('HTTP_X_FORWARDED_FOR')?: getenv('HTTP_X_FORWARDED')?: getenv('HTTP_FORWARDED_FOR')?: getenv('HTTP_FORWARDED')?: getenv('REMOTE_ADDR');

        echo "<div class='top'>
            <span class='title'><i class='micon'>$icon</i> $title</span>
            <div class='left'>".$this->breadcrumb()."</div>
            <div class='right'>".date('d F Y')." ($ip)</div>
        </div>";
    }

    public function modified($created, $modified, $link)
    {
        echo "<div class='dates'>
            <div><i class='micon'>add_alarm</i><span><b>Created</b>
            ".date('d F Y', strtotime($created))."</span></div>

            <div><i class='micon'>update</i><span><b>Modified</b>
            ".date('d F Y', strtotime($modified))."</span></div>
            <a href=".urlFlex.'pages/log.list/'.$link."><i class='micon'>note_alt</i></a>
        </div>";
    }

    public function breadcrumb()
    {
        $result = "";
        $bread = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        unset($bread[2]);
        foreach($bread as $k => $crumb){
            if($k >= 1){
                $reverse = str_replace('.', ' ', implode('.', array_reverse(explode('.', $crumb))));
                $result .= '<span>'.ucwords($reverse). '</span><i class="micon">arrow_right</i>';
            }
        }

        return substr($result, 0, -39);
    }

    public function upload($source, $destination, $link, $quality = 80)
    {
        if(!in_array($source['type'], array('image/jpeg', 'image/png', 'video/webm', 'video/mp4', 'image/gif', 'application/pdf', 'application/excel')) || $source['size'] > 31457280){
            $this->toast('warning', 'Data type or file size exceeds the rule!', $link);
        }

        if(preg_match('/image\/*/',$source['type'])){
            $info = getimagesize($source['tmp_name']);
            if ($info['mime'] == 'image/jpeg'){
                $image = imagecreatefromjpeg($source['tmp_name']);
                imagejpeg($image, $destination, $quality);
            } else if ($info['mime'] == 'image/png'){
                $image = imagecreatefrompng($source['tmp_name']);
                imagealphablending($image, false);
                imagesavealpha($image, true);
                imagepng($image, $destination);
            }
        } else {
            move_uploaded_file($source['tmp_name'], $destination);
        }
    }

    public function error($type, $message, $location)
    {
        $message = $this->data->real_escape_string($message);
        $user = $this->data->real_escape_string(json_encode($_COOKIE));

        $this->data->query("INSERT INTO tb_errors(`type`, `message`, `location`, `user`, `status`, `desc`, `created`, `modified`) VALUES('$type', '$message', '$location', '$user', 'n', NULL, NOW(), NOW())");
    }

    public function toast($status, $message, $link, $location = NULL)
    {
        if($status == 'error') $this->error($status, $message.' DB: '.$this->data->error, $location);
        echo ($link == 'development') ? $message : "<script>sessionStorage.setItem('toastColor', '$status');sessionStorage.setItem('toastMessage', `$message`); window.location.href = '". urlFlex.$link."'</script>";
        exit(0);
    }

    public function sendMail($to, $name, $subject, $body)
    {
        $adSet = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_advancedSettings` LIMIT 1"));
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $adSet['host'];
        $mail->SMTPAuth = $adSet['SMTPAuth'];
        $mail->SMTPSecure = $adSet['SMTPSecure'];
        $mail->Username = $adSet['username'];
        $mail->Password = $adSet['password'];
        $mail->Port = $adSet['port'];

        $mail->setFrom($adSet['username'], $adSet['sender']);
        $mail->addAddress($to, $name);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        unset($adSet);
    }

    public function notification($title, $desc, $to, $href = NULL)
    {
        $idUser = $this->data->real_escape_string($_COOKIE['idUser']);
        $to = $this->data->real_escape_string($to);

        if (substr($to, 0, 4) == 'user') $insert = $this->data->query("INSERT INTO tb_notifications(`idUser`, `title`, `desc`, `href`, `status`, `created`, `modified`) VALUES( '$to' '$title', '$desc', '$href', 'n', NOW(), NOW())");

        $sql = $this->data->query(($to == 'all') ? "SELECT `idUser` FROM `tb_users` WHERE `idUser` <> '$idUser'" : ((substr($to, 0, 4) == 'role') ? "SELECT `idUser` FROM `tb_users` WHERE `idRole` = '$to'" : "SELECT `idUser` FROM `tb_users` WHERE `idUser` = 'empty'"));

        while($row = mysqli_fetch_assoc($sql)){
            $insert = $this->data->query("INSERT INTO tb_notifications(`idUser`, `title`, `desc`, `href`, `status`, `created`, `modified`) VALUES('{$row['idUser']}', '$title', '$desc', '$href', 'n', NOW(), NOW())");
        }
    }
}