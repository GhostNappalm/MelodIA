@extends('layouts.app')
@section('title', 'History')

@section('content')
    <div class="container">
        <h1>Chart History</h1>

        @if($charts->isEmpty())
            <p>No chart in your history.</p>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Aitool Name</th>
                            <th>File</th>
                            <th>Inputs</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($charts as $chart)
                            <tr>                           
                                <td>
                                    <a href="#">{{ $chart['aitool_name'] }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('download.chart', $chart['id']) }}" download>{{ $chart['file_name'] }}</a>
                                </td>
                                <td>
                                    {{ $chart['inputs'] }}
                                </td>
                                <td>
                                    {{ $chart['created_at'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
