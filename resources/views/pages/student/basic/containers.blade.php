@extends('layouts.app', ['activePage' => 'basic', 'titlePage' => __("My Containers")])

@push('js')
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">      
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Containers Table</h4>
                <p class="card-category">List of Instace Container Images</p>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @include('pages/tables/containers_card', ['mycontainers' => $mycontainers,'user' => $user, 'image_names' => $image_names , 'isAdminArea' => false])
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