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

@php
    $kode_provinsi = '';
    $kode_kota     = '';
    $kode_kecamatan= '';

    $id_provinsi   = '';
    $id_kota       = '';
@endphp

<div class="row">
    
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
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
                        <label for="att_alamat_provinsis_id">Provinsi</label>
                        <select  id="att_alamat_provinsis_id" class="select2-provinsi form-control form-control-sm " required>
                            @if ($itm->att_alamat_kecamatans_id != '' && $itm->kecamatan->att_alamat_kotas_id != '' && $itm->kecamatan->kota->att_alamat_provinsis_id != '')
                            @php
                                $kode_provinsi = $itm->kecamatan->kota->provinsi->kode;
                                $id_provinsi   = $itm->kecamatan->kota->att_alamat_provinsis_id;
                            @endphp
                            <option selected value="{{$itm->kecamatan->kota->att_alamat_provinsis_id}}">{{$itm->kecamatan->kota->provinsi->kode}} : {{$itm->kecamatan->kota->provinsi->nama}}</option>
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
                        <select  id="att_alamat_kotas_id" class="select2-kota form-control form-control-sm " required>
                            @if ($itm->att_alamat_kecamatans_id != '' && $itm->kecamatan->att_alamat_kotas_id != '')
                            @php
                                $kode_kota = $itm->kecamatan->kota->kode_kota;
                                $id_kota   = $itm->kecamatan->att_alamat_kotas_id;
                            @endphp
                            <option selected value="{{$itm->kecamatan->att_alamat_kotas_id}}">{{$itm->kecamatan->kota->kode_kota}} : {{$itm->kecamatan->kota->nama}}</option>
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
                        <select name="att_alamat_kecamatans_id" id="att_alamat_kecamatans_id" class="select2-kecamatan form-control form-control-sm " required value="{{$itm->att_alamat_kecamatans_id}}">
                            @if ($itm->att_alamat_kecamatans_id != '')
                            @php
                                $kode_kecamatan= $itm->kecamatan->kode_kecamatan;
                            @endphp
                            <option selected value="{{$itm->att_alamat_kecamatans_id}}">{{$itm->kecamatan->kode_kecamatan}} : {{$itm->kecamatan->nama}}</option>
                            @endif
                        </select>
                        @if ($errors->has("att_alamat_kecamatans_id"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("att_alamat_kecamatans_id") }}</strong>
                            </span>
                        @endif
                    </div> 
                    

                    <div class="form-group">
                        <label for="kode_kelurahan">Kode Kelurahan</label>
                        <input type="text" class="form-control form-control-sm" name="kode_kelurahan" id="kode_kelurahan" placeholder="kode Kelurahan"  value="{{$itm->kode_kelurahan}}">
                        @if ($errors->has("kode_kelurahan"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("kode_kelurahan") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control form-control-sm" name="kode" id="kode" placeholder="kode provinsi - kode kota"  value="{{$itm->kode}}">
                        @if ($errors->has("kode"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("kode") }}</strong>
                            </span>
                        @endif
                    </div> 
                     
                    <div class="form-group">
                        <label for="nama">Nama Kelurahan</label>
                        <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Nama Kelurahan"  value="{{$itm->nama}}" required>
                        @if ($errors->has("nama"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("nama") }}</strong>
                            </span>
                        @endif
                    </div> 
                    
                    <button class="btn btn-block btn-info bg-{{$bg}}" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>

    @include('attributes.alamat.kelurahan.table')

    
</div>

@include('attributes.alamat.m_float')

@push('scripts')
    <script type="text/javascript">
        var kode_provinsi = '{!! $kode_provinsi !!}';
        var kode_kota     = '{!! $kode_kota !!}';
        var kode_kecamatan= '{!! $kode_kecamatan !!}';

        var id_provinsi   = '{!! $id_provinsi !!}';
        var id_kota       = '{!! $id_kota !!}';

        //====================================================================================
        var s_kecamatan = $('.select2-kecamatan').select2({
            allowClear: true,
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
            $('#kode').val(kode_provinsi + '-' + kode_kota + "-" + kode_kecamatan + '-' + $('#kode_kelurahan').val());
        });
        //====================================================================================

        //====================================================================================
        var s_kota = $('.select2-kota').select2({
            allowClear: true,
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
            $('#kode').val(kode_provinsi + '-' + kode_kota + "-" + kode_kecamatan + '-' + $('#kode_kelurahan').val());
        });
        //====================================================================================


        
        //====================================================================================
        var s_provinsi = $('.select2-provinsi').select2({
            allowClear: true,
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
            $('#kode').val(kode_provinsi + '-' + kode_kota + "-" + kode_kecamatan + '-' + $('#kode_kelurahan').val());
        });
        //====================================================================================


        $('#kode_kelurahan').on('input',function(e){
            $('#kode').val(kode_provinsi + '-' + kode_kota + "-" + kode_kecamatan + '-' + $('#kode_kelurahan').val());
        });

    </script>
@endpush

@endsection
