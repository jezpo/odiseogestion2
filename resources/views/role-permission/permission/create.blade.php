@extends('layouts.default')
@section('title1', 'Admin U.A.T.F.')
@section('title', 'Admin Permisos')
@section('Permisos', 'active')

@push('css')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->     
@endpush

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

@push('scripts')

<script src="/assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Evita el envío del formulario inicialmente
            const formData = new FormData(form); // Captura los datos del formulario
    
            // Inicia SweetAlert2 para confirmar
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Estás a punto de guardar un nuevo permiso.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, se envía el formulario via AJAX
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Si la respuesta es exitosa, redirige a la página de índice
                            Swal.fire(
                                'Guardado!',
                                'El permiso ha sido guardado exitosamente.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/path-to-index-page'; // Ajusta esta URL al índice de permisos
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Maneja errores, por ejemplo, mostrando un mensaje con SweetAlert
                            Swal.fire(
                                'Error!',
                                'No se pudo guardar el permiso: ' + error,
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
    </script>    
@endpush
@endsection
