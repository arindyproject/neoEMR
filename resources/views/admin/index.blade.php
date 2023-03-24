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
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}} ">
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
                        <i class="fas fa-user-plus"></i>
                        -
                        Tambah User Baru
                    </h3>


                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">User Aktif</span>
                                    <span class="info-box-number"><h5><b>{{$data->where('status', 1)->where('level', 0)->count()}}</b></h5></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-user-lock"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Admin</span>
                                    <span class="info-box-number"><h5><b>{{$admin->count()}}</b></h5></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger">
                                    <i class="fas fa-user-lock"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Non Aktif</span>
                                    <span class="info-box-number"><h5><b>{{$data->where('status', 0)->count()}}</b></h5></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fas fa-users"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total User</span>
                                    <span class="info-box-number"><h5><b>{{$data->count()}}</b></h5></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                    <form action="{{ route('admin.add_user') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nama Lengkap"
                                    required value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input name="username" type="text" class="form-control" id="username"
                                    placeholder="Username" required value="{{old('username')}}">
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input name="email" type="email" class="form-control" id="email" placeholder="Email"
                                    required value="{{old('email')}}">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder="Password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Re-password</label>
                            <div class="col-sm-10">
                                <input name="password_confirmation" type="password" class="form-control" id="password"
                                    placeholder="Retype password" required autocomplete="new-password">
                            </div>


                        </div>

                       

                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                </select>
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" multiple="multiple" name="roles[]" data-dropdown-css-class="select2-purple" data-placeholder="Select a Roles" style="width: 100%;">
                                    @foreach ($roles as $item)
                                        <option >{{$item->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('roles'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('roles') }}</strong>
                                </span>
                                @endif
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


@push('styles')
    <!-- Select2-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
     
@endpush

@include('admin.m_float')
@include('admin.scripts')
@push('scripts')

<script>
    $(function () {
        $('.select2').select2();
    });
</script>
@endpush

@endsection
