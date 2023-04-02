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
                        <i class="fas fa-plus-circle"></i> Buat Roles Baru
                    </h3>
                </div>
                <div class="card-body ">
                    <form action="{{Route('admin.roles.store')}}" method="POST" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name Roles</label>
                            <input type="text" name="name" class="form-control " id="name" placeholder="name roles" required>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard Name</label>
                            <input type="text" name="guard_name" class="form-control" id="guard_name" placeholder="guard_name" required
                                value="web">
                            @if ($errors->has('guard_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('guard_name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="permissions">Permission</label>
                            <select name="permissions[]" multiple="multiple" id="permissions" class="form-control select2-role">
                                <option value="">---</option>
                                @foreach($permissions as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('permissions'))
                            <span class="help-block">
                                <strong>{{ $errors->first('permissions') }}</strong>
                            </span>
                            @endif
                        </div>

                        <button class="btn btn-block btn-info bg-{{\App\Models\Config::get()['navbar_variants']}}" >Simpan</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>


        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">

                        <i class="fas fa-unlock-alt"></i>
                        -
                        Roles
                    </h3>

                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class='table table-hover text-nowrap'>
                        <thead>

                            <th>No</th>
                            <th>Nama</th>
                            <th>Permission</th>
                            <th>Users</th>
                            <th>Opsi</th>

                        </thead>

                        <tbody>
                            @foreach ($roles as $i=>$item)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @foreach($item->permissions as $a)
                                    @if ($a == 'admin')
                                    <span class="float-right badge bg-danger">{{$a->name}} </span>
                                    @else
                                    <span class="float-right badge bg-success">{{$a->name}} </span>
                                    @endif
                                    @endforeach
                                </td>
                                <td><a class="btn btn-sm btn-success" target="_blank"
                                        href="{{Route('admin.list_aktif')}}?role={{$item->name}}">{{$item->users_count}}</a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if ($item->name != 'admin' && $item->name != 'attribute')
                                        <a class="btn btn-sm btn-warning" href="{{Route('admin.roles.edit', $item->id)}}"><i
                                            class="fas fa-edit"></i></a>
                                        <form action="{{Route('admin.roles.delete', $item->id)}}" method="post"
                                            class="delete-submit-forms">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return ConfirmDelete();" class="btn btn-sm btn-danger delete-btns"><i
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
@push('scripts')
    <script>
        $(function () {
            $('.select2-role').select2()

            
        });
    </script>
@endpush
@endsection
