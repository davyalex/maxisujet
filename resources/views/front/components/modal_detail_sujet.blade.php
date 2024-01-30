<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="sujet{{ $item['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $item['sujet_title'] }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="meta-post">
                    <p>
                        <span style="font-weight: bold" class="">Publié
                            le</span>:
                        {{ $item['created_at'] }}
                    </p>
                    <ul>
                        <li>
                            <span style="font-weight:bold" class="">Categorie</span>:
                            <span class=""> {{ $item['categorie']['title'] }}</span>

                        </li>
                        <li>
                            <span style="font-weight: bold" class="">Matieres</span>:
                            @foreach ($item['matieres'] as $matieres)
                                <span> {{ $matieres['title'] }} ,</span>
                            @endforeach
                        </li>

                        <li>
                            <span style="font-weight: bold" class="">Niveaux</span>:
                            @foreach ($item['niveaux'] as $niveaux)
                                {{ $niveaux['title'] }} ,
                            @endforeach
                        </li>

                        <li class="{{ $item['etablissement'] ? ' ' : 'd-none' }}">
                            <span style="font-weight:bold" class="">Etablissement</span>:
                            <span class=""> {{ $item['etablissement']['title'] }}</span>

                        </li>


                        <li>
                            <span style="font-weight:bold" class="">Sujet</span>:
                            <span><i class="icofont-file-pdf"></i> Fichier du sujet</span>
                            @auth
                                <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->sujet_file) }}">
                                    <i class="icofont-download"></i> </a>
                            @endauth

                            @guest
                                <a href="{{ route('user.login') }}" type="button" class="lab-btn mt-2"><span>

                                        <i class="icofont-download"></i></span></a>
                            @endguest

                        </li>

                        <li class="{{ $item->corrige_file ? ' ' : 'd-none' }}">
                            <span style="font-weight:bold" class="">Corrigé</span>:
                            <span><i class="icofont-file-pdf"></i> Fichier du sujet corrigé</span>
                            @auth

                                <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->corrige_file) }}">
                                    <i class="icofont-download"></i> </a>
                            @endauth

                            @guest
                                <a href="{{ route('user.login') }}" type="button" class="lab-btn mt-2"><span>

                                        <i class="icofont-download"></i></span></a>
                            @endguest
                        </li>







                        <li class="{{ $item['description'] ? ' ' : 'd-none' }}">
                            <span style="font-weight:bold" class="">Description</span>:
                            <span class=""> {{ $item['description'] }}</span>

                        </li>
                    </ul>

<hr>

                    {{-- commentaire --}}

                    @auth
                        <div class="form-comment">
                            <h5>Ajouter un commentaire</h5>
                            <textarea class="form-control" name="content" id="content" cols="20" rows="
                        5"></textarea>
                        <input type="text" name="model" value="Sujet" id="" hidden>
                        <input type="text" name="sujet_id" value="{{$item['id']}}" hidden>

                            <button type="submit" id="submit" class="btn btn-outline-primary">Envoyer</button><br><br>
                        </div>
                    @endauth



                    @guest
                        <a href="{{ route('user.login') }}" type="button" class="lab-btn mt-2"><span>

                                <i class="icofont-pen-alt-2"></i> </span>Connectez vous pour ajouter votre commentaire.</a>
                    @endguest


                </div>
            </div>
            <div class="modal-footer " style="display: none">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button"  class="btn btn-primary">Valider</button>
            </div>
        </div>
    </div>
</div>


