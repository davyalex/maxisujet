@extends('front.layouts.app')

@section('title', 'Mon compte')

@section('content')
    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2> <span style="color:rgb(255, 84, 5)">Mon compte</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="javascript:history.back()"><i
                                            class="icofont-caret-left"></i> Retour</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont-home"></i>
                                        Accueil</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    <!-- course section start here -->
    <div class="course-section padding-tb section-bg">
        <div class="container">
            <div class="section-wrapper">
                <div class="text-center">
                </div>
                <div class="blog-section section-bg">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-12">
                                <aside>
                                    <div class="widget widget-category">
                                        <div class="widget-header" style="text-align: center">
                                            <img class="m-auto" width="50%"
                                                src="{{ asset('front/assets/images/custom/user_avatar.png') }}"
                                                alt="">
                                        </div>
                                        <div class="text-center">
                                            <p style="font-weight:bold; font-size:20px;"> {{ Auth::user()->username }} </p>
                                            <p> {{ Auth::user()->email }} </p>

                                            <p>
                                                <span><i class="icofont-book"></i> Publications:</span>
                                                <span style="color: rgb(246, 108, 3)"> {{ Auth::user()->sujets->count() }}
                                                </span>
                                            </p>

                                            <p>
                                                <span><i class="icofont-download"></i> Télechargement:</span>
                                                <span style="color: rgb(246, 108, 3)">
                                                    {{ count(Auth::user()->sujet_download) }} </span>
                                            </p>

                                            <h2 style="color: rgb(246, 108, 3)">{{ Auth::user()->point }}
                                                <span class="text-danger" style="font-size: 16px">point</span>
                                            </h2>
                                        </div>

                                    </div>
                                </aside>
                            </div>

                            <div class="col-lg-8 col-12">
                                <article>
                                    <div class="section-wrapper">
                                        <div class="row row-cols-1 justify-content-center g-2">

                                            <div class="card p-3 shadow">
                                                <nav>
                                                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">

                                                        <button class="nav-link active" id="nav-sujet-tab"
                                                            data-bs-toggle="tab" data-bs-target="#nav-sujet" type="button"
                                                            role="tab" aria-controls="nav-contact"
                                                            aria-selected="false">
                                                            <i class="icofont-files-stack"></i>
                                                            Mes sujet</button>

                                                        <button class="nav-link " id="nav-publier-tab" data-bs-toggle="tab"
                                                            data-bs-target="#nav-publier" type="button" role="tab"
                                                            aria-controls="nav-contact" aria-selected="false">
                                                            <i class="icofont-plus"></i>
                                                            Publier un sujet</button>


                                                        <button class="nav-link " id="nav-home-tab" data-bs-toggle="tab"
                                                            data-bs-target="#nav-home" type="button" role="tab"
                                                            aria-controls="nav-home" aria-selected="true">
                                                            <i class="icofont-download"></i>
                                                            Mes télechargements</button>

                                                        {{-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                            data-bs-target="#nav-profile" type="button" role="tab"
                                                            aria-controls="nav-profile" aria-selected="false">
                                                            <i class="icofont-user"></i>
                                                            Mon
                                                            profil</button> --}}


                                                    </div>
                                                </nav>

                                                @includeIf('admin.components.validationMessage')
                                                <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                                                    <div class="tab-pane fade " id="nav-home" role="tabpanel"
                                                        aria-labelledby="nav-home-tab">
                                                        <p>

                                                            @if (count(Auth::user()->sujet_download) > 0)
                                                                {{ count(Auth::user()->sujet_download) }}
                                                                sujet(s) téléchargé(s).
                                                                @include('front.pages.account.telechargement.liste')
                                                            @else
                                                                <h3> Vous n'avez pas encore télécharger de fichier</h3>
                                                            @endif

                                                        </p>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                                        aria-labelledby="nav-profile-tab">
                                                        <p>
                                                            @include('front.pages.account.profil.profil')

                                                        </p>
                                                    </div>
                                                    <div class="tab-pane fade active show" id="nav-sujet" role="tabpanel"
                                                        aria-labelledby="nav-sujet-tab">
                                                        <p>
                                                            @include('front.pages.account.sujet.liste')
                                                        </p>
                                                    </div>

                                                    <div class="tab-pane fade" id="nav-publier" role="tabpanel"
                                                        aria-labelledby="nav-publier-tab">
                                                        <p>
                                                            @include('front.pages.account.sujet.create')
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

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
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })
            ()

            $(".multiple").select2({
                placeholder: "Choisir......",
                allowClear: true
                // closeOnSelect: false
            });
        </script>
    @endpush

@endsection
