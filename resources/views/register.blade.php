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
                                <input type="email" class="form-control required valid" id="email" name="email" placeholder="Adresse e-mail" required>
                                <input type="text" class="mt-4 form-control required valid" id="username" name="username" placeholder="Nom d'utilisateur" required>
                                <select class="mt-4 form-control required valid" name="title" id="title" required>
                                    <option value="">-- Sélectionner un titre --</option>
                                    <option value="Monsieur">Monsieur</option>
                                    <option value="Madame">Madame</option>
                                    <option value="Neutre">Neutre</option>
                                    <option value="Docteur">Docteur</option>
                                    <option value="Professeur">Professeur</option>
                                    <option value="Maître">Maître</option>
                                </select>
                                <input type="text" class="mt-4 form-control required valid" id="lastName" name="lastName" placeholder="Nom" required>
                                <input type="text" class="mt-4 form-control required valid" id="firstName" name="firstName" placeholder="Prénom" required>
                                <input type="password" class="mt-4 form-control required valid" id="password" name="password" placeholder="Mot de passe" required>
                                <input type="password" class="mt-4 form-control required valid" id="password_confirmation" name="password_confirmation" placeholder="Confirmation du mot de passe" required>
                                <button type="submit" class="mt-5 btn btn-primary"><i class="fas fa-sign-in-alt"></i> S'inscrire</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
