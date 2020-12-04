@extends('layouts.layout')

@section('title', 'Page Title')

@section('content')
<div class="my-0">
    <div class="container">
        <div class="heading-block topmargin-lg center">
            <h2>Bienvenue sur MoviesPlaceholder</h2>
            <span class="mx-auto">Sur notre plateforme vous pouvez consulter et rediger des avis sur vos films favoris
                !</span>
        </div>
    </div>
</div>
<div class="my-0">
    <div class="container">
        <div class="heading-block topmargin-lg center">
            <form
                action="/search"
                method="post"
            >
                <div class="form-group">
                    <label for="exampleFormControlInput1">Rechercher un film</label>
                    <div class="row">
                        <div class="col-10">
                            <input
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
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


                </div>
            </form>
        </div>
    </div>
</div>
<div class="section my-1">
    <div class="container">
        <div class="heading-block topmargin-lg center">
            <h2>Dernières sorties</h2>
            <span class="mx-auto">Donnez votre avis sur les films sortis récemment.</span>
        </div>
        <nav aria-label="navigation" class="d-flex justify-content-center">
            <ul class="pagination">
            @if ($pageNumber < 2)
                <li class="page-item page-link current-page">1</li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=2">2</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=3">3</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber + 1 ?>">Next</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] ?>">Last</a></li>
            @elseif ($pageNumber === $movies['total_pages'])
                <li class="page-item"><a class="page-link" href="/?pageNumber=1">First</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber - 1 ?>">Previous</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] - 2 ?>">{{ $movies['total_pages'] - 2 }}</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] - 1 ?>">{{ $movies['total_pages'] - 1 }}</a></li>
                <li class="page-item page-link current-page">{{ $movies['total_pages'] }}</li>
            @else
                <li class="page-item"><a class="page-link" href="/?pageNumber=1">First</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber - 1 ?>">Previous</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber - 1 ?>">{{ $pageNumber -1 }}</a></li>
                <li class="page-item page-link current-page">{{ $pageNumber }}</li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber + 1 ?>">{{ $pageNumber + 1 }}</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber + 1 ?>">Next</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] ?>">Last</a></li>
            @endif
            </ul>
        </nav>
        <div class="row">
            @foreach ($movies['results'] as $movie)
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="poster-container d-flex justify-content-center align-items-center">
                        @if (!$movie['poster_path'])
                        <img
                            src="{{url('images/logo.png')}}"
                            alt=""
                        >
                        @else
                        <img
                            src="https://image.tmdb.org/t/p/w300<?php echo $movie['poster_path'] ?>"
                            alt=""
                        >
                        @endif
                        </div>
                        <h4 class="card-title mt-3">{{ $movie['title'] }}</h4>
                        <p><span class="badge badge-secondary">Rating <i class="far fa-star"></i></span></p>
                        <p class="card-text"><i class="fas fa-calendar-day"></i> {{ $movie['release_date'] }}</p>
                        <div class="badge-container">
                        @foreach ($movie['genre'] as $movieGenre)
                        <span class="badge badge-<?php echo strtolower($movieGenre) ?>">{{ $movieGenre }}</span>
                        @endforeach
                        </div>
                        @if ($movie['overview'] && $movie['overview'] !== '')
                        <p class="card-text movie-overview"><b>Synopsis : </b>{{$movie['overview']}}</p>
                        @else
                        <p class="card-text movie-overview font-italic">Le Synopsis du film n'est pas disponible</p> 
                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <a href="#">
                                    <p class="h2 text-center"> <i class="far fa-comment-dots"></i></p>
                                </a>

                            </div>
                            <div class="col-4">
                                <a href="#">
                                    <p class="h2 text-center"> <i class="fas fa-info-circle"></i></p>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#">
                                    <p class="h2 text-center"> <i class="fas fa-comments"></i></p>
                                </a>
                                <span class="top-cart-number">5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <nav aria-label="navigation" class="d-flex justify-content-center">
            <ul class="pagination">
            @if ($pageNumber < 2)
                <li class="page-item page-link current-page">1</li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=2">2</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=3">3</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber + 1 ?>">Next</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] ?>">Last</a></li>
            @elseif ($pageNumber === $movies['total_pages'])
                <li class="page-item"><a class="page-link" href="/?pageNumber=1">First</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber - 1 ?>">Previous</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] - 2 ?>">{{ $movies['total_pages'] - 2 }}</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] - 1 ?>">{{ $movies['total_pages'] - 1 }}</a></li>
                <li class="page-item page-link current-page">{{ $movies['total_pages'] }}</li>
            @else
                <li class="page-item"><a class="page-link" href="/?pageNumber=1">First</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber - 1 ?>">Previous</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber - 1 ?>">{{ $pageNumber -1 }}</a></li>
                <li class="page-item page-link current-page">{{ $pageNumber }}</li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber + 1 ?>">{{ $pageNumber + 1 }}</a></li>

                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $pageNumber + 1 ?>">Next</a></li>
                <li class="page-item"><a class="page-link" href="/?pageNumber=<?php echo $movies['total_pages'] ?>">Last</a></li>
            @endif
            </ul>
        </nav>
    </div>
</div>
@endsection
