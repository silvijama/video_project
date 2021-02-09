@extends('user.index')

@section('sadrzaj')


    <div class="row">
        
    </div>
    
      {{--@foreach($user->materials as $material) --}}
      
      @foreach($user->subjects as $subject)
      <ul>
        <h2>{{ $subject->name }}</h2>
      
        @foreach($subject->materials as $material)
          <li>{{ $material->name }} <a href="{{ route('user.materials.show', $material->id)  }}">Show</a> </li>
      
        @endforeach
        <hr>
        </ul>
      @endforeach
      

    <!--<img src="{{ url('storage/france.jpg') }}" alt="" height="1500px" width="2500px" />-->
@endsection
