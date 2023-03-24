    @extends('layouts.app')
@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <i class="fas fa-unlock"></i> <b>Admin</b>
    </a>
</li>
@endpush
@section('content')
<div class="">
    <div class="row ">

        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 d-none d-sm-inline-block">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <i class="fas fa-bars"></i>
                        <b>MENU ADMIN</b>
                    </h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @include('admin.menus')
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-xl-10 col-lg-10 col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <b>{{$data->count()}}</b>
                        <i class="fas fa-user-lock"></i>
                        -
                        Daftar Admin
                    </h3>

                    <div class="card-tools">
                        {{ $data->links() }}
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class='table table-hover text-nowrap'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $i=>$item)
                            <tr>
                                <td>{{$i + $data->firstItem() }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($item->id != Auth::user()->id)
                                        <button type="button" class="btn btn-sm btn-warning" onclick="set_non_admin_btn_c(this)" data-id="{{ $item->id }}">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        
                                        <button type="button" onclick="del_btn_c(this)" class="btn btn-sm btn-danger " data-id="{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        @endif

                                    </div>

                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->email}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>
@include('admin.m_float')
@include('admin.scripts')
@endsection
