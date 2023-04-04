@extends('layouts.app')


@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a  class="nav-link active">
        <b>Attributes Jenis-Jenis</b>
    </a>
</li>

@include('attributes.jenis.menus')
@endpush

@section('content')

<div class="row">
    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card ">
            <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                <h3 class="card-title">
                    <b>Basic</b>
                </h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills">
                    @include('attributes.jenis.menu_basic')
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card ">
            <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                <h3 class="card-title">
                    <i class="fas fa-fire"></i> FHAIR HL7</b>
                </h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills">
                    @include('attributes.jenis.menu_fhair')
                </ul>
            </div>
        </div>
    </div>
    
</div>

@endsection
