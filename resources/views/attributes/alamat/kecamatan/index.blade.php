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

<div class="row">
    @include('attributes.alamat.kecamatan.table')
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
                        <label for="att_alamat_provinsis_id">Provinsi</label>
                        <select  id="att_alamat_provinsis_id" class="select2-provinsi form-control form-control-sm " required></select>
                        @if ($errors->has("att_alamat_provinsis_id"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("att_alamat_provinsis_id") }}</strong>
                            </span>
                        @endif
                    </div> 


                    <div class="form-group">
                        <label for="att_alamat_kotas_id">Kota / Kabupaten</label>
                        <select name="att_alamat_kotas_id" id="att_alamat_kotas_id" class="select2-kota form-control form-control-sm " required></select>
                        @if ($errors->has("att_alamat_kotas_id"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("att_alamat_kotas_id") }}</strong>
                            </span>
                        @endif
                    </div> 

         

                    <div class="form-group">
                        <label for="kode_kecamatan">Kode Kecamatan</label>
                        <input type="text" class="form-control form-control-sm" name="kode_kecamatan" id="kode_kecamatan" placeholder="kode Kota"  value="{{old('kode_kecamatan')}}">
                        @if ($errors->has("kode_kecamatan"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("kode_kecamatan") }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control form-control-sm" name="kode" id="kode" placeholder="kode provinsi - kode kota"  value="{{old('kode')}}">
                        @if ($errors->has("kode"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("kode") }}</strong>
                            </span>
                        @endif
                    </div> 
                     
                    <div class="form-group">
                        <label for="nama">Nama Kecamatan</label>
                        <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Nama Kecamatan"  value="{{old('nama')}}" required>
                        @if ($errors->has("nama"))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first("nama") }}</strong>
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
@push('scripts')
    <script type="text/javascript">
        var kode_provinsi = '';
        var kode_kota     = '';

        var id_provinsi   = '';

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
            $('#kode').val(kode_provinsi + '-' + kode_kota + "-" + $('#kode_kecamatan').val());
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
            $('#kode').val(kode_provinsi + '-' + kode_kota + "-" + $('#kode_kecamatan').val());
        });
        //====================================================================================


        $('#kode_kecamatan').on('input',function(e){
            $('#kode').val(kode_provinsi + '-' + kode_kota + "-" + $('#kode_kecamatan').val());
        });

    </script>
@endpush
@endsection
