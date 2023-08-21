<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('assets/'); ?>css/style5.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.3/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot your password?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $this->session->flashdata('message'); ?>
                    <form class="user" method="post" action="<?= base_url('auth/forgotpassword'); ?>">
                        <div class="form-outline mb-2">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control mb-3" placeholder="Enter your email here" />
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reset password</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <section class="gradient-form bg-cover h-100" style="background-image: url(<?php echo base_url('assets/images/b.svg'); ?>);">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center vh-100">
                <div class="col-xl-8 p-2">
                    <div class="card rounded-3  text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-1 mx-md-4">
                                    <div class="text-center">
                                        <a data-aos="fade-up" data-aos-delay="600" href="<?= base_url('home'); ?>" >  <i  class="fa-solid fa-arrow-left fs-4 " style="position: absolute; top: 0; left: 0; margin: 1.6rem;"></i></a>
                                  
         
                                        <img class="mt-4" src="<?= base_url('assets/images/logo.png'); ?>" data-aos="fade-up" data-aos-delay="600" style="width: 70px;" alt="logo">
                                        <h4 class="mt-1 mb-2 pb-1" data-aos="fade-up" data-aos-delay="600">Blue Economy Company</h4>
                                   
                                    </div>

                                    <form class="user" method="post" action="<?= base_url('auth'); ?>" >
                                        <p class="text-center">Please login to your account</p>
                                        <?= $this->session->flashdata('message'); ?>
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control mb-3" placeholder="Enter your email here" />
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password here" />
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <center>
                                        <div class="mb-4 ">
                                            <div class="g-recaptcha  " data-sitekey="6LfxWQolAAAAAFF6MfcWdCqKz2nm9JTykXnHcxmr"></div>
                                            <?= form_error('g-recaptcha-response', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        </center>

                                        <div class="text-center pt-1 mb-1 pb-1">
                                            <button class="btn btn-primary btn-block w-100  mb-2" type="submit">Log
                                                in</button>
                                            <a role="button" href="#" class="text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration:none;">
                                                Forgot Password
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <p class="mb-2 me-3 p-2">Don't have an account?</p>
                                            <a href="<?= base_url('auth/registration'); ?>"><button type="button" class="btn btn-outline-primary">Create new</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center gradient-custom-2 text-center d-none d-lg-block">
                                <img data-aos="fade-up" data-aos-delay="600" src="<?= base_url('assets\home\assets\img\bg-home-perahu.png'); ?>" alt="deskripsi-gambar-anda" class="w-50 mt-5 ">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4" data-aos="fade-up" data-aos-delay="600">Become a blue economy company now!</h4>
                                    <p class="small mb-0" data-aos="fade-up" data-aos-delay="600">Blue Economy Company is a certified company in the maritime sectors, whose business meets 70% or more of 50 indicators of the Blue Economy Company Index (BECdex) to support the achievement of the Sustainable Development Goals (SDGs) in the coastal states.</p>
                                </div>
                            </div>

                        </div>


                   
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.3/aos.js" integrity="sha512-mDaCXfIXcUYe10u67E+F0EJkxGpQO5p89McKLAzBu+ZP8Dj3yk72U821aUf+O0xtGqEJodhyExKW/t0h1r9RIA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        AOS.init();
    </script>

</body>

</html>