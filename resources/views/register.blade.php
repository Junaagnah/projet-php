@extends('layouts.layout')

@section('title', 'Page title')

@section('content')
    <div class="my-0">
        <div class="container">
            <div class="heading-block topmargin-lg center">
                <h2>S'inscrire</h2>
            </div>
        </div>
    </div>
    <div class="my-0">
        <div class="container">
            <div class="topmargin-lg center">
                <form action="/register-action" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-5 mx-auto">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Adresse e-mail">
                                <input type="text" class="mt-4 form-control" id="username" name="username" placeholder="Nom d'utilisateur">
                                <input type="password" class="mt-4 form-control" id="password" name="password" placeholder="Mot de passe">
                                <input type="password" class="mt-4 form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation du mot de passe">
                                <button type="submit" class="mt-5 btn btn-primary"><i class="fas fa-sign-in-alt"></i> S'inscrire</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
