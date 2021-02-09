@extends('editor.index')

@section('sadrzaj')


<div class="card">
    <h5 class="card-header">Edit material</h5>
        
    <div class="card-body">

    <form action="{{ route('editor.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

            @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="subjectName" id="name" autocomplete="off" placeholder="Enter name" value="{{ $material->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="subjectSelect">Choose subject</label>
                        <select class="form-control" name="subjectSelect" id="subjectSelect">
                        @foreach ($user->subjects as $subject)
                            <option value="{{ $subject->id }}"> {{ $subject->name   }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" id="description" autocomplete="off" placeholder="Enter description" value="{{ $material->description }}">
            </div>

            

            <div class="form-group">
                <label for="file" multiple>Example file input</label>
                <input type="file" class="form-control-file" name="file[]" id="file">
            </div>

            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>
</div>
    @endsection