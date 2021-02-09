<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Vue js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#d1d1e0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="position:relative">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        
                        @can('user-routes')
                            <li class="nav-item">
                                <form class="d-flex"> 
                                    <input class="form-control me-2" type="search" name="search_subject" id="search_subject" placeholder="Search subject" aria-label="Search" autocomplete="off">    
                                </form>
                                <div id="show">
                                    <ul id="show-el" style="position:absolute; z-index: 2; background-color:silver; padding-right: 10px">
                                    </ul>
                                </div>
                            </li>
                        @endcan

                        @can('editor-routes')
                        <li class="nav-item">
                                <form class="d-flex"> 
                                    <input class="form-control me-2" type="search" name="search_user" id="search_user" placeholder="Search user" aria-label="Search" autocomplete="off">    
                                </form>
                                <div id="show">
                                    <ul id="show-el" style="position:absolute; z-index: 2; background-color:silver; padding-right: 10px">
                                    </ul>
                                </div>
                            </li>
                        @endcan

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


<?php
    if (Auth::user()) {
        if (Auth::user()->type !== 'admin' && Auth::user()->type !== 'editor') {
?>
    <script>

    $(document).ready(function(){
        fetch_data ()
        function fetch_data (query = '') {
            var show = document.getElementById('show')
            var ul   = document.getElementById("show-el")
            
            $.ajax({
                url: "{{ route('user.search') }}",
                method: 'GET',
                data: { query: query },
                dataType: 'json',
                success: function (data) {
                    ul.innerHTML = ''
                    if (data) {
                        data.forEach(function(el) {
                            var li = document.createElement('li')
                            li.style.listStyle = "none"
                            li.style.marginLeft= "-10px"
                            li.style.width = '160px'
                            var newAnchor = document.createElement("a");
                            newAnchor.textContent = el.name;
                            newAnchor.setAttribute('href', '{{ asset('user/subjects') }}/' + el.id);
                            li.append(newAnchor);
                            ul.append(li)
                        });
                    }
                }
            })
        }
        $(document).on('keyup', '#search_subject', function() {
            var query = $(this).val()
            fetch_data (query)
        })
    })
    </script>
<?php } 
    }   
?>
<?php
    if (Auth::user()) {
        if (Auth::user()->type == 'editor') {
?>
    <script>

    $(document).ready(function(){
        fetch_data ()
        function fetch_data (query = '') {
            var show = document.getElementById('show')
            var ul   = document.getElementById("show-el")
            
            $.ajax({
                url: "{{ route('editor.search') }}",
                method: 'GET',
                data: { query: query },
                dataType: 'json',
                success: function (data) {
                    ul.innerHTML = ''
                    if (data) {
                        data.forEach(function(el) {
                            var li = document.createElement('li')
                            li.style.listStyle = "none"
                            li.style.marginLeft= "-10px"
                            li.style.width = '160px'
                            var newAnchor = document.createElement("a");
                            newAnchor.textContent = el.name;
                            newAnchor.setAttribute('href', '{{ asset('editor/users') }}/' + el.id);
                            li.append(newAnchor);
                            ul.append(li)
                        });
                    }
                }
            })
        }
        $(document).on('keyup', '#search_user', function() {
            var query = $(this).val()
            fetch_data (query)
        })
    })
    </script>
<?php } 
    }   
?>


</body>
</html>
