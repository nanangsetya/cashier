@if(Session::has('failed'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ Session::get('failed') }}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('success') }}
    </div>
@endif