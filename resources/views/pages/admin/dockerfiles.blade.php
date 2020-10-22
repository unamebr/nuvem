@extends('layouts.app', ['activePage' => 'dockerfiles', 'titlePage' => __("Admin Area")])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Dockerfile List</h4>
                        <p class="card-category">List of registered machines</p>
                        <a href="{{ route('dockerfiles.create') }}" class="btn btn-success" >
                            Adicionar Dockerfile
                        </a>                                          
                    </div>
                    <div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('pages/tables/dockerfiles_table', ['dockerfiles' => $dockerfiles])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection