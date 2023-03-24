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
                <div class="card-body">
                    
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection
