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
    
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    <b>Detail {{{$title}}}</b>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        @foreach ($cols as $col)
                            <tr>
                                <td>{{$col}}</td>
                                <td>:</td>
                                <td>
                                    @php
                                        if ($col == 'author_id' && $data[$col] != '') {
                                            echo $data->author->name ;
                                        }elseif($col == 'edithor_id' && $data[$col] != ''){
                                            echo $data->edithor->name ;
                                        }else{
                                            echo $data[$col];
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <h6><b>Riwayat</b></h6>
                @if ($data->log == '')
                    <p>KOSONG</p>
                @else
                @foreach (json_decode($data->log ) as $a=>$item)
                <b>KE : {{$a + 1 }}</b>
                <table class="table table-sm">
                    <tbody>
                        @foreach ($item as $i=>$j)
                            <tr>
                                <td>{{$i}}</td>
                                <td>:</td>
                                <td>{{$j}}</td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
                <hr>
                @endforeach
                
                @endif
            </div>
        </div>
    </div>


    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}} ">
                <h3 class="card-title">
                    <b>{{$title_2}}</b>
                </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <span class="input-group-append ">
                            <a href="{{Route($url_index)}}" class="btn  btn-outline-danger"><i class="fas fa-table"></i> ALL Data {{$title}}</a>
                        </span>
                        
                        <span class="input-group-append ">
                            {{ $users->links() }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-sm">
                    <thead>
                        <th>No</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Menu</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $i=>$item)
                            <tr>
                                <td>{{$users->firstItem() + $i}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td><a class="btn btn-sm btn-info" href="{{route('profile', $item->id)}}">Detail <i class="fas fa-arrow-circle-right"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('attributes.kepegawaian.m_float')
@endsection
