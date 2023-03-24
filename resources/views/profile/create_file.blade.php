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
                        <i class="fas fa-file-import"></i>
                        -
                        Upload File
                    </h3>
                    <div class="card-tools">
                        <a href="{{Route('profile.file', $data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-copy"></i> My Files</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('profile.file.store', $data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input name="title" type="text" class="form-control form-control-sm" id="title" placeholder="Judul dokumen / file"
                                    required value="{{old('title')}}">
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_privat" class="col-sm-2 col-form-label">PRIVAT File</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" name="is_privat" id="is_privat" required>
                                    <option {{old('is_privat') == '1' ? 'selected' : ''}} value="1">PRIVAT</option>
                                    <option {{old('is_privat') == '0' ? 'selected' : ''}} value="0">PUBLIC</option>
                                </select>
                                @if ($errors->has('is_privat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('is_privat') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">File</label>
                            <div class="col-sm-10">
                                <input name="file" type="file" class="form-control form-control-sm" id="file" placeholder="File anda"
                                    required value="{{old('file')}}">
                                @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ket" class="col-sm-2 col-form-label">keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="ket" id="ket" cols="30" rows="3" class="form-control form-control-sm">{{old('ket')}}</textarea>
                                @if ($errors->has('ket'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ket') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        
                        

                        <button type="submit" class="btn btn-primary btn-block bg-{{$bg}}"><i class="fas fa-cloud-upload-alt"></i> Upload</button>

                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>
@endsection
