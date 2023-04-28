@extends('layouts.app')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/plugins/selectize/selectize.bootstrap3.min.css') }}"> 
@endpush

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

            <div class="card-body">
                <form class="form" action="">
                    <div class="row">

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="full_name">Nama (like)</label>
                            <input type="text" class="form-control form-control-sm" id="full_name" name="full_name" 
                            placeholder="nama pasien" value="{{request('full_name')}}">
                        </div>

                        
                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="place_of_birth">Tempat Lahir (like)</label>
                            <input type="text" class="form-control form-control-sm" id="place_of_birth" name="place_of_birth" 
                            placeholder="tempat lahir" value="{{request('place_of_birth')}}">
                        </div>


                        <!-- birthDate ---------------------------------------------------------------------------------->
                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="full_name">Tgl Lahir (==)</label>
                            <input type="date" class="form-control form-control-sm" id="birthDate_samadengan" name="birthDate_samadengan" 
                            value="{{request('birthDate_samadengan')}}">
                            <small>pasien lahir pada tanggal / sama dengan di atas</small>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="birthDate_kurandari">Tgl Lahir (<=)</label>
                            <input type="date" class="form-control form-control-sm" id="birthDate_kurandari" name="birthDate_kurandari" 
                            value="{{request('birthDate_kurandari')}}">
                            <small>pasien lahir pada tanggal / kurang dari tanggal di atas</small>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="full_name">Tgl Lahir (>=)</label>
                            <input type="date" class="form-control form-control-sm" id="birthDate_lebihdari" name="birthDate_lebihdari" 
                            value="{{request('birthDate_lebihdari')}}">
                            <small>pasien lahir pada tanggal / lebih dari tanggal di atas</small>
                        </div>
                        <!-- birthDate ---------------------------------------------------------------------------------->


                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="gender_id">Jenis Kelamin</label>
                            <select name="gender_id" id="gender_id" class="form-control form-control-sm">
                                <option value="">Semua Gender</option>
                                @foreach ($gender as $item)
                                    <option  {{$item->id == request('gender_id') ? 'selected' : ''}}  value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- alamat ---------------------------------------------------------------------------------->
                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label>Provinsi</label>
                            <select name="address_provinsi_id" id="address_provinsi_id" class="select2 form-control form-control-sm">
                                
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label>Kota/KAB</label>
                            <select name="address_kota_id" id="address_kota_id" class="select2 form-control form-control-sm">
                                
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label>Kecamatan</label>
                            <select name="address_kecamatan_id" id="address_kecamatan_id" class="select2 form-control form-control-sm">
                                
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label>Desa/Kelurahan</label>
                            <select name="address_kelurahan_id" id="address_kelurahan_id" class="select2 form-control form-control-sm">
                                
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="address_alamat">Alamat (like)</label>
                            <input type="text" class="form-control form-control-sm" id="address_alamat" name="address_alamat" 
                            placeholder="alamat" value="{{request('address_alamat')}}">
                        </div>
                        <!-- alamat ---------------------------------------------------------------------------------->


                        <!-- identity ---------------------------------------------------------------------------------->
                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="identity_type_id">Identity Type</label>
                            <select name="identity_type_id" id="gender_id" class="form-control form-control-sm select_search">
                                <option value="">Semua Type</option>
                                @foreach ($identity_type as $item)
                                    <option  {{$item->id == request('identity_type_id') ? 'selected' : ''}}  value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="identity_number">Identity Number (like)</label>
                            <input type="text" class="form-control form-control-sm" id="identity_number" name="identity_number" 
                            placeholder="nomor atau id identitas" value="{{request('identity_number')}}">
                        </div>
                        <!-- identity ---------------------------------------------------------------------------------->


                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="no_bpjs">BPJS / JKN (like)</label>
                            <input type="text" class="form-control form-control-sm" id="no_bpjs" name="no_bpjs" 
                            placeholder="nomor BPJS / JKN" value="{{request('no_bpjs')}}">
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="no_tlp">No HP / TLP (like)</label>
                            <input type="text" class="form-control form-control-sm" id="no_tlp" name="no_tlp" 
                            placeholder="nomor BPJS / JKN" value="{{request('no_tlp')}}">
                        </div>


                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="maritalStatus_id">Status Nikah</label>
                            <select name="maritalStatus_id" id="maritalStatus_id" class="form-control form-control-sm select_search">
                                <option value="">Semua Status</option>
                                @foreach ($status_nikah as $item)
                                    <option  {{$item->id == request('maritalStatus_id') ? 'selected' : ''}}  value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="agama_id">Agama</label>
                            <select name="agama_id" id="agama_id" class="form-control form-control-sm select_search">
                                <option value="">Semua Agama</option>
                                @foreach ($agama as $item)
                                    <option  {{$item->id == request('agama_id') ? 'selected' : ''}}  value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="pendidikan_id">Pendidikan</label>
                            <select name="pendidikan_id" id="pendidikan_id" class="form-control form-control-sm select_search">
                                <option value="">Semua Pendidikan</option>
                                @foreach ($pendidikan as $item)
                                    <option  {{$item->id == request('pendidikan_id') ? 'selected' : ''}}  value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="pekerjaan_id">Pekerjaan</label>
                            <select name="pekerjaan_id" id="pekerjaan_id" class="form-control form-control-sm select_search">
                                <option value="">Semua Pekerjaan</option>
                                @foreach ($pekerjaan as $item)
                                    <option  {{$item->id == request('pekerjaan_id') ? 'selected' : ''}}  value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="kewarganegaraan_id">Kewarganegaraan</label>
                            <select name="kewarganegaraan_id" id="kewarganegaraan_id" class="form-control form-control-sm select_search">
                                <option value="">Semua Kewarganegaraan</option>
                                @foreach ($country as $item)
                                    <option  {{$item->id == request('kewarganegaraan_id') ? 'selected' : ''}}  value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="bahasa">Bahasa (like)</label>
                            <input type="text" class="form-control form-control-sm" id="bahasa" name="bahasa" 
                            placeholder="bahasa yang dikuasai pasien" value="{{request('bahasa')}}">
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="suku">SUKU (like)</label>
                            <input type="text" class="form-control form-control-sm" id="suku" name="suku" 
                            placeholder="suku pasien" value="{{request('suku')}}">
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="kewarganegaraan_id">Gol Darah</label>
                            <select name="blood" id="blood" class="form-control form-control-sm select_search">
                                <option value="">Semua Golongan</option>
                                <option {{request('blood') == 'A' ? 'selected' : ''}} value="A">A</option>
                                <option {{request('blood') == 'A+' ? 'selected' : ''}} value="A+">A+</option>
                                <option {{request('blood') == 'B' ? 'selected' : ''}} value="B">B</option>
                                <option {{request('blood') == 'B+' ? 'selected' : ''}} value="B+">B+</option>
                                <option {{request('blood') == 'AB' ? 'selected' : ''}} value="AB">AB</option>
                                <option {{request('blood') == 'AB+' ? 'selected' : ''}} value="AB+">AB+</option>
                                <option {{request('blood') == 'O' ? 'selected' : ''}} value="O">O</option>
                                <option {{request('blood') == 'O+' ? 'selected' : ''}} value="O+">O+</option>
                            </select>
                        </div>

                        <div class="form-group form-group-sm col-sm-6 col-md-3 col-xl-2 col-lg-2">
                            <label for="-">-</label>
                            <button type="submit" class="btn btn-sm btn-info form-control form-control-sm"><i class="fas fa-search"></i> cari</button>
                        </div>

                    </div>

                    
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                
                <table class="table table-sm table-striped" id="patient-table">
                    <thead>
                        <th>NO</th>
                        <th>Menu</th>
                        <th>NO RM</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl Lahir</th>
                        <th>Usia</th>
                        <th>Jenis Kelamin</th>
                        <th>Full Alamat</th>
                        <th>Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Kota / KAB</th>
                        <th>Provinsi</th>
                        <th>Kartu Identitas</th>
                        <th>BPJS / JKN</th>
                        <th>No TLP/HP</th>
                        <th>Status Nikah</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Kewarganegaraan</th>
                        <th>Bahasa</th>
                        <th>Suku</th>
                        <th>Golongan Darah</th>
                        <th>Author</th>
                        
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
               
            </div>
        </div>
    </div>
</div>


@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('assets/plugins/selectize/selectize.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select_search').selectize({
          sortField: 'text'
        });


        var table = $("#patient-table").DataTable({
            dom: 'Blfrtip',
            buttons: [
                'copy', 'excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A3'
                }, {
                    extend: 'print',
                    orientation: 'landscape'
                }
            ],
            processing: true,
            serverSide: true,
            //responsive: true, 
            autoWidth: false,
            lengthMenu: [25, 30, 50, 100, 200, 500],
            info: true,
            ajax: {
                type: 'GET',
                url: "{!! route('patient.data_json') !!}" ,

            },

            columns: [
                {
                    "targets": 0,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_rm'
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'place_of_birth'
                },
                {
                    data: 'birthDate'
                },
                {
                    data: 'usia'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'full_address'
                },
                {
                    data: 'kelurahan'
                },
                {
                    data: 'kecamatan'
                },
                {
                    data: 'kota'
                },
                {
                    data: 'provinsi'
                },
                {
                    data: 'kartu_identitas'
                },
                {
                    data: 'no_bpjs'
                },
                {
                    data: 'no_tlp'
                },
                {
                    data: 'status_nikah'
                },
                {
                    data: 'agama'
                },
                {
                    data: 'pendidikan'
                },
                {
                    data: 'pekerjaan'
                },
                {
                    data: 'kewarganegaraan'
                },
                {
                    data: 'bahasa'
                },
                {
                    data: 'suku'
                },
                {
                    data: 'blood'
                },
                {
                    data: 'author'
                },
                

                
            ],
            columnDefs: [{
                targets: 6,
                className: 'dt-body-nowrap'
            }, {
                targets: 10,
                className: 'dt-body-nowrap'
            }],
            bAutoWidth: false,

        });




        //----------------------------------------------------------------------------
        
        var id_provinsi = "";
        var id_kota     = "";
        var id_kecamatan= "";
        var id_kelurahan= ""; 
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        var s_kelurahan = $('#address_kelurahan_id').select2({
            allowClear: true,
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kelurahan.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_kecamatan: id_kecamatan
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kelurahan.on('select2:select', function (e) {
            var data = e.params.data;
            id_kelurahan   = data.id;
        });
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        var s_kecamatan = $('#address_kecamatan_id').select2({
            allowClear: true,
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kecamatan.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_kota: id_kota
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kecamatan.on('select2:select', function (e) {
            var data = e.params.data;
            id_kecamatan   = data.id;

            s_kelurahan.val(null).trigger("change"); 
        });
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        var s_kota = $('#address_kota_id').select2({
            allowClear: true,
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kota.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_provinsi: id_provinsi
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kota.on('select2:select', function (e) {
            var data = e.params.data;
            id_kota   = data.id;

            s_kecamatan.val(null).trigger("change");
            s_kelurahan.val(null).trigger("change"); 
        });
        //----------------------------------------------------------------------------


        //----------------------------------------------------------------------------
        var s_provinsi = $('#address_provinsi_id').select2({
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
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_provinsi.on('select2:select', function (e) {
            var data = e.params.data;
            id_provinsi   = data.id;

            s_kota.val(null).trigger("change");
            s_kecamatan.val(null).trigger("change");
            s_kelurahan.val(null).trigger("change"); 
        });
        //----------------------------------------------------------------------------



        

    })
</script>

@endpush


@include('administration.m_float')
@endsection





