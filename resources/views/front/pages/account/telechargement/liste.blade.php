<div class=" overflow-auto">
    <ul class="overflow-auto">
    @foreach ($user['sujet_download'] as $key => $item)
        <li style="list-style: none" class=" overflow-auto">
            {{ ++$key }} - <a class="btn btn-link" data-bs-toggle="collapse"
                href="#collapsewithlink{{ $key }}" role="button" aria-expanded="false"
                aria-controls="collapsewithlink"> sujet# {{ $item['sujet_title'] }} télechargé le
                {{ $item['created_at'] }} </a>


            <div class="collapse" id="collapsewithlink{{ $key }}">
                <div class="card card-body">

                    <ul>
                        <li>
                            <span style="font-weight:bold" class="">Corrigé</span>:
                            <span><i class="icofont-file-pdf"></i> Fichier du sujet corrigé</span>


                            <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->corrige_file) }}">
                                <i class="icofont-download"></i> </a>

                        </li>

                        <li>
                            <span style="font-weight:bold" class="">Sujet</span>:
                            <span><i class="icofont-file-pdf"></i> Fichier du sujet</span>

                            <a class="btn btn-outline-info" href="{{ asset('storage/' . $item->sujet_file) }}">
                                <i class="icofont-download"></i> </a>
                        </li>
                    </ul>




                </div>
            </div>
        </li>
    @endforeach
</ul>

</div>