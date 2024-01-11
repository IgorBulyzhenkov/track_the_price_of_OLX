@if(session('success'))
    <div class="alert alert-warning alert-dismissible fade show custom_alert_success" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-warning alert-dismissible fade show custom_alert_error" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@error('email')
    <div class="alert alert-warning alert-dismissible fade show custom_alert_error" role="alert">
        {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

@error('password')
    <div class="alert alert-warning alert-dismissible fade show custom_alert_error" role="alert">
        {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror
