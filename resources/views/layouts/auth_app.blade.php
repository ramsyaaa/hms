<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title') | {{getAppName()}}</title>
    <meta name="description" content="Hospital management system">
    <meta name="keyword" content="hospital,doctor,patient,fever,MD,MS,MBBS">
    <link rel="icon" href="{{ asset('web/img/logo.jpg') }}" type="image/png">
    <link rel="canonical" href="{{ route('front') }}"/>
    <link rel="stylesheet" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')  }}">
    <link href="{{ mix('/assets/css/custom-auth.css') }}" rel="stylesheet" type="text/css"/>
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages.css') }}">--}}
    <!-- CSS Libraries -->
    @yield('css')
</head>
<body class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed">
<div class="d-flex flex-column flex-root">
    <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed authImage">
        @yield('content')
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('assets/js/third-party.js') }}"></script>
@yield('scripts')
<script>
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300)
    })
    

    $(document).on('click', '.language-select', function () {
        let languageName = $(this).data('id');
        $.ajax({
            type: 'get',
            url: 'set-language',
            data: {languageName: languageName},
            success: function () {
                location.reload();
            },
        });
    })

</script>
</body>
</html>
