@extends('layouts.app')
@section('title', 'AI Tool')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title">{{ $aitool['name'] }}</h1>
                    @if(Auth::check())
                        <button type="button" class="btn btn-outline-danger favoriteButton  bi 
                        @if(Auth::user()->favAitools->find($aitool['id'])) 
                        bi-heart-fill
                        @else 
                        bi-heart
                        @endif
                        "data-aitool-id="{{ $aitool['id'] }}">
                        </button>
                    @endif
                    <p><strong>Authors:</strong> {{ $aitool['authors'] }}</p>
                    <p><strong>Description:</strong> {{ $aitool['description'] }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Input Fields</h2>
                    <form id="myForm" method="POST" action="{{ route('generate.dance.map') }}" enctype="multipart/form-data" onsubmit="setLoadingAndSubmit()">
                        @csrf
                        <input type="hidden" name="ai_tool_id" value="{{$aitool['id']}}">
                        @foreach($aitool['inputs'] as $input)
                            <div class="form-group" style="margin-bottom:1em">
                                @if($input['type'] !== 'hidden')
                                    <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                @endif
                                @if($input['type'] === 'text')
                                     <input class="form-control" autocomplete="off" id="{{ $input['name'] }}" name="{{ $input['name'] }}">
                                @elseif($input['type'] === 'select')
                                    <select class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}">
                                        @foreach($input['options'] as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @elseif($input['type'] === 'file')
                                    <small class="text-muted">Accepted file types: {{ $input['accept'] }}</small>
                                    <input type="file" class="form-control-file mt-1" id="{{ $input['name'] }}" name="{{ $input['name'] }}" accept="{{ $input['accept'] }}" @if($input['required']) required @endif>
                                @elseif($input['type'] === 'number')
                                    <input type="{{ $input['type'] }}" class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}" @if($input['type'] === 'number') min="{{ $input['min'] }}" max="{{ $input['max'] }}" @endif>
                                @elseif($input['type'] === 'checkbox')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="{{ $input['name'] }}" name="{{ $input['name'] }}">
                                        <label class="form-check-label" for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                    </div>
                                @elseif($input['type'] === 'hidden')
                                    <input type="hidden" name="{{ $input['name'] }}" value="{{ $input['value'] }}">
                                @endif

                            </div>
                        @endforeach 
                        <button id="myFormSubmitButton" type="submit" style="margin-top:2em" class="btn btn-primary">Generate</button>
                        <div id="loading-text" style="display: none;">Processing Request...</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let loading=false;

    function setLoading(isLoading) {
        loading = isLoading;

        // Disabilita o abilita il bottone di submit
        const submitButton = document.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = isLoading;
        }

        // Mostra o nasconde l'icona di caricamento
        const loadingIcon = document.getElementById('loading-text');
        if (loadingIcon) {
            loadingIcon.style.display = isLoading ? 'block' : 'none';
        }
    }

    function setLoadingAndSubmit() {
        setLoading(true); // Imposta il caricamento prima di inviare il form
        return true; // Permette l'invio del form
    }

    $('.favoriteButton').click(function() {
    event.preventDefault();
    var aitoolId = $(this).data('aitool-id');
    if ($(this).hasClass('bi-heart')) {
        $(this).removeClass('bi-heart');
        $(this).addClass('bi-heart-fill');
      }else {
        $(this).removeClass('bi-heart-fill');
        $(this).addClass('bi-heart');
      }
    @auth 
        $.ajax({
            url: '{{ route('favAitool_flag',['aitool_id' => '']) }}' + aitoolId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Modifica l'icona del cuore in base alla risposta
                
            },
            error: function(xhr, status, error) {
                console.error('Errore nella richiesta AJAX:', error);
            }
        });
    @else
        // Se l'utente non è autenticato, reindirizzalo alla pagina di login o esegui altre azioni
        window.location.href = '{{ route('login') }}';
    @endauth
});


</script>

@endsection
