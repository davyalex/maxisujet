@extends('front.layouts.app')

@section('title', 'Actualités')


@section('content')
    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center mt-5">
                        <h4> <span style="color:rgb(255, 84, 5)"> </span> {{ $news_detail['title'] }}</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    <!-- blog section start here -->
    <div class="blog-section blog-single padding-tb section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <article>
                        <div class="section-wrapper">
                            <div class="row row-cols-1 justify-content-center g-4">
                                <div class="col">
                                    <div class="post-item style-2">
                                        <div class="post-inner">
                                            <div class="post-thumb">
                                                <img src="{{ asset('/storage/news/' . $news_detail['image']) }}"
                                                    alt="blog thumb rajibraj91" class="w-100">
                                            </div>
                                            <div class="post-content">
                                                <h2>{{ $news_detail['title'] }} </h2>
                                                <div class="meta-post">
                                                    <ul class="lab-ul">
                                                       <li><i class="icofont-ui-user"></i>{{ $news_detail['user']['username'] }} </li>
                                                <li><i class="icofont-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($news_detail['created_at'])->diffForHumans() }} </li>
                                                        <li><a href="#"><i class="icofont-speech-comments"></i>09
                                                                Comments</a></li>
                                                    </ul>
                                                </div>
                                                <p>
                                                    {!!  htmlspecialchars_decode($news_detail['content']) !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

    
                                    <div id="comments" class="comments">
                                        <h4 class="title-border">02 Comment</h4>
                                        <ul class="comment-list">
                                            <li class="comment">
                                                <div class="com-thumb">
                                                    <img alt="rajibraj91" src="assets/images/author/02.jpg">
                                                </div>
                                                <div class="com-content">
                                                    <div class="com-title">
                                                        <div class="com-title-meta">
                                                            <h6>Linsa Faith</h6>
                                                            <span> October 5, 2018 at 12:41 pm </span>
                                                        </div>
                                                        <span class="reply">
                                                            <a class="comment-reply-link" href="#"><i
                                                                    class="icofont-reply-all"></i>Reply</a>
                                                        </span>
                                                    </div>
                                                    <p>The inner sanctuary, I throw myself down among the tall grass bye the
                                                        trckli stream and, as I lie close to the earth</p>
                                                </div>
                                                <ul class="comment-list">
                                                    <li class="comment">
                                                        <div class="com-thumb">
                                                            <img alt="rajibraj91" src="assets/images/author/03.jpg">
                                                        </div>
                                                        <div class="com-content">
                                                            <div class="com-title">
                                                                <div class="com-title-meta">
                                                                    <h6>James Jusse</h6>
                                                                    <span> October 5, 2018 at 12:41 pm </span>
                                                                </div>
                                                                <span class="reply">
                                                                    <a class="comment-reply-link" href="#"><i
                                                                            class="icofont-reply-all"></i>Reply</a>
                                                                </span>
                                                            </div>
                                                            <p>A wonderful serenity has taken possession of my entire soul,
                                                                like these sweet mornings spring which I enjoy with my whole
                                                                heart</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="respond" class="comment-respond mb-lg-0">
                                        <h4 class="title-border">Leave a Comment</h4>
                                        <div class="add-comment">
                                            <form action="#" method="post" id="commentform" class="comment-form">
                                                <input name="name" type="text" value="" placeholder="Name">
                                                <input name="email" type="text" value="" placeholder="Email">
                                                <input name="url" type="text" value=""
                                                    placeholder="Subject">
                                                <textarea id="comment-reply" name="comment" rows="5" placeholder="Type Here Your Comment"></textarea>
                                                <button type="submit" class="lab-btn"><span>send comment</span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4 col-12">
                    <aside>
                        <div class="widget widget-search">
                            <form action="/" class="search-wrapper">
                                <input type="text" name="s" placeholder="Search...">
                                <button type="submit"><i class="icofont-search-2"></i></button>
                            </form>
                        </div>
                        {{-- <div class="widget widget-category">
                            <div class="widget-header">
                                <h5 class="title">Post Category</h5>
                            </div>
                            <ul class="widget-wrapper">
                                <li>
                                    <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>Themeforest</span><span>06</span></a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>Photodune</span><span>11</span></a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex active flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>Codecanyon</span><span>07</span></a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>GRaphicdriver</span><span>09</span></a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>Wordpress</span><span>50</span></a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>Joomla</span><span>20</span></a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>3docean</span><span>93</span></a>
                                </li>
                            </ul>
                        </div>

                        <div class="widget widget-post">
                            <div class="widget-header">
                                <h5 class="title">Most Popular Post</h5>
                            </div>
                            <ul class="widget-wrapper">
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/01.jpg"
                                                alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html">
                                            <h6>Poor People’s Campaign Our Resources</h6>
                                        </a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/02.jpg"
                                                alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html">
                                            <h6>Boosting Social For NGO And Charities </h6>
                                        </a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/03.jpg"
                                                alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html">
                                            <h6>Poor People’s Campaign Our Resources</h6>
                                        </a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/04.jpg"
                                                alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html">
                                            <h6>Boosting Social For NGO And Charities </h6>
                                        </a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="widget widget-archive">
                            <div class="widget-header">
                                <h5 class="title">Our Archives</h5>
                            </div>
                            <ul class="widget-wrapper">
                                <li><a href="archive.html" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>January</span><span>2021</span></a> </li>
                                <li><a href="archive.html" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>February</span><span>2020</span></a></li>
                                <li><a href="archive.html"
                                        class="d-flex active flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>March</span><span>2019</span></a></li>
                                <li><a href="archive.html" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>April</span><span>2018</span></a></li>
                                <li><a href="archive.html" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>June</span><span>2017</span></a></li>
                                <li><a href="archive.html" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>June</span><span>2016</span></a></li>
                                <li><a href="archive.html" class="d-flex flex-wrap justify-content-between"><span><i
                                                class="icofont-double-right"></i>February</span><span>2015</span></a></li>
                            </ul>
                        </div>

                        <div class="widget widget-instagram">
                            <div class="widget-header">
                                <h5 class="title">Gallery Photos</h5>
                            </div>
                            <ul class="widget-wrapper d-flex flex-wrap justify-content-center">
                                <li><a data-rel="lightcase" href="assets/images/blog/01.jpg"><img
                                            src="assets/images/blog/01.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/02.jpg"><img
                                            src="assets/images/blog/02.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/03.jpg"><img
                                            src="assets/images/blog/03.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/04.jpg"><img
                                            src="assets/images/blog/04.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/05.jpg"><img
                                            src="assets/images/blog/05.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/06.jpg"><img
                                            src="assets/images/blog/06.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/07.jpg"><img
                                            src="assets/images/blog/07.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/08.jpg"><img
                                            src="assets/images/blog/08.jpg" alt="product"></a></li>
                                <li><a data-rel="lightcase" href="assets/images/blog/09.jpg"><img
                                            src="assets/images/blog/09.jpg" alt="product"></a></li>
                            </ul>
                        </div>

                        <div class="widget widget-tags">
                            <div class="widget-header">
                                <h5 class="title">Our Popular Tags</h5>
                            </div>
                            <ul class="widget-wrapper">
                                <li><a href="#">envato</a></li>
                                <li><a href="#" class="active">themeforest</a></li>
                                <li><a href="#">codecanyon</a></li>
                                <li><a href="#">videohive</a></li>
                                <li><a href="#">audiojungle</a></li>
                                <li><a href="#">3docean</a></li>
                                <li><a href="#">envato</a></li>
                                <li><a href="#">themeforest</a></li>
                                <li><a href="#">codecanyon</a></li>
                            </ul>
                        </div> --}}
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- blog section ending here -->


@endsection
