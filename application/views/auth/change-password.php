<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('assets/'); ?>css/style5.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <section class="gradient-form" style="background-image: url(<?php echo base_url('assets/images/b.svg'); ?>); position: fixed; width: 100%">

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-5">
                    <div class="card rounded-3  text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body mx-md-4">

                                    <div class="text-center mb-3">
                                        <img src="<?= base_url('assets/images/logo.png'); ?>" style="width: 80px;" alt="logo">
                                    </div>

                                    <?= $this->session->flashdata('message'); ?>

                                    <form class="user" method="post" action="<?= base_url('auth/changepassword'); ?>">
                                        <h5 class="text-center">Change your password for</h5>
                                        <p class="mb-4 text-center"><?= $this->session->userdata('reset_email'); ?></p>

                                        <div class="form-wrapper mb-3 ">
                                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter new password...">
                                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-wrapper mb-3">
                                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat password...">
                                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mb-3">
                                            Change Password
                                        </button>



                                    </form>

                                </div>
                            </div>




                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>