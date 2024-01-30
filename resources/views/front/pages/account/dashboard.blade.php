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
                                                <span><i class="icofont-download"></i> Télechargement:</span>
                                                <span style="color: rgb(246, 108, 3)">0</span>
                                            </p>

                                            <h2 style="color: rgb(246, 108, 3)">0
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

                                                        <button class="nav-link active" id="nav-contact-tab" data-bs-toggle="tab"
                                                            data-bs-target="#nav-contact" type="button" role="tab"
                                                            aria-controls="nav-contact" aria-selected="false">
                                                            <i class="icofont-files-stack"></i>
                                                            Publier un sujet</button>

                                                        <button class="nav-link " id="nav-home-tab"
                                                            data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                                                            role="tab" aria-controls="nav-home" aria-selected="true">
                                                            <i class="icofont-download"></i>
                                                            Mes télechargements</button>

                                                              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                            data-bs-target="#nav-profile" type="button" role="tab"
                                                            aria-controls="nav-profile" aria-selected="false">
                                                            <i class="icofont-user"></i>
                                                            Mon
                                                            profil</button>


                                                    </div>
                                                </nav>


                                                <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                                                    <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                                        aria-labelledby="nav-home-tab">
                                                        <p><strong>This is some placeholder content the Home tab's
                                                                associated content.</strong>
                                                            Clicking another tab will toggle the visibility of this one for
                                                            the next. The tab JavaScript swaps
                                                            classes to control the content visibility and styling. You can
                                                            use it with tabs, pills, and any
                                                            other <code>.nav</code>-powered navigation.</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                                        aria-labelledby="nav-profile-tab">
                                                        <p>

                                                            <!-- Login Section Section Starts Here -->
                                                        <div class="login-section padding-tb section-bg">
                                                            <div class="container">
                                                                <div class="col-md-6 m-auto">
                                                                    @include('admin.components.validationMessage')
                                                                </div>
                                                                <div class="account-wrapper">
                                                                    <h3 class="title">S'inscrire</h3>
                                                                    <small class="text-danger">Inscrivez vous pour
                                                                        télecharger les sujets</small>
                                                                    <form class="account-form" method="POST"
                                                                        action="{{ route('user.register') }}">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                placeholder="Nom utilisateur"
                                                                                name="username" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="Email"
                                                                                name="email" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="password"
                                                                                placeholder="Mot de passe" name="password"
                                                                                required>
                                                                        </div>
                                                                        {{-- <div class="form-group">
                        <input type="password" placeholder="Confirm Password" name="password">
                    </div> --}}
                                                                        <input type="text" name="role"
                                                                            value="client" id="" hidden>
                                                                        <input type="text" name="url_previous"
                                                                            value="{{ url()->previous() }}" id=""
                                                                            hidden>

                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="lab-btn"><span>S'inscrire</span></button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Login Section Section Ends Here -->
                                                        </p>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                                        aria-labelledby="nav-contact-tab">
                                                        <p><strong>This is some placeholder content the Contact tab's
                                                                associated content.</strong>
                                                            Clicking another tab will toggle the visibility of this one for
                                                            the next.
                                                            The tab JavaScript swaps classes to control the content
                                                            visibility and styling. You can use it with
                                                            tabs, pills, and any other <code>.nav</code>-powered navigation.
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





@endsection
