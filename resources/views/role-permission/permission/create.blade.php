@extends('layouts.default')
@section('title1', 'Admin U.A.T.F.')
@section('title', 'Admin Permisos')
@section('Permisos', 'active')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Principal</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permisos</a></li>
        <li class="breadcrumb-item active">Nuevo permiso</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-plus-circle fa-fw"></i> Nuevo <small></small></h1>
    <!-- end page-header -->
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="input-group-prepend pull-right">
                <a href="{{ url('permissions') }}" class="btn btn-danger float-right">
                    <i class="fas fa-arrow-left"></i> Volver
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
            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ url('permissions') }}" method="POST">
                @csrf
    
                <div class="form-group form-inline">
                    <label for="name" class="mr-2">Nombre del Permiso: </label>
                    <input type="text" id="name" name="name" class="form-control form-control-lg" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
    
        </div>
    </div>
    
    <!-- end panel -->


@endsection
