@extends('layouts.layout')

@section('title', 'Page title')

@section('content')
    <div class="my-0">
        <div class="container">
            <div class="heading-block topmargin-lg center">
                <h2>Se connecter</h2>
            </div>
        </div>
    </div>
    <div class="my-0">
        <div class="container">
            <div class="topmargin-lg center">
                <form action="/login-action" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-5 mx-auto">
                                <input maxlength="100" type="text" class="form-control" id="email" name="email" placeholder="Adresse e-mail">
                                <input maxlength="32" type="password" class="mt-4 form-control" id="password" name="password" placeholder="Mot de passe">
                                <button type="submit" class="mt-5 btn btn-primary"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
