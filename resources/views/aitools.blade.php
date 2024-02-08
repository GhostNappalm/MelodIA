@extends('layouts.app')
@section('title', 'chartGenerators')

@section('content')
<style>


:root {
  --surface-color: #fff;
  --curve: 40;
}

* {
  box-sizing: border-box;
}

body {
  font-family: 'Noto Sans JP', sans-serif;
  background-color: #fef8f8;
}

.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin: 7rem 5vw;
  padding: 0;
  list-style-type: none;
}

.card {
  position: relative;
  display: block;
  height: 100%;  
  border-radius: calc(var(--curve) * 1px);
  overflow: hidden;
  text-decoration: none;
}

.card__image {      
  width: 100%;
  height: auto;
}

.card__overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1;      
  border-radius: calc(var(--curve) * 1px);    
  background-color: var(--surface-color);      
  transform: translateY(100%);
  transition: .2s ease-in-out;
}

.card:hover .card__overlay {
  transform: translateY(0);
}

.card__header {
  position: relative;
  display: flex;
  align-items: center;
  gap: 2em;
  padding: 2em;
  border-radius: calc(var(--curve) * 1px) 0 0 0;    
  background-color: var(--surface-color);
  transform: translateY(-100%);
  transition: .2s ease-in-out;
}

.card__arc {
  width: 80px;
  height: 80px;
  position: absolute;
  bottom: 100%;
  right: 0;      
  z-index: 1;
}

.card__arc path {
  fill: var(--surface-color);
  d: path("M 40 80 c 22 0 40 -22 40 -40 v 40 Z");
}       

.card:hover .card__header {
  transform: translateY(0);
}

.card__thumb {
  flex-shrink: 0;
  width: 50px;
  height: 50px;      
  border-radius: 50%;      
}

.card__title {
  font-size: 1em;
  margin: 0 0 .3em;
  color: #6A515E;
}

.card__tagline {
  display: block;
  margin: 1em 0;
  font-family: "MockFlowFont";  
  font-size: .8em; 
  color: #D7BDCA;  
}

.card__status {
  font-size: .8em;
  color: #D7BDCA;
}

.card__description {
  padding: 0 2em 2em;
  margin: 0;
  color: #D7BDCA;
  font-family: "MockFlowFont";   
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 3;
  overflow: hidden;
}    
</style>


@if($game!='0')
  <h1>{{ $game['name']}}</h1>
@endif


<ul class="cards" style="">


@foreach($aitools as $aitool)
  <li>
    <a href="" class="card" style=" width: 20rem; height:10rem;">
      <div class="card__overlay">
        <div class="card__header">
          <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
          @if(Auth::check())
            
            <button type="button" class="btn btn-outline-danger favoriteButton  bi 
            @if(Auth::user()->favAitools->find($aitool['id'])) 
              bi-heart-fill
            @else 
              bi-heart
            @endif
              "data-aitool-id="{{ $aitool['id'] }}">
            </button>
          @else
            <img class="card__thumb" src="https://cdn3d.iconscout.com/3d/premium/thumb/ai-5143193-4312366.png?f=webp" alt="" />
          @endif
          
          <div class="card__header-text">
            <h3 class="card__title">{{ $aitool['name']}}</h3>            
            <span class="card__status">{{ $aitool['authors']}}</span>
          </div>
        </div>
        <p class="card__description">{{ $aitool['description']}}</p>
      </div>
    </a>      
  </li>
@endforeach
</ul>

<script>
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