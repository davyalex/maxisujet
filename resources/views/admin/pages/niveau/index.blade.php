@extends('admin.layouts.app')

@section('title', 'niveau')

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
                        <h4>Liste des niveaux</h4>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAdd">
                            <i class="fas fa-plus"></i> Ajouter un niveau</button>
                    </div>
                    <div class="card-body">
                        @include('admin.components.validationMessage')
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Parent</th>
                                        <th>Date de création</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($niveaux as $key => $item)
                                        <tr>
                                            <td class="row_{{ $item['id'] }}">{{ ++$key }} </td>
                                            <td>{{ $item['title'] }} </td>
                                            <td>{{ $item['parent'] ? $item['parent']['title'] : '' }} </td>
                                            <td>{{ $item['created_at']->format('d-m-Y') }} </td>
                                            <td>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modalEdit{{ $item['id'] }}"><i class="fas fa-edit fs-20"
                                                        style="font-size: 20px;"></i></a>

                                                <a href="#" class="delete" role="button"
                                                    data-id="{{ $item['id'] }}"><i class="fas fa-trash text-danger"
                                                        style="font-size: 20px;"></i></a>
                                            </td>
                                        </tr>
                                        @include('admin.pages.niveau.edit')
                                    @endforeach
                                    {{-- modal edit form --}}
                                </tbody>
                            </table>

                            {{-- modal create form --}}
                            @include('admin.pages.niveau.create')
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

            // Vérifiez si la DataTable est déjà initialisée
            if ($.fn.DataTable.isDataTable('#tableExport')) {
                // Si déjà initialisée, détruisez l'instance existante
                $('#tableExport').DataTable().destroy();
            }

            $('#tableExport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ],

                // Utilisez drawCallback pour exécuter delete_row après chaque redessin
                drawCallback: function(settings) {
                    // Appeler la fonction delete après chaque redessin de la table
                    $('.delete').on("click", function(e) {
                        e.preventDefault();
                        var Id = $(this).attr('data-id');
                        Swal.fire({
                            title: "Êtes-vous sûr ?",
                            text: "Vous ne pourrez pas revenir en arrière !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Oui, Supprimer !"
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
                                                title: 'Opération réussie',
                                                animation: false,
                                                position: 'top',
                                                background: '#3da108e0',
                                                iconColor: '#fff',
                                                color: '#fff',
                                                showConfirmButton: false,
                                                timer: 500,
                                                timerProgressBar: true,
                                            });

                                            // Supprimer la ligne
                                            $('.row_' + Id).remove();
                                        }
                                    }
                                });
                            }
                        });
                    });
                },

                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('niveau.index') }}", // Remplacez par la route appropriée
                    type: 'GET',
                    data: function(d) {
                        d.page = d.start / d.length + 1; // Calculer la page côté serveur
                        d.limit = d.length; // Nombre d'éléments par page
                    }
                },

                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'parent'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    } // Désactiver l'ordre et la recherche pour la colonne d'action
                ],

                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                order: [
                    [1, 'asc']
                ], // Trier par titre par défaut
            });
        });
    </script>
@endsection
