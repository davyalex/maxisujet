@extends('admin.layouts.app')

@section('title', 'Categorie')

@section('content')

    @push('css')
        <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/datatables.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    @endpush




    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des Categories</h4>
                        <button class="btn btn-outline-primary"> <i class="fas fa-plus"></i> Ajouter une categorie</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Michael Bruce</td>
                                        <td>Javascript Developer</td>
                                        <td>Singapore</td>
                                        <td>29</td>
                                        <td>2011/06/27</td>
                                        <td>$183,000</td>
                                        <td>
                                           <a href=""><i class="fas fa-edit"></i></a>
                                           <a href=""><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Michael Bruce</td>
                                        <td>Javascript Developer</td>
                                        <td>Singapore</td>
                                        <td>29</td>
                                        <td>2011/06/27</td>
                                        <td>$183,000</td>
                                        <td>
                                           <a href=""><i class="fas fa-edit"></i></a>
                                           <a href=""><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    @push('js')
        <script src="{{ asset('back/assets/bundles/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('back/assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('back/assets/js/page/datatables.js') }}"></script>
    @endpush

@endsection
