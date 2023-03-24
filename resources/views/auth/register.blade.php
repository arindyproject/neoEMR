<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Config::get()['name'] }} | Registration</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icon') .'/'. \App\Models\Config::get()['icon_mini'] }}">

    @include('layouts.styles')
</head>

<body class="hold-transition register-page {{ \App\Models\Config::get()['dark_mode'] ? 'dark-mode' : '' }}">
    <div class="register-box">
        <div class="register-logo">
            <img src="{{ asset('images/icon') .'/'. \App\Models\Config::get()['icon_mini'] }}" alt="user-avatar"  class="profile-user-img img-fluid img-circle">
            <br>
            <a href="{{ route('welcome') }}"><b>{{ \App\Models\Config::get()['name'] }}</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="name" type="text" class="form-control" placeholder="Full name"
                            value="{{ old('name') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input name="username" type="text" class="form-control" placeholder="username"
                            value="{{ old('username') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                        
                    </div>


                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <br>
                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
                <br>
                <strong class="text-danger text-center">Setelah Anda Mendaftar Tidak Akan Bisa Langsung Login, Anda Harus Menghubungi Admin Terebih dahulu Untuk Aktifasi Akun</strong>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    @include('layouts.scripts')

</html>
