@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">

        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-bars"></i>
                        <b>USER SETTING </b>
                    </h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @include('profile.menus')
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-key"></i>
                        -
                        Ganti Password
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{route('profile.ganti_password_submit', $data->id)}}" method="post">
                        @csrf
                        @method('PUT')

                        @if(Auth::user()->id == $data->id)
                        <div class="form-group row">
                            <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input name="old_password" type="password" class="form-control" id="old_password"
                                    placeholder="Password Lama" required>
                                @if ($errors->has('old_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder="Password Baru" required>
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
                                    placeholder="Retype New password" required autocomplete="new-password">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block bg-{{$bg}}">Simpan</button>

                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>
@endsection
