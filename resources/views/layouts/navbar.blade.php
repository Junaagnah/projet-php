<header id="header" class="dark floating-header header-size-custom">
    <div id="header-wrap background-navbar">
        <div class="container-fluid">
            <div class="header-row justify-content-lg-between">

                <!-- Logo
                ============================================= -->
                <div id="logo" class="mr-lg-0">
                    <a href="{{ url('/') }}" class="standard-logo" data-dark-logo="demos/store/images/logo-dark.png"><img src="{{url('images/logo.png')}}" alt="Canvas Logo"></a>
                </div><!-- #logo end -->

                <div class="header-misc">
                    @if (empty($_SESSION['user']))
                        <!-- Top Login
                        ============================================= -->
                        <div id="top-account" class="px-4">
                            <a class="pr-4" href="{{ url('register') }}" data-lightbox="inline">S'inscrire</a>
                            <a href="{{ url('login') }}" data-lightbox="inline">Se connecter</a>
                        </div><!-- #top-search end -->
                    @else
                        <div id="top-account" class="px-4">
                            <a class="pr-4" href="/user/{{ $_SESSION['user']['username'] }}" data-lightbox="inline">{{ $_SESSION['user']['username'] }}</a>
                            <a href="{{ url('disconnect') }}" data-lightbox="inline">Se déconnecter</a>
                        </div>
                    @endif
                </div>

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu with-arrows">

                    <!-- Menu Left -->
                    <ul class="not-dark menu-container">
                        <li class="menu-item"><a class="menu-link" href="/"><div>Accueil</div></a></li>
                        @if(!empty($_SESSION['user']) && $_SESSION['user']['userRole'] === ROLE_ADMIN)
                            <!-- Only showing if the user is admin -->
                            <li class="menu-item"><a class="menu-link" href="/admin"><div>Administration</div></a></li>
                        @endif
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>

        </div>

    </div>

</header><!-- #header end -->
