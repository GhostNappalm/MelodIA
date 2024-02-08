@extends('layouts.app')
@section('title', 'Games')

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
  cursor: pointer;
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

<ul class="cards" style="">

@foreach($games as $game)
  <li>
    <a class="card" style=" width: 20rem; height:24rem;">
      <img onclick="location.href='{{route('gameAitools',['name'=>$game['name']])}}'" src="{{url('/games_img/'.$game['image_path'])}}" class="card__image" alt="" />
      <div class="card__overlay">
        <div class="card__header">
                              
          @if(Auth::check())
            @if(Auth::user()->favGames->find($game['id']))
            <button type="button" class="btn btn-outline-danger favoriteButton" data-game-id="{{ $game['id'] }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                  <path id="isFavorite" fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>              
              </svg>
            </button> 

            @else
            <button type="button" class="btn btn-outline-danger favoriteButton" data-game-id="{{ $game['id'] }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"></path>
              </svg>
            </button>
            
            @endif
          @else
            <img class="card__thumb" src="https://d29fhpw069ctt2.cloudfront.net/icon/image/37740/preview.svg" alt="" />
          @endif
          <div class="card__header-text">
            <h3 class="card__title">{{ $game['name']}}</h3>            
            <span class="card__status">Generators: {{ $game->N_aitools()}}</span>
          </div>
        </div>
        <p class="card__description">{{ $game['description']}}</p>
      </div>
    </a>      
  </li>
@endforeach
</ul>

<script>
$('.favoriteButton').click(function() {
    var gameId = $(this).data('game-id');

    @auth

        $.ajax({
            url: '{{ route('fav_flag',['game_id' => '']) }}' + gameId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Modifica l'icona del cuore in base alla risposta
                if (response.isFavorite) {
                    $(this).find('.bi-heart').addClass('bi-heart-fill').removeClass('bi-heart');
                } else {
                    $(this).find('.bi-heart-fill').addClass('bi-heart').removeClass('bi-heart-fill');
                }
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