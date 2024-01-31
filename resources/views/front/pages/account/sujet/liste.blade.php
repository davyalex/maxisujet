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
                                 <a href="" type="button" class="lab-btn mt-2" data-bs-toggle="modal"
                                     data-bs-target="#edit{{ $item['id'] }}" style="font-size: 20px;">
                                     <i class="icofont-edit"></i></a>

                                 <a href="#" class=" lab-btn mt-2 delete" role="button"
                                     data-id="{{ $item['id'] }}"><i class="icofont-trash"
                                         style="font-size: 20px;"></i></a>


                                 <a href="#" type="button" class="lab-btn mt-2" data-bs-toggle="modal"
                                     data-bs-target="#sujet{{ $item['id'] }}" style="font-size: 20px;">
                                     <i class="icofont-eye"></i></a>

                             @endauth

                         </div>
                     </div>
                     @include('front.pages.account.sujet.edit')
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



 <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>



 {{-- script JS for delete data --}}
 <script>
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
 </script>
