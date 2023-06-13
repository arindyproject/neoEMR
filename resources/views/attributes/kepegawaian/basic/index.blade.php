@extends('layouts.app')


@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a  class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>

@include('attributes.kepegawaian.menus')
@endpush

@section('content')

<div class="row">
    
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle"></i>
                    <b>ADD {{$title}}</b>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{Route($url_store)}}" method="POST" class="form form-sm">
                    @csrf

                    @foreach ($cols as $col)
                        @if ( $col != 'id' && $col != 'author_id' && $col != 'edithor_id' && $col != 'created_at' && $col != 'updated_at')
                        <div class="form-group">
                            <label for="{{$col}}">{{$col}}</label>
                            @php
                                if($to_select){
                                    foreach ($to_select as $key=>$item) {
                                        if($col == $key){
                                            $rr = '<select class="form-control" name="'.$col.'" id="'.$col.'" placeholder="'.$col.'"  value="'.old($col).'">';
                                            foreach ($item as $i) {
                                                $rr .= '<option '. (old($col) == $i ? 'selected' : '') .' value="'.$i.'">'.$i.'</option>';
                                            }
                                            $rr .= '</select>';
                                            echo $rr;
                                        }else{
                                            echo '<input type="text" class="form-control" name="'.$col.'" id="'.$col.'" placeholder="'.$col.'"  value="'.old($col).'">';
                                        }
                                    }
                                }else{
                                    echo '<input type="text" class="form-control" name="'.$col.'" id="'.$col.'" placeholder="'.$col.'"  value="'.old($col).'">';
                                }
                            @endphp
                            @if ($errors->has($col))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first($col) }}</strong>
                            </span>
                            @endif
                        </div>
                        @endif
                    @endforeach
                    <button class="btn btn-block btn-info bg-{{$bg}}" type="submit">Simpan</button>
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
                                @php
                                    if ($col == 'author_id'){
                                        echo "Author";
                                    }elseif ($col == 'edithor_id') {
                                        echo "Editor";
                                    }else{
                                        echo $col;
                                    }
                                @endphp
                            </th>
                        @endforeach
                        <th>Menu</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                @foreach ($cols as $col)
                                <td>
                                    @php
                                        if ($col == 'author_id' && $item[$col] != '') {
                                            echo $item->author->name ;
                                        }elseif($col == 'edithor_id' && $item[$col] != ''){
                                            echo $item->edithor->name ;
                                        }else{
                                            echo $item[$col];
                                        }
                                    @endphp
                                </td>
                                @endforeach
                                <td class="btn-group">
                                    <a href="{{Route($url_edit, $item->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                    <a href="{{Route($url_show, $item->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-history"></i></a>
                                    <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{route($url_deleted)}}">deleted_table</a>
            </div>
        </div>
    </div>
</div>
@include('attributes.kepegawaian.basic.modal')
@include('attributes.kepegawaian.m_float')
@endsection
