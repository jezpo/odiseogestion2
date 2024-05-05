@extends('layouts.default')

@section('title', config('hermes.name') . 'Correspondencia' . 'Flujo De Tramite')

@push('css')
    <link href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
@endpush

@section('header-nav')

@endsection

@section('content')

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Principal</a></li>

        <li class="breadcrumb-item active">Panel Flujo de Tramite</li>
    </ol>
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-file-alt fa-fw"></i> Flujo de Tramite <small></small></h1>
    <!-- end page-header -->

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle d-flex justify-content-between align-items-center">
            <!-- Título a la izquierda -->
            <!-- Botón "Nuevo" alineado a la izquierda -->
            <div class="d-block">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@mdo">
                    <i class="fas fa-plus"></i> <b>Nuevo Flujo Tramite</b>
                </button>
            </div>
            <!-- Botones en la esquina superior derecha -->
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
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            <div id="data-table-combine_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="dataTables_wrapper dt-bootstrap">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-xl-12">

                                <!-- Modal de creacion -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel"> <i
                                                        class="fas fa-file-alt"></i> Nuevo Flujo Tramite</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="create-form" class="form-horizontal" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Tramite:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="id_tipo_tramite"
                                                                name="id_tipo_tramite" data-parsley-required="true">
                                                                @foreach ($tipotramite as $tipo)
                                                                    <option value="{{ $tipo->id }}">
                                                                        {{ $tipo->id }} - {{ $tipo->tramite }}
                                                                    </option>
                                                                @endforeach
                                                                @error('id_tipo_tramite')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                        aria-hidden="false">
                                                                        <li class="parsley-required">
                                                                            {{ 'Este valor es requerido' }}</li>
                                                                    </ul>
                                                                @enderror
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Orden:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="orden" name="orden"
                                                                data-parsley-required="true">
                                                                <option value="0">En espera</option>
                                                                <option value="1">En proceso</option>
                                                                <option value="2">Enviado</option>
                                                            </select>
                                                            @error('orden')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Tiempo:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="time" id="fullname"
                                                                value="" name="tiempo"
                                                                placeholder="Tiempo en espera"
                                                                data-parsley-required="true">
                                                            @error('tiempo')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label">Estado:
                                                        </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="select-required"
                                                                name="estado" data-parsley-required="true">
                                                                <option value="">Por favor selecciona una opcion
                                                                </option>
                                                                <option value="A">Activo</option>
                                                                <option value="I">Inactivo</option>
                                                                @error('estado')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                        aria-hidden="false">
                                                                        <li class="parsley-required">
                                                                            {{ 'este valor es requerido' }}</li>
                                                                    </ul>
                                                                @enderror
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Unidad de Destino:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="select-required"
                                                                name="id_programa" data-parsley-required="true">
                                                                @foreach ($programas as $programa)
                                                                    <option value='{{ $programa->id_programa }}'
                                                                        {{ $programa->id == old('programa', $programa->id_programa) ? 'selected' : '' }}>
                                                                        {{ $programa->programa }}
                                                                    </option>
                                                                @endforeach
                                                                @error('id_programa')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                        aria-hidden="false">
                                                                        <li class="parsley-required">
                                                                            {{ 'Este valor es requerido' }}</li>
                                                                    </ul>
                                                                @enderror
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group row m-b-0">
                                                        <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <button type="submit" class="btn btn-primary"> <i
                                                                    class="far fa-save"></i> Registrar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin Modal de nuevo formulario -->

                                <div style="position: absolute; height: 1px; width: 0px; overflow: hidden;">
                                    <input type="text" tabindex="0">
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="flujostra-table"
                                            class="table table-striped table-bordered table-td-valign-middle dt-responsive "
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-nowrap">Nro.</th>
                                                    <th class="text-nowrap">Nombre del tramite</th>
                                                    <th class="text-nowrap">Orden</th>
                                                    <th class="text-nowrap">Tiempo</th>
                                                    <th class="text-nowrap">Estado</th>
                                                    <th class="text-nowrap">Unidad </th>
                                                    <th class="text-nowrap">Acciones</th>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div>
                                </div>
                                <!--FINAL DE CODIGO DONDE MUESTRA LAS TABLAS -->

                                <!--modal de edicion-->

                                <div class="modal fade" id="editProcessFormModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editProcessFormModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProcessFormModalLabel"><i
                                                        class="fas fa-edit"></i> Editar Flujo
                                                    Tramite
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editProcesForm" method="POST" enctype="multipart/form-data"
                                                    class="form-horizontal">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="_token" value="PUT">
                                                    <input type="hidden" id="edit-flujo-id" name="id">
                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Tramite:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="id_tipo_tramite2"
                                                                name="id_tipo_tramite" required>
                                                                @foreach ($tipotramite as $tipo)
                                                                    <option value="{{ $tipo->id }}">
                                                                        {{ $tipo->id }} - {{ $tipo->tramite }}
                                                                    </option>
                                                                @endforeach
                                                                @error('id_tipo_tramite')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                        aria-hidden="false">
                                                                        <li class="parsley-required">
                                                                            {{ 'Este valor es requerido' }}</li>
                                                                    </ul>
                                                                @enderror
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Orden:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="orden2" name="orden2"
                                                                data-parsley-required="true">
                                                                <option value="0">En espera</option>
                                                                <option value="1">En proceso</option>
                                                                <option value="2">Enviado</option>
                                                            </select>
                                                            @error('orden2')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Tiempo:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="time" id="tiempo2"
                                                                name="tiempo"
                                                                >

                                                            @error('tiempo2')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label">Estado:
                                                        </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="estado2" name="estado"
                                                                required>
                                                                <option value="">Por favor selecciona una opcion
                                                                </option>
                                                                <option value="A">Activo</option>
                                                                <option value="I">Inactivo</option>
                                                                @error('estado2')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                        aria-hidden="false">
                                                                        <li class="parsley-required">
                                                                            {{ 'este valor es requerido' }}</li>
                                                                    </ul>
                                                                @enderror
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label"
                                                            for="fullname">Unidad de Destino:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="id_programa2"
                                                                name="id_programa" required>
                                                                @foreach ($programas as $programa)
                                                                    <option value='{{ $programa->id_programa }}'
                                                                        {{ $programa->id == old('programa', $programa->id_programa) ? 'selected' : '' }}>
                                                                        {{ $programa->programa }}
                                                                    </option>
                                                                @endforeach
                                                                @error('id_programa2')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                        aria-hidden="false">
                                                                        <li class="parsley-required">
                                                                            {{ 'Este valor es requerido' }}</li>
                                                                    </ul>
                                                                @enderror
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group row m-b-0">
                                                        <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="far fa-save"></i> Actualizar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin Modal de edición -->

                            </div>
                            <!-- end panel-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    {{-- Aqui se coloca los JS de assets --}}
    {{-- Aqui se coloca los JS de assets --}}
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
    <!-- ================== END PAGE LEVEL STYLE ================== -->

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
    <script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="../assets/js/demo/ui-modal-notification.demo.js"></script>
    <script src="../assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
    <link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            $('#flujostra-table').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                processing: true,
                serverSide: true, // Habilita el procesamiento en el servidor
                ajax: "{{ route('flujotramites.index') }}", // Ruta que devuelve los datos JSON

                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tipo_tramite',
                        name: 'tipo_tramite'
                    }, // Asegúrate de que coincida con el nombre real de la columna
                    {
                        data: 'orden',
                        name: 'orden'
                    },
                    {
                        data: 'tiempo',
                        name: 'tiempo'
                    },
                    {
                        data: 'estado',
                        name: 'estado',
                        render: function(data, type, row) {
                            return data === 'A' ? 'Activo' : 'Inactivo';
                        }
                    },
                    {
                        data: 'programa',
                        name: 'programa'
                    }, // Asegúrate de que coincida con el nombre real de la columna
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
        $(document).on('submit', '#create-form', function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            $.ajax({
                url: '{{ route('flujotramites.store') }}',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#newProcedure').modal('hide'); // Cerrar el modal aquí
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro creado con éxito',
                            text: 'El flujo de documentos se ha creado correctamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Recargar la tabla después de cerrar el modal y mostrar el SweetAlert
                            $('#flujostra-table').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error al crear el flujo de documentos',
                            text: response.message.tramite ? response.message.tramite[0] :
                                'Error no especificado',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var firstError = Object.values(xhr.responseJSON.errors)[0][0];
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de validación',
                            text: firstError,
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de conexión',
                            text: 'No se pudo completar la solicitud: ' + error,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Configuración global de AJAX para incluir el token CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Función para cargar los datos en el modal y mostrarlo
            window.editramite = function(id) {
                $.ajax({
                    url: '/dashboard/flujo-tramites/edit/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === 'success') {
                            // Asumiendo que los campos de datos en 'response.data' se llaman igual que los IDs del formulario
                            $('#edit-flujo-id').val(response.data.id);
                            $('#orden2').val(response.data.orden);
                            $('#tiempo2').val(response.data.tiempo);
                            $('#estado2').val(response.data.estado);
                            $('#id_programa2').val(response.data.id_programa);
                            // Mostrar el modal
                            $('#editProcessFormModal').modal('show');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrió un error al obtener el trámite',
                                text: 'La respuesta del servidor no contiene la información esperada.',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Conexión',
                            text: 'No se pudo conectar con el servidor: ' + textStatus,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            };

            // Manejador de eventos para la presentación del formulario
            $('#editProcesForm').on('submit', function(e) {
                e.preventDefault(); // Prevenir la presentación estándar del formulario

                var id = $('#edit-flujo-id')
                    .val(); // Asegúrate de que este ID se está estableciendo correctamente
                var formData = new FormData(
                    this); // Usar FormData para manejar datos de formulario, incluidos archivos

                $.ajax({
                    url: '/dashboard/flujo-tramites/update/' + id,
                    type: 'PUT', // Usar POST como método de solicitud
                    data: formData,
                    processData: false, // Necesario para FormData
                    contentType: false, // Necesario para FormData
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#flujostra-table').modal('hide'); // Ocultar modal
                            Swal.fire({
                                icon: 'success',
                                title: 'El flujo se ha actualizado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Recargar datos, por ejemplo, usando DataTables o otra técnica
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al actualizar',
                                text: response.message,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 422) {
                            // Extraer errores de validación de Laravel y mostrarlos
                            let errors = jqXHR.responseJSON.errors;
                            let errorMessage = 'Por favor, corrija los siguientes errores:\n';
                            for (let key in errors) {
                                errorMessage += `${errors[key]}\n`;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error de validación',
                                text: errorMessage,
                                confirmButtonText: 'Aceptar'
                            });
                        } else {
                            // Manejo general de errores
                            Swal.fire({
                                icon: 'error',
                                title: 'Error en la solicitud',
                                text: 'Se produjo un error: ' + textStatus + ' - ' +
                                    errorThrown,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    }

                });
            });
        });
    </script>


    <script>
        function deleteTramite(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "El trámite será eliminado permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('flujotramites.destroy', '') }}/' + id,
                        type: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Trámite eliminado correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#flujostra-table').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrió un error al eliminar el trámite',
                                    text: response.message,
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error de AJAX: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                }
            });
        }
    </script>
@endpush
