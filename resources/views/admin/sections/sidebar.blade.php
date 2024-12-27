@if (Route::currentRouteName() !== 'auth.login')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> 
                {{-- <img alt="image" src="assets/img/logo.png" class="header-logo" /> --}}
                <span class="logo-name">MAXISUJETS</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown active">
                <a href="{{route('dashboard.index')}}" class="nav-link"><i
                        data-feather="monitor"></i><span>Tableau de bord</span></a>
            </li>
            <li class="menu-header">Gestion de Sujet</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="grid"></i><span>Categories</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('categorie.index')}}">Ajouter une categorie</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="activity"></i><span>Niveau</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('niveau.index')}}">Ajouter un niveau</a></li>
                  
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="book"></i><span>Matiere</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('matiere.index')}}">Ajouter une matiere</a></li>
                   
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="home"></i><span>Etablissement</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('etablissement.index')}}">Ajouter un etablissement</a></li>
                   
                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="book"></i><span>Sujet</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('sujet.index')}}">Ajouter un sujet</a></li>
                   
                </ul>
            </li>


            <li class="menu-header">Gestion des utilisateurs</li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Utilsateurs</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('user.index')}}">Ajouter un utilisateur</a></li>
                    <li><a class="nav-link" href="{{route('role.index')}}">Ajouter un role</a></li>
                </ul>
            </li>


            <li class="menu-header">Blog</li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="globe"></i><span>Informations</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('categorie-news.index')}}">Type information</a></li>
                    <li><a class="nav-link" href="{{route('news.index')}}">Ajouter une information</a></li>
                </ul>
            </li>

          
           
        </ul>
    </aside>
</div>
@endif

