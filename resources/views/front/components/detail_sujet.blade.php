<div class="collapse" id="collapsewithlink{{ $item['id'] }}">
    <div class="card card-body">

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
                    <span class="">
                        {{ $item['etablissement'] ? $item['etablissement']['title'] : '' }}</span>

                </li>


                {{-- <li>
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
                        </li> --}}







                <li class="{{ $item['description'] ? ' ' : 'd-none' }}">
                    <span style="font-weight:bold" class="">Description</span>:
                    <span class=""> {{ $item['description'] }}</span>

                </li>
            </ul>

            <hr>

            {{-- commentaire --}}


            {{-- <div id="comments" class="comments">
                <h4 class="title-border"> Commentaires ( {{ count($item->commentaires) }})</h4>
                <ul class="comment-list">
                    @foreach ($item['commentaires'] as $items)
                        <li class="comment">
                            <div class="com-thumb">
                                <img alt="" class="img-thumbnail" width="70%"
                                    src="{{ asset('front/assets/images/custom/user_avatar.png') }}">
                            </div>
                            <div class="com-content">
                                <div class="com-title">
                                    <div class="com-title-meta">
                                        <h6 id="auth_user"> {{ $items['user']['username'] }} </h6>
                                        <span id="created_at">
                                            {{ \Carbon\Carbon::parse($items['created_at'])->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <p id="news_content"> {{ $items['content'] }} </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div> --}}
{{-- 
            @auth
                <div id="respond" class="comment-respond mb-lg-0">
                    <h4 class="title-border">Laisser un commentaire</h4>
                    <div class="add-comment">
                        <p class="msgError text-danger text-center text-bold">
                            Le champs commentaire est vide
                        </p>
                        <form action="#" method="post">
                           
                            <textarea name="content" id="content" rows="5" placeholder="Ecrivez votre commentaire ici"></textarea>
                            <input type="text" name="model" value="Sujet" id="model" hidden>
                            <input type="text" name="sujet_id" id="sujet_id" value="{{ $item['id'] }}" hidden>
                            <button type="submit" id="submit" class="lab-btn"><span>Envoyez</span></button>
                        </form>
                    </div>
                </div>
            @endauth --}}



            {{-- @guest
                <a href="{{ route('user.login') }}" type="button" class="lab-btn mt-2"><span>

                        <i class="icofont-pen-alt-2"></i> </span>Connectez vous pour ajouter votre commentaire.</a>
            @endguest --}}


        </div>




    </div>
</div>


  <script type="text/javascript">
        //send content comment
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //hide error message
            $('.msgError').hide();

            $('#submit').click(function(e) {
                e.preventDefault();


                var sujetId = $('#sujet_id').val();
                var model = $('#model').val();
                var content = $("#content").val();

                if (content == '') {
                    $('.msgError').show(200);
                } else {
                    $('.msgError').hide();

                    //send data to controller


                    $.ajax({
                        type: "POST",
                        url: "{{ route('addComment') }}",
                        data: {
                            sujetId: sujetId,
                            model: model,
                            content: content
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.message == 'data found') {
                                location.reload();
                            }
                            // $("#content").val('');
                            // $('#news_content').append(response.data.content);
                            // $('#created_at').append(response.data.created_at);
                        }
                    });
                }



            });

        });
    </script>