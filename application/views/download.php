    <main id="main">
        <!-- ======= Download Section ======= -->
        <section id="about" class="about" style="padding-top: 150px;">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content bg-white">
                            <h3>Download</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($download as $key => $value): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $value->title ?></td>
                                            <td><a href="../assets/download/<?= $value->file ?>" target="_blank">Link File</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="<?= base_url() ?>assets/home/assets/img/logo.png" class="img-fluid" alt="">
                    </div>

                </div>
            </div>

        </section><!-- End Download Section -->

    </main><!-- End #main -->