@extends('admin.layouts.app')

@section('title', 'sujet')

@section('content')

    @push('css')
        <link rel="stylesheet" href="{{ asset('back/assets/bundles/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/datatables.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    @endpush




    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des sujets</h4>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAdd">
                            <i class="fas fa-plus"></i> Ajouter un sujet</button>
                    </div>
                    <div class="card-body">
                        @include('admin.components.validationMessage')
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>categorie</th>
                                        <th>Matiere</th>
                                        <th>Niveau</th>
                                        <th>Sujet</th>
                                        <th>Corrigé</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($sujets as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }} </td>
                                            <td>{{ $item['categorie']['title'] }} </td>
                                            <td>
                                                @foreach ($item['matieres'] as $matieres)
                                                    <span>{{ $matieres['title'] }} </span><br>
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach ($item['niveaux'] as $niveaux)
                                                    <span>{{ $niveaux['title'] }} </span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <span>{{ $item->sujet_file }}</span>
                                                <br> <a class="btn btn-outline-info"
                                                    href="{{ asset('storage/' . $item->sujet_file) }}">
                                                    <i class="fas fa-download">Telecharger</i> </a>

                                            </td>
                                            <td>
                                                <span>{{ $item->corrige_file }}</span>
                                                <br><a class="btn btn-outline-info"
                                                    href="{{ asset('storage/' . $item->corrige_file) }}">
                                                    <i class="fas fa-download">Telecharger</i>
                                                </a>

                                            </td>


                                            <td>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modalEdit{{ $item['id'] }}"><i
                                                        class="fas fa-edit fs-20" style="font-size: 20px;"></i></a>

                                                <a href="#" class="delete" role="button"
                                                    data-id="{{ $item['id'] }}"><i class="fas fa-trash text-danger"
                                                        style="font-size: 20px;"></i></a>
                                            </td>
                                        </tr>
                                        {{-- modal edit form --}}
                                        @include('admin.pages.sujet.edit')
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- modal create form --}}
                            @include('admin.pages.sujet.create')
                        </div>
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



    {{-- script JS for delete data --}}
    <script>
        $(document).ready(function() {
            $('.delete').on("click", function(e) {
                e.preventDefault();
                var Id = $(this).attr('data-id');
                Swal.fire({
                    title: "Etes vous sûr ?",
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Oui, Supprimer!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/admin/niveau/destroy/" + Id,
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
                                            "{{ route('niveau.index') }}";
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
