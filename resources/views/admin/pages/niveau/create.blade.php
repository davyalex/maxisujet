@php
    $msg_validation = ' Champs obligatoire';
@endphp





<!-- Modal with form -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Ajouter un Niveau</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('niveau.store')}}" class="needs-validation" novalidate="" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group {{count($niveaux) == 0 ? 'd-none' : ''}}">
                            <label>parent</label>
                            <div class="input-group">
                                <select style="width:600px" name="parent_id" class="form-control">
                                    <option></option>
                                   @foreach ($niveaux as $item) 
                                       <option value="{{$item['id']}}">{{$item['title']}} </option>
                                   @endforeach
                                </select>
                            </div>
                        </div>   

                        <div class="form-group">
                            <label>Title</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="title" name="title" required>
                                <div class="invalid-feedback">
                                    {{ $msg_validation }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





