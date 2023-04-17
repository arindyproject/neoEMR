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

    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12" id="data-patient">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title">
                    <i class="fas fa-user-edit"></i> {{$title}}
                </h3>
                <div class="card-tools">
                    <a href="{{Route('patient.show', $data->no_rm)}}" class="btn btn-success btn-sm"><i
                            class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
            </div>

            <form action="" class="form form-sm">
                <div class="card-body row">
                    @foreach ($data['name'] as $item)

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="use" class="col-sm-2 col-form-label col-form-label-sm">Use</label>
                                    <div class="col-sm-10">
                                        <select name="use[]" id="use" class="form-control form-control-sm" required>
                                            <option value="">select item...</option>
                                            @foreach ($name_use as $i)
                                            <option {{$item['use'] == $i['code'] ? 'selected' : ''}}
                                                value="{{$i['code']}}">{{$i['display']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="text" class="col-sm-2 col-form-label col-form-label-sm">text</label>
                                    <div class="col-sm-10">
                                        <input value="{{@$item['text'] ? $item['text'] : ''}}" name="text[]" id="text"
                                            type="text" class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="family" class="col-sm-2 col-form-label col-form-label-sm">family</label>
                                    <div class="col-sm-10">
                                        <input value="{{@$item['family'] ? $item['family'] : '' }}" name="family[]"
                                            id="family" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="given" class="col-sm-2 col-form-label col-form-label-sm">given</label>
                                    <div class="col-sm-10">
                                        <input value="{{@$item['given'] ? $item['given'] : '' }}" name="given[]"
                                            id="given" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="prefix" class="col-sm-2 col-form-label col-form-label-sm">prefix</label>
                                    <div class="col-sm-10">
                                        <input value="{{@$item['prefix'] ? $item['prefix'] : '' }}" name="prefix[]"
                                            id="prefix" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="suffix" class="col-sm-2 col-form-label col-form-label-sm">suffix</label>
                                    <div class="col-sm-10">
                                        <input value="{{@$item['suffix'] ? $item['suffix'] : '' }}" name="suffix[]"
                                            id="suffix" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="peroide"
                                        class="col-sm-2 col-form-label col-form-label-sm">peroide</label>
                                    <div class="col-sm-10">
                                        <div class="callout callout-success">
                                            <small>Time period when name was/is in use</small>
                                            <div class="form-group row">
                                                <label for="peroide_start"
                                                    class="col-sm-3 col-form-label col-form-label-sm">start</label>
                                                <div class="col-sm-9">
                                                    <input
                                                        value="{{@$item['peroide']['start'] ? $item['peroide']['start'] : '' }}"
                                                        type="date" class="form-control form-control-sm"
                                                        id="peroide_start" name="peroide_start[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="peroide_start"
                                                    class="col-sm-3 col-form-label col-form-label-sm">end</label>
                                                <div class="col-sm-9">
                                                    <input
                                                        value="{{@$item['peroide']['end'] ? $item['peroide']['end'] : '' }}"
                                                        type="date" class="form-control form-control-sm"
                                                        id="iperoide_end" name="peroide_end[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-sm btn-block btn-outline-danger">hapus</button>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </form>

        </div>
    </div>


</div>



@include('administration.m_float')
@endsection
