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
                <form action="{{ route('updateProfileInformation') }}" method="POST" enctype="multipart/form-data">
                    <h2>Profile Information</h2>
                    <p>Update your account's profile information and email address.</p>

                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="col-span-6 sm-col-span-4">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo">

                            @if ($this->user->profile_photo_path)
                                <button type="button" onclick="deleteProfilePhoto()">Remove Photo</button>
                            @endif

                            <span class="error"></span>
                        </div>
                    @endif

                    <div class="col-span-6 sm-col-span-4">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" autocomplete="name">
                        <span class="error"></span>
                    </div>

                    <div class="col-span-6 sm-col-span-4">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" autocomplete="username">
                        <span class="error"></span>

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                                !$this->user->hasVerifiedEmail())
                            <p>Your email address is unverified.</p>
                            <button type="button" onclick="sendEmailVerification()">Click here to re-send the verification
                                email.</button>
                            @if ($this->verificationLinkSent)
                                <p>A new verification link has been sent to your email address.</p>
                            @endif
                        @endif
                    </div>

                    <div>
                        <button type="submit" disabled>Save</button>
                        <span class="message"></span>
                    </div>
                </form>
            </div>
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
