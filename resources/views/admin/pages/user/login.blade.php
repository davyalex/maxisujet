@extends('admin.layouts.app')


@section('content')
<section class="section">
    <div class="container">
      <div class="row">
        <div class="col-6 col-sm-12 offset-sm-1 col-md-6 offset-md-1 col-lg-6 offset-lg-2 col-xl-6">
          <div class="card card-primary">
            @include('admin.components.validationMessage')
            <div class="card-header">
              <h3 class="m-auto">Connexion dashboard </h3>
            </div>
            <div class="card-body">
              <form class="needs-validation" novalidate="" method="POST" action="{{route('auth.login')}}">
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" required>
                  <div class="invalid-feedback">
                    Champs obligatoire
                </div>
                </div>
               
                  <div class="form-group">
                    <label for="password" class="d-block">Password</label>
                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                      name="password" required>
                    {{-- <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div> --}}
                    <div class="invalid-feedback">
                      Champs obligatoire
                  </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Connexion
                    </button>
                </div>
                
              </form>
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection