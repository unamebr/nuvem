@extends('layouts.app', ['activePage' => 'images', 'titlePage' => __("Avaiable Container")])

@push('js')
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Dockerfile Table</h4>
              <p class="card-category">Create New Dockerfile</p>
            </div>
            <div class="card-body">
              <div class="">
                  @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form action="{{ route('dockerfiles.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('POST') --}}
                    <div class="form-group">
                      <label for="tag">tag</label>
                      <input type="text" class="form-control" id="tag" name="tag">
                    </div>
                    <div class="form-group">
                      <label for="file">File</label>
                      <input type="file"  id="file" name="file">
                    </div>                    
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
