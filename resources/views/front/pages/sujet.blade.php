@extends('front.layouts.app')

@section('title', 'Liste des sujets')


@section('content')
    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center py-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="javascript:history.back()"><i
                                            class="icofont-caret-left"></i> Retour</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont-home"></i>
                                        Accueil</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Listes des sujets</li>
                            </ol>
                        </nav>

                        <h6> <span style="color:rgb(255, 84, 5)">{{ count($sujets) }} </span> Sujets <span
                                style="color:rgb(255, 84, 5)">{{ request('title') }} </span> disponibles </h6>

                        {{-- @if ($titre)
                            <div class="request_title ">
                                <span class="{{ $titre[0]['categorie_title'] ?? 'd-none' }}"> <b>Categorie</b> :
                                    {{ $titre[0]['categorie_title']['title'] }}</span>
                                <br><span class="{{ $titre[0]['matieres_title'] ?? 'd-none' }}"> <b>Matieres</b> :
                                    @foreach ($titre[0]['matieres_title'] as $item)
                                        {{ $item['title'] }},
                                    @endforeach
                                </span>
                                <br><span class="{{ $titre[0]['niveaux_title'] ?? 'd-none' }}"> <b>Niveaux</b> :
                                    @foreach ($titre[0]['niveaux_title'] as $item)
                                        {{ $item['title'] }},
                                    @endforeach
                                </span>
                                <br><span class="{{ $titre[0]['annee_title'] ?? 'd-none' }}"> <b>Année</b> :
                                    {{ $titre[0]['annee_title'] }}</span>
                                <br><span class="{{ $titre[0]['code_sujet_title'] ?? 'd-none' }}"> <b>Code sujet</b> :
                                    {{ $titre[0]['code_sujet_title'] }}</span>
                            </div>
                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->


    <!--Search sujet start -->
    @include('front.components.search')
    <!-- search sujet end -->


    <!-- course section start here -->
    <div class="course-section padding-tb section-bg">
        <div class="container">
            <div class="section-wrapper">
                <div class="text-center">
                    {{-- <p>Showing 1-6 of 10 results</p> --}}
                </div>
                <div class="blog-section section-bg">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-12">
                                <aside>
                                    <div class="widget widget-category">
                                        <div class="widget-header">
                                            <h5 class="title">Categories</h5>
                                        </div>
                                        <ul class="widget-wrapper">
                                            @foreach ($categories as $item)
                                                <li>
                                                    <a href="/sujet?category={{ $item['id'] }} && title={{ $item['title'] }}"
                                                        class="d-flex flex-wrap justify-content-between"><span><i
                                                                class="icofont-double-right"></i> {{ $item['title'] }}
                                                        </span><span> {{ $item->sujets->count() }} </span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </aside>
                            </div>

                            <div class="col-lg-8 col-12">
                                <article>
                                    <div class="section-wrapper">
                                        <div class="row row-cols-1 justify-content-center g-2">
                                            @foreach ($sujets as $key => $item)
                                                <div class="col">
                                                    <div class="sujet-recent bg-white p-2">
                                                        <a href="#">
                                                            <h3>
                                                                {{ $item['sujet_title'] }}
                                                            </h3>
                                                        </a>
                                                        <div class="meta-post">
                                                            <span style="font-weight: bold" class="">Categorie</span>:
                                                            {{ $item['categorie']['title'] }} <br>

                                                            <span style="font-weight: bold" class="">Matieres</span>:
                                                            @foreach ($item['matieres'] as $matieres)
                                                                {{ $matieres['title'] }} ,
                                                            @endforeach

                                                            <br> <span style="font-weight: bold"
                                                                class="">Niveaux</span>:
                                                            @foreach ($item['niveaux'] as $niveaux)
                                                                {{ $niveaux['title'] }} ,
                                                            @endforeach


                                                            <br> <span style="font-weight: bold" class="">Publié
                                                                le</span>:
                                                            {{ $item['created_at'] }}

                                                        </div>
                                                        {{-- si utilisateur connecté il peut telecharger --}}
                                                        @auth
                                                            <!-- ========== Verification sur le lien ========== -->
                                                            @if (Auth::user()->point > 0)
                                                                <a href="{{ asset('storage/' . $item->sujet_file) }}"
                                                                @elseif(Auth::user()->point == 0) <a href="#"
                                                                    @endif
                                                                    class="lab-btn mt-2 btn-download"
                                                                    data-id="{{ $item['id'] }}"
                                                                    data-file="{{ $item['sujet_file'] }}"><span>Télecharger le
                                                                        sujet
                                                                        <i class="icofont-download"></i></span></a>



                                                                <!-- ========== Verification sur le lien ========== -->
                                                                @if (Auth::user()->point > 0)
                                                                    <a href="{{ asset('storage/' . $item->corrige_file) }}"
                                                                    @elseif (Auth::user()->point == 0) <a href="#"
                                                                        @endif
                                                                        class="lab-btn mt-2 btn-download  {{ $item->corrige_file ? ' ' : 'd-none' }} "
                                                                        data-id="{{ $item['id'] }}"
                                                                        data-file="{{ $item['corrige_file'] }}"><span>Télecharger
                                                                            le corrigé
                                                                            <i class="icofont-download"></i></span></a>
                                                                @endauth


                                                                {{-- si  utilisateur n'est pas connecté on le redirige vers login --}}
                                                                @guest
                                                                    <a href="{{ route('user.login') }}"
                                                                        class="lab-btn mt-2"><span>Télecharger le
                                                                            sujet
                                                                            <i class="icofont-lock"></i></span></a>

                                                                    <a href="{{ route('user.login') }}"
                                                                        class="lab-btn mt-2  {{ $item->corrige_file ? ' ' : 'd-none' }}"><span>Télecharger
                                                                            le corrigé
                                                                            <i class="icofont-lock"></i></span></a>
                                                                @endguest
                                                                <a class="lab-btn mt-2" data-bs-toggle="collapse"
                                                                    href="#collapsewithlink{{ $item['id'] }}"
                                                                    role="button" aria-expanded="false"
                                                                    aria-controls="collapsewithlink"> <span>Détails
                                                                        <i class="icofont-eye"></i></span> </a>
                                                                @include('front.components.detail_sujet')


                                                    </div>
                                                </div>
                                                {{-- @include('front.components.modal_detail_sujet') --}}
                                            @endforeach

                                        </div>
                                    </div>
                                </article>
                                {{-- <ul class="default-pagination lab-ul">
                                    <li>
                                        <a href="#"><i class="icofont-rounded-left"></i></a>
                                    </li>
                                    <li>
                                        <a href="#">01</a>
                                    </li>
                                    <li>
                                        <a href="#" class="active">02</a>
                                    </li>
                                    <li>
                                        <a href="#">03</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icofont-rounded-right"></i></a>
                                    </li>
                                </ul> --}}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- course section ending here -->

            </div>
        </div>
    </div>
    <!-- course section ending here -->



    @push('js')
        @include('front.pages.account.sujet.script.download')
    @endpush



@endsection
