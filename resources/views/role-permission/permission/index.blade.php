@extends('layouts.default')
@section('title1', 'Admin U.A.T.F.')
@section('title', 'Admin Permisos')
@section('Permisos', 'active')
@push('css')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endpush

@section('content')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Principal</a></li>
        <li class="breadcrumb-item active">Permisos</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-plus-circle fa-fw"></i> Permisos <small></small></h1>
    <!-- end page-header -->
    <!-- begin panel -->

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="input-group-prepend pull-right">
                @can('create permission')
                    <a href="{{ url('permissions/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                        Nuevo Permiso</a>
                @endcan
            </div>
            <h4 class="panel-title"></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div id="data-table-combine_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="dataTables_wrapper dt-bootstrap">
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Formulario de búsqueda -->
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-6">
                                    <form method="GET" action="{{ route('permissions.index') }}" class="form-inline">
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="permissions-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nro</th>
                                            <th>Nombre</th>
                                            <th width="40%">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

@endsection
@push('scripts')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="../assets/css/material/app.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-autofill-bs4/css/autofill.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-colreorder-bs4/css/colreorder.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-keytable-bs4/css/keytable.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-rowreorder-bs4/css/rowreorder.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE =================C:\laragon\www\odiseogestion-crud3\public\assets\plugins\datatables.net\js= -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables.net-autofill/js/dataTables.autofill.min.js"></script>
    <script src="../assets/plugins/datatables.net-autofill-bs4/js/autofill.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables.net-colreorder/js/dataTables.colreorder.min.js"></script>
    <script src="../assets/plugins/datatables.net-colreorder-bs4/js/colreorder.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables.net-keytable/js/dataTables.keytable.min.js"></script>
    <script src="../assets/plugins/datatables.net-keytable-bs4/js/keytable.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables.net-rowreorder/js/dataTables.rowreorder.min.js"></script>
    <script src="../assets/plugins/datatables.net-rowreorder-bs4/js/rowreorder.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="../assets/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>

    <script src="../assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/pdfmake/build/pdfmake.min.js"></script>
    <script src="../assets/plugins/pdfmake/build/vfs_fonts.js"></script>
    <script src="../assets/plugins/jszip/dist/jszip.min.js"></script>
    <script src="../assets/js/demo/table-manage-combine.demo.js"></script>

    <script src="../assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link href="../assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="../assets/js/demo/ui-modal-notification.demo.js"></script>
    <script src="../assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
    <link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <script src="../assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#permissions-table').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('permissions.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                buttons: [{
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        text: '<i class="fa fa-file-pdf"></i> PDF'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success',
                        text: '<i class="fa fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-primary',
                        text: '<i class="fa fa-print"></i> Imprimir'
                    }
                ],
                language: {
                    url: '/assets/plugins/datatables.net/Spanish.json'
                },
                dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('#permissions-table').on('click', '.delete-permission', function() {
            var permissionId = $(this).data('id');
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/permissions/' + permissionId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Eliminado!',
                                    'El permiso ha sido eliminado.',
                                    'success'
                                );
                                // Recargar DataTables o eliminar la fila
                                $('#permissions-table').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'No se pudo eliminar el permiso. Intente de nuevo.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Error en la solicitud. Intente de nuevo.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
    </script>
    
    
@endpush
