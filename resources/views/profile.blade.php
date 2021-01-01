@extends('layouts.layout')

@section('title', 'Page title')

@section('content')
    <div class="my-0">
        <div class="container">
            <div class="heading-block topmargin-lg center">
                <h2>{{ $user['username'] }}</h2>
                @if(!empty($user['profilePicturePath']))
                    <img src="/images/{{$user['profilePicturePath']}}" alt="Profile picture" class="img-circle profile-picture mt-3">
                @else
                    <img src="/images/{{ DEFAULT_PROFILE_PICTURE }}" alt="Profile picture" class="img-circle profile-picture mt-3">
                @endif
            </div>
            <div class="mt-0 heading-block topmargin-lg center">
                <h2>Derniers commentaires</h2>
            </div>
            <div class="center">
                @if(empty($lastComments))
                    <h5>Pas de commentaires à afficher</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
