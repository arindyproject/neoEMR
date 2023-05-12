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
                        <i class="fas fa-edit"></i> Edit Payment (Cara Bayar)
                    </h3>
                </div>
                <div class="card-body table-responsive p-2">
                    <form action="" method="POST" class="form form-sm">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input value="{{$data->code}}" type="text" name="code" class="form-control form-control-sm" required placeholder="code payment">
                                    @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong
                                            class="text-danger">{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="{{$data->name}}" type="text" name="name" class="form-control form-control-sm" required placeholder="nama payment / cara bayar">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong
                                            class="text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type" id="type" class="form-control form-control-sm" required>
                                        <option {{$data->type == 'TUNAI' ? 'selected' : '' }}  value="TUNAI">TUNAI</option>
                                        <option {{$data->type == 'BPJS' ? 'selected' : '' }}  value="BPJS">BPJS</option>
                                        <option {{$data->type == 'ASURANSI' ? 'selected' : '' }}  value="ASURANSI">ASURANSI</option>
                                        <option {{$data->type == 'GRATIS' ? 'selected' : '' }}  value="GRATIS">GRATIS</option>
                                    </select>
                                    @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong
                                            class="text-danger">{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="ket" id="" cols="30" rows="2" class="form-control form-control-sm" required>{{$data->ket}}</textarea>
                                    @if ($errors->has('ket'))
                                    <span class="help-block">
                                        <strong
                                            class="text-danger">{{ $errors->first('ket') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" onclick="if (!confirm('Apakah Anda Yakin??')) { return false }" class="btn btn-sm btn-info btn-block"><b><i class="fas fa-save"></i> EDIT</b></button>
                    </form>
                </div>
            </div>


            

        </div>
    </div>
</div>



@include('administration.m_float')
@endsection
