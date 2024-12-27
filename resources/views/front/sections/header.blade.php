<header class="header-section">
    <div class="header-top" style="background-color: rgb(237, 236, 236)">
        <div class="container">
            <div class="header-top-area">
                <ul class="lab-ul left">
                    <li>
                        <a href="#">Actualités</a>
                    </li>
                    <li>
                        <a href="#">Forum</a>
                    </li>
                    <li>
                        <a href="#">Librairies</a>
                    </li>

                    <li>
                        <a href="#">Quiz</a>
                    </li>

                </ul>
                <ul class="lab-ul social-icons d-flex align-items-center">
                    <li><a href="#" class="fb"><i class="icofont-facebook"></i></a></li>
                    <li><a href="#" class="twitter"><i class="icofont-twitter"></i></a></li>
                    <li><a href="#" class="rss"><i class="icofont-rss-feed"></i></a></li>
                </ul>

                @auth
                    <div class="">
                        <a href="{{ route('user_account.dashboard') }}"
                            style="background: rgb(234, 92, 4); font-weight:bold" class="py-3 px-1 text-white text-bold"><i
                                class="icofont-dashboard"></i> <span>Mon compte</span> </a>
                        <a href="{{ route('user.logout') }}" style="background: rgb(255, 255, 255); font-weight:bold"
                            class="py-3 px-2 text-danger"><i class="icofont-exit"></i> <span>Se deconnecter</span> </a>
                    </div>
                @endauth

                @guest
                    <div class="">
                        <a href="{{ route('user.login') }}" style="background: rgb(234, 92, 4); font-weight:bold"
                            class="py-3 px-1 text-white text-bold"><i class="icofont-lock"></i> <span>Se connecter</span>
                        </a>
                        <a href="{{ route('user.register') }}" style="background: rgb(255, 255, 255); font-weight:bold"
                            class="py-3 px-2 text-bold"><i class="icofont-user"></i> <span>S'inscrire</span> </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    <div class="header-bottom" style="background-color:#1f1f33;">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('front/assets/images/custom/logo.png') }}"
                            width="80%" alt="logo"></a>
                </div>
                <div class="menu-area">
                    <div class="menu">
                        <ul class="lab-ul">
                            <li class="">
                                <a href="{{ route('home') }}">Accueil</a>
                                {{-- <ul class="lab-ul">
                                    <li><a href="index.html" class="active">Home One</a></li>
                                    <li><a href="index-2.html">Home Two</a></li>
                                    <li><a href="index-3.html">Home Three</a></li>
                                    <li><a href="index-4.html">Home Four</a></li>
                                    <li><a href="index-5.html">Home Five</a></li>
                                    <li><a href="index-6.html">Home Six</a></li>
                                    <li><a href="index-7.html">Home Seven</a></li>
                                </ul> --}}
                            </li>


                            <li>
                                <a href="#0" class="">Categories</a>
                                <ul class="lab-ul">
                                    @foreach ($categories as $item)
                                        <li><a href="/sujet?category={{ $item['id'] }}&&title={{ $item['title'] }}"
                                                class="text-uppercase">{{ $item['title'] }} </a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach ($niveaux_with_subNiveaux as $cycle)
                                <li>
                                    <a href="#0" style="text-transform:Capitalize">{{ $cycle['title'] }} </a>
                                    <ul class="lab-ul">
                                        @foreach ($cycle->subNiveaux as $niveaux)
                                            @if ($niveaux->subNiveaux->count() < 1)
                                                <li><a
                                                        href="/sujet?niveau={{ $niveaux['id'] }}&&title={{ $niveaux['title'] }}">{{ $niveaux['title'] }}</a>
                                                </li>
                                            @elseif ($niveaux->subNiveaux->count() > 0)
                                                <li>
                                                    <a href="#0"> {{ $niveaux['title'] }} </a>
                                                    <ul class="lab-ul">
                                                        @foreach ($niveaux->subNiveaux as $subNiveau2)
                                                            <li><a
                                                                    href="/sujet?niveau={{ $subNiveau2['id'] }}&&title={{ $subNiveau2['title'] }}">{{ $subNiveau2['title'] }}
                                                                </a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach


                                    </ul>
                                </li>
                            @endforeach

                            {{-- <li><a href="#">Contact</a></li> --}}
                        </ul>
                    </div>


                    <!-- toggle icons -->
                    <div class="header-bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="ellepsis-bar d-lg-none">
                        <i class="icofont-info-square"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
