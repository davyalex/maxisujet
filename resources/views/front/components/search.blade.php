<div class="content-search mt-4">
    <form action="{{ route('search') }}" method="GET">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Categorie</label>
                    <select name="categorie" class="single">
                        <option value=""></option>
                        @foreach ($categories as $item)
                            <option value="{{ $item['id'] }}">{{ $item['title'] }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Niveaux</label>
                    <select name="niveaux[]" class="multiple" multiple="multiple">
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
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Matieres</label>
                    <select name="matieres[]" class="multiple" multiple="multiple">
                        @foreach ($matieres as $item)
                            <option value="{{ $item['id'] }}">{{ $item['title'] }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label>Année</label>
                    <select name="annee" class="single">
                        <option value=""></option>

                        @for ($i = 1994; $i <= date('Y'); $i++)
                            <option value="{{ $i }}">{{ $i }} </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <label>Code sujet</label>
                    <input name="code_sujet" {{old('code_sujet')}} class="form-control">
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12 ">
                    <button type="submit" class="btn btn-primary btn-search w-100 mt-4">Rechercher</button>
                </div>

            </div>

        </div>
    </form>
</div>

@push('js')
    <script>
        $(".multiple").select2({
            placeholder: "Choisir......",
            allowClear: true
            // closeOnSelect: false
        });

        $(".single").select2({
            placeholder: "Choisir......",
            allowClear: true
            // closeOnSelect: false
        });
    </script>
@endpush
