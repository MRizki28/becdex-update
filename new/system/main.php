<?php class Main {
    public $data, $type, $menu, $page, $setting;

    public function __call($meth, $args)
    {
        $this->toast('warning', 'Method not found!: '.$meth);
    }

    public function token($key, $user, $role)
    {
        return hash('ripemd256', $key.crc32($user.$role).getenv('TOKEN'));
    }

    public function __construct($type = NULL)
    {
        $lines = file(dirFlex.'.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line){
            if (strpos(trim($line), '#') === 0) continue;
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)){
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }

        $this->connect();
        $this->setting = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_settings` LIMIT 1"));
    }

    public function connect()
    {
        $this->data = new mysqli(getenv('DB_SERVER'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    }

    public function clean($post){
        return array_map(function($p){ return (is_array($p)) ? array_map(function($a){ return (is_array($a)) ? array_map(array($this->data, 'real_escape_string'), $a) : $this->data->real_escape_string($a); }, $p) : $this->data->real_escape_string($p); }, $post);
    }

    public function toast($status, $message, $link = NULL)
    {
        echo ($link == 'development') ? $message : "<script>sessionStorage.setItem('toastColor', '$status'); sessionStorage.setItem('toastMessage', `$message`); window.location.href = '". urlBase.$link."'</script>";
        exit(0);
    }

	public function open(array $set, $css = [], $js = [])
    {
        $this->namePage = $this->data->real_escape_string($set[0]);
        if(!$page = mysqli_fetch_assoc($this->data->query("SELECT tb_pages.*, tb_settings.trademark, tb_settings.maintenance, tb_settings.tagline FROM `tb_pages`, `tb_settings` WHERE tb_pages.name = '{$this->namePage}'"))){
            $this->toast('warning', 'Halaman yang Anda cari tidak ditemukan!', '');
        }

        if($page['maintenance'] == 'y' && $this->namePage != 'maintenance'){
            echo "<meta http-equiv='refresh' content='0;url=".urlBase."maintenance'>";
            exit(0);
        } elseif($page['maintenance'] == 'n' && $this->namePage == 'maintenance'){
            echo "<meta http-equiv='refresh' content='0;url=".urlBase."'>";
            exit(0);
        }

		echo "<!DOCTYPE HTML><html lang='id'><head>
        <meta charset='UTF-8'/>
        <meta name='language' content='id'/>
        <meta name='apple-mobile-web-app-capable' content='yes'/>
        <meta name='mobile-web-app-capable' content='yes'/>
        <meta name='title' content='", $page['trademark'], " | ", $page['onMenu'], "'/>
        <meta name='description' content='".$page['desc']."'/>
        <meta name='author' content='conary.id'/>
        <meta name='robots' content='index, follow'/>
        <meta name='googlebot' content='index, follow'/>
        <meta name='google' content='notranslate'/>
        <meta name='theme-color' content='#ffffff'/>
        <meta name='msapplication-TileColor' content='#ffffff'/>
        <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'/>
        <title>", $page['trademark'], " | ", $page['onMenu'], ".</title>

        <!-- <link rel='manifest' href='".urlBase."manifest.json'/> -->
        <link rel='icon' type='image/png' href='".urlBase."assets/img/favicon/icon-72x72.png'/>
        <link rel='apple-touch-icon' href='".urlBase."assets/img/favicon/icon-96x96.png'/>

        <link rel='stylesheet' href='".urlBase."assets/css/standard.css?v=1.4'/>
        <link rel='stylesheet' href='".urlBase."assets/css/pages.css?v=1.5'/>

        <script src='".urlBase."assets/js/lib/jquery.js'></script>
        <script src='".urlBase."assets/js/standard.js'></script>";
        
        if(!empty($css)){
            foreach($css as $file){
                echo "<link rel='stylesheet' href='".urlBase."assets/css/$file.css'/>";
            }
        }

        if(!empty($js)){
            foreach($js as $file){
                echo "<script src='".urlBase."assets/js/$file.js'></script>";
            }
        }

        $this->page = $page;
        if($this->namePage != 'maintenance'){
		    require dirBase.'system/parts/header.php';
        }
	}

    public function notification($title, $desc, $to, $href = NULL)
    {
        $to = $this->data->real_escape_string($to);

        if (substr($to, 0, 4) == 'user'){
            $insert = $this->data->query("INSERT INTO tb_notifications(`idUser`, `title`, `desc`, `href`, `status`, `created`, `modified`) VALUES( '$to' '$title', '$desc', '$href', 'n', NOW(), NOW())");
        }

        $sql = $this->data->query(($to == 'all') ? "SELECT `idUser` FROM `tb_users`" : ((substr($to, 0, 4) == 'role') ? "SELECT `idUser` FROM `tb_users` WHERE `idRole` = '$to'" : "SELECT `idUser` FROM `tb_users` WHERE `idUser` = 'empty'"));

        while($row = mysqli_fetch_assoc($sql)){
            $insert = $this->data->query("INSERT INTO tb_notifications(`idUser`, `title`, `desc`, `href`, `status`, `created`, `modified`) VALUES('{$row['idUser']}', '$title', '$desc', '$href', 'n', NOW(), NOW())");
        }
    }

	public function close()
    {
		require dirBase.'system/parts/footer.php';
	}
}