@php
    $msg_validation = ' Champs obligatoire';
@endphp
<!-- Modal with form -->
<div class="modal fade" id="modalEdit{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Modification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('niveau.update', $item['id'])}}" class="needs-validation" novalidate="" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>parent</label>
                            <div class="input-group">
                                <select style="width:600px" name="parent_id" class="form-control  ">
                                    <option disabled selected value></option>
                                   @foreach ($niveaux as $niveau)
                                       <option value="{{$niveau['id']}}"  {{ $niveau['id'] == $item['parent_id'] ? 'selected' : '' }}>{{$niveau['title']}} </option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <div class="input-group">
                                <input type="text" value="{{$item['title']}}" class="form-control" placeholder="title" name="title" required>
                                <div class="invalid-feedback">
                                    {{ $msg_validation }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
