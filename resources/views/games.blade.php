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
  margin: 0 auto;
  border-radius: calc(var(--curve) * 1px);
  overflow: hidden;
  text-decoration: none;
  transition: transform 0.3s ease-in-out;
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



.custom-btn {
    background-color: #f857a8; /* Colore personalizzato */
    border-color: #f857a8; /* Colore del bordo, se necessario */
    color: #fff; /* Colore del testo */
}

.custom-btn:hover {
    background-color: #fff; /* Cambio di colore all'hover */
    border-color: #d00f56; /* Cambio di colore del bordo all'hover, se necessario */
    color: #f857a8; /* Colore del testo all'hover */
}
</style>

<div class="container-fluid" style="max-width: 50rem;">
  <div class="input-group">
    <input id="searchInput" class="form-control me-2" type="search" autocomplete="off" placeholder="Search games" aria-label="Search" >
  </div>
</div>

<ul class="cards">
@foreach($games as $game)
 
  <li  class="card-container" style=" align-items: center;justify-content: center;">

    <a class="card" style=" width: 20rem; height:22rem;">
      <img onclick="location.href='{{route('gameAitools',['name'=>$game['name']])}}'" src="{{url('/games_img/'.$game['image_path'])}}" class="card__image" alt="" />
      <div class="card__overlay">
        <div class="card__header">
                              
          @if(Auth::check())
            
            <button type="button" class="btn btn-outline-danger favoriteButton  bi 
            @if(Auth::user()->favGames->find($game['id'])) 
              bi-heart-fill
            @else 
              bi-heart
            @endif
            " data-game-id="{{ $game['id'] }}">
            </button>
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
    if ($(this).hasClass('bi-heart')) {
        $(this).removeClass('bi-heart');
        $(this).addClass('bi-heart-fill');
      }else {
        $(this).removeClass('bi-heart-fill');
        $(this).addClass('bi-heart');
      }
    @auth

        $.ajax({
            url: '{{ route('favGame_flag',['game_id' => '']) }}' + gameId,
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

if ('ontouchstart' in window) {
window.addEventListener('scroll', function() {
    var cards = document.querySelectorAll('.card');
    var windowHeight = window.innerHeight;
    var sectionTop = windowHeight / 2;
    var sectionBottom = windowHeight - sectionTop;

    cards.forEach(function(card) {
        var cardTop = card.getBoundingClientRect().top;
        var cardBottom = card.getBoundingClientRect().bottom;

        if (cardTop < sectionBottom && cardBottom > sectionTop) {
            card.style.transform = 'scale(1.1)';
            
            // Recupera altri elementi all'interno della card
            var header = card.querySelector('.card__header');
            var overlay = card.querySelector('.card__overlay');

            if (header) {
                header.style.transform = 'translateY(0)';
            }

            if (overlay) {
                overlay.style.transform = 'translateY(0)';
            }
        } else {
            card.style.transform = 'none';

            // Ripristina la trasformazione per gli elementi header e overlay
            var header = card.querySelector('.card__header');
            var overlay = card.querySelector('.card__overlay');

            if (header) {
                header.style.transform = 'translateY(-100%)';
            }

            if (overlay) {
                overlay.style.transform = 'translateY(100%)';
            }
        }
    });
});
}

// Funzione per aggiornare il layout delle carte durante la ricerca
function updateCardLayout() {
    var cardContainers = document.querySelectorAll('.card-container');
    cardContainers.forEach(function(container) {
        var card = container.querySelector('.card');
        if (card.style.display === 'none') {
            container.style.display = 'none';
        } else {
            container.style.display = 'block'; 
        }
    });
}

    // Funzione per filtrare le card in base al nome del gioco
    function filterCards(searchText) {
        var cards = document.querySelectorAll('.card');
        var visibleCardsCount = 0;

        cards.forEach(function(card) {
            var cardTitle = card.querySelector('.card__title').textContent.toLowerCase();
            if (searchText === '' || cardTitle.includes(searchText.toLowerCase())) {
                card.style.display = 'block'; // Mostra la card se il testo di ricerca è vuoto o corrisponde al nome del gioco
                visibleCardsCount++;
            } else {
                card.style.display = 'none'; // Nascondi la card se il testo di ricerca non corrisponde al nome del gioco
            }
        });

        // Aggiorna il layout delle carte solo se sono visibili carte filtrate
        if (visibleCardsCount > 0) {
            updateCardLayout();
        }
    }

    // Ascolta gli eventi di input nell'elemento di input della search bar
    document.getElementById('searchInput').addEventListener('input', function() {
        var searchText = this.value.trim(); // Ottieni il testo di ricerca e rimuovi eventuali spazi vuoti iniziali e finali
        filterCards(searchText); // Filtra le card in base al testo di ricerca
    });
</script>


</script>


@endsection    