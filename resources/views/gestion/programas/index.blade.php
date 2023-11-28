@extends('layouts.default')

@section('title', config('hermes.name') . ' :: ' . 'Documentos')

@push('css')
    {{-- Aqui se coloca los CSS de assets --}}
@endpush

@section('header-nav')

@endsection

@section('content')
    <!-- begin col-10 -->
    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle d-flex justify-content-between align-items-center">
                <div class="d-block">
                    <a id="abrirDocumentoModal" href="#modal-dialog" class="btn btn-sm btn btn-primary" data-toggle="modal"><i
                            class="fas fa-plus"></i> Nuevo Unidad O Carrera</a>
                </div>

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
                        <div class="row">
                            <div class="col-xl-12">

                                <!-- Botón para abrir el modal de creación -->
                                {{-- <div>
                                    <a id="abrirDocumentoModal" href="#modal-dialog" class="btn btn-sm btn btn-primary"
                                        data-toggle="modal">Crear Nuevo</a>
                                </div>
                                <br> --}}
                                <!-- Modal para Nuevo -->
                                <div class="modal fade" class="modal fade" id="modal-dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nuevoDocumentoModalLabel">
                                                    <i class="fas fa-building"></i> Nuevo Unidad O Carrera
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario de creación -->
                                                <form id="crearNuevoProgramaForm" class="form-horizontal" method="PUT"
                                                    enctype="multipart/form-data" action="{{ route('programas.store') }}">
                                                    @csrf
                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Sigla de la Unidad o Carrera: </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="text" id="id_programa"
                                                                value="" name="id_programa"
                                                                placeholder="ingrese la abrebiatura de la unidad o carrera"
                                                                data-parsley-required="true">
                                                            @error('id_programa')
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
                                                            for="fullname">Nombre Unidad O Carrrea:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="text" id="programa"
                                                                value="" name="programa"
                                                                placeholder="Nombre de Unidad O Carrera"
                                                                data-parsley-required="true">
                                                            @error('programa')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Ingresa el nivel numerico:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="text" id="id_padre"
                                                                value="" name="id_padre"
                                                                placeholder="Nombre de Unidad O Carrera"
                                                                data-parsley-required="true">
                                                            @error('id_padre')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label">Estado: </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="estado" name="estado"
                                                                data-parsley-required="true">
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

                                                    <div class="form-group row m-b-0">
                                                        <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <button type="submit"
                                                                class="btn btn-primary"><i class="fas fa-save"> </i> Registrar</button>
                                                        </div>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--DONDE MUESTRA LAS TABLAS ATRAVES DE DATA TABLES -->
                                <div style="position: absolute; height: 1px; width: 0px; overflow: hidden;">
                                    <input type="text" tabindex="0">
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="programa-table"
                                            class="table table-striped table-bordered table-td-valign-middle">
                                            <thead>
                                                <tr role="row">
                                                    <th width="10%">Nro</th></th>
                                                    <th width="10%">Sigla</th>
                                                    <th width="10%">Programa</th>
                                                    <th width="10%">Nivel de unidad</th>
                                                    <th width="10%">Estado</th>
                                                    <th width="40%">Acciones</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <!--FINAL DE CODIGO DONDE MUESTRA LAS TABLAS -->

                                <!-- Modal para Ver -->
                                <div class="modal fade" id="verDocumentoModal" tabindex="-1" role="dialog"
                                    aria-labelledby="verDocumentoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verDocumentoModalLabel">Detalles del Documento
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Contenido para mostrar detalles del documento -->

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para Editar -->
                                <div class="modal fade" id="editarProgramaModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editarDocumentoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editarDocumentoModalLabel"><i class="fas fa-edit"></i>  Editar Unidad o Carrera
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario de edición -->
                                                <form id="editarProgramaForm" class="form-horizontal" method="POST"
                                                    enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" id="edit-programa-id" name="id">
                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Sigla de
                                                            Unidad o carrera:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="text" id="id_programa2"
                                                                value="" name="id_programa2"
                                                                placeholder="ingrese la abrebiatura de la unidad o carrera"
                                                                data-parsley-required="true">
                                                            @error('id_programa')
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
                                                            for="fullname">Nombre Unidad O Carrrea:</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="text" id="programa2"
                                                                value="" name="programa2"
                                                                placeholder="Nombre de Unidad O Carrera"
                                                                data-parsley-required="true">
                                                            @error('programa')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Ingresa el nivel numerico: </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input class="form-control" type="text" id="id_padre2"
                                                                value="" name="id_padre2"
                                                                placeholder="Nombre de Unidad O Carrera"
                                                                data-parsley-required="true">
                                                            @error('id_padre')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                    aria-hidden="false">
                                                                    <li class="parsley-required">
                                                                        {{ 'Este valor es requerido' }}</li>
                                                                </ul>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label">Estado: </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <select class="form-control" id="estado2" name="estado2"
                                                                data-parsley-required="true">
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

                                                    <div class="form-group row m-b-0">
                                                        <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <button type="submit"
                                                                class="btn btn-primary"><i class="far fa-save"> </i> Registrar</button>
                                                        </div>
                                                    </div>


                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para Eliminar -->
                                <div class="modal fade" id="deleteDocument" tabindex="-1" role="dialog"
                                    aria-labelledby="eliminarDocumentoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="eliminarDocumentoModalLabel">Eliminar
                                                    Documento</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar este documento?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger" id="btnDelete"
                                                    name="btnDelete">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog"
                                    aria-labelledby="pdfModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="pdfModalLabel">Vista previa del PDF</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe id="pdfFrame" style="width:100%; height:500px;"
                                                    frameborder="0"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- end panel-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end panel-body -->
        </div>

    </div>
    <!-- end col-10 -->


@endsection
@push('scripts')
    {{-- Aqui se coloca los JS de assets --}}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() {
            var documentTable = $('#programa-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('programas.index') }}",
                },

                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'id_programa',
                        name: 'id_programa'
                    },
                    {
                        data: 'programa',
                        name: 'programa'
                    },
                    {
                        data: 'id_padre',
                        name: 'id_padre'
                    },
                    {
                        data: 'estado',
                        name: 'estado',
                        render: function(data, type, row) {
                            return data === 'A' ? 'Activo' : 'Inactivo';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                language: {
                    url: '/assets/plugins/datatables.net/Spanish.json'
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#crearNuevoProgramaForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: '{{ route('programas.store') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Programa registrado con éxito!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#modal-dialog').modal('hide');
                                    location
                                        .reload(); // Opcional, si deseas recargar la página después de una inserción exitosa.
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un error al registrar el programa.'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error: ' + textStatus
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function editProgram(id) {
            $.get('programas/edit/' + id, function(data) {
                $('#edit-programa-id').val(data.id);
                $('#id_programa2').val(data.id_programa);
                $('#programa2').val(data.programa);
                $('#id_padre2').val(data.id_padre);
                $('#estado2').val(data.estado).trigger('change');
                $('#editarProgramaModal').modal('show');
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Ocurrió un error al cargar los datos del programa. Por favor, inténtalo de nuevo.'
                });
            });
        }

        $('#editarProgramaForm').submit(function(e) {
            e.preventDefault();

            var id = $('#edit-programa-id').val();
            var id_programa = $('#id_programa2').val();
            var programa = $('#programa2').val();
            var id_padre = $('#id_padre2').val();
            var estado = $('#estado2').val();

            $.ajax({
                url: 'programas/update/' + id,
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    _method: 'PUT',
                    id_programa: id_programa,
                    programa: programa,
                    id_padre: id_padre,
                    estado: estado
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#editarProgramaModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro actualizado!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#programas-table').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Ocurrió un error al actualizar el programa. Por favor, inténtalo de nuevo.'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'Ocurrió un error al actualizar el programa. Por favor, inténtalo de nuevo.'
                    });
                    console.log("Error de AJAX: " + textStatus + ' : ' + errorThrown);
                }
            });
        });
    </script>
    <script>
        // Definir la variable global 'doc_id' que almacenará el ID del documento a eliminar
        var doc_id;
        // Función que será llamada cuando se haga clic en el botón "Eliminar"
        function deleteProgram(id) {
            doc_id = id;
            console.log("doc_id establecido como: ", doc_id); // Para depuración
            // Utiliza SweetAlert para mostrar un diálogo de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // El usuario confirmó la eliminación, ejecuta la solicitud AJAX
                    $.ajax({
                        url: 'programas/destroy/' + doc_id,
                        method: 'DELETE',
                        beforeSend: function() {
                            // Cambia el texto del botón mientras se realiza la solicitud
                            Swal.showLoading();
                        },
                        success: function(data) {
                            setTimeout(function() {
                                Swal.fire(
                                    'Eliminado',
                                    'El registro fue eliminado correctamente',
                                    'success'
                                );

                                // Asumiendo que tienes DataTable y quieres recargar los datos
                                $('#documentos-table').DataTable().ajax.reload();
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: ", xhr, status, error); // Para depuración
                            Swal.fire(
                                'Error',
                                'Hubo un error al eliminar el registro',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush
