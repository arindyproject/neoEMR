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
    
    

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
                <h3 class="card-title">
                    <i class="fas fa-table"></i>
                    <b>Deleted Table {{$title}}</b>
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
                                        }elseif($col == 'deleted_by' && $item[$col] != ''){
                                            echo $item->deletedBy->name ;
                                        }else{
                                            echo $item[$col];
                                        }
                                    @endphp
                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('attributes.kepegawaian.basic.modal')
@include('attributes.kepegawaian.m_float')
@endsection
