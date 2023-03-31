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
    @include('attributes.alamat.country.table')
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle"></i>
                    <b>ADD {{$title}}</b>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{Route($url_store)}}" method="POST" class="form form-sm">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Indonesia</label>
                        <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Nama Indonesia"  value="{{old('nama')}}" required>
                        @if ($errors->has("nama"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("nama") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Internasional</label>
                        <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Nama Internasional"  value="{{old('name')}}" required>
                        @if ($errors->has("name"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("name") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="alpha_2">Alpha 2</label>
                        <input type="text" class="form-control form-control-sm" name="alpha_2" id="alpha_2" placeholder="Alpha 2"  value="{{old('alpha_2')}}" required>
                        @if ($errors->has("alpha_2"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("alpha_2") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="alpha_3">Alpha 3</label>
                        <input type="text" class="form-control form-control-sm" name="alpha_3" id="alpha_3" placeholder="Alpha 3"  value="{{old('alpha_3')}}" required>
                        @if ($errors->has("alpha_3"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("alpha_3") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="country_code">Country Code</label>
                        <input type="text" class="form-control form-control-sm" name="country_code" id="country_code" placeholder="Country Code"  value="{{old('country_code')}}" required>
                        @if ($errors->has("country_code"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("country_code") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="iso_3166_2">ISO 3166_2</label>
                        <input type="text" class="form-control form-control-sm" name="iso_3166_2" id="iso_3166_2" placeholder="iso_3166_2"  value="{{old('iso_3166_2')}}" >
                        @if ($errors->has("iso_3166_2"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("iso_3166_2") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" class="form-control form-control-sm" name="region" id="region" placeholder="region"  value="{{old('region')}}" >
                        @if ($errors->has("region"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("region") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="sub_region">Sub Region</label>
                        <input type="text" class="form-control form-control-sm" name="sub_region" id="sub_region" placeholder="sub_region"  value="{{old('sub_region')}}" >
                        @if ($errors->has("sub_region"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("sub_region") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="intermediate_region">Intermediate Region</label>
                        <input type="text" class="form-control form-control-sm" name="intermediate_region" id="intermediate_region" placeholder="intermediate_region"  value="{{old('intermediate_region')}}" >
                        @if ($errors->has("intermediate_region"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("intermediate_region") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="region_code">Region Code</label>
                        <input type="text" class="form-control form-control-sm" name="region_code" id="region_code" placeholder="region_code"  value="{{old('region_code')}}" >
                        @if ($errors->has("region_code"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("region_code") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="sub_region_code">Sub Region Code</label>
                        <input type="text" class="form-control form-control-sm" name="sub_region_code" id="sub_region_code" placeholder="sub_region_code"  value="{{old('sub_region_code')}}" >
                        @if ($errors->has("sub_region_code"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("sub_region_code") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="intermediate_region_code">Intermediate Region Code</label>
                        <input type="text" class="form-control form-control-sm" name="intermediate_region_code" id="intermediate_region_code" placeholder="intermediate_region_code"  value="{{old('intermediate_region_code')}}" >
                        @if ($errors->has("intermediate_region_code"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("intermediate_region_code") }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <button class="btn btn-block btn-info bg-{{$bg}}" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>


    
</div>

@include('attributes.alamat.m_float')
@endsection
