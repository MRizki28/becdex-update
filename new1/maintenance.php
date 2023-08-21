<?php require 'root.php';
require dirBase.'system/main.php';
$main = new Main;
$main->open(array('maintenance')) ?>

    </head>
    <body style='position: absolute; height: 100%'>
        <section id='maintenance'>
            <div class='content wrap' style='align-content: center; justify-content: flex-start'>
                <img src='<?php echo urlBase, 'assets/img/', $main->setting['img'] ?>' alt='logo' class='logo'/>
                <span class='title'>Dalam Pengembangan.</span>
                <span class='desc'>Mohon maaf atas ketidaknyamanannya, situs web ini sedang dalam tahap pengembangan atau perawatan untuk menyajikan layanan dan pengalaman yang lebih baik, terima kasih.</span>
                <div class='contacts'>
                    <a href='mailto:<?php echo $main->setting['email'] ?>'><i class='micon'>email</i></a>
                    <a href='<?php echo $main->setting['whatsapp'] ?>'><i class='micon'>whatsapp</i></a>
                    <a href='javascript:void(0)'><i class='micon'>phone</i> <?php echo $main->setting['phone'] ?></a>
                </div>
                <span class='copy'>&copy; <?php echo date("Y"), ' oleh ', $main->setting['company'] ?><br/>All right reserved</span>
            </div>
        </section>