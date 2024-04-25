@extends('layouts.default')
@section('title1', 'Admin U.A.T.F.')
@section('title', 'Admin Roles')
@section('Roles', 'active')
@push('css')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />

    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Principal</a></li>
        <li class="breadcrumb-item active">Roles</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-sitemap fa-fw"></i> Roles <small></small></h1>
    <!-- end page-header -->
    <!-- begin panel -->

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="input-group-prepend pull-right">
                @can('create role')
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newrole">
                        <i class="fas fa-plus"></i> Agregar Rol
                    </a>
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
            <div class="table-responsive">
                <table id="roles-table" class="table table-striped table-bordered table-td-valign-middle dt-responsive " style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Nro</th>
                            <th class="text-nowrap">Nombre</th>
                            <th width="40%">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Los datos se cargarán a través de AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="newrole" tabindex="-1" role="dialog" aria-labelledby="newroleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-plus"></i> Nuevo Rol</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('roles') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nombre del Rol</label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="../assets/css/material/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-autofill-bs4/css/autofill.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-colreorder-bs4/css/colreorder.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-keytable-bs4/css/keytable.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-rowreorder-bs4/css/rowreorder.bootstrap4.min.css" rel="stylesheet" />
	<link href="../assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

    
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../assets/js/app.min.js"></script>
	<script src="../assets/js/theme/material.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
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
	<!-- ================== END PAGE LEVEL JS ================== -->


    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable({
                language: {
                    url: '/assets/plugins/datatables.net/Spanish.json'
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.index') }}",
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
                ]
            });
        });
    </script>
@endpush
