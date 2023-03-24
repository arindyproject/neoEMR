@extends('layouts.app')


@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a  class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>

@include('attributes.alamat.menus')
@endpush

@section('content')

<div class="row">
    
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}} ">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle"></i>
                    <b>UPDATE {{$title}}</b>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{Route($url_update, $itm->id)}}" method="POST" class="form form-sm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode">Kode Provinsi</label>
                        <input type="text" class="form-control form-control-sm" name="kode" id="kode" placeholder="kode Provinsi"  value="{{$itm->kode}}">
                        @if ($errors->has("kode"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("kode") }}</strong>
                            </span>
                        @endif
                    </div> 
                    <div class="form-group">
                        <label for="nama">Nama Provinsi</label>
                        <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Nama Provinsi"  value="{{$itm->nama}}" required>
                        @if ($errors->has("nama"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("nama") }}</strong>
                            </span>
                        @endif
                    </div> 
                    
                    <button class="btn btn-block btn-info bg-{{\App\Models\Config::get()['navbar_variants']}}" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    @include('attributes.alamat.provinsi.table')
    
</div>

@include('attributes.alamat.m_float')
@endsection
