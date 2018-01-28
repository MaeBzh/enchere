<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
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
            <ul class="nav navbar-nav">

                <li class="dropdown, @if(\Request::is('profil')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Votre compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/profil') }}">Votre profil</a></li>
                        <li><a href="{{ url('/ventesEnCours') }}">Vos ventes en cours</a></li>
                        <li><a href="{{ url('/ventesTerminees') }}">Vos ventes terminées</a></li>
                        <li><a href="{{ url('/achats') }}">Vos achats</a></li>
                        <li><a href="{{ url('/encheresEnCours') }}">Vos enchères en cours</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('formulaireMiseEnVente') }}">Mettre un objet en vente</a></li>
                <li><a href="#">Ventes en cours</a></li>

            </ul>
            <form class="navbar-form navbar-left" method="post" action="{{--{{ route('rechercheObjet') }}--}}">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Chercher un objet">
                </div>
                <button type="submit" class="btn btn-default">Valider</button>
            </form>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->

                @guest
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                    <li><a href="{{ route('register') }}">Inscription</a></li>
                @else
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Déconnexion
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>