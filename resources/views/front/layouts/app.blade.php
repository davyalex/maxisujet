<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxi sujet</title>
    <link rel="shortcut icon" href="front/assets/images/x-icon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>



    <link rel="stylesheet" href="front/assets/css/animate.css">
    <link rel="stylesheet" href="front/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="front/assets/css/icofont.min.css">
    <link rel="stylesheet" href="front/assets/css/swiper.min.css">
    <link rel="stylesheet" href="front/assets/css/lightcase.css">
    <link rel="stylesheet" href="front/assets/css/style.css">
    <link rel="stylesheet" href="front/assets/css/custom.css">
    @stack('css')
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



<!-- banner section start here -->
@if (Route::currentRouteName() == 'home')
    @include('front.sections.banner')
@endif
<!-- banner section ending here -->


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
                    <img src="{{ asset('front/assets/images/custom/logo.png') }}" alt="">
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
                                        <h4>CONTACT</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            <li>
                                                <p class="text-white">
                                                    Ce site regroupe de nombreux supports de sujets et de cours portant
                                                    sur divers domaines de votre parcours scolaire, universitaire et
                                                    votre entrée dans la vie professionnelle.
                                                </p>
                                            </li>
                                            <li><a href="mailto:info@maxisujets.net ">Email : info@maxisujets.net</a>
                                            </li>
                                            <li><a href="tel:(+225) 25 22 00 20 77 ">Tel : (+225) 25 22 00 20 77</a>
                                            </li>
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
                                        <h4>RESSOURCES</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            <li><a href="#">Université de Côte D'Ivoire</a></li>
                                            <li><a href="#">Qui-Sommes-nous</a></li>
                                            <li><a href="#">Bibliothèque en ligne</a></li>
                                            <li><a href="#">Rapport de Stage</a></li>
                                            <li><a href="#">Rédiger un CV</a></li>
                                            <li><a href="#">Annonce/Emploi</a></li>
                                            <li><a href="#">QCM</a></li>
                                            <li><a href="#">Testez votre mémoire</a></li>
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
                                        <h4>MAXISUJETS</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            @foreach ($categories as $item)
                                                <li><a
                                                        href="/sujet?category={{ $item['id'] }}">{{ $item['title'] }}</a>
                                                </li>
                                            @endforeach

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
                                        <h4>RÉSEAUX SOCIAUX</h4>
                                    </div>
                                    <div class="content-footer">
                                        <ul class="lab-ul">
                                            <li><a href="#" class="fb"><i class="icofont-facebook"></i></a>
                                            </li>
                                            <li><a href="#" class="twitter"><i class="icofont-twitter"></i></a>
                                            </li>
                                            <li><a href="#" class="rss"><i class="icofont-rss-feed"></i></a>
                                            </li>
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
                    <p>Copyright © @php
                        echo date('Y');
                    @endphp Maxisujets All Rights Reserved. Designed by <a
                            href="https://ticafrique.com/" target="blank">ticafrique.com</a>.</p>


                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section Ending Here -->
</div>
<!-- footer -->



<!-- jQuery -->
<script src="{{ asset('front/assets/js/jquery.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/progress.js') }}"></script>
<script src="{{ asset('front/assets/js/lightcase.js') }}"></script>
<script src="{{ asset('front/assets/js/counter-up.js') }}"></script>
<script src="{{ asset('front/assets/js/isotope.pkgd.js') }}"></script>
<script src="{{ asset('front/assets/js/functions.js') }}"></script>
<script src="{{ asset('back/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>

@stack('js')

<script>
    // $(".single").select2({
    //     placeholder: "Choisir ......",
    //     allowClear: true
    //     // closeOnSelect: false
    // });
    // $(".multiple").select2({
    //     placeholder: "Choisir......",
    //     allowClear: true
    //     // closeOnSelect: false
    // });
    



    
    
</script>
</body>

</html>
