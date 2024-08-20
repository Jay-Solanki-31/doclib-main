<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- FontAwesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

</head>
<body>
    <div id="app">
        @include('inc.nav')
        <div class="col-10 col-md-6 mt-5 offset-md-3 offset-1">
            @include('inc.messages')
        </div>

        <main class="py-4">
            {{-- <div class="container"> --}}
                @yield('content')
            {{-- </div> --}}
        </main>
    </div>

    {{-- CKEDITOR --}}
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function(){

            CKEDITOR.replace( 'editor1' );

            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);

            $('.Type-O, .Type-A').hide();

            var load = $("[name=type],[checked]").val();
            // alert(load);
            if (load == 'A') {
                $('.Type-O').hide();
                $('.Type-'+load).show(500);
            }
            else{
                $('.Type-A').hide();
                $('.Type-'+load).show(500);
            }

            $("[name=Type]").click(function(){
                // alert('#Type-'+$(this).val());
                if ($(this).val() == 'A') {
                    $('.Type-O').hide();

                    $('.Type-'+$(this).val()).show(500);
                }
                else{
                    $('.Type-A').hide();
                    $('.Type-'+$(this).val()).show(500);
                }
            });
        });
    </script>

    <script src="{{ asset('js/bootstrap-confirmation.min.js') }}" defer></script>
    <script>
        window.onload = function(){
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
            });
        }
    </script>
</body>
</html>
