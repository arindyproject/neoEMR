@extends('layouts.app')

@push('styles')
    <!-- Select2-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a  class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>

@include('attributes.alamat.menus')
@endpush

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}} ">
                    <h3 class="card-title">
                        <i class="fas fa-cogs"></i>
                        <b>DEFAULT {{$title}}</b>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{Route($url_update)}}" method="POST" class="form form-sm">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id"  id="country_id" class="select2-country form-control form-control-sm " >
                                @if ($data['def_alamat_country']['id'] != '' && $data['def_alamat_country']['nama'] != '')
                                <option selected value="{{$data['def_alamat_country']['id']}}">{{ $data['def_alamat_country']['nama']}}</option>
                                @endif
                            </select>
                            @if ($errors->has("country_id"))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first("country_id") }}</strong>
                                </span>
                            @endif
                        </div> 

                        <div class="form-group">
                            <label for="att_alamat_provinsis_id">Provinsi</label>
                            <select name="att_alamat_provinsis_id"  id="att_alamat_provinsis_id" class="select2-provinsi form-control form-control-sm " >
                                @if ($data['def_alamat_provinsi']['id'] != '' && $data['def_alamat_provinsi']['nama'] != '')
                                <option selected value="{{$data['def_alamat_provinsi']['id']}}">{{ $data['def_alamat_provinsi']['nama']}}</option>
                                @endif
                            </select>
                            @if ($errors->has("att_alamat_provinsis_id"))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first("att_alamat_provinsis_id") }}</strong>
                                </span>
                            @endif
                        </div> 
    
    
                        <div class="form-group">
                            <label for="att_alamat_kotas_id">Kota / Kabupaten</label>
                            <select name="att_alamat_kotas_id"  id="att_alamat_kotas_id" class="select2-kota form-control form-control-sm " >
                                @if ($data['def_alamat_kota']['id'] != '' && $data['def_alamat_kota']['nama'] != '')
                                <option selected value="{{$data['def_alamat_kota']['id']}}">{{ $data['def_alamat_kota']['nama']}}</option>
                                @endif
                            </select>
                            @if ($errors->has("att_alamat_kotas_id"))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first("att_alamat_kotas_id") }}</strong>
                                </span>
                            @endif
                        </div> 
    
    
                        <div class="form-group">
                            <label for="att_alamat_kecamatans_id">Kecamatan</label>
                            <select name="att_alamat_kecamatans_id" id="att_alamat_kecamatans_id" class="select2-kecamatan form-control form-control-sm " >
                                @if ($data['def_alamat_kecamatan']['id'] != '' && $data['def_alamat_kecamatan']['nama'] != '')
                                <option selected value="{{$data['def_alamat_kecamatan']['id']}}">{{ $data['def_alamat_kecamatan']['nama']}}</option>
                                @endif
                            </select>
                            @if ($errors->has("att_alamat_kecamatans_id"))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first("att_alamat_kecamatans_id") }}</strong>
                                </span>
                            @endif
                        </div> 

                        <div class="form-group">
                            <label for="att_alamat_kelurahans_id">Kelurahan</label>
                            <select name="att_alamat_kelurahans_id" id="att_alamat_kelurahans_id" class="select2-kelurahan form-control form-control-sm " >
                                @if ($data['def_alamat_kelurahan']['id'] != '' && $data['def_alamat_kelurahan']['nama'] != '')
                                <option selected value="{{$data['def_alamat_kelurahan']['id']}}">{{ $data['def_alamat_kelurahan']['nama']}}</option>
                                @endif
                            </select>
                            @if ($errors->has("att_alamat_kelurahans_id"))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first("att_alamat_kelurahans_id") }}</strong>
                                </span>
                            @endif
                        </div> 
                        
                        <button class="btn btn-block btn-info bg-{{\App\Models\Config::get()['navbar_variants']}}" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('attributes.alamat.m_float')
@push('scripts')
    <script type="text/javascript">
        var kode_provinsi = "{!! $data['def_alamat_provinsi']['kode'] !!}";
        var kode_kota     = "{!! $data['def_alamat_kota']['kode'] !!}";
        var kode_kecamatan= "{!! $data['def_alamat_kecamatan']['kode'] !!}";
        var kode_kelurahan= "{!! $data['def_alamat_kelurahan']['kode'] !!}";

        var id_provinsi   = "{!! $data['def_alamat_provinsi']['id'] !!}";
        var id_kota       = "{!! $data['def_alamat_kota']['id'] !!}";
        var id_kecamatan  = "{!! $data['def_alamat_kecamatan']['id'] !!}";


        
        

        //====================================================================================
        var s_country = $('.select2-country').select2({
            
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.country.autocomplete') !!}',
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term
                    }
                    return query;
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
        
        //====================================================================================



        //====================================================================================
        var s_kelurahan = $('.select2-kelurahan').select2({
            
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kelurahan.autocomplete') !!}',
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_kota : id_kecamatan
                    }
                    return query;
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.kode_kelurahan +' : '+ item.nama,
                                id: item.id,
                                kode_kelurahan: item.kode_kelurahan
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kelurahan.on('select2:select', function (e) {
            var data = e.params.data;
            kode_kelurahan = data.kode_kelurahan;
        });
        //====================================================================================

        //====================================================================================
        var s_kecamatan = $('.select2-kecamatan').select2({
            
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kecamatan.autocomplete') !!}',
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_kota : id_kota
                    }
                    return query;
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.kode_kecamatan +' : '+ item.nama,
                                id: item.id,
                                kode_kecamatan: item.kode_kecamatan
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kecamatan.on('select2:select', function (e) {
            var data = e.params.data;
            kode_kecamatan = data.kode_kecamatan;
            id_kecamatan = data.id;
            s_kelurahan.val(null).trigger("change");  
        });
        //====================================================================================

        //====================================================================================
        var s_kota = $('.select2-kota').select2({
            
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kota.autocomplete') !!}',
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_provinsi: id_provinsi
                    }
                    return query;
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.kode_kota +' : '+ item.nama,
                                id: item.id,
                                kode_kota: item.kode_kota
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kota.on('select2:select', function (e) {
            var data = e.params.data;
            kode_kota = data.kode_kota;
            id_kota = data.id;
            s_kecamatan.val(null).trigger("change");
            s_kelurahan.val(null).trigger("change");      
        });
        //====================================================================================


        
        //====================================================================================
        var s_provinsi = $('.select2-provinsi').select2({
            
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.provinsi.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.kode +' : '+ item.nama,
                                id: item.id,
                                kode: item.kode
                            }
                        })
                    };
                },
                cache: true
            }
        });
        s_provinsi.on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data)
            kode_provinsi = data.kode;
            id_provinsi   = data.id;
            s_kota.val(null).trigger("change");
            s_kecamatan.val(null).trigger("change");
            s_kelurahan.val(null).trigger("change"); 
           
        });
        //====================================================================================


    </script>
@endpush
@endsection
