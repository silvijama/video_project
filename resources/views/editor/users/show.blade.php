@extends('editor.index')

@section('sadrzaj')

    <div class="card text-center" style="width: 28rem;">
        <div class="card-body">
            <h5 class="card-title">Name : {{ $user->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Email : {{ $user->email }}</h6>
            
        </div>
    </div>
@endsection
