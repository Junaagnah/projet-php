@extends('layouts.layout')

@section('title', 'Page Title')

@section('content')
<div class="my-0">
    <div class="container">
        <div class="heading-block topmargin-lg center">
            <h2>Bienvenue sur MoviesPlaceholder</h2>
            <span class="mx-auto">Sur notre plateforme vous pouvez consulter et rediger des avis sur vos films favoris !</span>
        </div>
    </div>
</div>
<div class="my-0">
    <div class="container">
        <div class="heading-block topmargin-lg center">
            <form
                action="/search"
                method="get"
            >
                <div class="form-group">
                    <label for="searchByTitle">Rechercher un film</label>
                    <div class="row">
                        <div class="col-10">
                            <input
                                maxlength="500"
                                type="text"
                                class="form-control"
                                id="searchByTitle"
                                name="searchByTitle"
                                placeholder="Le Hobbit du Cantal"
                                autocomplete="off"
                            >
                        </div>
                        <div class="col-2">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            > <i class="fas fa-search"></i> Rechercher</button>
                        </div>
                    </div>
                    <input type="hidden" value="1" name="pageNumber"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="section my-1">
    <div class="container">
        @if(is_null($stringToSearch))
        <div class="heading-block topmargin-lg center">
            <h2>En salle en ce moment</h2>
            <span class="mx-auto">Donnez votre avis sur les films diffusés en ce moment.</span>
        </div>
        @else
        <div class="heading-block topmargin-lg center">
            <h2>Résultat de la recherche : {{$stringToSearch}}</h2>
        </div>
        @endif
        @if(!is_null($movies))
        <nav aria-label="navigation" class="d-flex justify-content-center">
            <ul class="pagination">
            @if ($pageNumber < 2)
                <li class="page-item page-link current-page">1</li>
                @if($movies['total_pages'] > 1)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=2' : '?pageNumber=2' ?>">2</a></li>
                @endif
                @if($movies['total_pages'] > 2)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=3' : '?pageNumber=3' ?>">3</a></li>
                @endif

                @if($movies['total_pages'] > 1)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber + 1) : '?pageNumber='.($pageNumber + 1) ?>">></a></li>
                @endif


                @if($movies['total_pages'] > 3)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.$movies['total_pages'] : '?pageNumber='.$movies['total_pages'] ?>">Last</a></li>
                @endif
            @elseif ($pageNumber === $movies['total_pages'])
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=1' : '?pageNumber=1' ?>">First</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>"><</a></li>

                @if($movies['total_pages'] > 2)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 2) : '?pageNumber='.($pageNumber - 2) ?>">{{$movies['total_pages'] - 2}}</a></li>
                @endif
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>">{{$movies['total_pages'] - 1}}</a></li>

                <li class="page-item page-link current-page">{{ $movies['total_pages'] }}</li>
            @else
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=1' : '?pageNumber=1' ?>">First</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>"><</a></li>

                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>">{{ $pageNumber -1 }}</a></li>
                <li class="page-item page-link current-page">{{ $pageNumber }}</li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber + 1) : '?pageNumber='.($pageNumber + 1) ?>">{{ $pageNumber + 1 }}</a></li>

                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber + 1) : '?pageNumber='.($pageNumber + 1) ?>">></a></li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.$movies['total_pages'] : '?pageNumber='.$movies['total_pages'] ?>">Last</a></li>
            @endif
            </ul>
        </nav>
        <div class="row">
            @foreach ($movies['results'] as $movie)
            <a class="col-4 mb-4" href="/movieOverview?movieId=<?php echo $movie['id'] ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="poster-container d-flex justify-content-center align-items-center">
                        @if (!$movie['poster_path'])
                        <img
                            class="mh-100"
                            src="{{url('images/logo.png')}}"
                            alt=""
                        >
                        @else
                        <img
                            class="mh-100"
                            src="https://image.tmdb.org/t/p/w300{{ $movie['poster_path'] }}?>"
                            alt=""
                        >
                        @endif
                        </div>
                        <h4 class="card-title mt-3">{{ $movie['title'] }}</h4>
                        @if(array_key_exists('release_date', $movie))
                        <p class="card-text"><i class="fas fa-calendar-day"></i> {{ date_format(date_create($movie['release_date']), 'd-m-Y') }}</p>
                        @else
                        <p class="card-text"><i class="fas fa-calendar-day mr-1"></i>Date de sortie inconnue</p>
                        @endif
                        <div class="badge-container">
                        @foreach ($movie['genre'] as $movieGenre)
                        <span class="badge badge-<?php echo strtolower($movieGenre['genreClassName']) ?>">{{ $movieGenre['genre'] }}</span>
                        @endforeach
                        </div>
                        @if ($movie['overview'] && $movie['overview'] !== '')
                        <p class="card-text movie-overview"><b>Synopsis : </b>{{$movie['overview']}}</p>
                        @else
                        <p class="card-text movie-overview font-italic">Le Synopsis du film n'est pas disponible</p> 
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <nav aria-label="navigation" class="d-flex justify-content-center">
            <ul class="pagination">
            @if ($pageNumber < 2)
                <li class="page-item page-link current-page">1</li>
                @if($movies['total_pages'] > 1)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=2' : '?pageNumber=2' ?>">2</a></li>
                @endif
                @if($movies['total_pages'] > 2)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=3' : '?pageNumber=3' ?>">3</a></li>
                @endif

                @if($movies['total_pages'] > 1)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber + 1) : '?pageNumber='.($pageNumber + 1) ?>">Next</a></li>
                @endif


                @if($movies['total_pages'] > 3)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.$movies['total_pages'] : '?pageNumber='.$movies['total_pages'] ?>">Last</a></li>
                @endif
            @elseif ($pageNumber === $movies['total_pages'])
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=1' : '?pageNumber=1' ?>">First</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>">Previous</a></li>

                @if($movies['total_pages'] > 2)
                    <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 2) : '?pageNumber='.($pageNumber - 2) ?>">{{$movies['total_pages'] - 2}}</a></li>
                @endif
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>">{{$movies['total_pages'] - 1}}</a></li>

                <li class="page-item page-link current-page">{{ $movies['total_pages'] }}</li>
            @else
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber=1' : '?pageNumber=1' ?>">First</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>">Previous</a></li>

                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber - 1) : '?pageNumber='.($pageNumber - 1) ?>">{{ $pageNumber -1 }}</a></li>
                <li class="page-item page-link current-page">{{ $pageNumber }}</li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber + 1) : '?pageNumber='.($pageNumber + 1) ?>">{{ $pageNumber + 1 }}</a></li>

                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.($pageNumber + 1) : '?pageNumber='.($pageNumber + 1) ?>">Next</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo isset($stringToSearch) ? '?searchByTitle='.$stringToSearch.'&pageNumber='.$movies['total_pages'] : '?pageNumber='.$movies['total_pages'] ?>">Last</a></li>
            @endif
            </ul>
        </nav>
        @else
        <h3 class="font-italic font-weight-normal d-block center">Aucun résultat</h3>
        @endif
    </div>
</div>
@endsection
