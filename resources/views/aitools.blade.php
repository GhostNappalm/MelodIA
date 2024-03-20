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
  display: flex;
  justify-content: center; 
  align-items: center;

  margin-right:0.5rem;
  margin-left:0.5rem;
  height: 100%;  
  border-radius: calc(var(--curve) * 1px);
  overflow: hidden;
  text-decoration: none;
  transition: transform 0.3s ease-in-out;
}

.card__header {
  position: relative;
  display: flex;
  padding:1rem;
  align-items: center;
  gap: 2em;
  border-radius: calc(var(--curve) * 1px) 0 0 0;    
  background-color: var(--surface-color);

} 

.card:hover  {
  transform: scale(1.1);
  text-decoration:none;
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
   

</style>


@if($game!='0')
<div style="text-align: center; margin: 3rem;">
    <h1 style="color: #6A515E; font-family: 'Noto Sans JP', sans-serif;">{{ $game['name']}}</h1>
    <p style="font-family: 'Noto Sans JP', sans-serif;">{{ $game['description']}}</p>
</div>

@endif

<div class="container-fluid" style="max-width: 50rem;">
  <div class="input-group">
    <input id="searchInput" class="form-control me-2" type="search" autocomplete="off" placeholder="Search generators by name or file extension" aria-label="Search" >
  </div>
</div>

<ul class="cards" style="">
@foreach($aitools as $aitool)
  <li class="card-container">
    <a href="{{ route('Aitool',['name'=>$aitool['name']])}}" class="card" style=" height:7rem;">

        <div class="card__header">
                             
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
            <h3 class="card__title">{{ $aitool['name'] }}</h3>            
            <span class="card__status">{{ $aitool['authors'] }}</span>
            <p class="hidden" style="display:none">{{ $aitool['out_file_ext'] }}</p>
          </div>
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

if ('ontouchstart' in window) {
    // Dispositivo touchscreen, attiva lo script
    window.addEventListener('scroll', function() {
        var cards = document.querySelectorAll('.card');
        var windowHeight = window.innerHeight;
        var sectionTop = windowHeight / 3;
        var sectionBottom = windowHeight - sectionTop;

        cards.forEach(function(card) {
            var cardTop = card.getBoundingClientRect().top;
            var cardBottom = card.getBoundingClientRect().bottom;

            if (cardTop < sectionBottom && cardBottom > sectionTop) {
                card.style.transform = 'scale(1.1)';
            } else {
                card.style.transform = 'none';
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
            var cardHidden = card.querySelector('.hidden').textContent.toLowerCase();
            if (searchText === '' || 
    cardTitle.toLowerCase().includes(searchText.toLowerCase()) || 
    cardHidden.toLowerCase().includes(searchText.toLowerCase())) {
                card.style.display = 'flex'; // Mostra la card se il testo di ricerca è vuoto o corrisponde al nome del gioco
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
    @endsection    