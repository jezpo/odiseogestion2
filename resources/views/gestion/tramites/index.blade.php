@extends('layouts.default')

@section('title', 'Tramites')

@push('css')
    <link href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
@endpush

@section('header-nav')

@endsection

@section('content')

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Principal</a></li>

        <li class="breadcrumb-item active">Panel Tramite</li>
    </ol>
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-file-alt fa-fw"></i> Trámites de documentos <small></small></h1>
    <!-- end page-header -->

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle d-flex justify-content-between align-items-center"">
            <!-- Botón para abrir el modal de creación -->
            <div class="d-block">
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus"> </i> Nuevo Tramite</a>
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
                <div class="table-responsive">
                    <table id="programa-table" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Nro</th>
                                <th class="text-nowrap">tramite</th>
                                <th class="text-nowrap">Estado</th>
                                <th class="text-nowrap">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--FINAL DE CODIGO DONDE MUESTRA LAS TABLAS -->
                <!-- end panel-body -->
            </div>
        </div>
    </div>
    <!-- end #content -->
    </div>
    <!-- end panel-body -->
    <!-- Modal de crear nuevo  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i>
                        Nuevo Tramite</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="create-form">
                        @csrf

                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Tramite:</label>
                            <div class="col-md-8 col-sm-8">
                                <input class="form-control" type="text" id="tramite" value="" name="tramite"
                                    placeholder="Introduzca un tramite " data-parsley-required="true">
                                @error('tramite')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false">
                                        <li class="parsley-required">
                                            {{ 'Este valor es requerido' }}</li>
                                    </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label">Estado: </label>
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" id="estado" name="estado" data-parsley-required="true">
                                    <option value="">Por favor selecciona una opcion
                                    </option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                    @error('estado')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false">
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
                                <button type="submit" class="btn btn-primary"><i class="far fa-save"> </i>
                                    Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal de edición -->
    <!-- Modal de edición -->
    <!-- Modal de edición -->
    <div class="modal fade" id="editProcess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i>
                        Editar Trámite</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="edit-form">
                        @csrf
                        @method('PUT') <!-- Agrega el método PUT -->
                        <input type="hidden" id="edit-tramite-id" name="id">
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="edit-tramite">Trámite:</label>
                            <div class="col-md-8 col-sm-8">
                                <input class="form-control" type="text" id="tramite2" name="tramite2"
                                    placeholder="Introduzca un tramite" data-parsley-required="true">
                                @error('tramite2')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false">
                                        <li class="parsley-required">
                                            {{ 'Este valor es requerido' }}</li>
                                    </ul>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-sm-4 col-form-label" for="edit-estado">Estado:</label>
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" id="estado2" name="estado2" data-parsley-required="true">
                                    <option value="">Por favor selecciona una opcion
                                    </option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                </select>
                                @error('estado2')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false">
                                        <li class="parsley-required">
                                            {{ 'este valor es requerido' }}</li>
                                    </ul>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row m-b-0">
                            <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                            <div class="col-md-8 col-sm-8">
                                <button type="submit" class="btn btn-primary"><i class="far fa-save">
                                    </i> Actulizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal de edición -->
    <!-- Fin Modal de edición -->

    <!-- Modal para Eliminar -->
    <div class="modal fade" id="deleteDocument" tabindex="-1" role="dialog"
        aria-labelledby="eliminarDocumentoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarDocumentoModalLabel">Eliminar
                        Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este documento?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDelete" name="btnDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Vista previa del PDF</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfFrame" style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal para Eliminar -->
@endsection

@push('scripts')
    {{-- Aqui se coloca los JS de assets --}}
    {{-- Aqui se coloca los JS de assets --}}
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="../assets/css/material/app.min.css" rel="stylesheet" />
    <link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="../assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="../assets/js/demo/ui-modal-notification.demo.js"></script>



    <script>
        $(document).ready(function() {
            var documentTable = $('#programa-table').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('tipo-tramites.index') }}",

                },

                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tramite',
                        name: 'tramite'
                    },
                    {
                        data: 'estado',
                        name: 'estado',
                        render: function(data, type, row) {
                            if (data === "A") {
                                return "Activo";
                            } else if (data === "I") {
                                return "Inactivo";
                            } else {
                                return data; // Por si hay algún otro valor inesperado, lo mostrará tal cual
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
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
                url: '{{ route('tipo-tramites.create') }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Trámite creado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#programa-table').DataTable().ajax.reload();
                        $('#exampleModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error al crear el trámite',
                            text: response.message.tramite ? response.message.tramite[0] :
                                'Error no especificado',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo completar la solicitud: ' + error,
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });
    </script>
    <script>
        function editProcess(id) {
            $.ajax({
                url: '/dashboard/tipo-tramites/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        // Rellenar el formulario con los datos del registro
                        $('#edit-tramite-id').val(response.data.id);
                        $('#tramite2').val(response.data.tramite);
                        $('#estado2').val(response.data.estado);

                        // Mostrar el modal
                        $('#editProcess').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error al obtener el trámite',
                            text: response.message,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function(response) {
                    // Manejar error
                }
            });
        }

        $(document).on('submit', '#edit-form', function(e) {
            e.preventDefault();

            // Obtener el ID del trámite desde el campo oculto
            var id = $('#edit-tramite-id').val();
            // Resto de los datos del formulario
            var tramite = $('#tramite2').val();
            var estado = $('#estado2').val();

            $.ajax({
                url: '/dashboard/tipo-tramites/update/' + id, // Ruta que incluye el ID
                type: 'PUT',
                data: {
                    _token: $('input[name="_token"]').val(),
                    tramite: tramite,
                    estado: estado
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#editProcess').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Trámite actualizado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#programa-table').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error al actualizar el trámite',
                            text: response.message,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error de AJAX: " + textStatus + ' : ' + errorThrown);
                }
            });
        });
    </script>
    <script>
        var doc_id;

        function deleteProcess(id) {
            doc_id = id;
            Swal.fire({
                icon: 'warning',
                title: '¿Está seguro de eliminar este trámite?',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: '{{ route('tipo-tramites.destroy', '') }}/' + doc_id,
                        type: 'DELETE', // Utiliza el método DELETE para eliminar el registro
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                // Show success message using SweetAlert
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Trámite eliminado correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                // Reload table data
                                $('#programa-table').DataTable().ajax.reload();
                            } else {
                                // Show error message using SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrió un error al eliminar el trámite',
                                    text: response.message,
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        },
                        error: function(response) {
                            // Handle error response
                        }
                    });
                }
            });
        }
    </script>
@endpush
