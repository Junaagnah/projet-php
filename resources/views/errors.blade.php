@extends('layouts.layout')

@section('title', 'Page Title')

@section('content')

    <div class="card">
        <div class="card-header">
            Une erreur est survenue
        </div>
        @if(is_array(json_decode($error, true)))
            @foreach(json_decode($error, true) as $err)
                @if(is_array($err))
                    @foreach($err as $msg)
                        <div class="card body">
                            {{ $msg }}
                        </div>
                    @endforeach
                @else
                    <div class="card body">
                        {{ $err }}
                    </div>
                @endif
            @endforeach
        @else
            <div class="card body">
                {{ $error }}
            </div>
        @endif
    </div>
    <button class="btn btn-primary btn-down d-block mx-auto" onclick="history.go(-1);">Retour</button>


@endsection
