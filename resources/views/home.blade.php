@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <style>
        .card-img-top{
            height:250px;
            width:auto;
        }

        .card{
            display:inline-flex;
            width:33%;
        }

        @media only screen and (max-width: 600px) {
            .card {
                width:100%;
            }
        }
    </style>

    <div class="container">
        <h1> Home </h1>
        <h1> Home </h1>
        <h1> Home </h1>
        <h1> Home </h1>
        <h1> Home </h1>
        <h1> Home </h1>
    </div>
@endsection