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
                <form action="{{ route('user.update', $item['id']) }}" class="needs-validation" novalidate="" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>userName</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="davyalex" name="username" value="{{$item['username']}}"
                                required>
                            <div class="invalid-feedback">
                                {{ $msg_validation }}
                            </div>
                        </div>

                        <label>Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="support@gmail.com"
                                name="email" value="{{$item['email']}}" required>
                            <div class="invalid-feedback">
                                {{ $msg_validation }}
                            </div>
                        </div>

                        <label>Role</label>
                      
                        <div class="input-group">
                            <select style="width:600px" class="form-control" name="role" id="" required>
                                <option desabled value selected>Selectionner</option>
                                @foreach ($roles as $data)
                                    <option value="{{ $data['name']}}" {{$item['roles'][0]['name']==$data['name'] ? 'selected' : ''}}> {{ $data['name'] }} </option>
                                @endforeach
                            </select>
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
