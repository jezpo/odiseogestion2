@extends('layouts.default')
@section('title1', 'Admin U.A.T.F.')
@section('title', 'Admin Roles')
@section('Roles', 'active')
@push('css')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />

    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Principal</a></li>
        <li class="breadcrumb-item active">Roles</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><i class="fas fa-sitemap fa-fw"></i> Roles <small></small></h1>
    <!-- end page-header -->
    <!-- begin panel -->
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="input-group-prepend pull-right">
                <a href="{{ url('roles') }}" class="btn btn-danger float-right"><i class="fas fa-arrow-left"></i> Atras</a>
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
            <h4><i class="fas fa-user fa-user"></i> Usuario: {{ $role->name }}</h4>
            <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    @error('permission')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="">Permissions</label>

                    <div class="row">
                        @foreach ($permissions as $permission)
                        <div class="col-md-2">
                            <label>
                                <input
                                    type="checkbox"
                                    name="permission[]"
                                    value="{{ $permission->name }}"
                                    {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                />
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-lg fa-fw m-r-10 fa-sync-alt"></i> Actualizar
                </button>
            </form>


        </div>
    </div>
    <!-- end panel -->


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
    <script src="/assets/plugins/pdfmake/build/pdfmake.min.js"></script>
    <script src="/assets/plugins/pdfmake/build/vfs_fonts.js"></script>
    <script src="/assets/plugins/jszip/dist/jszip.min.js"></script>
    <script src="/assets/plugins/moment/min/moment.min.js"></script>
    <script src="/assets/plugins/moment/locale/es-us.js"></script>
    <script src="/assets/plugins/switchery/switchery.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endpush
