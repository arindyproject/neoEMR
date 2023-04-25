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

            <div class="card-body table-responsive p-0">
                
                <table class="table table-sm table-striped">
                    <thead>
                        <th>NO</th>
                        <th>NO RM</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl Lahir</th>
                        <th>Usia</th>
                        <th>Alamat</th>
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
                        <th>Menu</th>
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


@endpush


@include('administration.m_float')
@endsection





