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
                        <i class="fas fa-user-edit"></i>
                        -
                        Edit Profile
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{route('profile.edit_submit', $data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nama Lengkap"
                                    required value="{{$data->name}}">
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
                                    placeholder="Username" required value="{{$data->username}}">
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
                                    required value="{{$data->email}}">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir"
                                    placeholder="Tempat lahir"  value="{{$data->tempat_lahir}}">
                                @if ($errors->has('tempat_lahir'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthDate" class="col-sm-2 col-form-label">Tgl Lahir</label>
                            <div class="col-sm-10">
                                <input name="birthDate" type="date" class="form-control" id="birthDate"
                                    placeholder="Tgl lahir"  value="{{$data->birthDate}}">
                                @if ($errors->has('birthDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthDate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address_alamat" id="" cols="2" rows="4">{{$data->address_alamat}}</textarea>
                                @if ($errors->has('address_alamat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address_alamat') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_tlp" class="col-sm-2 col-form-label">No HP/TLP</label>
                            <div class="col-sm-10">
                                <input name="no_tlp" type="text" class="form-control" id="no_tlp"
                                    placeholder="No HP/TLP"  value="{{$data->no_tlp}}">
                                @if ($errors->has('no_tlp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_tlp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                            <div class="col-sm-10">
                                <input name="photo" type="file" class="form-control" id="photo"
                                    placeholder="Photo">
                                @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                                @endif
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
