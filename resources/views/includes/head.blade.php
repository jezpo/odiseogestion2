    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/assets/img/favicon.png">
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="/assets/css/material/app.min.css" rel="stylesheet" />
    <link href="/assets/css/material/theme/blue.min.css" rel="stylesheet" id="theme-css-link">

    <!-- ================== END BASE CSS STYLE ================== -->
<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @stack('css')
