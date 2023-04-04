@extends('layouts.app')
@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <i class="fas fa-unlock"></i> <b>Admin</b>
    </a>
</li>
@endpush
@section('content')
<div class="">
    <div class="row ">

        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 d-none d-sm-inline-block">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <i class="fas fa-bars"></i>
                        <b>MENU ADMIN</b>
                    </h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @include('admin.menus')
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-xl-10 col-lg-10 col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <i class="fab fa-wpforms"></i>
                        -
                        FORM Setting MODE
                    </h3>


                </div>
                <div class="card-body ">
                    <form action="{{ route('admin.setting.form.mode') }}" method="post" >
                        @csrf
                        <div class="form-group row">
                            <label for="form_new_pasien" class="col-sm-2 col-form-label">Form New Patient</label>
                            <div class="col-sm-10">
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
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>
@include('admin.m_float')
@include('admin.scripts')
@endsection
