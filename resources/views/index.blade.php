@extends('layouts.layout')

@section('title', 'Page Title')

@section('content')
    <div class="my-0">
        <div class="container">
            <div class="heading-block topmargin-lg center">
                <h2>Bienvenue sur MoviesPlaceholder</h2>
                <span class="mx-auto">Sur notre plateforme vous pouvez consulter et redigez des avis sur vos films favoris !</span>
            </div>
        </div>
    </div>
    <div class="my-0">
        <div class="container">
            <div class="heading-block topmargin-lg center">
                <form action="/search" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Rechercher un film</label>
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Le Hobbit du Cantal" autocomplete="off">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Rechercher</button>
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
                <span class="mx-auto">Donner votre avis sur les films sortis récemment.</span>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{url('images/logo.png')}}" alt="">
                            <h4 class="card-title">Movie Title</h4>
                            <p><span class="badge badge-secondary">Rating <i class="far fa-star"></i></span></p>
                            <p class="card-text"><i class="fas fa-calendar-day"></i> DD/MM/YYYY</p>
                            <span class="badge badge-primary">Primary</span>
                            {{--<span class="badge {{$genre}}">{{$Genre}}</span>--}}
                            <p class="card-text"><b>Synopsis :</b>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="far fa-comment-dots"></i></p></a>

                                </div>
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="fas fa-info-circle"></i></p></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="fas fa-comments"></i></p></a>
                                    <span class="top-cart-number">5</span>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{url('images/logo.png')}}" alt="">
                            <h4 class="card-title">Movie Title</h4>
                            <p><span class="badge badge-secondary">Rating <i class="far fa-star"></i></span></p>
                            <p class="card-text"><i class="fas fa-calendar-day"></i> DD/MM/YYYY</p>
                            <span class="badge badge-primary">Primary</span>
                            {{--<span class="badge {{$genre}}">{{$Genre}}</span>--}}
                            <p class="card-text"><b>Synopsis :</b>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="far fa-comment-dots"></i></p></a>

                                </div>
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="fas fa-info-circle"></i></p></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="fas fa-comments"></i></p></a>
                                    <span class="top-cart-number">5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{url('images/logo.png')}}" alt="">
                            <h4 class="card-title">Movie Title</h4>
                            <p><span class="badge badge-secondary">Rating <i class="far fa-star"></i></span></p>
                            <p class="card-text"><i class="fas fa-calendar-day"></i> DD/MM/YYYY</p>
                            <span class="badge badge-primary">Primary</span>
                            {{--<span class="badge {{$genre}}">{{$Genre}}</span>--}}
                            <p class="card-text"><b>Synopsis :</b>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="far fa-comment-dots"></i></p></a>

                                </div>
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="fas fa-info-circle"></i></p></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><p class="h2 text-center"> <i class="fas fa-comments"></i></p></a>
                                    <span class="top-cart-number">5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
