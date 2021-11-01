<div class="container">
  
  <div class="row row-cols-1 row-cols-md-2 ">
    <div class="col-6">
      Imagem
    </div>
    <div class="col-4">
      Imagem
    </div>
    <div class="col-2">
      opções
    </div>
  </div>
  @foreach ($mycontainers as $key => $container)
    <div class="row row-cols-1 row-cols-md-2 ">
      <div class="col-2 ">
        <img src="{{ asset($container->image->photo ) }}" class="img-thumbnail"  alt="">
        {{ $container->image->name }}
      </div>
      <div class="col-8 ">
        {{ $container->status }}
      </div>
      <div class="col-2 ">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cogs"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
        
        {{--  --}}
      </div>
    </div>
  @endforeach
</div>

{{-- <tr>
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
</tr> --}}


{{-- <div class="card" style="width: 15rem;">
  <img src="{{asset($container->image()->photo)}}" style="width: 80%;height:40%"  class="rounded ml-3 mt-4" alt="...">
  <div class="card-body">

    <h5 class="card-title">{{ $container->image()->name }}</h5>
  </div>

  <ul class="list-group list-group-flush">

    <li class="list-group-item">
        <strong>{{ ucfirst($container['State']) }} </strong>
        <div class="spinner-grow text-success" role="status">
          <span class="sr-only ">Loading...</span>
        </div>
    </li>


    <li class="list-group-item">
      @forelse ($info[$key]['Ports'] as $port)
        <p>
            <a class="btn btn-info" href="{{ 'http://'. $port['IP'] .':'. $port['PublicPort'].'/'.$user->user_name }}" target="_blank">Acessar link</a>
        </p>
      @empty
        Nenhum link foi criado.
      @endforelse
    </li>
  </ul>
  <div class="card-body">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

      @if($info[$key]['State'] != "running")
        <div class="btn-group" role="group" aria-label="Third group">
          <a href="{{ route('container.playStop', $info[$key]['Id']) }}" class="btn btn-link btn-success"
              data-original-title="" title="Play/Pause the container.">
              Iniciar <i class="far fa-play-circle"></i>
          </a>
        </div>
      @else
        <div class="btn-group" role="group" aria-label="Third group">
          <a href="{{ route('container.playStop', $info[$key]['Id']) }}" class="btn btn-link btn-warning"
              data-original-title="" title="Play/Pause the container.">

              Pausar <i class="fas fa-pause-circle"></i>
          </a>
        </div>
      @endif
      <div class="btn-group" role="group" aria-label="Third group">
        {!! Form::open(['route' => ['aluno.basic.container.destroy', $info[$key]['Id']], 'method' => 'POST']) !!}
        <button type="submit" class="btn btn-danger btn-link" title="Detele the container."
            onclick="return confirm('Are you sure?')" type="submit">
            Apagar <i class="fas fa-trash-alt"></i>
        </button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> --}}