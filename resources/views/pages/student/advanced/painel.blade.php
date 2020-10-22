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
                    <table class='table ml-3'>
                        <thead>
                            <th>Nickname</th>
                            <th>Running</th>
                            <th>Options</th>
                        </thead>
                        <tbody>
                            @foreach ($params['mycontainers'] as $container)
                            
                            <tr>
                              
                                <td>
                                  <a href="{{ route('aluno.advanced.terminal', $container->docker_id) }}" class="btn btn-info btn-link">
                                    {{ $container->nickname }}
                                  </a>
                                </td>
                                <td class="td-actions text-center">
                                    @if ($container->dataHora_finalizado)
                                    <a href="#" class="btn btn-danger" data-original-title="" title="">
                                        <i class=" material-icons">stop</i>
                                    </a>
                                    @else
                                    <div class="spinner-grow text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    @endif
                                </td>
                                <td class="td-actions text-right">
                                    
                                        
                                        {!! Form::open(['route' => ['containers.destroy', $container->docker_id], 'method' => 'delete']) !!}
                                        <button type="submit" class="btn btn-danger btn-link" title="Detele the container."
                                            onclick="return confirm('Are you sure?')" type="submit">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        {!! Form::close() !!}
                                    
                                </td>
                              
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
     
                  </div>
                  <div class="col-md-8 ">

                    <div class="card-body ml-3">
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
