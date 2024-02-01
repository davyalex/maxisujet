 <div class="col-lg-12 col-12">
     <article>
         <div class="section-wrapper">
             <div class="row row-cols-1 justify-content-center g-2">
                 @foreach ($sujets as $item)
                     <div class="col">
                         <div class="sujet-recent bg-white p-2">
                             <a href="#">
                                 <h3>
                                     {{ $item['sujet_title'] }}
                                 </h3>
                             </a>
                             <div class="meta-post">
                                 <span style="font-weight: bold" class="">Categorie</span>:
                                 {{ $item['categorie']['title'] }} <br>

                                 <span style="font-weight: bold" class="">Matieres</span>:
                                 @foreach ($item['matieres'] as $matieres)
                                     {{ $matieres['title'] }} ,
                                 @endforeach

                                 <br> <span style="font-weight: bold" class="">Niveaux</span>:
                                 @foreach ($item['niveaux'] as $niveaux)
                                     {{ $niveaux['title'] }} ,
                                 @endforeach


                                 <br> <span style="font-weight: bold" class="">Publié
                                     le</span>:
                                 {{ $item['created_at'] }}

                             </div>
                             {{-- si utilisateur connecté il peut telecharger --}}
                             @auth
                                 <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapsewithlink{{$item['id']}}"
                                     role="button" aria-expanded="false" aria-controls="collapsewithlink"><i class="icofont-eye text-white"
                                         style="font-size: 20px;"></i></a>


                                 <div class="collapse" id="collapsewithlink{{$item['id']}}">
                                     <div class="card card-body">
                                         @include('front.pages.account.sujet.edit') </div>
                                 </div>


                                 <a href="#" class="btn btn-danger delete" role="button"
                                     data-id="{{ $item['id'] }}"><i class="icofont-trash text-white"
                                         style="font-size: 20px;"></i></a>


                                 {{-- <a href="#" type="button" class="lab-btn mt-2" data-bs-toggle="modal"
                                     data-bs-target="#sujet{{ $item['id'] }}" style="font-size: 20px;">
                                     <i class="icofont-eye"></i></a> --}}

                             @endauth

                         </div>
                     </div>




                     @include('front.components.modal_detail_sujet')
                 @endforeach

             </div>
         </div>
     </article>
     {{-- <ul class="default-pagination lab-ul">
                                    <li>
                                        <a href="#"><i class="icofont-rounded-left"></i></a>
                                    </li>
                                    <li>
                                        <a href="#">01</a>
                                    </li>
                                    <li>
                                        <a href="#" class="active">02</a>
                                    </li>
                                    <li>
                                        <a href="#">03</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icofont-rounded-right"></i></a>
                                    </li>
                                </ul> --}}
 </div>





 <script>
     //script JS for delete data 
     $(document).ready(function() {
         $('.delete').on("click", function(e) {
             e.preventDefault();
             var Id = $(this).attr('data-id');
             Swal.fire({
                 title: "Etes vous sûr ?",
                 // text: "Vous ne pourrez pas revenir en arrière !",
                 // icon: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#3085d6",
                 cancelButtonColor: "#d33",
                 confirmButtonText: "Oui, Supprimer!"
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         type: "POST",
                         url: "/admin/sujet/destroy/" + Id,
                         dataType: "json",
                         data: {
                             _token: '{{ csrf_token() }}',

                         },
                         success: function(response) {
                             if (response.status === 200) {
                                 Swal.fire({
                                     toast: true,
                                     icon: 'success',
                                     title: 'Opération reussi',
                                     animation: false,
                                     position: 'top',
                                     background: '#3da108e0',
                                     iconColor: '#fff',
                                     color: '#fff',
                                     showConfirmButton: false,
                                     timer: 500,
                                     timerProgressBar: true,
                                 });
                                 setTimeout(function() {
                                     window.location.href =
                                         "{{ route('user_account.dashboard') }}";
                                 }, 500);
                             }
                         }
                     });
                 }
             });
         });
     });



     /***** script pour la gestion du sujet ******/

     // cacher par defaut

     $('.btn_edit').click(function(e) {
         e.preventDefault();
         //  var  btnId=  $(this).attr("data-id")
         //  var  divId=  $('.sujet_edit').attr('data-id');
         //  if (btnId === divId) {
         //     $('.sujet_edit').show();
         //  }
         //  console.log(btnId===divId);





         //on affiche les infos du sujet
         //  $('.sujet_edit').toggle(200);



     });
 </script>
