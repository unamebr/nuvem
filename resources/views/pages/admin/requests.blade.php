@extends('layouts.app', ['activePage' => 'admin-area-requests', 'titlePage' => __("Admin Area")])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-stats">
                    <div class="card-header card-header-info">

                        <h3 class="card-title">
                            <i class="material-icons">people</i>
                            Users List
                        </h3>
                        <p class="card-category"></p>
                    </div>
                    <div class="" id="users">
                        @include('pages/tables/users_table', ['users' => $users])
                    </div>
                    <div class="card-footer">
                        <p class="card-category">Registered this Mouth: {{ $registeredMonth }}</p>
                        <p class="card-category">Registered Today: {{ $registeredToday }}</p>
                        <p class="card-category">Total: {{ $users->count() }}</p>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('js')
<script>
    var
</script>
<script>
$(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    md.initDashboardPageCharts();
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

