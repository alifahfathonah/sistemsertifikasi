<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- footer part start-->
<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="single-footer-widget footer_1">
                    <a href="index.html"> <img src="<?php echo base_url() ?>/assets/img/uib.png" alt=""> </a>
                    <p>University with international quality standard that produces graduates, science, technology and arts that can meet global dynamic changes.</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4">
                <div class="single-footer-widget footer_2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.056680179816!2d104.00085421409236!3d1.119548462585573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98be09646b351%3A0x36a826082690c786!2sBatam%20International%20University!5e0!3m2!1sen!2sid!4v1601471095535!5m2!1sen!2sid" width="380" height="190" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4">
                <div class="single-footer-widget footer_2">
                    <h4>Contact us</h4>
                    <div class="contact_info">
                        <p><span> Address :</span> Universitas Internasional Batam Jl. Gajah Mada, Baloi – Sei Ladi, Batam 29442 </p>
                        <p><span> Phone :</span> +62 878 2522 5979</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright_part_text text-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> Universitas Internasional Batam
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->

    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/frontend/js/jquery.nice-select.min.js"></script>
    <!-- swiper js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/slick.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/frontend/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/frontend/js/waypoints.min.js"></script>
    <!-- custom js -->
    <script src="<?php echo base_url() ?>/assets/frontend/js/custom.js"></script>

    <!-- Animasi saat klik menu -->
    <script type="text/javascript">
        $('a').click(function() {
            var clickedele = $(this).attr("href");
            var desti = $(clickedele).offset().top;
            $('html, body').animate({ scrollTop: desti-15}, 'slow');
            return false;
        });
    </script>
</body>

</html>