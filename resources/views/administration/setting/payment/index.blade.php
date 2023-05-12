@extends('layouts.app')

@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@include('administration.menus')
@endpush

@section('content')

<div class="container">
    <div class="row">
        @include('administration.setting.menu')

        <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-money-bill-wave"></i> Payment (Cara Bayar)
                    </h3>
                </div>

                <div class="card-body table-responsive p-0">
                    
                    
                    
                </div>
            </div>
        </div>

    </div>
</div>



@include('administration.m_float')
@endsection
