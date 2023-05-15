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

<div class="row">
    @include('administration.patient.show_left')

    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
        <div class="card" id="data-patient">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    @include('administration.patient.show_menu')
                </ul>
            </div>
            <div class="card-body p-0">
                <!-- ---------------------------------------------------- -->
                <div class="card">
                    <!-- ---------------------------------------------------- -->
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#ranap" data-toggle="tab"><i class="fas fa-hospital-user"></i> Rawat Inap</a></li>
                            <li class="nav-item"><a class="nav-link" href="#rajal" data-toggle="tab"><i class="fas fa-procedures"></i> Rawat Jalan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#igd" data-toggle="tab"><i class="fas fa-ambulance"></i> IGD</a></li>
                        </ul>
                    </div>
                    <!-- ---------------------------------------------------- -->

                    <!-- ---------------------------------------------------- -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- RANAP---------------------------------------------------- -->
                            <div class="active tab-pane" id="ranap">
                                <form action="" class="form">
                                    <input type="hidden" name="patient_id" value="{{$data->id}}">
                                    <input type="hidden" name="type_kunjungan" value="RAJAL">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-4 col-sm-6">
                                            <div class="form-group">
                                                <label>Tgl Pemeriksaan</label>
                                                <input type="date" name="tgl_pemeriksaan" class="form-control" value="{{$tgl_sekarang}}"  min="{{old('tgl_sekarang')}}">
                                                @if ($errors->has('tgl_pemeriksaan'))
                                                <span class="help-block">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('tgl_pemeriksaan') }}</strong>
                                                </span>
                                                @endif  
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-4 col-sm-6">
                                            <div class="form-group">
                                                <label>Type Kunjungan</label>
                                                <select name="type_kunjungan" id="type_kunjungan"class="form-control">
                                                    @foreach ($type_kunjungan as $item)
                                                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('tgl_pemeriksaan'))
                                                <span class="help-block">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('tgl_pemeriksaan') }}</strong>
                                                </span>
                                                @endif  
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-4 col-sm-6">
                                            <div class="form-group">
                                                <label>Cara Bayar</label>
                                                <select name="payment_id" id="payment_id"class="form-control">
                                                    @foreach ($payment as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('payment_id'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('payment_id') }}</strong>
                                                </span>
                                                @endif  
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-block btn-info">SIMPAN</button>
                                </form>
                            </div>
                            <!-- RANAP---------------------------------------------------- -->

                            <!-- RAJAL---------------------------------------------------- -->
                            <div class="tab-pane" id="rajal">
                                <h1 class="text-center"><i class="fas fa-procedures"></i> Comming soon</h1>
                            </div>
                            <!-- RAJAL---------------------------------------------------- -->

                            <!-- IGD---------------------------------------------------- -->
                            <div class="tab-pane" id="igd">
                                <h1 class="text-center"><i class="fas fa-ambulance"></i> Comming soon</h1>
                            </div>
                            <!-- IGD---------------------------------------------------- -->

                        </div>
                    </div>
                    <!-- ---------------------------------------------------- -->

                </div>
                <!-- ---------------------------------------------------- -->
            </div>
        </div>
    </div>

</div>



@include('administration.m_float')
@endsection
