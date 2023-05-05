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
                        <i class="fab fa-wpforms"></i> Mode Form Pengisian
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.setting.form.mode') }}" method="post" >
                        @csrf
                        <div class="form-group row">
                            <label for="form_new_pasien" class="col-sm-4 col-form-label">Form New Patient</label>
                            <div class="col-sm-8">
                                <select name="form_new_pasien" id="form_patient" class="form-control">
                                    <option {{ $data['form_new_pasien']['mode'] == 'simple' ? 'selected' : '' }} value="simple">Simple</option>
                                    <option {{ $data['form_new_pasien']['mode'] == 'medium' ? 'selected' : '' }} value="medium">Medium</option>
                                    <option {{ $data['form_new_pasien']['mode'] == 'advance' ? 'selected' : '' }} value="advance">Advance</option>
                                </select>
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
