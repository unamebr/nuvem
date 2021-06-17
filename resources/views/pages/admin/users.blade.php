@extends('layouts.app', ['activePage' => 'admin-area-requests', 'titlePage' => __("Admin Area")])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @if(session('message'))
            <div class="col-md-12" style="margin-top: 5px;">
                <div class="alert alert-success">
                    <p>{{session('message')}}</p>
                </div>
            </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Users List</h4>
                        <p class="card-category">List of registered users</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('pages/tables/users_table', ['users' => $users])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
