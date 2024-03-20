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
                            <th>Aitool</th>
                            <th>File</th>
                            <th>Inputs</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($charts as $chart)
                            <tr>                           
                                <td>
                                    <a href="{{ route('Aitool',['name'=>$chart->aitool_name])}}">{{ $chart->aitool_name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('download_chart',['id'=>$chart->id]) }}">{{ $chart->file_name }}</a>
                                </td>
                                <td>
                                    @php
                                        $inputs = json_decode($chart->inputs, true); // Decodifica il JSON in un array associativo
                                    @endphp

                                    @foreach($inputs as $label => $value)
                                        <p>{{ $label }}: {{ $value }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $chart->created_at }}
                                </td>
                                <td>
                                    <a class="btn btn-danger" style="color:white" onclick="return confirm('Are you sure?')" href="{{route('deleteChart', ['id'=>$chart->id])}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
