
@extends('editor.index')

@section('sadrzaj')

    <div class="card text-center">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">Svi predmeti</h4>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('editor.subjects.create') }}" class="btn btn-outline-primary">Add subject</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-center mt-3">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">ECTS</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
            <tbody>
            
                {{--@foreach($user->subjects as $subject)--}}
                {{--@foreach($subjects as $subject) --}}
                @foreach($user->subjects as $subject)
                <tr>
                    <th scope="row">{{ $subject->id }}</th>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->semester }}</td>
                    <td>{{ $subject->ects }}</td>
                    <td>
                    <form action="{{ route('editor.subjects.destroy', $subject->id) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
      
@endsection
