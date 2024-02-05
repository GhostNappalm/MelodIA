<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name', 'MelodIA')}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

</head>
    <body>

        <header id="nav-wrapper">
            <nav id="nav">
                <div class="nav left">
                    <span class="gradient skew " style="padding:1rem;"><h1 class="logo un-skew" ><a href="{{ route('home') }}">MelodIA</a></h1></span>
                    <button id="menu" class="btn-nav"><span class="fa fa-bars"></span></button>
                </div>
                <div class="nav right">
                    <a id="home" href="{{ route('home') }}" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Home</span></span></a>
                    <a id="games" href="{{ route('games') }}" class="nav-link"><span class="nav-link-span"><span class="u-nav">Games</span></span></a>
                    <a id="chartGen" href="" class="nav-link"><span class="nav-link-span"><span class="u-nav">Chart Generators</span></span></a>
                    <a id="editors" href="" class="nav-link"><span class="nav-link-span"><span class="u-nav">Editors</span></span></a>
                    @guest
                        <a id="login" href="{{ route('login') }}" class="nav-link"><span class="nav-link-span"><span class="u-nav">Login</span></span></a>
                    @else
                        <a id="logout" href="{{ route('logout') }}" class="nav-link"><span class="nav-link-span"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><span class="u-nav">Logout</span></span></a>
                            
                    @endguest
                </div>
                
            </nav>
        </header>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
        <main class="py-4" style=" margin-top: 4rem;">
            @yield('content')
        </main>
    
    </body>
</html>