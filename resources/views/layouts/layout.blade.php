<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="language" content="fr"/>
    <meta name="Robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MoviesPlaceholder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ url('theme/css/theme/style.css') }}?v0.9">
    <link rel="stylesheet" href="{{ url('theme/css/theme/bootstrap.css') }}?v0.9">
    <link rel="stylesheet" href="{{ url('theme/css/theme/custom.css') }}?v0.9">
    <link rel="stylesheet" href="{{ url('theme/css/theme/font-icons.css') }}?v0.9">
    <link rel="stylesheet" href="{{ url('theme/css/theme/swiper.css') }}?v0.9">
    <link rel="stylesheet" href="{{ url('theme/css/theme/animate.css') }}?v0.9">
    <link rel="stylesheet" href="{{ url('theme/css/theme/bootstrap.css') }}?v0.9">
    <link rel="stylesheet" href="{{ url('theme/css/theme/magnific-popup.css') }}?v0.9">

    <link rel="stylesheet" href="{{ url('theme/css/main.css') }}?v0.6">
    <link rel="stylesheet" href="{{ url('theme/css/design.css') }}?v0.9">


    <script src="https://kit.fontawesome.com/710b1f50a1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



</head>
<body class="stretched">
<div id="wrapper" class="clearfix">

    {{--{{ include("navbar.blade.php") }}--}}
    @include('layouts.navbar')


    @yield('content')

    {{--@section('footer')
    {{ include("footer") }}
    @stop--}}

</div>


<script src="{{ url('js/jquery.js') }}" type="application/javascript"></script>
<script src="{{ url('js/plugins.min.js') }}" type="application/javascript"></script>
<script src="{{ url('js/functions.js') }}" type="application/javascript"></script>

</div>
</body>
</html>
