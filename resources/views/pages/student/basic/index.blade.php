@extends('layouts.app', ['activePage' => 'basic', 'titlePage' => __("Basic")])

@push('js')
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">      
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Templates Table</h4>
                <p class="card-category">List of Instace Container Images</p>
            </div>
            <div class="Container" >              
              <div class="row">
                @foreach($images as $image)

                  <div class="col-sm-6">
                    <div class="card text-white bg-info mb-3 ml-3" style="max-width: 25rem;">
                      <div class="card-body">
                        <h5 class="card-title"> 
                        @if($image['RepoTags'] == null) 
                          @php $pieces = explode("@", $image['RepoDigests'][0]) @endphp
                          {{ $pieces[0] }}  
                        @else 
                          {{ $image['RepoTags'][0] }}
                        @endif </h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <form action="{{ route('aluno.salvar.imagem') }}" method="post">
                          @csrf
                          <input type="hidden" name="repoTags" @if($image['RepoTags'] == null) 
                          @php $pieces = explode('@', $image['RepoDigests'][0]) @endphp
                          value="{{ $pieces[0] }}"  
                        @else 
                          value="{{ $image['RepoTags'][0] }}"
                        @endif >
                          <button type="submit" class="btn btn-primary">
                            Salvar imagem
                          </button>
                        </form>
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

@endsection
@push('js')
<script>
  
</script>
@endpush
