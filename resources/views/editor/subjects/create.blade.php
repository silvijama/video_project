
@extends('editor.index')

@section('sadrzaj')

<div class="card text-center">
    <h5 class="card-header">Add subject</h5>
        
    <div class="card-body">
    <form action="{{ route('editor.subjects.store') }}" method="POST">
        @csrf
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="selectRole">Select subject</label>
                        <select class="form-control" id="selectSubject" name="selectSubject">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>    
        </div>
    </form>
    </div>
</div>
      
@endsection
