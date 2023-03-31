@extends('layouts.app')


@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a  class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>

@include('attributes.jenis.menus')
@endpush

@section('content')

<div class="row">
    
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle"></i>
                    <b>EDIT {{$title}}</b>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{Route($url_update, $itm->id)}}" method="POST" class="form form-sm">
                    @csrf
                    @method('PUT')
                    @foreach ($cols as $col)
                        @if ( $col != 'id' && $col != 'user_id' && $col != 'created_at' && $col != 'updated_at')
                        <div class="form-group">
                            <label for="{{$col}}">{{$col}}</label>
                            <input type="text" class="form-control" name="{{$col}}" id="{{$col}}" placeholder="{{$col}}" value="{{$itm->$col}}">

                            @if ($errors->has($col))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first($col) }}</strong>
                            </span>
                            @endif
                        </div>
                        @endif
                    @endforeach
                    <button class="btn btn-block btn-info bg-{{$bg}}" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>


    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
                <h3 class="card-title">
                    <i class="fas fa-table"></i>
                    <b>Table {{$title}}</b>
                </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <span class="input-group-append ">
                            <a href="{{Route($url_index)}}" class="btn  btn-outline-danger"><i class="fas fa-table"></i> ALL Data {{$title}}</a>
                        </span>
                        <span class="input-group-append ">
                            {{ $data->links() }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-sm table-striped">
                    <thead>
                        @foreach ($cols as $col)
                            <th>
                                @if ($col == 'user_id')
                                    Author
                                @else
                                    {{$col}}
                                @endif
                            </th>
                        @endforeach
                        <th>Menu</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                @foreach ($cols as $col)
                                <td>
                                    @if ($col == 'user_id' && $item[$col] != '')
                                        {{ $item->author->name }}
                                    @else
                                        {{$item[$col]}}
                                    @endif
                                </td>
                                @endforeach
                                <td class="btn-group">
                                    <a href="{{Route($url_edit, $item->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                    <form action="{{Route($url_delete, $item->id)}}" method="post"
                                        class="delete-submit-form">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return false" class="btn btn-sm btn-danger delete-btn"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('attributes.jenis.basic.m_float')
@endsection
