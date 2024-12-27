 @php
     $msg_validation = ' Champs obligatoire';
 @endphp



 <!-- Button trigger modal -->
 <!-- Modal -->
 {{-- <div class="modal fade" id="edit{{ $item['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">{{ $item['sujet_title'] }} </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               
             </div>
             <div class="modal-footer " style="display: none">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                 <button type="button" class="btn btn-primary">Valider</button>
             </div>
         </div>
     </div>
 </div> --}}


   <form action="{{ route('sujet.update', $item['id']) }}" class="needs-validation" novalidate=""
                     method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                         <div class="form-group">
                             <label>Categorie</label>
                             <div class="input-group">
                                 <select name="category_id" class="form-control" required>
                                     <option></option>
                                     @foreach ($categories as $category)
                                         <option value="{{ $category['id'] }}"
                                             {{ $category['id'] == $item['category_id'] ? 'selected' : '' }}>
                                             {{ $category['title'] }} </option>
                                     @endforeach
                                 </select>
                                 <div class="invalid-feedback">
                                     {{ $msg_validation }}
                                 </div>
                             </div>
                         </div>

                         <div class="form-group">
                             <label>Niveau</label>
                             <div class="input-group">
                                 <select name="niveaux[]" class="form-control multiple" multiple="multiple" required>
                                     {{-- On affiche tous les niveau et sous niveaux --}}
                                     @foreach ($niveaux_with_subNiveaux as $items)
                                         <option disabled> {{ $items['title'] }} </option>

                                         {{-- On affiche tous les sous niveau du niveau  --}}
                                         @foreach ($items->subNiveaux as $sub_niveaux)
                                             @if ($sub_niveaux->subNiveaux->count() < 1)
                                                 <option value="{{ $sub_niveaux['id'] }}"
                                                     @if ($item->niveaux->containsStrict('id', $sub_niveaux->id)) selected="selected" @endif>
                                                     {{ $sub_niveaux['title'] }}
                                                 </option>
                                             @endif
                                             {{-- On affiche tous les sous niveau qui ont des sous niveaux(parent)  --}}
                                             @if ($sub_niveaux->subNiveaux->count() > 0)
                                                 @foreach ($sub_niveaux->subNiveaux as $sub_niveaux2)
                                                     <option value="{{ $sub_niveaux2['id'] }}"
                                                         @if ($item->niveaux->containsStrict('id', $sub_niveaux2->id)) selected="selected" @endif>
                                                         {{ $sub_niveaux2['title'] }}</option>
                                                 @endforeach
                                             @endif
                                         @endforeach
                                     @endforeach
                                 </select>
                                 <div class="invalid-feedback">
                                     {{ $msg_validation }}
                                 </div>
                             </div>
                         </div>

                         <div class="form-group">
                             <label>Matiere</label>
                             <div class="input-group">
                                 <select name="matieres[]" class="form-control multiple" multiple required>
                                     <option></option>
                                     @foreach ($matieres as $matiere)
                                         <option value="{{ $matiere['id'] }}"
                                             @if ($item->matieres->containsStrict('id', $matiere->id)) selected="selected" @endif>
                                             {{ $matiere['title'] }} </option>
                                     @endforeach
                                 </select>
                                 <div class="invalid-feedback">
                                     {{ $msg_validation }}
                                 </div>
                             </div>
                         </div>

                         <label>Etablissement</label>
                         <div class="input-group">
                             <select name="etablissement_id" class="form-control" required>

                                 @foreach ($etablissements as $etablissement)
                                     <option value="{{ $etablissement['id'] }}"
                                         {{ $etablissement['id'] == $item['etablissement_id'] ? 'selected' : ' <option >Selectionner</option>' }}>
                                         {{ $etablissement['title'] }} </option>
                                 @endforeach
                             </select>
                             <div class="invalid-feedback">
                                 {{ $msg_validation }}
                             </div>
                         </div>

                         <label>Année</label>
                         <div class="input-group">
                             <select name="annee" class="form-control">

                                 @for ($i = 1994; $i <= date('Y'); $i++)
                                     <option value="{{ $i }}" {{ $i == $item['annee'] ? 'selected' : '' }}>
                                         {{ $i }}
                                     </option>
                                 @endfor

                             </select>
                             <div class="invalid-feedback">
                                 {{ $msg_validation }}
                             </div>
                         </div>

                         <div class="form-group my-4">
                             <label>Fichier du sujet</label>
                             <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->sujet_file) }}">
                                 {{ $item->sujet_file }}
                                 <i class="fas fa-download"></i>
                             </a>
                             <div class="input-group">
                                 <input type="file" name ="sujet_file" class="form-control">
                                 <div class="invalid-feedback">
                                     {{ $msg_validation }}
                                 </div>
                             </div>
                         </div>



                         <div class="form-group">
                             <label>Corrigé du sujet</label>
                             <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->corrige_file) }}">
                                 {{ $item->corrige_file }}
                                 <i class="fas fa-download"></i>
                             </a>
                             <div class="input-group">
                                 <input type="file" name ="corrige_file" class="form-control">
                             </div>
                         </div>


                         <input type="text" value="{{ $item->corrige_file }}" name="corrige_file_exist" hidden>
                         <input type="text" value="{{ $item->sujet_file }}" name="sujet_file_exist" hidden>


                     </div>
                     <div class="card-footer text-right">
                         <button type="submit" class="btn btn-primary">Modifier</button>
                     </div>
                 </form>





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
     })()

      

 </script>
