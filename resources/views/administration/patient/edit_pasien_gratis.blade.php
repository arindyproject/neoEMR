@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/selectize/selectize.bootstrap3.min.css') }}">
@endpush

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

    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12" id="data-patient">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title">
                    <i class="fab fa-creative-commons-nc"></i> {{$title}}
                </h3>
                <div class="card-tools">
                    <a href="{{Route('patient.show', $data->no_rm)}}" class="btn btn-success btn-sm"><i
                            class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{Route('patient.pasien_gratis', $data->id)}}" class="form form-sm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 col-sm-6">
                            <div class="form-group">
                                <label>IS Gratis</label>
                                <div class="form-control">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_pasien_gratis" required
                                            id="is_pasien_gratis_true" value="1" {{$data->is_pasien_gratis == '1' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="is_pasien_gratis_true">YA, Gratis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_pasien_gratis" required
                                            id="is_pasien_gratis_false" value="0" {{$data->is_pasien_gratis == '0' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="is_pasien_gratis_false">Tidak</label>
                                    </div>
                                </div>
                                @if ($errors->has('is_pasien_gratis'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('is_pasien_gratis') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-4 col-sm-6">
                            <div class="form-group">
                                <label>Alasan Gratis</label>
                                <textarea class="form-control" name="ket_pasien_gratis" id="ket_pasien_gratis" cols="30" rows="4" required>{{$data->ket_pasien_gratis}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-4 col-sm-6">
                            <div class="form-group">
                                <label>-</label>
                                <button type="submit" class="btn btn-info form-control">Simpan</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>


        </div>
    </div>


</div>



@include('administration.m_float')

@endsection
