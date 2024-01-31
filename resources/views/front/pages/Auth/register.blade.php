@extends('front.layouts.app')

@section('title', 'Inscription')

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
                                <li class="breadcrumb-item"><a href="javascript:history.back()"><i class="icofont-caret-left"></i> Retour</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont-home"></i> Accueil</a></li>
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
                <h3 class="title">S'inscrire</h3>
                <small class="text-danger">Inscrivez vous pour télecharger les sujets</small>
                <form class="account-form" method="POST" action="{{route('user.register')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Nom utilisateur" name="username" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Mot de passe" name="password" required>
                    </div>
                    {{-- <div class="form-group">
                        <input type="password" placeholder="Confirm Password" name="password">
                    </div> --}}
                    <input type="text" name="role" value="client"  hidden>
                    <input type="text" name="url_previous" value="{{url()->previous()}}"  hidden>

                    <div class="form-group">
                        <button type="submit" class="lab-btn"><span>S'inscrire</span></button>
                    </div>
                </form>
                <div class="account-bottom">
                    <span class="d-block cate pt-10">Vous avez déjà un compte? <a href="#">Connectez-vous</a></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->
    
@endsection