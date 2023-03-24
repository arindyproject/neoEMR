@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">

        @include('profile.index_left')


        <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        @include('profile.index_menu')
                    </ul>
                </div>
                <div class="card-body table-responsive p-0">
                    @if (Auth::user()->hasRole('admin') || Auth::user()->id == $id)
                    <a href="{{Route('profile.file.create', $id)}}" class="btn btn-sm btn-info"><i class="fas fa-file-import"></i> Uplaod New File</a>
                    @endif
                    <table  class="table table-sm">
                        <thead>
                            <th>no</th>
                            <th>title</th>
                            <th>keterangan</th>
                            <th>is_private</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>menu</th>
                        </thead>
                        <tbody>
                            @foreach ($file as $i=>$item)
                                <tr>
                                    <td>{{$i + $file->firstItem() }}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->ket}}</td>
                                    <td>
                                        @if ($item->is_privat)
                                            <b class="text-danger">PRIVAT</b>
                                        @else
                                            <b class="text-success">PUBLIC</b>
                                        @endif
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td class="btn-group">
                                        <a href="/files/user/{{$item->file}}" class="btn btn-sm btn-success" target="popup"
                                            onclick="window.open('/files/user/{{$item->file}}','popup','width=800,height=1000,scrollbars=no,resizable=no'); return false;"
                                            >
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{Route('profile.file.edit', $item->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        
                                        @if (Auth::user()->hasRole('admin') || Auth::user()->id == $id)
                                        <form action="{{Route('profile.file.delete', $item->id)}}" method="post"
                                            class="delete-submit-form">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger delete-btnd"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection
