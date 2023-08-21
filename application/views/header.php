<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/home/assets/img/logo.png" />

    <title><?= $title ?></title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- Favicons  -->
    <link href="<?= base_url() ?>assets/home/assets/img/logo.png" rel="icon">
    <link href="<?= base_url() ?>assets/home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?> assets/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/logo/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url() ?>assets/logo/site.webmanifest">
    <!-- Vendor CSS Files  -->
    <link href="<?= base_url() ?>assets/home/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
    <!-- 
     Template Main CSS File  -->
    <link href="<?= base_url() ?>assets/home/assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <style>
        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            #homes {
                margin-top: 0px;
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            #homes {
                margin-top: 0px;
            }
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            #homes {
                margin-top: 10px;
            }
        }

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            #homes {
                margin-top: 10px;
            }
        }
    </style>
    <!-- Link Swiper's CSS -->

    <!-- =======================================================
  * Template Name: FlexStart - v1.9.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== 
</head> -->

<body>
    <!-- 
     ======= Header =======  -->
    <header id="header" class="header fixed-top bg-white shadow-md">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
                <img src="<?= base_url() ?>assets/home/assets/img/logo.png" alt="">
                <span>BECdex</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <?php
                    $about_url = base_url() . 'home/about';
                    $indonesia = base_url('home');
                    $exploreId = base_url('home/explore');
                    $downloadId = base_url('home/download');
                    //ubah url /home menjadi /home/indonesia
                    if ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'indonesia') {
                        $about_url = base_url() . 'home/aboutId';
                        $indonesia = base_url('home/indonesia');
                        $exploreId = base_url() . 'home/exploreId';
                        $downloadId = base_url() . 'home/downloadId';
                    } else if ($this->uri->segment(2) == 'aboutId') {
                        $about_url = base_url() . 'home/aboutId';
                        $indonesia = base_url() . 'home/indonesia';
                        $exploreId = base_url() . 'home/exploreId';
                        $downloadId = base_url() . 'home/downloadId';
                    } else if ($this->uri->segment(2) == 'exploreId') {
                        $about_url = base_url() . 'home/aboutId';
                        $indonesia = base_url() . 'home/indonesia';
                        $exploreId = base_url() . 'home/exploreId';
                        $downloadId = base_url() . 'home/downloadId';
                    } else if ($this->uri->segment(2) == 'downloadId') {
                        $about_url = base_url() . 'home/aboutId';
                        $indonesia = base_url() . 'home/indonesia';
                        $exploreId = base_url() . 'home/exploreId';
                        $downloadId = base_url() . 'home/downloadId';
                    }

                    ?>


                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'indonesia') {
                                                        echo 'active';
                                                    } ?>" href="<?= $indonesia ?>"><?php if ($this->uri->segment(2) == 'aboutId' || $this->uri->segment(2) == 'indonesia' || $this->uri->segment(2) == 'indonesia' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'downloadId') {
                                                                                        echo 'Beranda';
                                                                                    } else {
                                                                                        echo 'Home';
                                                                                    } ?></a></li>
                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == 'about' || $this->uri->segment(2) == 'aboutId') {
                                                        echo 'active';
                                                    } ?>" href="<?= $about_url ?>"><?php if ($this->uri->segment(2) == 'aboutId' || $this->uri->segment(2) == 'indonesia' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'downloadId') {
                                                                                        echo 'Tentang';
                                                                                    } else {
                                                                                        echo 'About Us';
                                                                                    } ?></a></li>
                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == 'explore' || $this->uri->segment(2) == 'exploreId') {
                                                        echo 'active';
                                                    } ?>" href="<?= $exploreId ?>"><?php if ($this->uri->segment(2) == 'aboutId' || $this->uri->segment(2) == 'indonesia' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'downloadId') {
                                                                                        echo 'Penelusuran';
                                                                                    } else {
                                                                                        echo 'Explore';
                                                                                    } ?></a></li>
                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == 'download' || $this->uri->segment(2) == 'downloadId') {
                                                        echo 'active';
                                                    } ?>" href="<?= $downloadId ?>"><?php if ($this->uri->segment(2) == 'aboutId' || $this->uri->segment(2) == 'indonesia' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'downloadId') {
                                                                                        echo 'Unduhan';
                                                                                    } else {
                                                                                        echo 'Download';
                                                                                    } ?></a></li>
                    <div class="dropdown">
                        <a href="#" class="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-earth fs-5 "></i>
                        </a>
                        <ul class="dropdown-menu">
                            <a class="nav-link scrollto 
                                                    <?php if ($this->uri->segment(3) == 'indonesia') {
                                                        echo 'active';
                                                    } ?><?php if (
                                                            $this->uri->segment(2) == 'indonesia' ||
                                                            $this->uri->segment(2) == 'aboutId' ||
                                                            $this->uri->segment(2) == 'exploreId' ||
                                                            $this->uri->segment(2) == 'downloadId '  && $this->uri->segment(1) == 'home'
                                                        ) {
                                                            echo 'disabled';
                                                        } ?>" href="<?= base_url() ?>home/indonesia">ID</a>
                            <a class="nav-link scrollto 
                                                 <?php if ($this->uri->segment(1) == 'home') {
                                                     echo 'active';
                                                   } ?><?php if (
                                                                    $this->uri->segment(2) == 'home' ||
                                                                    $this->uri->segment(2) == 'about' ||
                                                                    $this->uri->segment(2) == 'explore' ||
                                                                    $this->uri->segment(2) == 'download' && $this->uri->segment(1) == 'home'
                                                                ) {
                                                                    echo 'disabled';
                                                                } ?>" href=" <?= base_url() ?>home">EN</a>


                        </ul>
                    </div>
                    <?php
                    $login_text = 'Log In';
                    $register_text = 'Registration';
                    if ($this->uri->segment(2) == 'indonesia' || $this->uri->segment(2) == 'aboutId' || $this->uri->segment(2) == 'exploreId' || $this->uri->segment(2) == 'downloadId') {
                        $login_text = 'Masuk';
                        $register_text = 'Registrasi';
                    }
                    ?>
                    <li><a class="getstarted scrollto" href="<?= base_url() ?>auth"><?= $login_text ?></a></li>
                    <li><a class="getstarted scrollto" href="<?= base_url() ?>auth/registration"><?= $register_text ?></a></li>
                </ul>


                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar  -->

        </div>

    </header>


    <script>
        document.getElementById('dropdown').addEventListener('mouseover', function handleMouseOver() {
            document.getElementById('dropcontent').style.display = 'block';
        });
        document.getElementById('dropcontent').addEventListener('mouseover', function handleMouseOver() {
            document.getElementById('dropcontent').style.display = 'block';
        });
        document.getElementById('dropcontent').addEventListener('mouseout', function handleMouseOut() {
            document.getElementById('dropcontent').style.display = 'none';
        });
    </script>