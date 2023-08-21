<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="<?= base_url() ?>assets/home/assets/img/logo.png" alt="">
                        <span>BECdex</span>
                    </a>
                    <p>© 2022 BECdex. Blue Economy Company Index (BECdex) is a trademark of PT Mahakarya Maritim Indonesia. Registered in the Directorate General of Intellectual Property of the Republic of Indonesia.

                    
                    </p>

                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('home')?>">Company Certification</a></li>
                        <!-- <li><i class="bi bi-chevron-right"></i> <a href="#">Training</a></li> -->
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>
                        <strong>Operation Office - Maritimepreneur</strong>
                        Indonesia Blue Economy Center (IBEC) <br>
                        Campus C STIE Indonesia Jakarta<br>
                        Jalan Pratekan No. 9A, Rawamangun<br>
                        Jakarta, Indonesia 13220
                    </p>
                    <div class="social-links mt-3 align-center">
                        <a href="mailto:maritimepreneur@gmail.com" class="instagram"><i class="bi bi-envelope" style="width: 20px;"></i></a>
                        <a href="https://www.instagram.com/maritimepreneur/" class="linkedin"><i class="bi bi-instagram" style="width: 20px;"></i></a>
                        <a href="https://www.linkedin.com/company/maritimepreneur" class="linkedin"><i class="bi bi-linkedin" style="width: 20px;"></i></a>
                        <a href="https://www.f6s.com/maritimepreneur" class="linkedin"><img src="<?= base_url() ?>assets/home/assets/img/f6s.png" alt="" style="width: 22px;"></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Becdex</span></strong>. All Rights Reserved
        </div>
    </div> -->
</footer><!-- End Footer -->
<!-- 
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>assets/home/assets/vendor/purecounter/purecounter.js"></script>
<script src="<?= base_url() ?>assets/home/assets/vendor/aos/aos.js"></script>
<script src="<?= base_url() ?>assets/home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/home/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url() ?>assets/home/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>assets/home/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url() ?>assets/home/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url() ?>assets/home/assets/js/main.js"></script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        // Responsive breakpoints
        breakpoints: {
          // when window width is >= 320px
          320: {
            slidesPerView: 1,
            spaceBetween: 30,
            grid: {
              rows: 2,
            },
          },
          // when window width is >= 480px
          480: {
            slidesPerView: 1,
            spaceBetween: 30,
            grid: {
              rows: 2,
            },
          },
          // when window width is >= 640px
          640: {
            slidesPerView: 3,
            spaceBetween: 30,
            grid: {
              rows: 2,
            },
          }
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
</script>
</body>

</html>