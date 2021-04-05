@extends('layouts.app', ['activePage' => 'advanced', 'titlePage' => __("Advanced")])

@push('js')
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">      
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Containers</h4>
                <p class="card-category">Manager Containers</p>
            </div>
            <div class="Container" >              
                <div class="row">
                  <div class="col-md-4">
                    
                    <div class="dropdown">
                      <a class="btn btn-sucess dropdown-toggle ml-3" style="width: 28em" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <i class="fas fa-plus center"></i> &nbsp; Container 
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                    
                        @foreach($images as $image)
                          {!! Form::open(['route' => 'aluno.advanced.container.store', 'method' => 'post']) !!}
                          <input type="hidden" value="{{ $image->id }}" name='image_id'>
                          <input type="hidden" value="{{ Auth()->user()->id }}" name='user_id'>                    
                          <input type="hidden" value="{{ now() }}" name='nickname'> 
                          <input type="hidden" value=0 name='Memory'> 
                          <input type="hidden" value="{{ null }}" name='envVariables'> 
                          <input type="hidden" value="{{ null }}" name='IPAddress'> 
                                            
                          <button type="submit" class="btn btn-sucess btn-link">
                              <a class="dropdown-item" >{{ $image->name }}</a>
                          </button>

                          {!! Form::close() !!}
                            
                        @endforeach                    
                      </div>
                    </div>
                    @foreach ($params['mycontainers'] as $container)
                      <div class="accordion" id="accordionExample{{ $container->id }}" style="width: 25em;">
                            <h5 class="mb-0 ml-3">
                              <button class="btn btn-link btn-block text-left  text-white bg-info" type="button" data-toggle="collapse" data-target="#collapseOne{{ $container->id }}" aria-expanded="true" aria-controls="collapseOne">
                                <div class="row">
                                  <div class="col-md-10">
                                    <a href="{{ route('aluno.advanced.terminal', $container->docker_id) }}"  >
                                 {{ $container->nickname }}</a>
                                  </div>
                                  <div class="col-md-2">
                                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
</svg>
                                  </div>                                  
                                </div>
                              </button>

                            </h5>
                          <div id="collapseOne{{ $container->id }}" @if($loop->first) class="collapse show" @else class="collapse" @endif aria-labelledby="headingOne" data-parent="#accordionExample{{ $container->id }}">
                            <div class="card-body">
                                      @if($container->dataHora_finalizado)
                                      <a href="{{ route('instance.playStop', $container->docker_id) }}" class="btn btn-link btn-warning btn-sm"
                                          data-original-title="" title="Play/Pause the container.">
                                          <i class=" material-icons">play_circle_outline</i>
                                      </a>
                                      @else
                                      <a href="{{ route('instance.playStop', $container->docker_id) }}" class="btn btn-link btn-warning btn-sm"
                                          data-original-title="" title="Play/Pause the container.">
                                          <i class=" material-icons">pause_circle_outline</i>
                                      </a>
                                      @endif
                                      <a href="{{ route('aluno.advanced.terminal', $container->docker_id) }}" class="btn btn-info btn-link btn-sm"
                                           title="Open terminal.">
                                          <i class="fas fa-terminal"></i>
                                      </a>
                                      
                                      <a href="{{$params['dockerHost']}}/containers/{{$container->docker_id}}/logs?timestamps=1&stdout=1&stderr=1"
                                          class="btn btn-info btn-link btn-sm" target="_black" title="Logs.">
                                          <i class="fas fa-file-alt"></i>
                                      </a>
                                      <a href="{{ route('containers.show' , [$container->docker_id]) }}" class="btn btn-link btn-sm"
                                          title="Details.">
                                          <i class="material-icons">visibility</i>
                                      </a>
                                      <a href="{{ route('containers.edit' , [$container->docker_id]) }}" class="btn btn-warning btn-link btn-sm"
                                          title="Edit nickname.">
                                          <i class="material-icons">edit</i>
                                      </a>
                                      <div style="width: 5em;">
                                        {!! Form::open(['route' => ['containers.destroy', $container->docker_id], 'method' => 'delete']) !!}
                                        <button type="submit" class="btn btn-danger btn-link btn-sm" title="Detele the container."
                                            onclick="return confirm('Are you sure?')" type="submit">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        {!! Form::close() !!}                                         
                                      </div>
                                      
                                  
                              
                            </div>
                          </div>
                                                                                  
                      </div>
                  @endforeach
     
                  </div>
                  <div class="col-md-8 ">

                    <div class="card-body ml-3">
                      <p> <strong>Portas abertas:</strong> </p>
                          @foreach ($params['info'] as $element)
                            @forelse ($element['Ports'] as $port) 
                              @if(isset($port['IP']))
                              <a class="btn btn-info" href="{{ 'http://'. $port['IP'] .':'. $port['PublicPort'] }}" target="_blank">{{ $port['PublicPort'] }}</a>
                              
                              @endif
                            @empty
                                No ports
                            @endforelse                            
                          @endforeach
                      
                      <div id="terminal"></div>
                    </div>


                  </div>
                  <div class="col-md-4">
                      
                  </div>              
              </div>
            </div>
      </div>
    </div>
  </div>
</div>    


@endsection
@push('js')
  <script>
    $('.dropdown-toggle').dropdown();
  var socketParams = <?= $socketParams; ?>;
  var host = socketParams['dockerHost'];
  var containerId = socketParams['container_id'];
  console.log(containerId + 'id container')
  var endpoint = "/attach/ws?logs=0&stream=1&stdin=1&stdout=1&stderr=1";

  const url = host+'/containers/'+containerId+endpoint;

  console.log('url => ' + url);
  const webSocket = new WebSocket(url);

  const attachAddon = new AttachAddon.AttachAddon(webSocket);
  const fitAddon = new FitAddon.FitAddon();
  const webLinksAddon = new WebLinksAddon.WebLinksAddon();
  const term = new Terminal();

  term.loadAddon(attachAddon);
  term.loadAddon(fitAddon);
  term.loadAddon(webLinksAddon);

  term.open(document.getElementById('terminal'));
  fitAddon.fit();
  term.reset();
  </script>
@endpush
