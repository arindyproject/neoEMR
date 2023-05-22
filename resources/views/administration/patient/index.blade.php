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

                <div class="card-tools">
                    <form action="" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="q" class="form-control" placeholder="nama / nomor RM" value="{{request('q')}}">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info btn-flat">Cari!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-sm table-striped">
                    <thead>
                        <th>NO</th>
                        <th>NO RM</th>
                        <th>Nama Lengkap</th>
                        <th>Tgl Lahir</th>
                        <th>Usia</th>
                        <th>Alamat</th>
                        <th>Kartu Identitas</th>
                        <th>BPJS / JKN</th>
                        <th>No TLP/HP</th>
                        <th>Menu</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $i=>$item)
                        <tr>
                            <td>{{$i + $data->firstItem() }}</td>
                            <td>{{$item->no_rm}}</td>
                            <td>{{$item->full_name}}</td>
                            <td>{{$item->birthDate}}</td>
                            <td>{{$item->usia()}}</td>
                            <td>
                                {{$item->address_alamat}},
                                {{$item->address_kelurahan_id   != '' ? $item->kelurahan->nama : ''}},
                                {{$item->address_kecamatan_id   != '' ? $item->kecamatan->nama : ''}},
                                {{$item->address_kota_id        != '' ? $item->kota->nama : ''}},
                                {{$item->address_provinsi_id    != '' ? $item->provinsi->nama : ''}}
                            </td>
                            <td>
                                {{$item->identity_type_id != '' ? $item->identityType->nama : ''}}:
                                {{$item->identity_number}}
                            </td>
                            <td>{{$item->no_bpjs}}</td>
                            <td>{{$item->no_tlp}}</td>
                            <td class="btn-group">
                                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('administration'))
                                @if ($item->active)
                                <a href="{{Route('administration.pendaftaran', $item->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-plus-circle"></i> Daftarkan</a>
                                @else   
                                <button disabled class="btn btn-sm btn-outline-danger"><b class="text-danger"><i class="fas fa-power-off"></i> No Active</b></button>
                                @endif
                                @endif
                                <a href="{{Route('patient.show', $item->no_rm)}}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                                <a href="{{Route('patient.history', $item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-history"></i> History</a>
                            </td>
                            </td>
                            @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>



@include('administration.m_float')
@endsection
