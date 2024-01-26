@extends('front.layouts.app')

@section('title', 'Liste des sujets')


@section('content')
    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2> <span style="color:rgb(255, 84, 5)">{{ count($sujets) }} </span> Sujets disponibles</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listes des sujets</li>
                            </ol>
                        </nav>
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
                                                    <a href="/sujet?category={{$item['id']}}"
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
                                            @foreach ($sujets as $item)
                                                <div class="col">
                                                    <div class="sujet-recent bg-white p-2">
                                                        <a href="blog-single.html">
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

                                                           <br> <span style="font-weight: bold" class="">Niveaux</span>:
                                                            @foreach ($item['niveaux'] as $niveaux)
                                                                {{ $niveaux['title'] }} ,
                                                            @endforeach


                                                            <br> <span style="font-weight: bold" class="">Publié
                                                                le</span>:
                                                            {{ $item['created_at'] }}

                                                        </div>
                                                        <a href="{{ asset('storage/' . $item->corrige_file) }}"
                                                            class="lab-btn mt-2"><span>Télecharger le sujet
                                                                <i class="icofont-download"></i></span></a>

                                                                <a href="{{ asset('storage/' . $item->sujet_file) }}"
                                                                    class="lab-btn mt-2"><span>Télecharger le corrigé
                                                                        <i class="icofont-download"></i></span></a>

                                                        <a href="#" type="button" class="lab-btn mt-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#sujet{{ $item['id'] }}"><span>Details

                                                                <i class="icofont-eye"></i></span></a>


                                                    </div>
                                                </div>
                                                @include('front.components.modal_detail_sujet')
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
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('.modal-link').on('click', function() {
                    $('body').addClass("modal-open");
                });
                $('.close-modal').on('click', function() {
                    $('body').removeClass("modal-open");
                });
            });
        }(jQuery));
    </script>
@endsection
