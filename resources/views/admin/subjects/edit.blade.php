

@extends('admin.index')

@section('sadrzaj')

    <div class="card">
        <div class="card-header">Edit Subject - {{ $subject->name }}</div>

        <div class="card-body">
            <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ects" class="form-label">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" value="{{ $subject->name }}" autocomplete="off">
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
                            <input type="number" min="1" max="10" class="form-control" name="ects" id="ects" value="{{ $subject->ects }}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>
        </div>
    </div>
 
@endsection
