<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name', 'MelodIA')}}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/melody.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>
    

</head>
    <body>

        <header id="nav-wrapper">
            <nav id="nav">
                <div class="nav left">
                    <span class="gradient skew " style="font-family: sans;padding:1rem;"><h1 class="logo un-skew" ><a href="{{ route('home') }}">MelodIA</a></h1></span>
                    <button id="menu" class="btn-nav"><span class="fa fa-bars"></span></button>
                </div>
                <div class="nav right">
                    <a id="home" href="{{ route('home') }}" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Home</span></span></a>
                    <a id="games" href="{{ route('games') }}" class="nav-link"><span class="nav-link-span"><span class="u-nav">Games</span></span></a>
                    <a id="chartGen" href="{{ route('aitools') }}" class="nav-link"><span class="nav-link-span"><span class="u-nav">Chart Generators</span></span></a>
                    <!--<a id="editors" href="" class="nav-link"><span class="nav-link-span"><span class="u-nav">Editors</span></span></a>-->
                    @guest
                        <a id="login" href="{{ route('login') }}" class="nav-link"><span class="nav-link-span"><span class="u-nav">Login</span></span></a>
                    @else
                        <a class="dropdown" >
                            <button class="dropbtn" style="transform: skew(-20deg);"><p style="transform: skew(20deg);" >{{Auth::user()->name}}</p></button>
                            <div class="dropdown-content"style="transform:translate(-2.1rem,-1rem) skew(-20deg) ;">
                                <div onclick="location.href='{{ route('history',['name'=>Auth::user()->name]) }}'"><p style="margin: 0; transform: skew(20deg);">History</p></div>
                                <div href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><p style="margin: 0; transform: skew(20deg);">Logout</p></div>
                             </div>
                        </a>

                        <a id="History" href="{{ route('history',['name'=>Auth::user()->name]) }}" class="nav-link dropdownMobile"><span class="nav-link-span"><span class="u-nav">History</span></span></a>
                        <a id="Logout" href="{{ route('logout') }}" class="nav-link dropdownMobile" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><span class="nav-link-span"><span class="u-nav">Logout</span></span></a>



                                       
                    @endguest
                </div>
                
            </nav>
        </header>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
        <main class="py-4" style=" margin-top: 4rem;margin-bottom: 10rem">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>     
            @elseif ($message = Session::get('error'))
                <div class="alert alert-danger">
                    {{ $message }}
                </div> 
            @endif

            @yield('content')
        </main>

        <footer class="footer bg-white py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h3>About MelodIA</h3>
                <p>MelodIA is a web tool created to provide rhythm game creators and players with access to various open-source AI projects for chart generation. It aims to remove the need for programming skills, making these projects accessible to a wider audience.</p>
            </div>
            <div class="col-md-4">
                <h3>Contact Us</h3>
                <p>If you have any questions or feedback, feel free to contact us at <a href="mailto:info@melodia.com">info@melodia.com</a>.</p>
            </div>
            <div class="col-md-4">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-3"> <!-- Linea divisoria più sottile -->
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; 2024 MelodIA. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
    </body>
</html>