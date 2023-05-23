@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/selectize/selectize.bootstrap3.min.css') }}"> 
    <!-- Select2-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush



@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b><i class="fas fa-user-plus"></i> {{$title}}</b>
    </a>
</li>
@include('administration.menus')
@endpush

@section('content')
<form action="{{Route('patient.store')}}" method="POST" class="form form-sm" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title">
                    <i class="fas fa-user-plus"></i> {{$title}}
                </h3>
            </div>
            <div class="card-body p-0">
                <!-- ---------------------------------------------------- -->
                
                    <!-- ---------------------------------------------------- -->
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card-body">
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-2 col-sm-4 col-form-label">Nama Lengkap*</label>
                                    <div class="col-md-2 col-sm-2">
                                        <select name="title" id="title" class="form-control form-control-sm">
                                            <option value="">pilih title</option>
                                            @foreach ($title_patient as $item)
                                            <option {{old('title') == $item['id'] ? 'selected' : ''}} value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-8 col-sm-6">
                                        <input type="text" class="form-control form-control-sm" name="full_name"
                                            id="full_name" placeholder="Nama Lengkap Pasien" required
                                            value="{{old('full_name')}}">
                                        @if ($errors->has('full_name'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('full_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="place_of_birth" class="col-md-2 col-sm-4 col-form-label">Tempat/Tgl
                                        Lahir</label>
                                    <div class="col-md-10 col-sm-8">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="place_of_birth" id="place_of_birth" placeholder="Tempat Lahir"
                                                    value="{{old('place_of_birth')}}">
                                                @if ($errors->has('place_of_birth'))
                                                <span class="help-block">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('place_of_birth') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" name="birthDate" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask
                                                    id="birthDate" placeholder="Tgl Lahir" value="{{old('birthDate')}}">
                                                @if ($errors->has('birthDate'))
                                                <span class="help-block">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('birthDate') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="identity_type_id"
                                        class="col-md-2 col-sm-4 col-form-label">Identity</label>
                                    <div class="col-md-10 col-sm-8">
                                        <div class="row">
                                            <div class="col">
                                                <select name="identity_type_id" id="identity_type_id"
                                                    class="form-control form-control-sm">
                                                    <option value="">silahkan pilih</option>
                                                    @foreach ($identity_type as $item)
                                                    <option {{$item->id == old('identity_type_id') ? 'selected' : ''}}
                                                        value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('identity_type_id'))
                                                <span class="help-block">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('identity_type_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="identity_number" id="identity_number"
                                                    placeholder="Identity Number" value="{{old('identity_number')}}">
                                                @if ($errors->has('identity_number'))
                                                <span class="help-block">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('identity_number') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="gender_id" class="col-md-2 col-sm-4 col-form-label">Jenis
                                        Kelamin *</label>
                                    <div class="col-md-10 col-sm-8">
                                        <select name="gender_id" id="gender_id" class="form-control form-control-sm"
                                            required>
                                            @foreach ($gender as $item)
                                            <option {{$item->id == old('gender_id') ? 'selected' : ''}}
                                                value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('gender_id'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('gender_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="maritalStatus_id" class="col-md-2 col-sm-4 col-form-label">Status
                                        Nikah</label>
                                    <div class="col-md-10 col-sm-8">
                                        <select name="maritalStatus_id" id="maritalStatus_id"
                                            class="form-control form-control-sm">
                                            @foreach ($status_nikah as $item)
                                            <option {{$item->id == old('maritalStatus_id') ? 'selected' : ''}}
                                                value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('maritalStatus_id'))
                                        <span class="help-block">
                                            <strong
                                                class="text-danger">{{ $errors->first('maritalStatus_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="no_tlp" class="col-md-2 col-sm-4 col-form-label">Nomor TLP/HP</label>
                                    <div class="col-md-10 col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="no_tlp"
                                            id="no_tlp" placeholder="Nomor TLP/HP" value="{{old('no_tlp')}}">
                                        @if ($errors->has('no_tlp'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('no_tlp') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="no_bpjs" class="col-md-2 col-sm-4 col-form-label">Nomor BPJS/JKN</label>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="no_bpjs"
                                            id="no_bpjs" placeholder="Nomor BPJS/JKN" value="{{old('no_bpjs')}}">
                                        @if ($errors->has('no_bpjs'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('no_bpjs') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-2 col-sm-2">
                                        <select name="kelas_bpjs" id="kelas_bpjs" class="form-control form-control-sm">
                                            <option {{old('kelas_bpjs') == '3' ? 'selected' : ''}} value="3">kelas 3</option>
                                            <option {{old('kelas_bpjs') == '2' ? 'selected' : ''}} value="2">kelas 2</option>
                                            <option {{old('kelas_bpjs') == '3' ? 'selected' : ''}} value="1">kelas 1</option>
                                        </select>
                                        @if ($errors->has('kelas_bpjs'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('kelas_bpjs') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4 col-sm-2">
                                        <select name="jenis_bpjs_id" id="jenis_bpjs_id" class="form-control form-control-sm">
                                            @foreach ($jenis_bpjs as $item)
                                                <option {{old('jenis_bpjs_id') == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('jenis_bpjs_id'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('jenis_bpjs_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <!-- ---------------------------------------------------- -->

                                <!-- Medium --------------------------------------------- -->
                                @if ($mode_form == 'medium' || $mode_form == 'advance')
                                <div class="form-group row">
                                <!-- ---------------------- -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama IBU Kandung</label>
                                        <input type="text" class="form-control form-control-sm" name="nama_ibu"
                                            id="nama_ibu" placeholder="Nama IBU Kandung" value="{{old('nama_ibu')}}">
                                        @if ($errors->has('nama_ibu'))
                                        <span class="help-block">
                                            <strong
                                                class="text-danger">{{ $errors->first('nama_ibu') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------- -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gol Darah</label>
                                        <select name="blood" id="blood" class="form-control form-control-sm">
                                            <option  value="">Pilih ...</option>
                                            <option {{ old('blood') == 'A' ? 'selected' : ''}} value="A">A</option>
                                            <option {{ old('blood') == 'A+' ? 'selected' : ''}} value="A+">A+</option>
                                            <option {{ old('blood') == 'B' ? 'selected' : ''}} value="B">B</option>
                                            <option {{ old('blood') == 'B+' ? 'selected' : ''}} value="B+">B+</option>
                                            <option {{ old('blood') == 'AB' ? 'selected' : ''}} value="AB">AB</option>
                                            <option {{ old('blood') == 'AB+' ? 'selected' : ''}} value="AB+">AB+</option>
                                            <option {{ old('blood') == 'O' ? 'selected' : ''}} value="O">O</option>
                                            <option {{ old('blood') == 'O+' ? 'selected' : ''}} value="O+">O+</option>
                                        </select>
                                        @if ($errors->has('blood'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('blood') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------- -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <select name="pendidikan_id" id="pendidikan_id"
                                            class="form-control form-control-sm select-search">
                                            <option value="">Pilih ...</option>
                                            @foreach ($pendidikan as $item)
                                            <option {{$item->id == old('pendidikan_id') ? 'selected' : ''}}
                                                value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('pendidikan_id'))
                                        <span class="help-block">
                                            <strong
                                                class="text-danger">{{ $errors->first('pendidikan_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------- -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <select name="pekerjaan_id" id="pekerjaan_id"
                                            class="form-control form-control-sm select-search">
                                            <option value="">Pilih ...</option>
                                            @foreach ($pekerjaan as $item)
                                            <option {{$item->id == old('pekerjaan_id') ? 'selected' : ''}}
                                                value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('pekerjaan_id'))
                                        <span class="help-block">
                                            <strong
                                                class="text-danger">{{ $errors->first('pekerjaan_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ---------------------- -->
                                </div>
                                @endif
                                <!-- Medium --------------------------------------------- -->
                            </div>
                        </div>
                        <!-- ---------------------------------------------------- -->
                        <!-- ---------------------------------------------------- -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card-body">
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">

                                    <!-- Medium --------------------------------------------- -->
                                    @if ($mode_form == 'medium' || $mode_form == 'advance')
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select name="agama_id" id="agama_id"
                                                class="form-control form-control-sm">
                                                <option value="">Pilih ...</option>
                                                @foreach ($agama as $item)
                                                <option {{$item->id == old('agama_id') ? 'selected' : ''}}
                                                    value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('agama_id'))
                                            <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('agama_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kewarganegaraan</label>
                                            <select name="kewarganegaraan_id" id="kewarganegaraan_id"
                                                class="form-control form-control-sm select-search">
                                                <option value="">Pilih ...</option>
                                                @foreach ($country as $item)
                                                <option  {{$default['def_alamat_country']['id'] == $item->id ? 'selected' : '' }}  {{$item->id == old('kewarganegaraan_id') ? 'selected' : ''}}
                                                    value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('kewarganegaraan_id'))
                                            <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('kewarganegaraan_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>SUKU</label>
                                            <input type="text" class="form-control form-control-sm" name="suku"
                                                id="suku" placeholder="SUKU" value="{{old('suku')}}">
                                            @if ($errors->has('suku'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('suku') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Bahasa</label>
                                            <input type="text" class="form-control form-control-sm" name="bahasa"
                                                id="bahasa" placeholder="bahasa yang dikuasi" value="{{old('bahasa')}}">
                                            @if ($errors->has('bahasa'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('bahasa') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    @endif
                                    <!-- Medium --------------------------------------------- -->

                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select name="address_provinsi_id" id="address_provinsi_id" class="select2 form-control form-control-sm">
                                                @if ($default['def_alamat_provinsi']['id'] != '')
                                                    <option selected value="{{$default['def_alamat_provinsi']['id']}}">{{$default['def_alamat_provinsi']['nama']}} </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kota/KAB</label>
                                            <select name="address_kota_id" id="address_kota_id" class="select2 form-control form-control-sm">
                                                @if ($default['def_alamat_kota']['id'] != '')
                                                    <option selected value="{{$default['def_alamat_kota']['id']}}">{{$default['def_alamat_kota']['nama']}} </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select name="address_kecamatan_id" id="address_kecamatan_id" class="select2 form-control form-control-sm">
                                                @if ($default['def_alamat_kecamatan']['id'] != '')
                                                    <option selected value="{{$default['def_alamat_kecamatan']['id']}}">{{$default['def_alamat_kecamatan']['nama']}} </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Desa/Kelurahan</label>
                                            <select name="address_kelurahan_id" id="address_kelurahan_id" class="select2 form-control form-control-sm">
                                                @if ($default['def_alamat_kelurahan']['id'] != '')
                                                    <option selected value="{{$default['def_alamat_kelurahan']['id']}}">{{$default['def_alamat_kelurahan']['nama']}} </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alamat *</label>
                                            <textarea class="form-control form-control-sm" name="address_alamat"
                                                id="address_alamat" cols="30" required
                                                rows="2">{{old('address_alamat')}}</textarea>
                                            @if ($errors->has('address_alamat'))
                                            <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('address_alamat') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" class="form-control form-control-sm" name="postalCode"
                                                id="postalCode" placeholder="Kode Pos" value="{{old('postalCode')}}">
                                            @if ($errors->has('postalCode'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('postalCode') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Note (catatan untuk pasien)</label>
                                            <textarea class="form-control form-control-sm" name="note"
                                                id="note" cols="30"
                                                rows="2">{{old('note')}}</textarea>
                                            @if ($errors->has('note'))
                                            <span class="help-block">
                                                <strong
                                                    class="text-danger">{{ $errors->first('note') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Photo (max 4MB)</label>
                                            <input type="file" class="form-control form-control-sm" name="photo"
                                                id="photo" placeholder="photo" value="{{old('photo')}}">
                                            @if ($errors->has('photo'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('photo') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ---------------------- -->
                                </div>
                                <!-- ---------------------------------------------------- -->
                            </div>
                            
                        </div>
                    </div>
                    <!-- ---------------------------------------------------- -->
                
                <!-- ---------------------------------------------------- -->
            </div>
        </div>
    </div>

    <!-- advance --------------------------------------------- -->
    @if ($mode_form == 'advance')
    @include('administration.patient.advance_create')
    @endif
    <!-- advance --------------------------------------------- -->

</div>

<button type="submit" class="btn btn-success btn-block">SIMPAN</button>
</form>

@if ($mode_form == 'advance')
@include('administration.patient.script_advance')
@endif

@include('administration.patient.scripts')
@include('administration.m_float')
@endsection
