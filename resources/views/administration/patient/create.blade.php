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
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title">
                    {{$title}}
                </h3>
            </div>
            <div class="card-body p-0">
                <!-- ---------------------------------------------------- -->
                <form action="{{Route('patient.store')}}" method="POST" class="form form-sm">
                    @csrf
                    <!-- ---------------------------------------------------- -->
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card-body">
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-2 col-sm-4 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-10 col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="full_name"
                                            id="full_name" placeholder="Nama Lengkap Pasien" required value="{{old('full_name')}}">
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
                                                    name="place_of_birth" id="place_of_birth"
                                                    placeholder="Tempat Lahir" value="{{old('place_of_birth')}}">
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control form-control-sm" name="birthDate"
                                                    id="birthDate" placeholder="Tgl Lahir" value="{{old('birthDate')}}">
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
                                                    <option  {{$item->id == old('identity_type_id') ? 'selected' : ''}} value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="identity_number" id="identity_number"
                                                    placeholder="Identity Number" value="{{old('identity_number')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="gender_id" class="col-md-2 col-sm-4 col-form-label">Jenis
                                        Kelamin</label>
                                    <div class="col-md-10 col-sm-8">
                                        <select name="gender_id" id="gender_id" class="form-control form-control-sm"
                                            required>
                                            @foreach ($gender as $item)
                                            <option {{$item->id == old('gender_id') ? 'selected' : ''}} value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
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
                                            <option {{$item->id == old('maritalStatus_id') ? 'selected' : ''}} value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="no_tlp" class="col-md-2 col-sm-4 col-form-label">Nomor TLP/HP</label>
                                    <div class="col-md-10 col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="no_tlp"
                                            id="no_tlp" placeholder="Nomor TLP/HP" value="{{old('no_tlp')}}">
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <label for="no_bpjs" class="col-md-2 col-sm-4 col-form-label">Nomor BPJS/JKN</label>
                                    <div class="col-md-10 col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="no_bpjs"
                                            id="no_bpjs" placeholder="Nomor BPJS/JKN" value="{{old('no_bpjs')}}">
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                            </div>
                        </div>
                        <!-- ---------------------------------------------------- -->
                        <!-- ---------------------------------------------------- -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card-body">
                                <!-- ---------------------------------------------------- -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control form-control-sm" name="address_alamat"
                                            id="address_alamat" cols="30" rows="2">{{old('address_alamat')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" class="form-control form-control-sm" name="postalCode" id="postalCode"
                                                placeholder="Kode Pos" value="{{old('postalCode')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kota/KAB</label>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Desa/Kelurahan</label>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------- -->
                            </div>
                            <button type="submit" class="btn btn-block btn-info">SIMPAN</button>
                        </div>
                    </div>
                    <!-- ---------------------------------------------------- -->
                </form>
                <!-- ---------------------------------------------------- -->
            </div>
        </div>
    </div>
</div>



@include('administration.m_float')
@endsection
