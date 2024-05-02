@extends('layouts.default')
@section('title1', 'Odiseo U.A.T.F.')
@section('title', 'Perfil')

@push('css')
    <style>
        .thumb {
            height: 200px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
        }

        #img {
            text-align: center;
        }
    </style>
    @push('css')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
        <link href="/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />

        <!-- ================== END PAGE LEVEL STYLE ================== -->
    @endpush

@endpush

@section('content')
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-address-book fa-fw"></i> Perfil <small></small></h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Editar Perfil</h4>
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
            <div>
                <div class="card mt-3">
                    <div class="card-header">
                        Actualizar información del perfil
                    </div>
                    <div class="card-body">
                        <!-- Form for updating profile information -->
                        <form enctype="multipart/form-data">
                            <!-- Fields for the form -->
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Ingresa el Nuevo Nombre">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="Ingresa el Correo Electronico">
                            </div>
                            <div class="form-group">
                                <label for="profile_image">Imagen de Perfil</label>
                                <input type="file" class="form-control-file" id="profile_image">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sync"></i> Actualizar
                            </button>
                        </form>



                    </div>
                </div>

                <!-- Horizontal Rule/Section Border -->
                <hr class="my-4">

                <!-- Update Password Form -->
                <div class="card mt-3">
                    <div class="card-header">
                        Actulizar Contraseña
                    </div>
                    <div class="card-body">
                        <!-- Form for updating password -->
                        <form action="updatePassword" method="POST">
                            <div class="form-group">
                                <label for="current_password">Contraseña Actual</label>
                                <input type="password" class="form-control" id="current_password"
                                    placeholder="Contraseña Actual">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="new_password"
                                    placeholder="Nueva Contraseña">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirma La Nueva Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    placeholder="Confirma La Nueva Contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key"></i> Cambiar Contraseña
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Two Factor Authentication -->
                <div class="card mt-3">
                    <div class="card-header">
                        Two Factor Authentication
                    </div>
                    <div class="card-body">
                        <!-- Form for managing two-factor authentication -->
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-user-shield"></i> Manage Two Factor Authentication
                        </button>
                    </div>
                </div>

                <!-- Logout Other Browser Sessions Form -->
                <div class="card mt-3">
                    <div class="card-header">
                        Logout Other Browser Sessions
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-warning">
                            <i class="fas fa-sign-out-alt"></i> Logout Other Sessions
                        </button>
                    </div>
                </div>

                <!-- Delete Account Form -->
                <div class="card mt-3">
                    <div class="card-header">
                        Delete Account
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Delete Account
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/plugins/pdfmake/build/pdfmake.min.js"></script>
    <script src="/assets/plugins/pdfmake/build/vfs_fonts.js"></script>
    <script src="/assets/plugins/jszip/dist/jszip.min.js"></script>
    <script src="/assets/plugins/moment/min/moment.min.js"></script>
    <script src="/assets/plugins/moment/locale/es-us.js"></script>
    <script src="/assets/plugins/switchery/switchery.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script src="/assets/js/director.js"></script>
    <script>
        function readImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result); // Renderizamos la imagen
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".custom-file-input").change(function() {
            readImage(this);
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endpush
