@extends('user.index')

@section('sadrzaj')

    <div class="card text-center" style="width: 28rem;">
        <div class="card-body">
            <h5 class="card-title">Subject : {{ $subject->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">ECTS : {{ $subject->ects }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">Semester : {{ $subject->semester }}</h6>
        </div>
    </div>
@endsection
