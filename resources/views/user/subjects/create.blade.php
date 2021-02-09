
@extends('user.index')

@section('sadrzaj')

<div class="card text-center">
    <h5 class="card-header">Add subject</h5>
        
    <div class="card-body">
    <form action="{{ route('user.subjects.store') }}" method="POST">
        @csrf
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
    
        <div class="form-group" style="width:50%; margin:auto">
            <label for="selectRole">Select subject</label>
            <select class="form-control" id="selectSubject" name="selectSubject">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline-primary mt-2">Submit</button>
                
    </form>
    </div>
</div>
      
@endsection
