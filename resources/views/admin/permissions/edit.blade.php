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

        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle"></i> Edit Permissions {{$data->name}}
                    </h3>
                </div>
                <div class="card-body ">
                    <form action="{{Route('admin.permissions.update', $data->id)}}" method="POST" class="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name Permissions</label>
                            <input type="text" name="name" class="form-control " id="name" placeholder="name Permissions" required value="{{$data->name}}">
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard Name</label>
                            <input type="text" name="guard_name" class="form-control" id="guard_name" placeholder="guard_name" required
                                value="{{$data->guard_name}}">
                            @if ($errors->has('guard_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('guard_name') }}</strong>
                            </span>
                            @endif
                        </div>

                        

                        <button class="btn btn-block btn-info bg-{{\App\Models\Config::get()['navbar_variants']}}">Update</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        

        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <form action="" method="GET" class="form">
                            <div class="input-group input-group-sm">
                                <label class="form-control"><b><i class="fas fa-key"></i> Permissions - </b></label>
                                <input type="text" name="name" class="form-control" placeholder="Name Permissions" value="{{request('name')}}">
                                <span class="input-group-append ">
                                    <button type="submit" class="btn btn-info btn-flat">Cari!</button>
                                </span>
                            </div>
                        </form>
                    </h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <span class="input-group-append ">
                                <a href="{{Route('admin.permissions')}}" class="btn  btn-info"><i class="fas fa-plus-circle"></i> Permissions Baru</a>
                            </span>
                            <span class="input-group-append ">
                                {{ $permissions->appends(['name' => request('name')])->links() }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class='table table-hover text-nowrap'>
                        <thead>

                            <th>No</th>
                            <th>Nama</th>
                            <th>Roles</th>
                            <th>Opsi</th>

                        </thead>

                        <tbody>
                            @foreach ($permissions as $i=>$item)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @foreach($item->roles as $a)
                                    @if ($a == 'admin')
                                    <span class="float-right badge bg-danger">{{$a->name}} </span>
                                    @else
                                    <span class="float-right badge bg-success">{{$a->name}} </span>
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if ($item->name != 'admin' && $item->name != 'attribute')
                                        <a class="btn btn-sm btn-warning" href="{{Route('admin.permissions.edit', $item->id)}}"><i
                                            class="fas fa-edit"></i></a>
                                        <form action="{{Route('admin.permissions.delete', $item->id)}}" method="post"
                                            class="delete-submit-form">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return false" class="btn btn-sm btn-danger delete-btn"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
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
