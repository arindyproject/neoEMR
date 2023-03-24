<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ \App\Models\Config::get()['name'] }} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icon') .'/'. \App\Models\Config::get()['icon_mini'] }}">

    @include('layouts.styles')
</head>

<body class="hold-transition login-page {{ \App\Models\Config::get()['dark_mode'] ? 'dark-mode' : '' }}">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('images/icon') .'/'. \App\Models\Config::get()['icon_mini'] }}" alt="user-avatar"  class="profile-user-img img-fluid img-circle">
            <br>
            <a href="{{ route('home') }}"><b>{{ \App\Models\Config::get()['name'] }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkkan Login Dahulu!!!</p>
               
            @if (session('login_error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session('login_error') }}
                </div>
            @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control "
                            placeholder="Username / Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                </p>
                
            </div>
            <!-- /.login-card-body -->

            
        </div>

        
        
    </div>
    <!-- /.login-box -->

    @include('layouts.scripts')
</body>
</html>
