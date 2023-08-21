<?php $menu[$this->namePage] = 'active' ?>
</head><body>
    <header class='show-on-scroll' style='transition: all 0.9s ease-in-out 0.3s'>
        <div class='content'>
            <div class='left'>
                <a href='<?php echo urlBase ?>'><img class='logo' src='<?php echo urlBase, 'assets/img/', $this->setting['img'] ?>' alt='logo'/></a>
                <span class='title'><?php echo $this->setting['company'] ?></span>
            </div>
            <div class='right'>
                <ul id='main-menu' class='menu'>
                <?php $sql = $this->data->query("SELECT `idPage`, `name`, `url`, `onMenu`, `parent` FROM `tb_pages` WHERE `visibility` = 'y' ORDER BY `order` DESC");
                while($db = mysqli_fetch_assoc($sql)){
                    if($db['parent'] == 'y'){ ?>
                    <li class="parent <?php echo (isset($menu[$db['name']])) ? $menu[$db['name']] : '' ?>"><a href='<?php echo urlBase, $db['url'] ?>'><?php echo $db['onMenu'] ?> <i class='micon'>keyboard_arrow_down</i></a>
                        <ul class='child'>
                            <?php $sqlSub = $this->data->query("SELECT `title`, `url` FROM `tb_subpages` WHERE `idPage` = '{$db['idPage']}' AND `visibility` = 'y' ORDER BY `order` DESC");
                            while($dbSub = mysqli_fetch_assoc($sqlSub)){ ?>
                                <li><a href='<?php echo urlBase, 'pages/sub/', $db['name'], '/', $dbSub['url'] ?>'><?php echo $dbSub['title'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="<?php echo (isset($menu[$db['name']])) ? $menu[$db['name']] : '' ?>"><a href='<?php echo urlBase, $db['url'] ?>'><?php echo $db['onMenu'] ?></a></li>
                <?php }} ?>
                </ul>
                <div class='contact-icons'>
                    <a href='mailto:<?php echo $this->setting['email'] ?>'><i class='micon'>email</i></a>
                    <a href='<?php echo $this->setting['whatsapp'] ?>'><i class='micon'>whatsapp</i></a>
                </div>
                <i class='micon' open-sidebar>apps</i>
            </div>
            <div class='sidebar'>
                <div class='top'><i class='micon' close-sidebar>east</i></div>
                <ul id='sidebar-menu' class='menu'></ul>
                <div class='bottom'>&copy; <?php echo date('Y'), ' by ', $this->setting['company'] ?> All right reserved.</div>
            </div>

            <div id="toast">
                <div class="center">
                    <div class='report'>
                        <i class='micon'></i><span></span>
                        <a href='javascript:void(0)'>Close</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>document.getElementById('sidebar-menu').innerHTML = document.getElementById('main-menu').innerHTML</script>