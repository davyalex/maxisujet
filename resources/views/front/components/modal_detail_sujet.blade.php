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
                            <span>{{ $item->sujet_file }}</span>
                            <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->sujet_file) }}">
                                <i class="icofont-download"></i> </a>
                        </li>

                        <li>
                            <span style="font-weight:bold" class="">Corrigé</span>:
                            <span>{{ $item->corrige_file }}</span>
                            <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->corrige_file) }}">
                                <i class="icofont-download"></i> </a>
                        </li>
                        <li class="{{ $item['description'] ? ' ' : 'd-none' }}">
                            <span style="font-weight:bold" class="">Description</span>:
                            <span class=""> {{ $item['description'] }}</span>

                        </li>
                    </ul>

                    <div class="form-comment">
                        <h5>Ajouter un commentaire</h5>
                        <textarea class="form-control" name="" id="message" cols="20" rows="
                        5"></textarea>
                        <button type="submit" class="btn btn-outline-primary">Envoyer</button><br><br>
                    </div>

                </div>
            </div>
            <div class="modal-footer " style="display: none">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
