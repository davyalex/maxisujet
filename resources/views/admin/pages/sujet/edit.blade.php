@extends('admin.layouts.app')

@section('title', 'sujet')

@section('content')

    @push('css')
        <link rel="stylesheet" href="{{ asset('back/assets/bundles/select2/dist/css/select2.min.css') }}">
    @endpush


    @php
        $msg_validation = ' Champs obligatoire';
    @endphp


    <div class="section-body">
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier un sujet</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.components.validationMessage')
                        <form action="{{ route('sujet.update', $sujet['id']) }}" class="needs-validation" novalidate=""
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Categorie</label>
                                    <div class="input-group">
                                        <select name="category_id" class="form-control select2" required>
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}"
                                                    {{ $category['id'] == $sujet['category_id'] ? 'selected' : '' }}>
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
                                        <select name="niveaux[]" class="form-control select2" multiple required>
                                            {{-- On affiche tous les niveau et sous niveaux --}}
                                            @foreach ($niveaux_with_subNiveaux as $item)
                                                <option disabled> {{ $item['title'] }} </option>

                                                {{-- On affiche tous les sous niveau du niveau  --}}
                                                @foreach ($item->subNiveaux as $sub_niveaux)
                                                    @if ($sub_niveaux->subNiveaux->count() < 1)
                                                        <option value="{{ $sub_niveaux['id'] }}"
                                                        @if ($sujet->niveaux->containsStrict('id', $sub_niveaux->id)) selected="selected" @endif

                                                        >{{ $sub_niveaux['title'] }}
                                                        </option>
                                                    @endif
                                                    {{-- On affiche tous les sous niveau qui ont des sous niveaux(parent)  --}}
                                                    @if ($sub_niveaux->subNiveaux->count() > 0)
                                                        @foreach ($sub_niveaux->subNiveaux as $sub_niveaux2)
                                                            <option value="{{ $sub_niveaux2['id'] }}"
                                                                @if ($sujet->niveaux->containsStrict('id', $sub_niveaux2->id)) selected="selected" @endif>
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
                                        <select name="matieres[]" class="form-control select2" multiple required>
                                            <option></option>
                                            @foreach ($matieres as $matiere)
                                                <option value="{{ $matiere['id'] }}"
                                                    @if ($sujet->matieres->containsStrict('id', $matiere->id)) selected="selected" @endif>
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
                                    <select name="etablissement_id" class="form-control select2" required>

                                        @foreach ($etablissements as $etablissement)
                                            <option value="{{ $etablissement['id'] }}"
                                                {{ $etablissement['id'] == $sujet['etablissement_id'] ? 'selected' : ' <option >Selectionner</option>' }}>
                                                {{ $etablissement['title'] }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $msg_validation }}
                                    </div>
                                </div>

                                <label>Année</label>
                                <div class="input-group">
                                    <select name="annee" class="form-control select2" required>

                                        @for ($i = 1994; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}"
                                                {{ $i == $sujet['annee'] ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $msg_validation }}
                                    </div>
                                </div>

                                <div class="form-group my-4">
                                    <label>Fichier du sujet</label>
                                    <a class="btn btn-outline-info" href="{{ asset('storage/' . $sujet->sujet_file) }}">
                                        {{ $sujet->sujet_file }}
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
                                    <a class="btn btn-outline-info" href="{{ asset('storage/' . $sujet->corrige_file) }}">
                                        {{ $sujet->corrige_file }}
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <div class="input-group">
                                        <input type="file" name ="corrige_file" class="form-control">
                                    </div>
                                </div>


                                <input type="text" value="{{ $sujet->corrige_file }}" name="corrige_file_exist" hidden>
                                <input type="text" value="{{ $sujet->sujet_file }}" name="sujet_file_exist" hidden>


                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>







    @push('js')
        <script src="{{ asset('back/assets/bundles/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
        </script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('back/assets/js/page/datatables.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush




@endsection
