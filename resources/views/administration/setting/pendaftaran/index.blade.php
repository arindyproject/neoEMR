@extends('layouts.app')

@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@include('administration.menus')
@endpush

@section('content')

<div class="container">
    <div class="row">
        @include('administration.setting.menu')

        <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-laptop-medical"></i> Setting Pendaftaran
                    </h3>
                </div>

                <div class="card-body">
                    <form action="" method="post" >
                        @csrf
                        <div class="form-group row">
                            <label for="form_new_pasien" class="col-sm-12 col-form-label">Maksimal Batas Pendaftaran (hari)</label>
                            <div class="col-sm-12">
                                <input type="number" min="1" name="max_day_pendaftaran" class="form-control" value="{{$data['max_day_pendaftaran']}}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block bg-{{\App\Models\Config::get()['navbar_variants']}}">Simpan</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>




@include('administration.m_float')
@endsection
