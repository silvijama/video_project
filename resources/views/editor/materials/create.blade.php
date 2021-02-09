@extends('editor.index')

@section('sadrzaj')


<form action="{{ route('editor.materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="subjectName" id="name" autocomplete="off" placeholder="Enter name" value="{{ old('subjectName') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" autocomplete="off" placeholder="Enter description" value="{{ old('description') }}">
        </div>

        <div class="form-group">
        <label for="subjectSelect">Choose subject</label>
            <select class="form-control" name="subjectSelect" id="subjectSelect">
            @foreach ($user->subjects as $subject)
                <option value="{{ $subject->id }}"> {{ $subject->name   }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="file" multiple>Example file input</label>
            <input type="file" class="form-control-file" name="file[]" id="file">
        </div>

        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>

    @endsection