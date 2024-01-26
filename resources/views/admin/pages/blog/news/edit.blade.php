  <style>
      img {
          max-width: 180px;
      }

      input[type=file] {
          padding: 10px;
          background: #eaeaea;
      }
  </style>

  <script>
      function readURL(input) {
          let noimage =
              "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                  $('#img-preview')
                      .attr('src', e.target.result);
              };


              reader.readAsDataURL(input.files[0]);
          } else {
              $("#img-preview").attr("src", noimage);
          }
      }

      // ######################
      function _readURL(input) {
          let _noimage =
              "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                  $('#_img-preview')
                      .attr('src', e.target.result);
              };


              reader.readAsDataURL(input.files[0]);
          } else {
              $("#_img-preview").attr("src", _noimage);
          }
      }
  </script>


  @push('css')
      <link rel="stylesheet" href="{{ asset('back/assets/bundles/summernote/summernote-bs4.css') }}">
  @endpush

  @extends('admin.layouts.app')

  @section('title', 'News')


  @section('content')
      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  @include('admin.components.validationMessage')
                  <div class="card">
                      <div class="card-header">
                          <i class="fas fa-caret-left">
                              <a class="btn btn-dark text-white" href="{{ route('news.index') }}"> Retour à la liste</a>
                          </i>

                          <h4 class="ml-3">Nouvel article</h4>
                      </div>
                      <form class="needs-validation" novalidate="" action="{{ route('news.update', $news_edit['id']) }}"
                          method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Titre</label>
                                  <div class="col-sm-12 col-md-7">
                                      <input value="{{ $news_edit['title'] }}" type="text" name="title"
                                          class="form-control" required>
                                      <div class="invalid-feedback">Champs obligatoire</div>
                                  </div>
                              </div>
                              <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Categorie</label>
                                  <div class="col-sm-12 col-md-7">
                                      <select name="category_news" class="form-control selectric" required>
                                          <option disabled selected value>Selectionner une categorie</option>
                                          @foreach ($categorie_news as $item)
                                              <option value="{{ $item['id'] }}"
                                                  {{ $item['id'] == $news_edit['category_news_id'] ? 'selected' : ' ' }}>
                                                  {{ $item['title'] }} </option>
                                          @endforeach
                                      </select>
                                      <div class="invalid-feedback">Champs obligatoire</div>
                                  </div>
                              </div>


                              <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                  <div class="col-sm-12 col-md-7">

                                      <div>
                                          <img id="img-preview" src="{{ asset('/storage/news/' . $news_edit['image']) }}"
                                              alt="" width="200px">

                                      </div>
                                      <input type="text" name="image_exist" value="{{$news_edit['image']}}" hidden>
                                      <input type="file" id="addFile" name="image" class="form-control"
                                          onchange="readURL(this);" hidden>
                                      <label for="addFile" class="btn btn-light btn-lg border">
                                          <i data-feather="image"></i>
                                          Changer image</label>


                                  </div>
                              </div>



                              <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                  <div class="col-sm-12 col-md-7">
                                      <textarea name="content" class="summernote">
                                        {{ $news_edit['content'] }}
                                      </textarea>
                                  </div>
                              </div>
                              <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                  <div class="col-sm-12 col-md-7">
                                      <button type="submit" class="btn btn-primary">Publier</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>


      @push('js')
          <script src="{{ asset('back/assets/bundles/summernote/summernote-bs4.js') }}"></script>
      @endpush
  @endsection
