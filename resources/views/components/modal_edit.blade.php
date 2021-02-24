
<!-- Modal -->

<div class="modal" tabindex="-1" role="dialog" id="{{$target}}" style="color:black">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"> <strong>{{$titulo}}</strong> </h5>
          </button>
        </div>
        <form action="{{ route('user.update', ["user"=>$user->id]) }}" method="post">
        <div class="modal-body" id="modalBody">
                @csrf()
                @method('put')
                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="hidden" name="email" value="{{ $user->email }}">
                <input type="hidden" name="phone" value="{{ $user->phone }}">
                                
                <select class="custom-select" name="user_type">                              
                    <option @if($user->user_type == 'basic') selected @endif value="basic">basic</option>
                    {{--  <option @if($conteudo == 'admin') selected @endif value="admin">Admin</option>  --}}
                    <option @if($user->user_type == 'advanced') selected @endif value="advanced">advanced</option>
                </select>
                <div class="form-group">
                  <label for="number_container" class="col-form-label" >Number Containers</label>
                  <input type="number" value="{{$user->containers}}" class="form-control" id="number_container">
                </div>         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" >Salvar</button>
            </div>
        </form>
      </div>
    </div>
  </div>