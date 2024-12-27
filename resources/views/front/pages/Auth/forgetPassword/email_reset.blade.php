@extends('front.layouts.app')

@section('title', 'Recuperation de mot de passe')

@section('content')


    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2> <span style="color:rgb(255, 84, 5)"> @yield('title') </h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
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




    <!-- Login Section Section Starts Here -->
    <div class="login-section padding-tb section-bg">
        <div class="container">
            <div class="col-md-6 m-auto">
                @include('admin.components.validationMessage')
            </div>
            <div class="account-wrapper">
                <h3 class="">Mot de passe oublié</h3>
                <span class="text-bold">Veuillez entrer votre email <br>pour la recuperation de votre mot de passe</span>
                <form class="account-form mt-3" method="POST" action="{{ route('forget.password.post') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Nom utilisateur ou Email" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="lab-btn"><span class="">Valider</span>
                            <div class="spinner-grow text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->
    <script>
        $(document).ready(function() {
            $('.spinner-grow').hide();
        
            $('form').submit(function (e) { 
                  var email = $('#email').val()
                if (email) {
                    $('.lab-btn').prop("disabled", true);
                    $(".spinner-grow").show();
                }
            });

        });
    </script>

@endsection
