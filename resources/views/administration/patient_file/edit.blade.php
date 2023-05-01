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

<div class="row">
    @include('administration.patient.show_left')

    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
        <div class="card" id="data-patient">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    @include('administration.patient.show_menu')
                </ul>
            </div>
            <div class="card-body">
                <h5>Edit File</h5>
                <form action="{{Route('file.patient.update', $file->id)}}" method="POST" class="form form-sm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-sm" id="title" name="title"
                                placeholder="nama file" required value="{{$file->title}}">
                            @if ($errors->has('title'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="file">File (max : 5MB)</label>
                            <input type="file" class="form-control form-control-sm" id="file" name="file"
                                placeholder="nama file" >
                                @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('file') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="form-group form-group-sm col-sm-6 col-md-4 col-xl-6 col-lg-6">
                            <label for="ket">Descripsi</label>
                            <input type="text" class="form-control form-control-sm" id="ket" name="ket"
                                placeholder="descripsi file" value="{{$file->ket}}">
                        </div>
                        <div class="form-group form-group-sm col-sm-6 col-md-2 col-xl-2 col-lg-2">
                            <label for="title">-</label>
                            <button type="submit" class="btn btn-sm  btn-info form-control form-control-sm"><i
                                    class="fas fa-upload"></i> Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>



@include('administration.m_float')
@endsection
