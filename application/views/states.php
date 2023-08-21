<main id="main">

    <section id="about" class="about">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content bg-white">
                        <h3>List of Coastal States</h3>
                        <p>
                            Coastal state is a state with a sea-coastline. There are 153 of 193 member states of United Nations are coastal states in 2021.
                        </p>
                        <div class="row">
                            <div class="col-6">     
                                <ol>
                                    <?php foreach (array_slice($countries,0,80) as $data) { ?>

                                        <li><?= $data->nicename ?></li>
                                    <?php } ?>
                                </ol>
                            </div>
                            <div class="col-6">        
                                <ol start="81">
                                    <?php foreach (array_slice($countries,80,153) as $data) { ?>
                                        <li><?= $data->nicename ?></li>
                                    <?php } ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6  mt-6" data-aos="zoom-out" data-aos-delay="200">
                    <img src="<?= base_url() ?>assets/home/assets/img/image1.png" class="mt-6" style="padding: 50px" alt="">
                </div>

            </div>
        </div>

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="content py-0 bg-white">
                        
                    </div>
                </div>
            </div>

        </div>

    </section><!-- End About Section -->

</main><!-- End #main -->