@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('admin.index') }}">O nama</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('admin.users.index') }}">Upravljanje korisnicima</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('admin.subjects.index') }}">Predmeti</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('admin.api_subjects.index') }}">Dodaj predmete</a>
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            @include('partials.alerts')
            @yield('sadrzaj')

            <div class="container">
          <br>
          <p> Fakultet prirodoslovno-matematičkih i odgojnih znanosti u Mostaru</p> <br>
          <p>Adresa: Mostar 88000 </p><br>
          <p>Kontakt: 036 355-455 </p><br>
          <p>Email: eureka@fpmoz.sum.ba </p>

      </div>

        </div>
    </div>
</div>
@endsection