
<!-- Modal -->
{{-- @if(session('error'))
<div class="col-md-12" style="margin-top: 5px;">
    <div class="alert alert-success">
        <p>{{session('error')}}</p>
    </div>
</div>
@endif --}}
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
                    <option @if($user->user_type == 'advanced') selected @endif value="advanced">advanced</option>
                </select>
                <div class="form-group">
                    <label for="number_container" >Number Containers</label>
                    <input type="number" value="{{$user->containers}}" class="form-control" id="number_container">
                </div>
                <div class="form-check ">

                    <label class="form-check-label text-body" for="exampleRadios{{$user->id}}">{{ __('Autorizar acesso.') }}
                        <input class="form-check-input" type="checkbox" name="acess" id="exampleRadios{{$user->id}}" value="true" @if($user->acess) checked @endif>
                        <div class="form-check-sign mr-2" style="margin-top: 13px;">
                            <div class="check"></div>
                        </div>
                    </label>

                </div>
                {{-- <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" >Salvar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
