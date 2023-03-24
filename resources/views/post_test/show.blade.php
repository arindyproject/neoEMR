@extends('layouts.app')
@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@endpush
@section('content')

<div class="container">
    <div class="row ">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}} ">
                    <h3 class="card-title">
                        <b>{{$title}}</b>
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <span class="input-group-append ">
                                <a href="{{Route('post_test.index')}}" class="btn  btn-info"><i
                                        class="far fa-newspaper"></i> All Post</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="text-center">
                        <h3>{{$data->title}}</h3>
                        <p>{{$data->content}}</p>
                        <hr>
                        <b>Author     : {{$data->author->name}}</b>
                        <br>
                        <b>created_at : {{$data->created_at}}</b>
                        <br>
                        <b>Editor     : {{$data->editor_id != '' ? $data->editor->name : '-' }}</b>
                        <br>
                        <b>updated_at : {{$data->updated_at}}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

