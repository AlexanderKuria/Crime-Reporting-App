@if (session('error'))
    <div class="container">
        <div class="alert alert-danger">{{ session('error') }}</div>
    </div>
@endif
@if (session('message'))
    <div class="container">
        <div class="alert alert-info">{{ session('message') }}</div>
    </div>
@endif
@if (session('info'))
    <div class="container">
        <div class="alert alert-info">{{ session('info') }}</div>
    </div>
@endif
