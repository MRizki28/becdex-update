<main id="main">
    <!-- ======= Download Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= base_url('home/catalog') ?>">Catalog</a></li>
                <li><?= $company->name ?></li>
            </ol>
        </div>
    </section>
    <section id="about" class="about">
        <div class="container">
            <div class="card  mb-3 p-2">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="<?= base_url('assets/img/profile/'.$company->image) ?>" class="img-fluid rounded-start w-100" alt="company picture">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text m-0" style="font-size: small;">Certified on: <?= $company->tanggal_publish ?></p>
                            <h5 class="card-title"><b><?= $company->name ?></b></h5>
                            <a href="<?= $company->weblink ?>" class="btn btn-primary" target="_blank">Go to <?= $company->name ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><b>Description</b></h5>
                    <p class="card-text"><?= $company->description_company ?></p>
                    <div class="container" data-aos="fade-up">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="row gy-4">
                                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                        <div class="service-box blue">
                                            <div class="text-center"><img width="60" src="<?= base_url() ?>/assets/svg/detail-sector.svg"></i></div>
                                            <h3>Sector</h3>
                                            <p><?= $company->field_name ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                        <div class="service-box orange">
                                            <div class="text-center"><img width="60" src="<?= base_url() ?>/assets/svg/detail-location.svg"></div>
                                            <h3>Location</h3>
                                            <p><?= $company->nicename ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                        <div class="service-box green">
                                            <div class="text-center"><i class="fa fa-check-circle display-5 text-primary"></i></div>
                                            <h3>Category</h3>
                                            <p><?= $company->becdex_cat_name ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card ">
            <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b>Primary Office</b></h5>
                            <p class="card-text "><?= $company->address ?></p>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <!-- End Download Section -->

</main><!-- End #main -->