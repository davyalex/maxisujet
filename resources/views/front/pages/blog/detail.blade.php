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
                                {{-- <li class="breadcrumb-item active" aria-current="page"></li> --}}
                                <li class="breadcrumb-item"><a href="javascript:history.back()"><i
                                            class="icofont-caret-left"></i> Retour</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont-home"></i>
                                        Accueil</a></li>

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
                                                        <li><i
                                                                class="icofont-ui-user"></i>{{ $news_detail['user']['username'] }}
                                                        </li>
                                                        <li><i class="icofont-calendar"></i>
                                                            {{ \Carbon\Carbon::parse($news_detail['created_at'])->diffForHumans() }}
                                                        </li>
                                                        <li><a href="#"><i class="icofont-speech-comments"></i>  {{count($news_detail['commentaires'])}} </a></li>
                                                    </ul>
                                                </div>
                                                <p>
                                                    {!! htmlspecialchars_decode($news_detail['content']) !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="comments" class="comments">
                                        <h4 class="title-border"> Commentaires ( {{ count($news_detail->commentaires) }})</h4>
                                        <ul class="comment-list">
                                            @foreach ($news_detail['commentaires'] as $item)
                                                
                                            <li class="comment">
                                                <div class="com-thumb">
                                                    <img alt="" class="img-thumbnail" width="70%" src="{{asset('front/assets/images/custom/user_avatar.png')}}">
                                                </div>
                                                <div class="com-content">
                                                    <div class="com-title">
                                                        <div class="com-title-meta">
                                                            <h6 id="auth_user"> {{$item['user']['username']}} </h6>
                                                            <span id="created_at">  {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                    <p id="news_content"> {{$item['content']}} </p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                   @auth
                                        <div id="respond" class="comment-respond mb-lg-0">
                                        <h4 class="title-border">Laisser un commentaire</h4>
                                        <div class="add-comment">
                                            <p class="msgError text-danger text-center text-bold">
                                                Le champs commentaire est vide
                                            </p>
                                            <form action="#" method="post" id="commentform" class="comment-form">
                                                {{-- <input name="name" type="text" value="" placeholder="Name">
                                                <input name="email" type="text" value="" placeholder="Email">
                                                <input name="url" type="text" value=""
                                                    placeholder="Subject"> --}}
                                                <textarea name="content" id="content" rows="5" placeholder="Ecrivez votre commentaire ici" required></textarea>
                                                <input type="text" name="model" value="News" id="model" hidden>
                                                <input type="text" name="news_id" id="news_id"
                                                    value="{{ $news_detail['id'] }}" hidden>
                                                <button type="submit" id="submit"
                                                    class="lab-btn"><span>Envoyez</span></button>
                                            </form>
                                        </div>
                                    </div>
                                   @endauth

                                   @guest
                                        @guest
                                <a href="{{ route('user.login') }}" type="button" class="lab-btn mt-4"><span>

                                        <i class="icofont-lock"></i> Connectez vous pour laisser un commentaire</span></a>
                            @endguest
                                   @endguest
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



    <script type="text/javascript">
        //send content comment
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //hide error message
            $('.msgError').hide();

            $('#submit').click(function(e) {
                e.preventDefault();

                var newsId = $('#news_id').val();
                var model = $('#model').val();
                var content = $("#content").val();

                if (content == '') {
                    $('.msgError').show(200);
                } else {
                    $('.msgError').hide();

                    //send data to controller


                    $.ajax({
                        type: "POST",
                        url: "{{ route('addComment') }}",
                        data: {
                            newsId: newsId,
                            model: model,
                            content: content
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.message =='data found') {
                                location.reload();
                            }
                            // $("#content").val('');
                            // $('#news_content').append(response.data.content);
                            // $('#created_at').append(response.data.created_at);
                        }
                    });
                }



            });

        });
    </script>

@endsection
