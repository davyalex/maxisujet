@extends('front.layouts.app')

{{-- @section('title', 'Nouveau mot de passe') --}}

@section('content')
    @php
        $msg_validation = ' Champs obligatoire';
    @endphp

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
                <h3 class="">Definir un nouveau mot de passe</h3>
                <form novalidate class="account-form mt-3 needs-validation form-horizontal" method="POST"
                    action="{{ route('reset.password.post') }}">
                    @csrf
                    <div>
                        <div class="form-group">
                            <input id="password" class="form-control" type="password" placeholder="Mot de passe"
                                name="password" required>
                            <div class="invalid-feedback"> {{ $msg_validation }} </div>
                        </div>
                        <div class="form-group">
                            <input id="confirm_password" class="form-control" type="password"
                                placeholder="Confirmer le mot de password" name="confirm_password" required>
                            <div class="invalid-feedback"> {{ $msg_validation }} </div>
                            <p id="Msg_pwd"></p>
                        </div>
                        <input type="text" value="{{request('token')}}" name="token" hidden>
                    </div>

                    <button type="submit" class="lab-btn btn-register"><span>Valider</span></button>
                </form>

            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->



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


            //on verifie si les deux mot passe correspondent
            $('#password, #confirm_password').on('keyup', function() {
                var password = $('#password').val()
                var confirm_password = $('#confirm_password').val()

                if (password == confirm_password && password.length >= 8 && confirm_password.length >= 8) {
                    $('#Msg_pwd').html('les mots de passe sont identiques!').css('color', 'green');
                    $('.btn-code').show(200);
                } else if (password != confirm_password) {
                    $('#Msg_pwd').html('les mots de passe ne sont pas identique!').css('color', 'red');
                    $('.btn-code').hide(200);
                } else if (password.length < 8 && confirm_password.length < 8) {
                    $('#Msg_pwd').html("le mot de passe doit etre 8 caractere minimun").css('color', 'red');
                    $('.btn-code').hide(200);
                }

            });

            //on affiche le champs profil autre si  l'utilisateur coche la case "Autre"
        </script>
    @endpush
@endsection
