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
                    <form action="{{Route('post_test.store')}}" method="POST" class="form">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" placeholder="title">
                                @if ($errors->has('title'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">content</label>
                            <div class="col-sm-10">
                                <textarea rows="10" name="content" class="form-control"></textarea>
                                @if ($errors->has('content'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit"
                            class="btn btn-block btn-info bg-{{\App\Models\Config::get()['navbar_variants']}}">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
