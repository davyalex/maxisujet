@extends('front.layouts.app')

@section('title', 'Inscription')

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
                <h3 class="">S'inscrire</h3>
                <span class="text-bold">Inscrivez vous pour télecharger les sujets</span>
                <form novalidate class="account-form mt-3 needs-validation form-horizontal" method="POST"
                    action="{{ route('user.register') }}">
                    @csrf
                    <div class="form_hide">
                        <div class="form-group">
                            <select class="form-control" name="profil" id="profil" required>
                                <option selected disabled value>Sélectionner votre profil</option>
                                <option value="eleve">Eleve</option>
                                <option value="etudiant">Etudiant(e)</option>
                                <option value="enseignant">Enseignant(e)</option>
                                <option value="autre">Autre</option>
                            </select>
                            <div class="invalid-feedback"> {{ $msg_validation }} </div>
                        </div>
                        <div class="form-group profil_autre">
                            <input id="profil_autre" type="text" class="form-control"
                                placeholder="votre profil Ex :repetiteur, parent: " name="profil_autre">
                            <div class="invalid-feedback"> {{ $msg_validation }} </div>
                        </div>
                        <div class="form-group">
                            <input id="username" type="text" class="form-control" placeholder="Nom utilisateur"
                                name="username" required>
                            <div class="invalid-feedback"> {{ $msg_validation }} </div>
                        </div>
                        <div class="form-group">
                            <input id="email" class="form-control" type="text" placeholder="Email" name="email"
                                required>
                            <div class="invalid-feedback"> {{ $msg_validation }} </div>
                        </div>
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


                        <input type="text" name="role" value="client" hidden>
                        <input type="text" name="url_previous" value="{{ url()->previous() }}" hidden>
                    </div>

                    <!-- ========== Start generate random code ========== -->
                    <h4 id="captcha"></h4>
                    <!-- ========== End generate random code ========== -->
                    <input class="form-control" type="text" name="captcha" placeholder="Tapez le code generé içi"
                        id="captcha_insert" required>
                    <p id="Msg_captcha"></p>



                    <div class="form-group">
                        <button class="lab-btn btn-code"><span>Continuer</span></button>
                        <button type="submit" class="lab-btn btn-register"><span>S'inscrire</span></button>
                    </div>
                </form>
                <div class="account-bottom">
                    <span class="d-block cate pt-10">Vous avez déjà un compte? <a
                            href="{{ route('user.login') }}">Connectez-vous</a></span>
                </div>
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

            //Gestion du formulaire

            //on cache la div du champs profil autre
            $('.profil_autre').hide();

            //on cache les boutton register, continuer
            $('.btn-code').hide();
            $('.btn-register').hide();

            //on cache le champs captcha
            $('#captcha_insert').hide();




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
                    $('#Msg_pwd').html("le mot de passe doit etre 8 caractere maximum").css('color', 'red');
                    $('.btn-code').hide(200);
                }

            });



            //on affiche le champs profil autre si  l'utilisateur coche la case "Autre"
            $('#profil').change(function() {
                if ($("option:selected").val() === "autre") {
                    $('.profil_autre').show(200);
                    $('#profil_autre').prop('required', true);
                } else {
                    $('.profil_autre').hide(200);
                    $('#profil_autre').prop('required', false);
                    $('#profil_autre').val('');
                };
            });



            // on genere le code captcha
            $(".btn-code").click(function(e) {
                // e.preventDefault();

                var profil = $('#profil').val();
                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val()
                var confirm_password = $('#confirm_password').val()

                //on verifie si les champs ne  sont pas vides
                if (
                    profil.length > 0 &&
                    username.length > 0 &&
                    email.length > 0 &&
                    password.length > 0 &&
                    confirm_password.length > 0
                )

                {


                    if ($('#profil_autre').is(':visible') && $('#profil_autre').val().length > 0) {
                        // on genere le code
                        var code = Math.random().toString(36).slice(2)
                        $("#captcha").html(code);
                        $('#captcha_insert').show(200);
                                            $('.form_hide').hide(200);


                    } else if ($('#profil_autre').is(':hidden') && profil.length > 0) {
                        var code = Math.random().toString(36).slice(2)
                        $("#captcha").html(code);
                        $('#captcha_insert').show(200);
                                            $('.form_hide').hide(200);


                    } else if ($('#profil_autre').is(':visible') && $('#profil_autre').val().length == 0) {
                        $("#captcha").html('');
                        $('#captcha_insert').hide(200);
                    } 

                }

            });


            $('#captcha_insert').keyup(function(e) {
                var captcha_insert = $('#captcha_insert').val();
                var code = $("#captcha").html()
                if (code !== captcha_insert) {
                    $('#Msg_captcha').html("Le code inseré est incorrect").css('color', 'red');

                } else {
                    $('#Msg_captcha').html("Le code correct").css('color', 'green');
                    $('.btn-code').hide();
                    $("#captcha").show();
                    $('#captcha_insert').show(200);
                    $('.btn-register').show(200);
                }


            });








            // on genere le code
            // var code = Math.random().toString(36).slice(2)
            // $("#captcha").html(code);

            // $(".multiple").select2({
            //     placeholder: "Choisir......",
            //     allowClear: true
            //     // closeOnSelect: false
            // });
        </script>
    @endpush
@endsection
