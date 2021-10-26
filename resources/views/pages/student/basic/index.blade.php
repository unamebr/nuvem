@extends('layouts.app', ['activePage' => 'basic', 'titlePage' => __("Basic")])

@push('js')
@endpush

@section('content')
    <div class="content" style="background-color: #161920;">
      <div class="container-fluid">
      {{-- mensagem de confimação --}}
      @if(session('success'))
      <div class="col-md-12" style="margin-top: 5px;">
          <div class="alert alert-success">
              <p>{{session('success')}}</p>
          </div>
      </div>
      @endif
      @if(session('error'))
      <div class="col-md-12" style="margin-top: 5px;">
          <div class="alert alert-danger">
              <p>{{session('error')}}</p>
          </div>
      </div>
      @endif

      <div class="col-md-12" >
            <div class="card " style="background-color: #1d212c">
                <div class="card-header ">
                    <h3 class="card-title text-white"> <strong> Imagens Docker</strong></h3>
                    <hr class="line">
                </div>
                <div class="Container ml-3 mr-3 " >
                  <div class="row">
                    <div class="col-4">
                      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($images as $image)
                          <a class="nav-link @if ($loop->first) active @endif " id="v-pills-{{ $image->id }}-tab" data-toggle="pill" href="#v-pills-{{ $image->id }}" role="tab" aria-controls="v-pills-{{ $image->id }}" aria-selected="true">
                            <img class=" " src="{{asset($image->photo)}}" style="width: 100%;height:100%"  class="rounded" alt="...">
                            
                          </a>
                        @endforeach
                      </div>
                    </div>
                    <div class="col-8 item-dark">
                      <div class="tab-content " id="v-pills-tabContent">
                        @foreach($images as $image)
                          <div class="tab-pane  fade @if ($loop->first) show active @endif " id="v-pills-{{ $image->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $image->id }}-tab">
                            <div class="card item-dark">
                              <img class="rounded mx-auto d-block mt-3" src="{{asset($image->photo)}}" style="width: 20rem;height:15rem"  class="rounded" alt="...">
                              <div class="card-body">
                                <h5 class="card-title">{{ $image->name }}</h5>
                                {{ $image->description }}
                                <p class="card-text">
                                  {!! Form::open(['route' => 'aluno.basic.container.store', 'method' => 'post']) !!}
                                    <input type="hidden" value="{{ $image->id }}" name='image_id'>
                                    <input type="hidden" value="{{ Auth()->user()->id }}" name='user_id'>
                                    <input type="hidden" value="{{ now() }}" name='nickname'>
                                    <input type="hidden" value=0 name='Memory'>
                                    <input type="hidden" value="{{ null }}" name='envVariables'>
                                    <input type="hidden" value="{{ null }}" name='IPAddress'>
    
                                    <button id="buttonExecutar" type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="O botão Executar irá criar um container dessa imagem.">
                                        Executar
                                    </button>
    
                                    <div id="spin" class="spinner-border" style="display: none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
    
                                  {!! Form::close() !!}
                                </p>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>


      </div>
    </div>
  </div>

@endsection
@push('js')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script>
    $(document).ready(function(){

        $("#buttonExecutar").click(function(){
            $("#spin").show();
            $("#buttonExecutar").hide();
        });

        $('#v-pills-tab a').on('click', function (event) {
          event.preventDefault()
        $(this).tab('show')
})


    });

</script>
@endpush
