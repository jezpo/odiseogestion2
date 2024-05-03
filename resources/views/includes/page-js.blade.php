<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/js/app.min.js"></script>
<script src="/assets/js/theme/material.min.js"></script>
<script src="/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>

<!-- ================== END BASE JS ================== -->
{{--<script>
    $(document).ready(function() {
        $('.profile_img').attr('src', "{{ url('user/' . auth()->user()->id . '/foto') }}");
    });
</script>--}}

@stack('scripts')
