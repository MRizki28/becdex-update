<?php require dirname(__FILE__, 4).'/root.php';
require dirFlex.'system/core.php';

class Notification extends Core {

	public function list($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);

        $sql = $this->data->query("SELECT tb_notifications.*, tb_users.name AS `user` FROM `tb_notifications`, `tb_users` WHERE tb_notifications.idUser = '{$post['idUser']}' AND tb_notifications.idUser = tb_users.idUser ORDER BY tb_notifications.created DESC");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(array('data' => $data));
        exit(0);
	}

    public function get($post)
    {
        parent::__construct('private');
        parent::privileges('notification', 'cru');
        $post = parent::clean($post);

        $data = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_notifications` WHERE `idNotif` = '{$post['idNotif']}'"));

        if($data['status'] == 'n'){ 
            $this->data->query("UPDATE `tb_notifications` SET `status` = 'y' WHERE idNotif = '{$post['idNotif']}'"); 
        }

        $data['desc'] = html_entity_decode($data['desc']);
        $data['date'] = date('d F Y G:i:s', strtotime($data['created']));
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
        exit(0);
    }

    public function bell($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);

        $sql = $this->data->query("SELECT * FROM `tb_notifications` WHERE `idUser` = '{$post['idUser']}' AND `status` = 'n' LIMIT 3");

        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $desc =  strlen($row['desc']) > 85 ? substr($row['desc'],0,85).' ...' : $row['desc'];
            $row['desc'] = html_entity_decode($desc);
            $data[] = $row;
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
        exit(0);
    }

    public function message($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);

        $content = htmlentities($post['content']);
        $this->notification($post['title'], $content, $post['recipient'], $post['url']);

        $body = "<!DOCTYPE html><html xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office' lang='en'><head><title></title><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'><style>*{box-sizing: border-box;}body{margin: 0;padding: 0;}a[x-apple-data-detectors]{color: inherit !important;text-decoration: inherit !important;}#MessageViewBody a{color: inherit;text-decoration: none;}p{line-height: inherit}@media (max-width:540px){.row-content{width: 100% !important;}.stack .column{width: 100%;display: block;}}</style></head><body style='background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'><table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;'><tbody><tr><td><table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><tbody><tr><td><table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 520px;' width='520'><tbody><tr><td class='column' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 20px; padding-right: 20px; padding-top: 40px; padding-bottom: 40px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'><table class='text_block' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'><tr><td style='padding-right:10px;'><div style='font-family: sans-serif'><div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #b0b0b0; line-height: 1.2; font-family: Source Sans Pro, Tahoma, Verdana, Segoe, sans-serif;'><p style='margin: 0; font-size: 14px;'>Cnryflex | Notification</p></div></div></td></tr></table><table class='divider_block' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><tr><td style='padding-bottom:10px;padding-top:10px;'><div align='center'><table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><tr><td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;'><span>&#8202;</span></td></tr></table></div></td></tr></table><table class='heading_block' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><tr><td style='text-align:center;width:100%;'><h1 style='margin: 0; color: #002099; direction: ltr; font-family: Source Sans Pro, Tahoma, Verdana, Segoe, sans-serif; font-size: 28px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;'><strong>".$post['title']."</strong></h1></td></tr></table><table class='text_block' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'><tr><td style='padding-bottom:40px;padding-right:10px;padding-top:30px;'><div style='font-family: sans-serif'><div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #393d47; line-height: 1.2; font-family: Source Sans Pro, Tahoma, Verdana, Segoe, sans-serif;'><p style='margin: 0; font-size: 14px;'>".str_replace(["\n","\r"], "", html_entity_decode($content))."</p></div></div></td></tr></table><table class='button_block' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><tr><td style='text-align:left;padding-top:10px;padding-right:10px;padding-bottom:10px;'>";
        
        if(!empty($post['url'])){
            $body .= "<div style='text-decoration:none;display:inline-block;color:#ffffff;background-color:#0028bf;border-radius:4px;width:auto;border-top:1px solid #8a3b8f;border-right:1px solid #8a3b8f;border-bottom:1px solid #8a3b8f;border-left:1px solid #8a3b8f;padding-top:5px;padding-bottom:5px;font-family:Source Sans Pro, Tahoma, Verdana, Segoe, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;'><a href='".$post['url']."' style='padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;'><span style='font-size: 16px; line-height: 1.2; word-break: break-word; mso-line-height-alt: 19px;'>Action</span></a></div>";
        }
        
        $body .= "</td></tr></table><table class='divider_block' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><tr><td style='padding-bottom:10px;padding-top:10px;'><div align='center'><table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><tr><td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;'><span>&#8202;</span></td></tr></table></div></td></tr></table><table class='text_block' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'><tr><td style='padding-bottom:10px;padding-right:10px;padding-top:10px;'><div style='font-family: sans-serif'><div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #a5a5a5; line-height: 1.2; font-family: Source Sans Pro, Tahoma, Verdana, Segoe, sans-serif;'><p style='margin: 0; font-size: 14px;'><span style='font-size:12px;'>copyright ".date('Y')." by Conary.&nbsp;</span></p></div></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";

        if(substr($post['recipient'], 0, 4) == 'user'){

            $user = mysqli_fetch_assoc($this->data->query("SELECT `name`, `email` FROM `tb_users` WHERE `idUser` = '{$post['recipient']}'")); $this->sendMail($user['email'], $user['name'], $post['title'], $body);

        } else {

            $sql = $this->data->query(($post['recipient'] == 'all') ? "SELECT `name`, `email` FROM `tb_users` WHERE `idUser` <> '{$post['idUser']}'" : ((substr($post['recipient'], 0, 4) == 'role') ? "SELECT `name`, `email` FROM `tb_users` WHERE `idRole` = '{$post['recipient']}'" : "SELECT `name`, `email` FROM `tb_users` WHERE `idUser` = 'empty'"));

            while($row = mysqli_fetch_assoc($sql)){
                $this->sendMail($row['email'], $row['name'], $post['title'], $body);
            }

        }

        echo 1; exit(0);
    }

    public function count($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);

        echo mysqli_num_rows($this->data->query("SELECT `created` FROM `tb_notifications` WHERE `idUser` = '{$post['idUser']}' AND `status` = 'n'"));
    }

    public function clear($post)
    {
        parent::__construct('private');
        $post = parent::clean($post);

        echo ($this->data->query("UPDATE `tb_notifications` SET `status` = 'y' WHERE `idUser` = '{$post['idUser']}'")) ? 1 : 0;
        exit(0);
    }
}

$action = new Notification;
call_user_func_array(array($action, filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)), array(array_merge($_POST, $_COOKIE)));