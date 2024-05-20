@extends('layouts.default')
@section('title1', 'Admin U.A.T.F.')
@section('title', 'Editar Uusario')
@section('Users', 'active')
@push('css')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Principal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/users') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Nuevo Usuario</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-user-plus fa-fw"></i> Nuevo Usuario <small></small></h1>

    <!-- end page-header -->
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="input-group-prepend pull-right">
            
                <a href="{{ url('users') }}" class="btn btn-primary float-right">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
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
            <form action="{{ url('users') }}" method="POST" id="userForm">
                @csrf
    
                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input type="text" id="name" name="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="name">Apellido: </label>
                    <input type="text" id="name" name="last_name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="ci">CI: </label>
                    <input type="text" id="ci" name="ci" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico: </label>
                    <input type="text" id="email" name="email" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña: </label>
                    <input type="password" id="password" name="password" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="roles">Roles: </label>
                    <select id="roles" name="roles[]" class="form-control" multiple>
                        <option value="">Seleccionar Rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="far fa-lg fa-fw m-r-8 fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
    
@endsection
@push('scripts')
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="/assets/plugins/moment/min/moment.min.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="/assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
    <script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
    <script src="/assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
    <script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="/assets/plugins/tag-it/js/tag-it.min.js"></script>
    <script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
    <script src="/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
    <script src="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
    <script src="/assets/plugins/clipboard/dist/clipboard.min.js"></script>
    <script src="/assets/js/demo/form-plugins.demo.js"></script>
    <script src="../assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script>
        // Esperar a que el documento esté listo
        document.addEventListener("DOMContentLoaded", function () {
            // Capturar el formulario
            const form = document.getElementById('userForm');
    
            // Agregar un evento para el envío del formulario
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevenir el envío normal del formulario
    
                // Hacer la petición del formulario
                fetch(form.action, {
                    method: form.method,
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}' // Asegurar la protección CSRF
                    }
                })
                .then(response => {
                    // Si la respuesta es exitosa
                    if (response.ok) {
                        // Mostrar una alerta SweetAlert
                        Swal.fire({
                            title: 'Éxito',
                            text: 'El usuario ha sido creado exitosamente',
                            icon: 'success',
                            showConfirmButton: false, // No mostrar el botón "OK"
                            timer: 1500 // Cerrar la alerta después de 1.5 segundos
                        });
    
                        // Redirigir al índice después de 1.5 segundos
                        setTimeout(function(){
                            window.location.href = '{{ url("/users") }}';
                        }, 1500);
                    } else {
                        // Si la respuesta no es exitosa, mostrar un mensaje de error
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al crear el usuario',
                            icon: 'error',
                            showConfirmButton: true // Mostrar el botón "OK"
                        });
                    }
                })
                .catch(error => {
                    // En caso de error en la petición, mostrar un mensaje de error
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al crear el usuario',
                        icon: 'error',
                        showConfirmButton: true // Mostrar el botón "OK"
                    });
                });
            });
        });
    </script>
@endpush
