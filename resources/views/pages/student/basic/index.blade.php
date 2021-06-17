@extends('layouts.app', ['activePage' => 'basic', 'titlePage' => __("Basic")])

@push('js')
@endpush

@section('content')
    <div class="content">
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

      <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title "> <strong> Imagens Docker</strong></h3>
                    <p class="card-category"> <strong>Lista de imagens disponíveis</strong>  </p>
                </div>
                <div class="Container ml-3 mr-3 " >
                  @foreach($images as $image)
                    <div class="card mb-3  " style="max-width: 90%;">
                      <div class="row g-0">
                        <div class="col-md-5">
                          <div class="text-center m-auto ">
                            <img class=" mt-4 ml-2" src="{{asset($image->photo)}}" style="width: 95%;height:95%"  class="rounded" alt="...">
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="card-body">
                            <h5 class="card-title font-weight-bolder">{{ $image->name }}</h5>
                            <p class=" card-text " >
                              {{ $image->description }}
                            </p>
                            {{-- <p class="card-text d-inline-block text-truncate">{{ $image->description }}</p> --}}
                            <p class="card-text">
                              Para mais informações acesse: <br>
                              <a href="{{ $image->website }}">{{ $image->website }}</a>
                            </p>
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
                    </div>
                  @endforeach
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

    });

</script>
@endpush
