@extends('layouts.layout')

@section('title', 'Page Title')

@section('content')
    <div class="my-0">
        <div class="container">
            <div class="heading-block topmargin-lg center">
                <h2>Administration</h2>
                <span class="mx-auto">Supprimez, bannisez et choisissez des administrateurs.</span>
            </div>
        </div>
    </div>

    <div class="container">
        <form
            action="/search-user"
            method="post"
        >
            <div class="form-group">
                <div class="row">
                    <div class="col-8">
                        <label class="text-center">Pseudo ou adresse e-mail de l'utilisateur</label>
                        <input
                            name="search"
                            type="text"
                            class="form-control"
                            placeholder="Bilb0_s4cquet"
                        >
                    </div>
                    <div class="col-2">
                        <label class="text-center">Role</label>
                        <select name="role" class="form-control">
                            <option value="all">Tous</option>
                            <option value="ROLE_USER">Utilisateur</option>
                            <option value="ROLE_ADMIN">Administrateur</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button
                            type="submit"
                            class="btn btn-primary btn-down"
                        >
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Pseudo</th>
                <th>Role</th>
                <th>email</th>
                <th>Bannir / Dé-bannir</th>
                <th>Promouvoir / Démoter</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr @if ($user->isBanned == true) class="background-red" @endif>
                <td>{{$user->username}}</td>
                <td>{{$user->userRole}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if ($user->isBanned == true)
                        <form action="/unban-user" method="post">
                            <button class="btn btn-primary" name="user" type="submit" value="{{$user->id}}">
                                Dé-bannir
                            </button>
                        </form>
                    @else
                        <form action="/ban-user" method="post">
                            <button class="btn btn-primary" name="user" type="submit" value="{{$user->id}}">
                                Bannir
                            </button>
                        </form>
                    @endif

                </td>
                <td>
                    @switch($user->userRole)
                        @case('ROLE_USER')
                            <form action="/promote-admin" method="post">
                                <button class="btn btn-primary" name="user" type="submit" value="{{$user->id}}">
                                    Passer Administrateur
                                </button>
                            </form>
                            @break
                        @case('ROLE_ADMIN')
                            <form action="/demote-user" method="post">
                                <button class="btn btn-primary" name="user" type="submit" value="{{$user->id}}">
                                    Passer Utilisateur
                                </button>
                            </form>
                            @break
                    @endswitch
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>





@endsection
