@extends('layouts.layout')

@section('title', 'Page Title')

@section('content')

    <div class="card">
        <div class="card-header">
            Une erreur est survenue
        </div>
        <div class="card body">
            {{$error}}
        </div>
    </div>


@endsection
