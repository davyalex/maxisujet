<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Tableau de bord</a></li>
      {{-- <li class="breadcrumb-item"> <a href="{{url()->previous()}}">Retour</a></li> --}}
      <li class="breadcrumb-item active" aria-current="page"> @yield('title')</li>
    </ol>
  </nav>