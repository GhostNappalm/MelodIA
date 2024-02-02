<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name', 'MelodIA')}}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

</head>
    <body>

        <header id="nav-wrapper">
            <nav id="nav">
                <div class="nav left">
                    <span class="gradient skew"><h1 class="logo un-skew" ><a href="{{ route('home') }}">MelodIA</a></h1></span>
                    <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
                </div>
                <div class="nav right">
                    <a id="home" href="{{ route('home') }}" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Home</span></span></a>
                    <a id="games" href="{{ route('games') }}" class="nav-link"><span class="nav-link-span"><span class="u-nav">Games</span></span></a>
                    <a id="chartGen" href="" class="nav-link"><span class="nav-link-span"><span class="u-nav">Chart Generators</span></span></a>
                    <a id="editors" href="" class="nav-link"><span class="nav-link-span"><span class="u-nav">Editors</span></span></a>
                    <a id="login" href="" class="nav-link"><span class="nav-link-span"><span class="u-nav">Login</span></span></a>
                </div>
            </nav>
        </header>
            
        <main class="py-4" style=" margin-top: 40px;">
            @yield('content')
        </main>
    
    </body>
</html>