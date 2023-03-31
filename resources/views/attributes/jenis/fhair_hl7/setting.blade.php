@extends('layouts.app')

@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@include('attributes.jenis.menus')
@endpush
@section('content')

<div class="row">
    <!-- ------------------------------------------------ -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title"><i class="fas fa-fire"></i> {{$title}}</h3>
            </div>
            <div class="card-body">
                <form action="{{Route($url_setting)}}" method="POST" class="form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="name" required>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" name="url" class="form-control" id="url" placeholder="url link json" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="text" name="file" class="form-control" id="file" placeholder="file name json" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-block btn-info bg-{{$bg}}">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------ -->


    <!-- ------------------------------------------------ -->
    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title"><i class="fas fa-code"></i> LIST - {{$title}}</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-sm">
                    <thead>
                        <th>Name</th>
                        <th>URL</th>
                        <th>File</th>
                        <th>Menu</th>
                    </thead>
                    <tbody>
                        @foreach ($list as $i=>$item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item['url']}}</td>
                            <td>{{$item['file']}}</td>
                            <td>
                                <a href="{{Route($urls_, $i)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i>
                                    lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------ -->
</div>



@include('attributes.jenis.fhair_hl7.m_float')
@endsection
