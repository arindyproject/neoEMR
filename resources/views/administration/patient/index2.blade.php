@extends('layouts.app')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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

            <div class="card">
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


<script>
    $(document).ready(function () {
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

    })
</script>

@endpush


@include('administration.m_float')
@endsection





