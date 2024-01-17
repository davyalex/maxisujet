@php
    $msg_validation = ' Champs obligatoire';
@endphp





<!-- Modal with form -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Ajouter un sujet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sujet.store') }}" class="needs-validation" novalidate="" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Categorie</label>
                            <div class="input-group">
                                <select style="width:600px" name="category_id" class="form-control" required>
                                    <option></option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }} </option>
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
                                    {{-- On affiche tous les niveau et sous niveaux --}}
                                    @foreach ($niveaux_with_subNiveaux as $item)
                                        <option disabled> {{ $item['title'] }} </option>

                                        {{-- On affiche tous les sous niveau du niveau  --}}
                                        @foreach ($item->subNiveaux as $sub_niveaux)
                                            @if ($sub_niveaux->subNiveaux->count() < 1)
                                                <option value="{{ $sub_niveaux['id'] }}">{{ $sub_niveaux['title'] }}
                                                </option>
                                            @endif
                                            {{-- On affiche tous les sous niveau qui ont des sous niveaux(parent)  --}}
                                            @if ($sub_niveaux->subNiveaux->count() > 0)
                                                @foreach ($sub_niveaux->subNiveaux as $sub_niveaux2)
                                                    <option value="{{ $sub_niveaux2['id'] }}">
                                                        {{ $sub_niveaux2['title'] }}
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
                                <select style="width:600px" name="matieres[]" class="form-control select2" multiple
                                    required>
                                    <option></option>
                                    @foreach ($matieres as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }} </option>
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
                                <option>Selectionner</option>
                                @foreach ($etablissements as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['title'] }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $msg_validation }}
                            </div>
                        </div>

                        <label>Année</label>
                        <div class="input-group">
                            <select style="width:600px" name="annee" class="form-control" required>
                                <option>Selectionner</option>

                                @for ($i = 1994; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }} </option>
                                @endfor

                            </select>
                            <div class="invalid-feedback">
                                {{ $msg_validation }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Fichier du sujet</label>
                            <div class="input-group">
                                <input type="file" name ="sujet_file" class="form-control" required>
                                <div class="invalid-feedback">
                                    {{ $msg_validation }}
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label>Corrigé du sujet</label>
                            <div class="input-group">
                                <input type="file" name ="corrige_file" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
