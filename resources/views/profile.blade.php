@extends('layouts.layout')

@section('title', 'Page title')

@section('content')
    <div class="my-0">
        <div class="container">
            <div class="heading-block topmargin-lg center">
                <h2>{{ $user['username'] }}</h2>
                @if(!empty($user['profilePicturePath']))
                    <img src="/images/profile_picture/{{$user['profilePicturePath']}}" alt="Profile picture" class="img-circle profile-picture mt-3">
                @else
                    <img src="/images/{{ DEFAULT_PROFILE_PICTURE }}" alt="Profile picture" class="img-circle profile-picture mt-3">
                @endif
            </div>

            <div class="container">
                @if($user['private'] == false)
                    <p class="text-center user-info h4 mt-3">Titre : {{$user['title']}}</p>
                    <p class="text-center user-info h4 mt-3">Nom : {{$user['lastName']}}</p>
                    <p class="text-center user-info h4 mt-3">Prénom : {{$user['firstName']}}</p>
                    <p class="text-center user-info h4 mt-3">Courriel : {{$user['email']}}</p>
                    <p class="text-center user-info h4 mt-3">Rôle : {{$user['userRole']}}</p>
                @elseif($user['private'] == true || $user['isBanned'] == true)
                    <p class="text-center user-info h4 mt-3">Pseudo : {{$user['username']}}</p>
                    <p class="text-center user-info h4 mt-3">Rôle : {{$user['userRole']}}</p>
                @endif
            </div>

            <p class="text-center mt-4">
                <button class="btn btn-primary" data-toggle="modal" data-target=".edit-modal"> <i class="fas fa-pen" aria-hidden="true"></i> Modifier les informations</button>
            </p>

            <div class="modal fade edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title text-center h4" id="myModalLabel">Modification les informations</p>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="/edit-user-action/{{$user['username']}}" enctype='multipart/form-data' method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-5 mx-auto">
                                                <label for="email" class="mt-2">Courriel</label>
                                                <input type="text" class=" mt-2 form-control " id="email" name="email" placeholder="{{$user['email']}}">
                                                <label for="username" class="mt-2">Pseudo</label>
                                                <input type="text" class="mt-2 form-control" id="username" name="username" placeholder="{{$user['username']}}">
                                                <label for="title" class="mt-2">Titre</label>
                                                <select class="mt-2 form-control" name="title" id="title">
                                                    <option value="">-- Sélectionner un titre --</option>
                                                    <option value="Monsieur">Monsieur</option>
                                                    <option value="Madame">Madame</option>
                                                    <option value="Neutre">Neutre</option>
                                                    <option value="Docteur">Docteur</option>
                                                    <option value="Professeur">Professeur</option>
                                                    <option value="Maître">Maître</option>
                                                </select>
                                                <label for="lastName" class="mt-2">Prénom</label>
                                                <input type="text" class="mt-2 form-control" id="lastName" name="lastName" placeholder="{{$user['lastName']}}" >
                                                <label for="firstName" class="mt-2">Nom de famille</label>
                                                <input type="text" class="mt-2 form-control" id="firstName" name="firstName" placeholder="{{$user['firstName']}}" >
                                                <label for="password" class="mt-4">Modifier le mot de passe</label>
                                                <input type="password" class="mt-2 form-control" id="password" name="password" placeholder="Nouveau mot de passe">
                                                <label class="mt-2">Photo de profile</label>
                                                <input id="profile_picture" name="profile_picture" type="file" class="file-loading mt-2" data-show-preview="false">
                                                <label for="private" class="mt-2">Visibilité du profil</label>
                                                <select class="mt-2 form-control" name="private" id="private">
                                                    <option value="">-- Sélectionner la visibilité --</option>
                                                    <option value="0">Publique</option>
                                                    <option value="1">Privé</option>
                                                </select>
                                                <label for="password_confirmation" class="mt-3">Vérification du mot de passe</label>
                                                <input type="password" class="mt-2 form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation du mot de passe" required>
                                                <button type="submit" class="mt-4 btn btn-primary"><i class="fas fa-sign-in-alt"></i> Changer les informations</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 heading-block topmargin-lg center">
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
