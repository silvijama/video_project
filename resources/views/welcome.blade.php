<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Video lekcije</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #d1d1e0;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body >
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <!--<a href="{{ url('/home') }}">Home</a>-->
                        @can('admin-routes')
                            <a href="{{ route('admin.index') }}">Home Admin</a>
                        @endcan
                        @can('editor-routes')
                            <a href="{{ route('editor.index') }}">Home Editor</a>
                        @endcan
                        @can('user-routes')
                            <a href="{{ route('user.index') }}">Home</a>
                        @endcan
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" >
            <img src="{{ URL::asset('/slika/slika.svg')}}" alt="Home" height="300" width="500">
                <div class="title m-b-md">
                Video lekcije
                </div>
                <div>
                Fakultet prirodoslovno-matematičkih i odgojnih znanosti u Mostaru
                <br>
                <p>Silvija Marić i Marsela Azinović</p>

                </div> 
            </div>
        </div>
    </body>
</html>
