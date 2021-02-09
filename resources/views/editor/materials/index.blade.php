@extends('editor.index')

@section('sadrzaj')

<div class="card text-center">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">Svi materijali</h4>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('editor.materials.create') }}" class="btn btn-outline-primary">Add material</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
      <div class="card-body">
      @foreach($user->subjects as $subject)
        <ul class="list-group">
        <h2>{{ $subject->name }}</h2>

            @foreach($subject->materials as $material)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <p style="width:100%">{{ $material->name }}</p>
                
                <a href="{{ route('editor.materials.edit', $material->id) }}">
                    <button type="button" class="btn btn-outline-primary btn-sm mr-5">Edit</button>
                </a>
                <a href="{{-- route('admin.users.edit',$user->id) --}}">
                    <button type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                </a>
              </li>
            @endforeach
        </ul>
        @endforeach
      </div>
    </div>


    <!--<img src="{{ url('storage/france.jpg') }}" alt="" height="1500px" width="2500px" />-->
@endsection
