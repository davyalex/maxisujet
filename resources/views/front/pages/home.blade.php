@extends('front.layouts.app')

@section('title', 'Accueil')



@section('content')
<!-- banner section start here -->
@include('front.sections.banner')
<!-- banner section ending here -->


<!--  section after slide card start here -->
<div class="about-section style-2 section-bg">
    <div class="container">
        <div class="row d-flex g-1">
            <div class="col-md-4 col-sm-12 col-lg-4 text-center bg-white p-2">
                <img src="{{ asset('front/assets/images/custom/login.jpg') }}" width="" height="" alt="about icon">
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4 text-center bg-white p-2 ">
                <img src="{{ asset('front/assets/images/custom/poster.jpg') }}" class="rounded" width="" height="auto"
                    alt="about icon">
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4 text-center bg-white p-2">
                <img src="{{ asset('front/assets/images/custom/quiz.jpg') }}" width="" height="" alt="about icon">
            </div>
        </div>
    </div>
</div>
<!--  section after slide ending here -->

<!-- google adsense banner start -->
<div class="row">
    <div class="bg-dark p-4">
        <h3 class="text-center text-white">GOOGLE ADS</h3>
    </div>
</div>
<!-- google adsense banner end -->


<!--Search sujet start -->
@include('front.components.search')
<!-- search sujet end -->




<!-- course section start here -->
<div class="blog-section padding-tb section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="">
                    <h3 class="title-recent-sujet" style="color: rgb(255, 132, 0)">Maxi Sujets recents
                    </h3>
                    <hr class="under">
                </div>
                <article>
                    <div class="section-wrapper">
                        <div class="row row-cols-1 justify-content-center g-4">
                            <div class="col">
                                <div class="post-item style-2">
                                    <div class="post-inner">
                                        <div class="post-content">
                                            <a href="blog-single.html">
                                                <h3>
                                                    Interactively Morph High Standards Anding
                                                </h3>
                                            </a>
                                            <div class="meta-post">
                                                <ul class="lab-ul">
                                                    <li>
                                                        <i class="icofont-calendar"></i>April 23,2021
                                                    </li>
                                                    <li>
                                                        <i class="icofont-ui-user"></i>Begrass Tyson
                                                    </li>
                                                    <li>
                                                        <i class="icofont-speech-comments"></i>09
                                                        Comments
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="blog-single.html" class="lab-btn mt-2"><span>Read
                                                    More
                                                    <i class="icofont-external-link"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="post-item style-2">
                                    <div class="post-inner">
                                        <div class="post-content">
                                            <a href="blog-single.html">
                                                <h3>
                                                    Financial Reporting Qoncil What Could More.
                                                </h3>
                                            </a>
                                            <div class="meta-post">
                                                <ul class="lab-ul">
                                                    <li>
                                                        <i class="icofont-calendar"></i>April 23,2021
                                                    </li>
                                                    <li>
                                                        <i class="icofont-ui-user"></i>Begrass Tyson
                                                    </li>
                                                    <li>
                                                        <i class="icofont-speech-comments"></i>09
                                                        Comments
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="blog-single.html" class="lab-btn mt-2"><span>Read
                                                    More
                                                    <i class="icofont-external-link"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="post-item style-2">
                                    <div class="post-inner">
                                        <div class="post-content">
                                            <a href="blog-single.html">
                                                <h3>
                                                    Consulting Reporting Qounc Arei Could More.
                                                </h3>
                                            </a>
                                            <div class="meta-post">
                                                <ul class="lab-ul">
                                                    <li>
                                                        <i class="icofont-calendar"></i>April 23,2021
                                                    </li>
                                                    <li>
                                                        <i class="icofont-ui-user"></i>Begrass Tyson
                                                    </li>
                                                    <li>
                                                        <i class="icofont-speech-comments"></i>09
                                                        Comments
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="blog-single.html" class="lab-btn mt-2"><span>Read
                                                    More
                                                    <i class="icofont-external-link"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2 text-center">
                        <button class="btn btn-primary w-50 py-3 btn-all-sujet">
                            <span>Voir tous les sujets</span>
                        </button>
                    </div>

                    <div class="text-center bg-dark py-2">
                        <h3 class="text-white">Google ADS</h3>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-12">
                <div class="bg-dark">
                    <h3 class="text-white text-center py-3">Google Ads</h3>
                </div>
                <aside>
                    <div class="widget widget-search">
                        <h4>Need a new search?</h4>
                        <p>
                            If you didn't find what you were looking for, try a new
                            search!
                        </p>

                    </div>
                    <div class="widget widget-search">
                        <h4>Need a new search?</h4>
                        <p>
                            If you didn't find what you were looking for, try a new
                            search!
                        </p>

                    </div>
                    <div class="widget widget-search">
                        <h4>Need a new search?</h4>
                        <p>
                            If you didn't find what you were looking for, try a new
                            search!
                        </p>

                    </div>
                    <div class="widget widget-search">
                        <h4>Need a new search?</h4>
                        <p>
                            If you didn't find what you were looking for, try a new
                            search!
                        </p>

                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- course section ending here -->



<!-- blog section maxi actualités start here -->
<div class="blog-section">
    <div class="container">
        <div class="">
            <h3 class="title-recent-sujet" style="color: rgb(255, 132, 0)">Maxi Actualités
                <i class="icofont-caret-right"></i> <a href="">Tous voir</a>
            </h3>
            <hr class="under">
        </div>
        <div class="section-wrapper">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center g-4">
                <div class="col">
                    <div class="post-item">
                        <div class="post-inner">
                            <div class="post-thumb">
                                <a href="blog-single.html"><img src="front/assets/images/blog/01.jpg" alt="blog thumb"></a>
                            </div>
                            <div class="post-content">
                                <a href="blog-single.html">
                                    <h4>Scottish Creatives To Receive Funded Business.</h4>
                                </a>
                                <div class="meta-post">
                                    <ul class="lab-ul">
                                        <li><i class="icofont-ui-user"></i>Begrass Tyson</li>
                                        <li><i class="icofont-calendar"></i>April 23,2021</li>
                                    </ul>
                                </div>
                                <p>Pluoresnts customize prancing apcente customer service anding ands asing
                                    in straelg
                                    Interacvely cordinate performe</p>
                            </div>
                            <div class="post-footer">
                                <div class="pf-left">
                                    <a href="blog-single.html" class="lab-btn-text">Read more <i
                                            class="icofont-external-link"></i></a>
                                </div>
                                <div class="pf-right">
                                    <i class="icofont-comment"></i>
                                    <span class="comment-count">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="post-item">
                        <div class="post-inner">
                            <div class="post-thumb">
                                <a href="blog-single.html"><img src="front/assets/images/blog/02.jpg" alt="blog thumb"></a>
                            </div>
                            <div class="post-content">
                                <a href="blog-single.html">
                                    <h4>Scottish Creatives To Receive Funded Business.</h4>
                                </a>
                                <div class="meta-post">
                                    <ul class="lab-ul">
                                        <li><i class="icofont-ui-user"></i>Begrass Tyson</li>
                                        <li><i class="icofont-calendar"></i>April 23,2021</li>
                                    </ul>
                                </div>
                                <p>Pluoresnts customize prancing apcente customer service anding ands asing
                                    in straelg
                                    Interacvely cordinate performe</p>
                            </div>
                            <div class="post-footer">
                                <div class="pf-left">
                                    <a href="blog-single.html" class="lab-btn-text">Read more <i
                                            class="icofont-external-link"></i></a>
                                </div>
                                <div class="pf-right">
                                    <i class="icofont-comment"></i>
                                    <span class="comment-count">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="post-item">
                        <div class="post-inner">
                            <div class="post-thumb">
                                <a href="blog-single.html"><img src="front/assets/images/blog/03.jpg" alt="blog thumb"></a>
                            </div>
                            <div class="post-content">
                                <a href="blog-single.html">
                                    <h4>Scottish Creatives To Receive Funded Business.</h4>
                                </a>
                                <div class="meta-post">
                                    <ul class="lab-ul">
                                        <li><i class="icofont-ui-user"></i>Begrass Tyson</li>
                                        <li><i class="icofont-calendar"></i>April 23,2021</li>
                                    </ul>
                                </div>
                                <p>Pluoresnts customize prancing apcente customer service anding ands asing
                                    in straelg
                                    Interacvely cordinate performe</p>
                            </div>
                            <div class="post-footer">
                                <div class="pf-left">
                                    <a href="blog-single.html" class="lab-btn-text">Read more <i
                                            class="icofont-external-link"></i></a>
                                </div>
                                <div class="pf-right">
                                    <i class="icofont-comment"></i>
                                    <span class="comment-count">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog section maxi actualités ending here -->


<!-- maxi sujet par cycle start here -->
<div class="category-section padding-tb section-bg style-2">
    <div class="container">
        <div class="section-header text-center">
            {{-- <span class="subtitle">Popular Category</span> --}}
            <h2 class="title text-uppercase">Maxi sujet par cycle</h2>
            <hr class="under m-auto">
        </div>
        <div class="section-wrapper">
            <div class="row g-4 justify-content-center row-cols-xl-4 row-cols-lg-4 row-cols-sm-2 row-cols-1">
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/07.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Computer Science</h6>
                                </a>
                                <span>24 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/08.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Civil Engineering</h6>
                                </a>
                                <span>63 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/09.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Business Analysis</h6>
                                </a>
                                <span>63 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/10.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Data Science Analytics</h6>
                                </a>
                                <span>65 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/11.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Learning Management</h6>
                                </a>
                                <span>78 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/12.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Computer Engineering</h6>
                                </a>
                                <span>92 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/13.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Design Architect</h6>
                                </a>
                                <span>68 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="category-item text-center">
                        <div class="category-inner">
                            <div class="category-thumb">
                                <img src="front/assets/images/category/icon/14.jpg" alt="category">
                            </div>
                            <div class="category-content">
                                <a href="course.html">
                                    <h6>Foreign Language</h6>
                                </a>
                                <span>48 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- maxi sujet par cycle start here -->


<!-- Maxi astuces et conseils section start here -->
<div class="blog-section padding-tb section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-9">
                <div class="">
                    <h3 class="title-recent-sujet" style="color: rgb(255, 132, 0)">Maxi astuces et
                        conseils
                        <i class="icofont-caret-right"></i> <a href="">Tous voir</a>
                    </h3>
                    <hr class="under">
                </div>
                <article>
                    <div class="section-wrapper">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 justify-content-center g-4">
                            <div class="col">
                                <div class="post-item">
                                    <div class="post-inner">
                                        <div class="post-thumb">
                                            <a href="blog-single.html"><img src="front/assets/images/blog/01.jpg"
                                                    alt="blog thumb"></a>
                                        </div>
                                        <div class="post-content">
                                            <a href="blog-single.html">
                                                <h4>Scottish Creatives To Receive Funded Business.</h4>
                                            </a>
                                            <div class="meta-post">
                                                <ul class="lab-ul">
                                                    <li><i class="icofont-ui-user"></i>Begrass Tyson</li>
                                                    <li><i class="icofont-calendar"></i>April 23,2021</li>
                                                </ul>
                                            </div>
                                            <p>Pluoresnts customize prancing apcente customer service anding
                                                ands asing
                                                in straelg Interacvely cordinate performe</p>
                                        </div>
                                        <div class="post-footer">
                                            <div class="pf-left">
                                                <a href="blog-single.html" class="lab-btn-text">Read more
                                                    <i class="icofont-external-link"></i></a>
                                            </div>
                                            <div class="pf-right">
                                                <i class="icofont-comment"></i>
                                                <span class="comment-count">3</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="post-item">
                                    <div class="post-inner">
                                        <div class="post-thumb">
                                            <a href="blog-single.html"><img src="front/assets/images/blog/02.jpg"
                                                    alt="blog thumb"></a>
                                        </div>
                                        <div class="post-content">
                                            <a href="blog-single.html">
                                                <h4>Scottish Creatives To Receive Funded Business.</h4>
                                            </a>
                                            <div class="meta-post">
                                                <ul class="lab-ul">
                                                    <li><i class="icofont-ui-user"></i>Begrass Tyson</li>
                                                    <li><i class="icofont-calendar"></i>April 23,2021</li>
                                                </ul>
                                            </div>
                                            <p>Pluoresnts customize prancing apcente customer service anding
                                                ands asing
                                                in straelg Interacvely cordinate performe</p>
                                        </div>
                                        <div class="post-footer">
                                            <div class="pf-left">
                                                <a href="blog-single.html" class="lab-btn-text">Read more
                                                    <i class="icofont-external-link"></i></a>
                                            </div>
                                            <div class="pf-right">
                                                <i class="icofont-comment"></i>
                                                <span class="comment-count">3</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-3 col-12">
                <div class="bg-dark">
                    <h3 class="text-white text-center py-3">Google Ads</h3>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Maxi astuces et conseils section ending here -->

@endsection