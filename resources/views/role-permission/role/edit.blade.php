@extends('layouts.default')
@section('title1','Admin U.A.T.F.')
@section('title','Editar Rol')
@section('Roles','active')
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
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Editar Rol</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header"><i class="fas fa-edit fa-fw"></i> Editar <small></small></h1>
<!-- end page-header -->
<!-- begin panel -->


<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <div class="pull-right">
            <a href="{{ url('roles') }}" class="btn btn-danger float-right"><i class="fas fa-arrow-left"></i>Atras</a>
        </div>
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body">
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <h4 class="panel-title">Detalle Rol {{$role['name']}}</h4>
        <form action="{{ url('roles/'.$role->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div class="form-group">
                <label for="name">Nombre del Rol</label>
                <input type="text" id="name" name="name" value="{{ $role->name }}" class="form-control" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Actualizar</button>

            </div>
        </form>
    </div>
    

</div>
<!-- end panel -->
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