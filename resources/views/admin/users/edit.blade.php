
@extends('admin.index')

@section('sadrzaj')

    <div class="card">
        <div class="card-header">Edit User - {{ $user->name }}</div>

        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                
                <div class="form-group">
                    <label for="selectRole">Select role</label>
                    <select class="form-control" id="selectRole" name="selectRole">
                    @foreach($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-primary">
                    Update
                </button>
            </form>
        </div>
    </div>
 
@endsection
