======= Hero Section =======
<link rel="stylesheet" href="<?= base_url('assets/css/style2.css'); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row" id="homes">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <div>
                    <h1 data-aos="fade-up">Blue Economy Company Index (BECdex)</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400"></h2>
                    <div class="content pt-3">
                        <h5 class="text-primary">Apa itu BECdex?</h5>
                        <p align="justify">
                            Blue Economy Company Index (BECdex) adalah standar dan perangkat internasional untuk mengidentifikasi dan mensertifikasi perusahaan maritim yang mengoperasikan bisnis mereka sesuai dengan prinsip panduan ekonomi biru.
                        </p>
                        <p align="justify">
                            Proses sertifikat BECdex dijalankan oleh Maritimepreneure International Certifications Center (MICC) sebagai lembaga sertifikasi.
                        </p>
                        <div class="text-center text-lg-start">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary floating-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-sharp fa-solid fa-question"></i>
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pusat Bantuan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo site_url('Help_controller/save'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" aria-describedby="emailHelp" placeholder="Masukan nama anda">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Masukan email anda">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_whatsapp">Nomor Handphone</label>
                                            <input type="number" name="no_whatsapp" id="no_whatsapp" class="form-control" placeholder="Masukan nomor anda">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_masalah">Kategori</label>
                                            <select name="jenis_masalah" id="jenis_masalah" class="form-control">
                                                <option>Masukan</option>
                                                <option>Platform</option>
                                                <option>Pilihan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="detail">Detail</label>
                                            <textarea class="form-control" name="detail" id="detail" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 data-aos="fade-up" data-aos-delay="400"></h2>
                        <div class="content pt-3">
                            <h5 class="text-primary">Bagaimana cara mendapatkan sertifikasi sebagai Perusahaan Ekonomi Biru ?</h5>
                            <p align="justify">
                                Untuk proses sertifikasi, perusahaan harus mendaftar terlebih dahulu lalu mengikuti proses sertifikasi melalui penyerahan beberapa dokumen yang dibutuhkan dan kemudian melakukan pembayaran biaya sertifikasi sebesar USD 2.980. Setelah proses penilaian dan verifikasi selesai, perusahaan akan mendapatkan e-certificate dengan label Standard (skor: 70-78), Good (skor: 80-88), atau Excellent (skor: 90-100) Blue Economy Company .
                            </p>
                            <p>
                            <h2>
                                <p><br><b>Untuk mensertifikasi perusahaan Anda : <a href="<?= base_url('auth/registration')?>" target="_blank"> <u>KLIK DISINI</a></u></b></br></p>
                            </h2>
                            </p>
                            <div class="text-center text-lg-start">
                            </div>
                        </div>

                    </div>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="<?= base_url() ?>home/aboutId" target="_blank" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Pelajari Lebih Lanjut</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img " >
                <div id="carouselExampleIndicators" style="height: 450px;" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner "  >
                        <div class="carousel-item active">
                            <img src="<?= base_url() ?>assets/home/assets/img/becdex1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url() ?>assets/home/assets/img/becdex2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url() ?>assets/home/assets/img/becdex3.png" class="d-block w-100" alt="...">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    
                </div><br>
                <center>
                    <div class="col-sm-11 d-flex" >
                    <img src="<?= base_url() ?>assets/home/assets/img/certifflowid2.png" class="img-fluid" alt="">
                </div>
                </center>
            
            </div>
        </div>
</section><!-- End Hero -->
<section id="clients" class="clients text-center">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <header class="section-header">
            <h2>
                <p>LEMBAGA SERTIFIKASI</p>
            </h2>
        </header>

        <div class="col-sm-12 mb-3 pb-3">
            <div class="d-sm-flex justify-content-center align-items-center">
                <a href="https://maritimepreneur.com" target="_blank">
                    <img src="<?= base_url() ?>assets/maritimepreneur.png" alt="netflix" class="p-2 p-lg-0 mr-5" data-aos="fade-down" data-aos-offset="-400" style="height: 170px"></a>

            </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
    </div>
    </div>
</section>



<section id="clients" class="clients text-center">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <header class="section-header">
            <h2>
                <p>MITRA STRATEGIS</p>
            </h2>
        </header>
        <div class="col-sm-12 mb-3 pb-3">
            <div class="d-sm-flex justify-content-center align-items-center">
                <a href="https://maritim.go.id" target="_blank">
                    <img src="<?= base_url() ?>assets/LogoKemenkoMaritim2.png" alt="netflix" class="p-2 p-lg-0 mr-5" data-aos="fade-down" data-aos-offset="-400" style="height: 170px"></a>
                <a href="https://ibec.stei.ac.id/" target="_blank">
                    <img src="<?= base_url() ?>assets/stei&ibec.png" alt="netflix" class="p-2 p-lg-0 mr-5" data-aos="fade-down" data-aos-offset="-400" style="height: 170px"></a>
                <div class="d-sm-flex justify-content-center align-items-center">
                    <a href="https://maritimmuda.id" target="_blank">
                        <img src="<?= base_url() ?>assets/LogoMaritimMudaHR1.png" alt="netflix" class="p-2 p-lg-0 mr-5" data-aos="fade-down" data-aos-offset="-400" style="height: 170px"></a>
                    <a href="https://delamoreindonesia.co.id/" target="_blank">
                        <img src="<?= base_url() ?>assets/delmore.png" alt="netflix" class="p-2 p-lg-0 mr-5" data-aos="fade-down" data-aos-offset="-400" style="height: 170px"></a>

                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    </div>
</section>

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>
                <p>Kontak</p>
            </h2>
            <!--   <p>Contact Us</p> -->
        </header>

        <div class="row gy-4">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">

                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Kantor</h3>
                            <p>Maritimepreneur International Certification Center (MICC) <br>
                                Kampus C, STIE Indonesia Jakarta<br>
                                Jalan Pratekan No. 9A, Rawamangun,<br>
                                Jakarta, Indonesia 13220
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-telephone"></i>
                            <h3>Kontak Kami</h3>
                            <p>+62 21 489 11 37 (Banding dan Pengaduan)</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Kami</h3>
                            <p>info@becdex.com</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-clock"></i>
                            <h3>Waktu Operasional</h3>
                            <p>Senin - Jum'at<br>9:00AM - 05:00PM</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">
            </div>


        </div>

    </div>

</section><!-- End Contact Section -->
<script>
    $(document).ready(function() {
        setInterval(function() {
            $('.carousel').carousel('next');
        }, 3000);
    });
    $('.carousel').carousel({
        wrap: true
    });
</script>
</main><!-- End #main