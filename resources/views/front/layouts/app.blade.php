<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxi sujet</title>
    <link rel="shortcut icon" href="front/assets/images/x-icon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="front/assets/css/animate.css">
    <link rel="stylesheet" href="front/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="front/assets/css/icofont.min.css">
    <link rel="stylesheet" href="front/assets/css/swiper.min.css">
    <link rel="stylesheet" href="front/assets/css/lightcase.css">
    <link rel="stylesheet" href="front/assets/css/style.css">
    <link rel="stylesheet" href="front/assets/css/custom.css">
</head>


<!-- preloader start here -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- preloader ending here -->


<!-- scrollToTop start here -->
<a href="#" class="scrollToTop"><i class="icofont-rounded-up"></i></a>
<!-- scrollToTop ending here -->


<!-- header section start here -->
@include('front.sections.header')
<!-- header section ending here -->




<div class="container-fluid">
    <div class="row">
        <!--div google ads start -->
        <div class="col-md-1 col-sm-0 col-xs-0 col-lg-1"></div>
        <!--div google ads end -->


        <div class="col-md-10 col-sm-12 col-xs-12 col-lg-10">

               @yield('content')

        </div>

        <!--div google ads start -->
        <div class="col-md-1 ol-sm-0 col-xs-0 col-lg-1"></div>
        <!--div google ads end -->
    </div>
</div>














<!-- footer -->
<div class="news-footer-wrap">
    <div class="fs-shape">
        <img src="front/assets/images/shape-img/03.png" alt="fst" class="fst-1">
        <img src="front/assets/images/shape-img/04.png" alt="fst" class="fst-2">
    </div>
    <!-- Newsletter Section Start Here -->
    <div class="news-letter">
        <div class="container">
            <div class="section-wrapper">
                <div class="news-title">
                    <h3>Want Us To Email You About Special Offers And Updates?</h3>
                </div>
                <div class="news-form">
                    <form action="/">
                        <div class="nf-list">
                            <input type="email" name="email" placeholder="Enter Your Email">
                            <input type="submit" name="submit" value="Subscribe Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Section Ending Here -->

    <!-- Footer Section Start Here -->
    <footer>
        <div class="footer-top padding-tb pt-0">
            <div class="container">
                <div class="row g-4 row-cols-xl-4 row-cols-sm-2 row-cols-1 justify-content-center">
                    <div class="col">
                        <div class="footer-item">
                            <div class="footer-inner">
                                <div class="footer-content">
                                    <div class="title">
                                        <h4>Site Map</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            <li><a href="#">Documentation</a></li>
                                            <li><a href="#">Feedback</a></li>
                                            <li><a href="#">Plugins</a></li>
                                            <li><a href="#">Support Forums</a></li>
                                            <li><a href="#">Themes</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-item">
                            <div class="footer-inner">
                                <div class="footer-content">
                                    <div class="title">
                                        <h4>Useful Links</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Help Link</a></li>
                                            <li><a href="#">Terms & Conditions</a></li>
                                            <li><a href="#">Contact Us</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-item">
                            <div class="footer-inner">
                                <div class="footer-content">
                                    <div class="title">
                                        <h4>Social Contact</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            <li><a href="#">Facebook</a></li>
                                            <li><a href="#">Twitter</a></li>
                                            <li><a href="#">Instagram</a></li>
                                            <li><a href="#">YouTube</a></li>
                                            <li><a href="#">Github</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-item">
                            <div class="footer-inner">
                                <div class="footer-content">
                                    <div class="title">
                                        <h4>Our Support</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            <li><a href="#">Help Center</a></li>
                                            <li><a href="#">Paid with Mollie</a></li>
                                            <li><a href="#">Status</a></li>
                                            <li><a href="#">Changelog</a></li>
                                            <li><a href="#">Contact Support</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom style-2">
            <div class="container">
                <div class="section-wrapper">
                    <p>&copy; 2021 <a href="index.html">Edukon</a> Designed by <a
                            href="https://themeforest.net/user/CodexCoder" target="_blank">CodexCoder</a> </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section Ending Here -->
</div>
<!-- footer -->



<!-- jQuery -->
<script src="front/assets/js/jquery.js"></script>
<script src="front/assets/js/bootstrap.min.js"></script>
<script src="front/assets/js/swiper.min.js"></script>
<script src="front/assets/js/progress.js"></script>
<script src="front/assets/js/lightcase.js"></script>
<script src="front/assets/js/counter-up.js"></script>
<script src="front/assets/js/isotope.pkgd.js"></script>
<script src="front/assets/js/functions.js"></script>
<script src="{{ asset('back/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>


<script>
    $(".single").select2({
        placeholder: "Choisir ......",
        allowClear: true
        // closeOnSelect: false
    });
    $(".multiple").select2({
        placeholder: "Choisir......",
        allowClear: true
        // closeOnSelect: false
    });
</script>
</body>

</html>
