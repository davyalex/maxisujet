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
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Categories</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('categorie.index')}}">Ajouter une categorie</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Niveau</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="chat.html">Ajouter un niveau</a></li>
                  
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="mail"></i><span>Matiere</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="email-inbox.html">Ajouter une matiere</a></li>
                   
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="mail"></i><span>Etablissement</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="email-inbox.html">Ajouter un etablissement</a></li>
                   
                </ul>
            </li>
          
           
        </ul>
    </aside>
</div>