@extends('layouts.layout')

@section('title', 'Page title')

@section('content')
    <div class='movie-backdrop d-flex justify-content-center align-items-center' style="background-image: linear-gradient(90deg, rgba(43,47,86,1) 0%, rgba(9,9,45,0.85) 50%, rgba(43,47,86,1) 100%), url('https://image.tmdb.org/t/p/original<?php echo $movie['backdrop_path'] ?>');">
        <div class='container w-75 d-flex'>

            @if (!$movie['poster_path'])
            <img
                class="empty-poster w-25 rounded"
                src="{{url('images/logo.png')}}"
                alt=""
            >
            @else
            <img src="https://image.tmdb.org/t/p/original{{ $movie['poster_path'] }}?>" alt="" class="poster w-25 rounded">
            @endif
            <div class="w-75 p-5 d-flex flex-column">
                <h2 class="mb-3">{{$movie['title']}}</h2>
                @if(array_key_exists('release_date', $movie))
                <p class="card-text mb-3 mt-0"><i class="fas fa-calendar-day"></i> {{ date_format(date_create($movie['release_date']), 'd-m-Y') }}</p>
                @else
                <p class="card-text mb-3 mt-0"><i class="fas fa-calendar-day mr-1"></i>Date de sortie inconnue</p>
                @endif
                <div class='note-and-genres-container'>
                    @if (empty($movie['average_note']))
                    <p class="note-info my-0 pl-2 mr-3 font-weight-bold text-center">Aucune revue de ce film sur notre site pour le moment</p>
                    @else
                    <p class="note my-0 font-weight-bold">{{ $movie['average_note'] }}</p>
                    <p class="note-info my-0 pl-2 font-weight-bold">Note des utilisateurs MoviePlaceholder</p>
                    @endif

                    @if (empty($movie['vote_average']))
                    <p class="note-info my-0 pl-2 mr-3 font-weight-bold text-center">Aucune revue de ce film sur MovieDB pour le moment</p>
                    @else
                    <p class="note my-0 font-weight-bold">{{ $movie['vote_average'] }}</p>
                    <p class="note-info my-0 pl-2 font-weight-bold">Note des utilisateurs MovieDB</p>
                    @endif

                    @foreach ($movie['genres'] as $movieGenre)
                    <span class="badge mr-1 badge-<?php echo strtolower($movieGenre['genreClassName']) ?>">{{ $movieGenre['name'] }}</span>
                    @endforeach
                </div>
                <p class='movie-details-synopsis mt-3 pr-3'><b>Synopsis : </b>{{$movie['overview']}}</p>
            </div>
        </div>
    </div>
    @if (!empty($_SESSION['user']))
        @if (array_search($_SESSION['user']['id'], array_column($reviews, 'FK_userId')) !== false)
        <div
            style="background-color: rgba(0,0,0,0.1)"
        >
            <form
                action="/editReview"
                method="post"
                class='d-flex justify-content-center align-items-center pt-3'
            >
                <div class="form-group">
                    <label for="review">Editer votre revue</label>
                    <div class="row">
                        <div class="col-10">
                        <textarea maxlength="5000" name="review"id="review"cols="100"rows="6"placeholder="Ajouter un commentaire">{{trim($reviews[array_search($_SESSION['user']['id'],array_column($reviews,'FK_userId'))]['review'])}}</textarea>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                            <label class="text-center" for="number">Note / 10 <span>(chiffre rond uniquement)</span></label>
                            <input
                                class="pl-1 w-50"
                                type="number"
                                min="1"
                                max="10"
                                step="1"
                                id="note"
                                name="note"
                                autocomplete="off"
                                value="{{$reviews[array_search($_SESSION['user']['id'],array_column($reviews,'FK_userId'))]['note']}}"
                            >
                            <button
                                type="submit"
                                class="btn btn-primary m-auto"
                            >Valider</button>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $movie['id'] }}" name="FK_movieId"/>
                    </div>
            </form>
            <form
                action="/deleteReview"
                method="post"
                class='d-flex justify-content-center align-items-center pb-3'
            >
                <input type="hidden" value="{{ $movie['id'] }}" name="FK_movieId"/>
                <button
                    class="btn btn-danger m-auto"
                >Supprimer</button>
            </form>
        </div>
        @else
        <form
            action="/addReview"
            method="post"
            class='d-flex justify-content-center align-items-center pt-3'
            style="background-color: rgba(0,0,0,0.1)"
        >
            <div class="form-group">
                <label for="review">Ajouter une revue</label>
                <div class="row">
                    <div class="col-10">
                    <textarea maxlength="5000" name="review"id="review"cols="100"rows="6"placeholder="Ajouter un commentaire"></textarea>
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                        <label for="number">Note / 10 <span>(chiffre rond uniquement)</span></label>
                        <input
                            class="pl-1 w-50"
                            type="number"
                            min="1"
                            max="10"
                            step="1"
                            id="note"
                            name="note"
                            autocomplete="off"
                        >
                        <button
                            type="submit"
                            class="btn btn-primary m-auto"
                        >Envoyer</button>
                    </div>
                </div>
                <input type="hidden" value="{{ $movie['id'] }}" name="FK_movieId"/>
                </div>
        </form>
        @endif
    @endif
    <div class="heading-block topmargin-lg center">
            <h2>Derniers commentaires</h2>
    </div>
    @if (!empty($reviews))
    <div class="reviews-container d-flex flex-column justify-content-center align-items-center m-auto">
        @foreach ($reviews as $review)
        <div class='review d-flex justify-content-center mb-3'>
            <div class="user-name p-3 center">
                <a href="/user/{{ $review['username'] }}"><h5>{{ $review['username'] }}</h5></a>
                <br>
                @if(!empty($review['profilePicturePath']))
                    <img class="profile-picture img-circle" src="/images/profile_picture/{{ $review['profilePicturePath'] }}" alt="profile picture">
                @else
                    <img class="profile-picture img-circle" src="/images/profile_picture/{{ DEFAULT_PROFILE_PICTURE }}" alt="profile picture">
                @endif
            </div>
            <div class="user-review p-3 pb-5">
                {{ $review['review'] }}
                <span class="updated-at pb-1 pr-2 font-italic">Mis à jour le : {{date_format(date_create($review['updated_at']), 'd-m-Y à H:i:s')}}</span>
            </div>
            <div class="user-note p-3  d-flex justify-content-center align-items-center">{{ $review['note'] }}</div>
            @if (!empty($_SESSION['user']) && $_SESSION['user']['userRole'] === ROLE_ADMIN)
            <form
                action="/adminDeleteReview"
                method="post"
                class='d-flex justify-content-center align-items-center pb-3'
            >
                <input type="hidden" value="{{ $movie['id'] }}" name="FK_movieId"/>
                <input type="hidden" value="{{ $review['id'] }}" name="id"/>
                <button
                    class="btn btn-danger admin-delete-review-button"
                >Supprimer</button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
    @else
        <p class="text-center font-italic">Aucun commentaire</p>
    @endif

@endsection
