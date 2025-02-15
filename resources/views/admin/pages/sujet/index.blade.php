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
                                        <th>Approuvé</th>
                                        <th>code</th>
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
                                        <tr id="row_{{ $item['id'] }}">
                                            <td>{{ ++$key }} </td>
                                            <td class=" text-bold text-{{ $item['approved'] == 0 ? 'info' : 'success' }}">
                                                {{ $item['approved'] == 0 ? 'Non' : 'Oui' }} </td>
                                            <td>{{ $item['categorie']['title'] }} </td>
                                            <td>{{ $item['sujet_title'] }}</td>

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
                                                    href="{{ asset('storage/sujets/' . $item->sujet_file) }}"
                                                    target="_blank">
                                                    <i class="fas fa-download">Telecharger</i> </a>

                                            </td>
                                            <td>
                                                <span>{{ $item->corrige_file }}</span>
                                                <br><a class="btn btn-outline-info"
                                                    href="{{ asset('storage/corriges/' . $item->corrige_file) }}"
                                                    target="_blank">
                                                    <i class="fas fa-download">Telecharger</i>
                                                </a>

                                            </td>


                                            <td>



                                                <div class="btn-group">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('sujet.approved', $item['id']) }}"
                                                            class="dropdown-item {{ $item['approved'] == 1 ? 'd-none' : '' }}"><i
                                                                class="fas fa-check"></i> Approved</a>

                                                        <a href="{{ route('sujet.edit', $item['id']) }}"
                                                            class="dropdown-item "><i class="fas fa-edit"></i> Edit</a>

                                                        <a href="#" class="dropdown-item delete" role="button"
                                                            data-id="{{ $item['id'] }}"><i class="fas fa-trash"></i>
                                                            Delete</a>


                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        {{-- modal edit form --}}
                                        {{-- @include('admin.pages.sujet.edit') --}}
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

            // function for delete data
            function delete_row() {
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
                                        $('#row_' + Id).remove();

                                    }
                                }
                            });
                        }
                    });
                });
            }


            // Vérifiez si la DataTable est déjà initialisée
            if ($.fn.DataTable.isDataTable('#tableExport')) {
                // Si déjà initialisée, détruisez l'instance existante
                $('#tableExport').DataTable().destroy();
            }

            // Initialisez la DataTable avec les options et le callback
            var table = $('#tableExport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ],

                // Utilisez drawCallback pour exécuter delete_row après chaque redessin
                drawCallback: function(settings) {
                    // var route = "depense"
                    delete_row();
                }
            });

        });
    </script>
@endsection
