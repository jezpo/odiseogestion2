@extends('layouts.default')
@section('title1','Admin U.A.T.F.')
@section('title','Editar Uusario')
@section('Users','active')
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
<link href="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endpush
@section('content')
 <!-- begin breadcrumb -->
 <ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Principal</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/users') }}">Usuarios</a></li>
    <li class="breadcrumb-item active">Editar Usuario</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header"><i class="fas fa-users fa-fw"></i> Editar <small></small></h1>
<!-- end page-header -->
<!-- begin panel -->

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title d-flex justify-content-between align-items-center">
            <span>Actualizar Usuario</span>
            <a href="{{ url('users') }}" class="btn btn-danger">
                <i class="fas fa-lg fa-fw m-r-8 fa-arrow-left"></i> Atrás
            </a>
    </div>
    <div class="panel-body">
        <form action="{{ url('users/'.$user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" />
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="name">Apellido: </label>
                <input type="text" id="name" name="last_name" value="{{ $user->last_name }}" class="form-control" />
                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="ci">CI: </label>
                <input type="text" id="ci" name="ci" readonly value="{{ $user->ci }}" class="form-control" />
                @error('ci') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="text" id="email" name="email" readonly value="{{ $user->email }}" class="form-control" />
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
           
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" />
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="roles">Roles</label>
                <select id="roles" name="roles[]" class="form-control" multiple>
                    <option value="">Seleccionar Rol</option>
                    @foreach ($roles as $role)
                    <option
                        value="{{ $role }}"
                        {{ in_array($role, $userRoles) ? 'selected':'' }}
                    >
                        {{ $role }}
                    </option>
                    @endforeach
                </select>
                @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                <i class="far fa-lg fa-fw m-r-8 fa-save"></i> Actualizar
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

@endpush
