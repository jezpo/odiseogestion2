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
    <!-- ================== END PAGE LEVEL STYLE ================== --> <!-- Additional CSS for Timeline -->

    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
@endpush

@section('content')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Principal</a></li>
        <li class="breadcrumb-item active">Buscar documento</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-search fa-fw"></i> Buscar Documento<small></small></h1>
    <!-- end page-header -->
    <!-- begin panel -->

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="input-group-prepend pull-right">
            </div>
            <h4 class="panel-title">Buscar Documento</h4>
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
            <div class="container">
                <h1>Buscar Progreso del Documento</h1>

                <!-- Formulario de Búsqueda -->
                <form id="searchForm" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="document_id" id="document_id"
                            placeholder="Ingrese ID del documento" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>

                <!-- Resultados -->
                <div id="results">
                    <h2 class="text-center py-3">Bootstrap 4 Timeline</h2>
                    <div class="container py-2 mt-4 mb-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul id="bSTime">
                                    <!-- Timeline items will be appended here -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="../assets/css/material/app.min.css" rel="stylesheet" />
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

    <script src="../assets/js/demo/timeline.demo.js"></script>
    <!-- Include necessary scripts -->
    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                let documentId = $('#document_id').val();
    
                $.ajax({
                    url: '{{ url('flujos/progreso') }}/' + documentId,
                    method: 'GET',
                    success: function(response) {
                        let timeline = $('#bSTime');
                        timeline.empty();
    
                        if (response.etapas.length > 0) {
                            response.etapas.forEach(function(etapa, index) {
                                let iconClass = etapa.activa ? 'fa-check-circle' : 'fa-times-circle';
                                let iconColor = etapa.activa ? 'text-success' : 'text-danger';
                                let invertedClass = index % 2 === 0 ? '' : 'timeline-inverted';
                                let etapaHtml = `
                                    <div class="row no-gutters ${invertedClass} justify-content-center">
                                        <div class="col-sl"></div>
                                        <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <i class="fas ${iconClass} ${iconColor}" style="font-size: 1.5rem;"></i>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 py-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="float-right text-muted small">${etapa.fecha}</div>
                                                    <h4 class="card-title">${etapa.nombre}</h4>
                                                    <p class="card-text">${etapa.descripcion}</p>
                                                    <p class="card-text">${etapa.programa ? `Unidad o carrera: ${etapa.programa}` : etapa.mensaje}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                timeline.append(etapaHtml);
                            });
                        } else {
                            timeline.append(
                                '<div class="row no-gutters justify-content-center"><div class="col-sm"></div><div class="col-sm-1 text-center flex-column d-none d-sm-flex"></div><div class="col-sm-8 py-2"><div class="card"><div class="card-body"><p>No se encontraron etapas para este documento.</p></div></div></div></div>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'Hubo un problema al buscar el documento. Por favor, inténtelo de nuevo.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
