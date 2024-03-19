           @extends('front.layouts.app')

           @section('title', 'Mon profil')

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
                                           <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                                       class="icofont-home"></i>
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
                           <h3 class="">Modifier mes informations</h3>
                           <form novalidate class="account-form mt-3 needs-validation form-horizontal" method="POST"
                               action="{{ route('user_account.update-profil-info', Auth::id()) }}">
                               @csrf
                               <div class="form_hide">
                                   <div class="form-group">
                                       @php
                                           $profil = Auth::user()->profil;
                                           $profil_autre = '';
                                           if (in_array($profil, ['eleve', 'etudiant', 'enseignant'])) {
                                               $profil_autre = false;
                                           } else {
                                               $profil_autre = true;
                                           }
                                       @endphp
                                       <select class="form-control" name="profil" id="profil" required>

                                           <option selected disabled value>Sélectionner votre profil</option>
                                           <option value="eleve" {{ $profil == 'eleve' ? 'selected' : '' }}>Eleve</option>
                                           <option value="etudiant" {{ $profil == 'etudiant' ? 'selected' : '' }}>
                                               Etudiant(e)
                                           </option>
                                           <option value="enseignant" {{ $profil == 'enseignant' ? 'selected' : '' }}>
                                               Enseignant(e)</option>
                                           <option value="autre" {{ $profil_autre == true ? 'selected' : '' }}>Autre
                                           </option>
                                       </select>
                                       <div class="invalid-feedback"> {{ $msg_validation }} </div>
                                   </div>
                                   <div class="form-group profil_autre">
                                       <input id="profil_autre" type="text"
                                           value="{{ $profil_autre == true ? Auth::user()->profil : '' }}"
                                           class="form-control" placeholder="votre profil Ex :repetiteur, parent: "
                                           name="profil_autre">
                                       <div class="invalid-feedback"> {{ $msg_validation }} </div>
                                   </div>
                                   <div class="form-group">
                                       <input id="username" value="{{ Auth::user()->username }}" type="text"
                                           class="form-control" placeholder="Nom utilisateur" name="username" required>
                                       <div class="invalid-feedback"> {{ $msg_validation }} </div>
                                   </div>
                                   <div class="form-group">
                                       <input id="email" value="{{ Auth::user()->email }}" class="form-control"
                                           type="text" placeholder="Email" name="email" required>
                                       <div class="invalid-feedback"> {{ $msg_validation }} </div>
                                   </div>


                               </div>
                               <button type="submit" class="lab-btn btn-register"><span>Modifier</span></button>
                           </form>


                           <h5 class="text-danger mt-5">Modifier le mot de passe</h5>
                           @include('admin.components.validationMessage')

                           <form novalidate class="account-form mt-3 needs-validation form-horizontal" method="POST"
                               action="{{ route('user_account.update-profil-pwd', Auth::id()) }}">
                               @csrf
                               <div class="form_hide">

                                   <div class="form-group">
                                       <input id="password" class="form-control" type="password"
                                           placeholder="Entrez l'ancien mot de passe" name="old_password" required>
                                       <div class="invalid-feedback"> {{ $msg_validation }} </div>
                                   </div>
                                   <div class="form-group">
                                       <input id="new_password" class="form-control" type="password"
                                           placeholder="Nouveau mot de passe" name="new_password" required>
                                       <div class="invalid-feedback"> {{ $msg_validation }} </div>
                                       <p id="Msg_pwd"></p>
                                   </div>



                               </div>
                               <button type="submit" class="lab-btn btn-register"><span>Modifier</span></button>
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

                       //Gestion du formulaire

                       //on cache la div du champs profil autre
                       $('.profil_autre').hide();




                       //on verifie si les deux mot passe font 8 caractere minimun
                       $('#password, #new_password').on('keyup', function() {
                           var password = $('#password').val()
                           var new_password = $('#new_password').val()
                           if (password.length < 8) {
                               $('#Msg_pwd').html("le mot de passe doit etre 8 caractere minimun").css('color', 'red');
                               $('.btn-code').hide(200);
                           } else if (new_password.length < 8) {
                               $('#Msg_pwd').html("le mot de passe doit etre 8 caractere minimun").css('color', 'red');
                               $('.btn-code').hide(200);
                           } else {
                               $('.btn-code').show(200);
                               $('#Msg_pwd').html(" ")
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

                       //on verifie si option du champs profil est 'autre'
                       var p_autre = $('#profil_autre').val();
                       if (p_autre.length > 0) {
                           $('.profil_autre').show(200);
                       } else {
                           $('.profil_autre').hide(200);
                       }

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
