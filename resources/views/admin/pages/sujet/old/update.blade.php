{{-- @php
    $msg_validation = ' Champs obligatoire';
@endphp





<!-- Modal with form -->
<div class="modal fade" id="modalEdit{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Modifier un sujet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sujet.update', $item['id']) }}" class="needs-validation" novalidate="" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Categorie</label>
                            <div class="input-group">
                                <select style="width:600px" name="category_id" class="form-control" required>
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}" {{$category['id'] == $item['category_id'] ? 'selected' : ''}}>{{ $category['title'] }} </option>
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
                                <select style="width:600px" name="niveaux[]" class="form-control select2" multiple
                                    required>
                                    @foreach ($niveaux_with_subNiveaux as $data)
                                        <option disabled>{{ $data['title'] }} </option>
                                        @foreach ($data->subNiveaux as $sub_niveaux)
                                            <option value="{{ $sub_niveaux['id'] }}"
                                            @if ($niveaux->contains('id', $sub_niveaux['id'])) @selected(true) @endif
                                            >{{ $sub_niveaux['title'] }}
                                            </option>
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
                                <select style="width:600px" name="matieres[]" class="form-control select2" multiple
                                    required>
                                    <option></option>
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere['id'] }}"
                                        @if ($sujet->matieres->containsStrict('id',$matiere->id)) selected="selected" @endif>
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
                            <select style="width:600px" name="etablissement_id" class="form-control" required>
                              
                                @foreach ($etablissements as $etablissement)
                                    <option value="{{ $etablissement['id'] }}" {{$etablissement['id'] == $item['etablissement_id'] ? 'selected' : ' <option >Selectionner</option>'}}>{{ $etablissement['title'] }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $msg_validation }}
                            </div>
                        </div>

                        <label>Année</label>
                        <div class="input-group">
                            <select style="width:600px" name="annee" class="form-control" required>
                              
                              @for ($i = 1994; $i <=date("Y"); $i++)
                              <option value="{{$i}}">{{$i}} </option>
                              @endfor
                             
                            </select>
                            <div class="invalid-feedback">
                                {{ $msg_validation }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Fichier du sujet</label>
                            <a class="btn btn-outline-info"
                            href="{{ asset('storage/' . $item->sujet_file) }}">
                            {{$item->sujet_file}}
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
                            <a class="btn btn-outline-info"
                            href="{{ asset('storage/' . $item->corrige_file) }}">
                            {{$item->corrige_file}}
                            <i class="fas fa-download"></i>
                        </a>
                            <div class="input-group">
                                <input type="file" name ="corrige_file" class="form-control">
                            </div>
                        </div>


                        <input type="text" value="{{$item->corrige_file}}" name="corrige_file_exist" hidden>
                        <input type="text" value="{{$item->sujet_file}}" name="sujet_file_exist" hidden>


                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
