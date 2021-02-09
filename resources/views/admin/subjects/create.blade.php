
@extends('admin.index')

@section('sadrzaj')

<div class="card">
    <h5 class="card-header">Add subject</h5>
        
    <div class="card-body">
    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ects" class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" autocomplete="off">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="selectRole">Select semester</label>
                        <select class="form-control" id="selectSemester" name="selectSemester">
                            
                            <option value="zimski">zimski</option>
                            <option value="ljetni">ljetni</option>
                            
                        </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ects" class="form-label">ECTS</label>
                    <input type="number" min="1" max="10" class="form-control" name="ects" id="ects" autocomplete="off">
                </div>
            </div>
            
        </div>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
    </div>

    
 
</div>
      
@endsection
