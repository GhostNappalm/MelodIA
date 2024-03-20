@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            padding-top: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 800px; /* Imposta la larghezza massima del container */
        }

        h1 {
            color: #007bff;
            text-align: center;
            font-size: 2rem;
        }

        .par {
            font-size: 1em;
            text-align: center;
            margin-top: 1rem;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .process-arrow {
            width: 3rem;
            height: 3rem;
            border: 2px solid #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1em;
            color: #007bff;
        }
    </style>

    <div class="container text-center"> <!-- Aggiunto text-center al container -->
        <h1>Welcome to MelodIA!</h1>
        
        <p class="par">Unlock the power of AI in music creation and rhythm chart design. MelodIA is your ultimate platform for exploring, creating, and sharing musical experiences.</p>
        
        <div class="row">
            <div class="col-sm">
                <a href="{{ url('/games') }}" class="cta-button" style="color:white;">Get Started</a>
            </div>
        </div>
    
        <div class="row" style="margin-top:2rem">
            <div class="col-sm">
                <div class="col" style="display: inline-block;"><div class="process-arrow">1</div></div>
                <p class="par">Choose a Game</p>
            </div>
            <div class="col-sm">
                <div class="col" style="display: inline-block;"><div class="process-arrow">2</div></div>
                <p class="par">Choose an AI Chart Generator</p>
            </div>
            <div class="col-sm">
                <div class="col" style="display: inline-block;"><div class="process-arrow">3</div></div>
                <p class="par">Fill the Input Fields and Generate your Chart</p>
            </div>
        </div>
        <div class="par" style="margin-top: 2rem;">
            Don't have an account yet? <a href="{{ route('register') }}" style="color: #007bff;">Register now</a> to save your generated charts, access your history, and bookmark your favorite games and AI tools for quick access!
        </div>
    </div>

    
@endsection
