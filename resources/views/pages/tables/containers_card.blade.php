<div class="container">
  <div class="row row-cols-1 row-cols-md-2">

    @foreach ($mycontainers as $container)
      <div class="col-12 mb-4">
        <div class="card" style="width: 58rem;">      
          <div class="card-body">
            <h5 class="card-title">{{ $container['Image'] }}</h5>
            <p class="card-text">
              {{ $container['Labels']['maintainer'] ?? "" }}
              <div class="row">
                <div class="col-md-2">
                  <h6 class="mt-3">{{$container['State']}}</h6>
                  
                  @if($container['State'] != "running")
                  {{-- <a href="{{ route('container.playStop', $container['Id']) }}" class="btn btn-link btn-success"
                      data-original-title="" title="Play/Pause the container.">
                      <i class=" material-icons">play_circle_outline</i>
                  </a> --}}
                  @else
                  {{-- <a href="{{ route('container.playStop', $container['Id']) }}" class="btn btn-link btn-warning"
                      data-original-title="" title="Play/Pause the container.">
                      <i class=" material-icons">pause_circle_outline</i>
                  </a> --}}
                  @endif
                </div>
                <div class="col-md-2">
                  {!! Form::open(['route' => ['aluno.basic.container.destroy', $container['Id']], 'method' => 'POST']) !!}
                  <button type="submit" class="btn btn-danger btn-link" title="Detele the container."
                      onclick="return confirm('Are you sure?')" type="submit">
                      <i class="material-icons">delete</i>
                  </button>
                  {!! Form::close() !!}             
                </div>
                <div class="col-md-3">
                  @forelse ($container['Ports'] as $port)
                    <p>
                        <a class="btn btn-info" href="{{ 'http://'. $port['IP'] .':'. $port['PublicPort'].'/blog' }}" target="_blank">Acessar link</a>
                    </p>
                  @empty
                    Nenhum link foi criado.
                  @endforelse
                </div>
                
                <div class="col-md-5"></div>
              </div>
                
                {{-- {{dd($container)}} --}}
                  
                
                                          
                
            </p>
          </div>
        </div>
      </div>
    @endforeach
    </div>
</div>



{{-- <table class='table'>
    <thead>
        <th>#</th>
        <th>Container Id- Card</th>
        <th>Nickname</th>
        @if($isAdminArea ?? false)
        <th>User Email</th>
        @endif
        <th>Iniciated at</th>
        <th>Running</th>
        <th>Port</th>
        <th>Options</th>
    </thead>
    <tbody>
        @foreach ($mycontainers as $container)
        <tr>
            <td><i class="fas fa-server"></i></td>
            <td>{{ substr($container->docker_id, 0, 12) }}</td>
            <td>{{ $container->nickname }}</td>
            @if($isAdminArea)
            <td>{{ $container->user()->email }}</td>
            @endif
            <td>{{ $container->dataHora_instanciado }}</td>
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
                <div class='row'>
                    @if($container->dataHora_finalizado)
                    <a href="{{ route('instance.playStop', $container->docker_id) }}" class="btn btn-link btn-success"
                        data-original-title="" title="Play/Pause the container.">
                        <i class=" material-icons">play_circle_outline</i>
                    </a>
                    @else
                    <a href="{{ route('instance.playStop', $container->docker_id) }}" class="btn btn-link btn-warning"
                        data-original-title="" title="Play/Pause the container.">
                        <i class=" material-icons">pause_circle_outline</i>
                    </a>
                    @endif
                    <a href="{{ route('container.terminalTab', $container->docker_id) }}" class="btn btn-info btn-link"
                        target="_black" title="Open terminal.">
                        <i class="fas fa-terminal"></i>
                    </a>
                    <a href="{{$dockerHost}}/containers/{{$container->docker_id}}/export" class="btn btn-info btn-link"
                        title="Download.">
                        <i class=" material-icons">get_app</i>
                    </a>
                    <a href="{{$dockerHost}}/containers/{{$container->docker_id}}/logs?timestamps=1&stdout=1&stderr=1"
                        class="btn btn-info btn-link" target="_black" title="Logs.">
                        <i class="fas fa-file-alt"></i>
                    </a>
                    <a href="{{ route('containers.show' , [$container->docker_id]) }}" class="btn btn-link"
                        title="Details.">
                        <i class="material-icons">visibility</i>
                    </a>
                    <a href="{{ route('containers.edit' , [$container->docker_id]) }}" class="btn btn-warning btn-link"
                        title="Edit nickname.">
                        <i class="material-icons">edit</i>
                    </a>
                    {!! Form::open(['route' => ['containers.destroy', $container->docker_id], 'method' => 'delete']) !!}
                    <button type="submit" class="btn btn-danger btn-link" title="Detele the container."
                        onclick="return confirm('Are you sure?')" type="submit">
                        <i class="material-icons">delete</i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $mycontainers->links() !!} --}}
