<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/home/assets/img/logo.png" />

    <title><?= $title ?></title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <link
         rel="stylesheet"
         href="https://unpkg.com/swiper/swiper-bundle.min.css"
       />
    <!-- Favicons  -->
    <link href="<?= base_url() ?>assets/home/assets/img/logo.png" rel="icon">
    <link href="<?= base_url() ?>assets/home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files  -->
    <link href="<?= base_url() ?>assets/home/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
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
                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(1) == '') {
                                                        echo 'active';
                                                    } ?> " href="<?= base_url() ?>">Home</a></li>
                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == 'about') {
                                                        echo 'active';
                                                    } ?>" href="<?= base_url() ?>home/about">About Us</a></li>
                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == 'catalog' || $this->uri->segment(2) == 'states') {
                                                        echo 'active';
                                                    } ?>" id="dropdown" href="#">Explore</a></li>
                    <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == 'download' || $this->uri->segment(2) == 'states') {
                        echo 'active';
                    } ?>" id="dropdown" href="<?= base_url() ?>home/download">Download</a></li>
                    <li><a class="getstarted scrollto" href="<?= base_url() ?>auth">Log In</a></li>
                    
                    <li><a class="getstarted scrollto" href="<?= base_url() ?>auth/registration">Registration</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar  -->

        </div>

        <div class="container-fluid container-xl align-items-center justify-content-between w-100 mt-4 bg-white pt-4" id="dropcontent" style="display: none;">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <img src="<?= base_url() ?>assets/home/assets/img/image2.png" alt="" style="width: 200px;">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="content pt-3">
                                <h5 class="text-primary"><a href="<?= base_url() ?>home/catalog">Catalog of Blue Economy Companies</a></h5>
                                <p>
                                    Blue Economy Company is a maritime company running their business meeting 70% or more of 50 Blue Economy Company Index (BECdex) indicators to support the achievement of Sustainable Development Goals (SDGs) in the coastal states.
                                </p>
                                <div class="text-center text-lg-start">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <img src="<?= base_url() ?>assets/home/assets/img/image1.png" alt="" style="width: 198px;">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="content pt-3">
                                <h5 class="text-primary"><a href="<?= base_url() ?>home/states">List of Coastal States</a></h5>
                                <p>
                                    Coastal state is a state with a sea-coastline. There are 153 of 193 member states of United Nations are coastal states in 2021.
                                </p>
                                <div class="text-center text-lg-start">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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