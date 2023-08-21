<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
       
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-primary">REGISTERED COMPANIES</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['companies'] ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i></span>
                                <span>Detail</span></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-primary">VERIFIED CERTIFICATES</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['certificate'] ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-primary mr-2"><i class="fa fa-arrow-down"></i></span>
                                <span>Detail</span></a>
                            </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-award  fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-primary">ONGOING SUBMISSION</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['submission'] ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i></span>
                                <span>Detail</span></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-primary">PENDING PAYMENT VERIFICATION</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['payment'] ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i></span>
                                <span>Detail</span></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang Di Dashboard 🎉</h5>
                            <p class="mb-4"></b></p>
                            <i class="fa-sharp fa-solid fa-face-smile text-warning"></i>
                            <a href="javascript:;" class="text-decoration-none">Enjoy your work !!!</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/img/illustrations/man-with-laptop-light.png"
                                height="350" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->