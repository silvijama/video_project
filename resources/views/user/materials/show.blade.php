@extends('user.index')

@section('sadrzaj')

    <h2>{{ $material->name }}</h2>      

    <div class="card" style="width: 48rem;">

    @if ($material->file)
        <iframe src="{{ url('storage/', $material->file) }}" width="100%" height="400"></iframe>
    @else
        <h3 style="text-align:center">Nema dostupnih video materijala</h3> 
    @endif
    
        <!--<img src="{{ url('storage/france.jpg') }}" alt=""   />-->
        <div class="card-body">
            <p class="card-text">{{ $material->description }}.</p>
        </div>
    </div>
@endsection
