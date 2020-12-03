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
                <form action="/login" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-5 mx-auto">
                                <input type="text" class="form-control" id="email" placeholder="Adresse e-mail">
                                <input type="password" class="mt-4 form-control" id="password" placeholder="Mot de passe">
                                <button type="submit" class="mt-5 btn btn-primary"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
                                <a href="#" class="mt-1 form-control-plaintext">Mot de passe oublié ?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
