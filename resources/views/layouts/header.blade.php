<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Projet DevWeb
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            @auth
            <ul class="nav navbar-nav">

                <li class="dropdown, @if(\Request::is('mon_*', 'mes_*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Mon compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="@if(\Request::is('mon_profil')) active @endif">
                            <a href="{{ url('/mon_profil') }}">Mon profil</a>
                        </li>
                        <li class="@if(\Request::is('mes_ventes_en_cours')) active @endif">
                            <a href="{{ url('/mes_ventes_en_cours') }}">Mes ventes en cours</a>
                        </li>
                        <li class="@if(\Request::is('mes_ventes_terminees')) active @endif">
                            <a href="{{ url('/mes_ventes_terminees') }}">Mes ventes terminées</a>
                        </li>
                        <li class="@if(\Request::is('mes_achats')) active @endif">
                            <a href="{{ url('/mes_achats') }}">Mes achats</a>
                        </li>
                        <li class="@if(\Request::is('mes_encheres_en_cours')) active @endif">
                            <a href="{{ url('/mes_encheres_en_cours') }}">Mes enchères en cours</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ url('/mettre_en_vente') }}">Mettre un objet en vente</a></li>
                <li><a href="{{ url('/ventes_en_cours') }}">Ventes en cours</a></li>

            </ul>
            <form class="navbar-form navbar-left" method="post" role="search" action="{{ url('/recherche') }}">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="recherche"
                           placeholder="Chercher un objet">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>

            </form>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->

                @guest
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                    <li><a href="{{ route('register') }}">Inscription</a></li>
                @else
                    <li> <a>Bonjour {{ ucfirst(Auth::user()->username) }} !</a></li>
                    <li>
                        <a onclick="$('form#logout-form').submit();">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>