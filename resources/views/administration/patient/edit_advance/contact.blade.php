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
                    <i class="fas fa-user-edit"></i> {{$title}}
                </h3>
                <div class="card-tools">
                    <a href="{{Route('patient.show', $data->no_rm)}}" class="btn btn-success btn-sm"><i
                            class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
            </div>

            <form method="POST" action="{{Route('patient.update_advance', [$type, $data->id])}}" class="form form-sm">
                @csrf
                @method('PUT')
                <div class="card-body row" id="form-add">
                    @foreach ($data['contact'] as $item)

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">

                            
                                <div class="form-group row">
                                    <label for="contact_relationship" class="col-sm-2 col-form-label col-form-label-sm">relationship</label>
                                    <div class="col-sm-10">
                                        <select name="contact_relationship[]" id="contact_relationship" class="form-control form-control-sm" required>
                                            <option value="" >select item...</option>
                                            @foreach ($contact_relationship as $i)
                                            <option {{@$item['relationship']['code']['code']  ? ($item['relationship']['code']['code'] == $i['code'] ? 'selected' : '') : ''}}
                                                value="{{$i['code']}}">{{$i['code']}} : {{$i['display']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <!-- name-------------------------------------------------- --->
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-2 col-form-label col-form-label-sm">name</label>
                                    <div class="col-sm-10">
                                        <div class="callout callout-success">
                                            
                                            <div class="form-group row">
                                                <label for="contact_name_use" class="col-sm-2 col-form-label col-form-label-sm">Use</label>
                                                <div class="col-sm-10">
                                                    <select name="contact_name_use[]" id="contact_name_use" class="form-control form-control-sm" required>
                                                        <option value="" >select item...</option>
                                                        @foreach ($name_use as $i)
                                                        <option {{$item['name']['use'] == $i['code'] ? 'selected' : ''}}
                                                            value="{{$i['code']}}">{{$i['display']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="text" class="col-sm-2 col-form-label col-form-label-sm">text</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['name']['text'] ? $item['name']['text'] : ''}}" name="contact_name_text[]" id="contact_name_text"
                                                        type="text" class="form-control form-control-sm" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- name-------------------------------------------------- --->


                                <!-- gender-------------------------------------------------- --->
                                <div class="form-group row">
                                    <label for="contact_gender" class="col-sm-2 col-form-label col-form-label-sm">gender</label>
                                    <div class="col-sm-10">
                                        <select name="contact_gender[]" id="contact_gender" class="form-control form-control-sm">
                                            <option value="" >select item...</option>
                                            @foreach ($administrative_gender as $i)
                                            <option {{$item['gender'] == $i['code'] ? 'selected' : ''}}
                                                value="{{$i['code']}}">{{$i['display']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- gender-------------------------------------------------- --->


                                <!-- telecom-------------------------------------------------- --->
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-2 col-form-label col-form-label-sm">telecom</label>
                                    <div class="col-sm-10">
                                        <div class="callout callout-success">
                                            
                                            <div class="form-group row">
                                                <label for="contact_telecom_use" class="col-sm-2 col-form-label col-form-label-sm">Use</label>
                                                <div class="col-sm-10">
                                                    <select name="contact_telecom_use[]" id="contact_telecom_use" class="form-control form-control-sm" required>
                                                        <option value="" >select item...</option>
                                                        @foreach ($telecom_use as $i)
                                                        <option {{$item['telecom']['use'] == $i['code'] ? 'selected' : ''}}
                                                            value="{{$i['code']}}">{{$i['display']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="contact_telecom_system" class="col-sm-2 col-form-label col-form-label-sm">system</label>
                                                <div class="col-sm-10">
                                                    <select name="contact_telecom_system[]" id="contact_telecom_system" class="form-control form-control-sm" required>
                                                        <option value="" >select item...</option>
                                                        @foreach ($telecom_system as $i)
                                                        <option {{$item['telecom']['system'] == $i['code'] ? 'selected' : ''}}
                                                            value="{{$i['code']}}"> {{$i['display']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="text" class="col-sm-2 col-form-label col-form-label-sm">value</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['telecom']['value'] ? $item['telecom']['value'] : ''}}" name="contact_telecom_value[]" id="contact_telecom_value"
                                                        type="text" class="form-control form-control-sm" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- telecom-------------------------------------------------- --->


                                <!-- address-------------------------------------------------- --->
                                <div class="form-group row">
                                    <label for="address"
                                        class="col-sm-2 col-form-label col-form-label-sm">address</label>
                                    <div class="col-sm-10">
                                        <div class="callout callout-success">
                                            
                                            <div class="form-group row">
                                                <label for="contact_address_use" class="col-sm-2 col-form-label col-form-label-sm">Use</label>
                                                <div class="col-sm-10">
                                                    <select name="contact_address_use[]" id="contact_address_use" class="form-control form-control-sm" required>
                                                        <option value="" >select item...</option>
                                                        @foreach ($address_use as $i)
                                                        <option {{$item['address']['use'] == $i['code'] ? 'selected' : ''}}
                                                            value="{{$i['code']}}">{{$i['display']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
            
            
                                            <div class="form-group row">
                                                <label for="type" class="col-sm-2 col-form-label col-form-label-sm">type</label>
                                                <div class="col-sm-10">
                                                    <select name="contact_address_type[]" id="contact_address_type" class="form-control form-control-sm" required>
                                                        <option value="" >select item...</option>
                                                        @foreach ($address_type as $i)
                                                        <option {{$item['address']['type'] == $i['code'] ? 'selected' : ''}}
                                                            value="{{$i['code']}}"> {{$i['display']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="text" class="col-sm-2 col-form-label col-form-label-sm">text</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['address']['text'] ? $item['address']['text'] : '' }}" name="contact_address_text[]" required
                                                        id="contact_address_text" type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>
            
                                            <div class="form-group row">
                                                <label for="line" class="col-sm-2 col-form-label col-form-label-sm">line</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['address']['line'] ? $item['address']['line'] : '' }}" name="contact_address_line[]" 
                                                        id="contact_address_line" type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>
            
                                            <div class="form-group row">
                                                <label for="city" class="col-sm-2 col-form-label col-form-label-sm">city</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['address']['city'] ? $item['address']['city'] : '' }}" name="contact_address_city[]" 
                                                        id="contact_address_city" type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>
            
                                            <div class="form-group row">
                                                <label for="district" class="col-sm-2 col-form-label col-form-label-sm">district</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['address']['district'] ? $item['address']['district'] : '' }}" name="contact_address_district[]" 
                                                        id="contact_address_district" type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>
            
                                            <div class="form-group row">
                                                <label for="state" class="col-sm-2 col-form-label col-form-label-sm">state</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['address']['state'] ? $item['address']['state'] : '' }}" name="contact_address_state[]" 
                                                        id="contact_address_state" type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>
            
                                            <div class="form-group row">
                                                <label for="postalCode" class="col-sm-2 col-form-label col-form-label-sm">postalCode</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['address']['postalCode'] ? $item['address']['postalCode'] : '' }}" name="contact_address_postalCode[]" 
                                                        id="contact_address_postalCode" type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="country" class="col-sm-2 col-form-label col-form-label-sm">country</label>
                                                <div class="col-sm-10">
                                                    <input value="{{@$item['address']['country'] ? $item['address']['country'] : '' }}" name="contact_address_country[]" 
                                                        id="contact_address_country" type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- address-------------------------------------------------- --->


                                <div class="form-group row">
                                    <label for="organization" class="col-sm-3 col-form-label col-form-label-sm">organization</label>
                                    <div class="col-sm-9">
                                        <input value="{{@$item['organization'] ? $item['organization'] : '' }}" name="contact_organization[]" 
                                            id="contact_organization" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                               


                                <!-- period-------------------------------------------------- --->
                                <div class="form-group row">
                                    <label for="period"
                                        class="col-sm-2 col-form-label col-form-label-sm">period</label>
                                    <div class="col-sm-10">
                                        <div class="callout callout-success">
                                            <small>Time period when name was/is in use</small>
                                            <div class="form-group row">
                                                <label for="period_start"
                                                    class="col-sm-2 col-form-label col-form-label-sm">start</label>
                                                <div class="col-sm-10">
                                                    <input
                                                    value="{{@$item['period']['start'] ? $item['period']['start'] : '' }}"
                                                        type="date" class="form-control form-control-sm"
                                                        id="period_start" name="period_start[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="period_start"
                                                    class="col-sm-2 col-form-label col-form-label-sm">end</label>
                                                <div class="col-sm-10">
                                                    <input
                                                        value="{{@$item['period']['end'] ? $item['period']['end'] : '' }}"
                                                        type="date" class="form-control form-control-sm"
                                                        id="iperiod_end" name="period_end[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- period-------------------------------------------------- --->

                                <button class="btn btn-sm btn-block btn-outline-danger btn-remove">hapus</button>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>

                <div class="card-footer ">
                    <div class="btn-group ">
                        <a href="{{Route('patient.show', $data->no_rm)}}" class="btn btn-warning"><i
                            class="fas fa-arrow-circle-left"></i> Kembali</a>
                        <button type="button" class="btn btn-info btn-add"><i class="fas fa-plus-circle"></i> Tambah Item</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


</div>



@include('administration.m_float')
@push('scripts')
<script src="{{ asset('assets/plugins/selectize/selectize.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('select').selectize({
      sortField: 'text'
    });

    var add     = $(".btn-add");
    var form    = $('#form-add');
    var x       = 1;

    var html = '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">';
        html += '<div class="card"><div class="card-body">';
        //--------------------------------------------------
        
        //contact_relationship----
        html += '<div class="form-group row">';
        html += '<label for="contact_relationship" class="col-sm-2 col-form-label col-form-label-sm">relationship</label>';
        html += '<div class="col-sm-10">';
        html += '<select name="contact_relationship[]" id="contact_relationship" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($contact_relationship as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['code'] !!} : {!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //contact_relationship----

        //name-------------------------------------------
        html += '<div class="form-group row">';
        html += '<label for="name" class="col-sm-2 col-form-label col-form-label-sm">name</label>';
        html += '<div class="col-sm-10">';
        html += '<div class="callout callout-success">';
        
        //use----
        html += '<div class="form-group row">';
        html += '<label for="use" class="col-sm-2 col-form-label col-form-label-sm">Use</label>';
        html += '<div class="col-sm-10">';
        html += '<select name="contact_name_use[]" id="contact_name_use" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($name_use as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //use----

        //text----
        html += '<div class="form-group row">';
        html += '<label for="text" class="col-sm-2 col-form-label col-form-label-sm">text</label>';
        html += '<div class="col-sm-10">';
        html += '<input name="contact_name_text[]" id="contact_name_text" type="text" class="form-control form-control-sm" required>';
        html += '</div></div>';
        //text----

        html += '</div>';
        html += '</div></div>';
        //name-------------------------------------------


        //gender-------------------------------------------
        html += '<div class="form-group row">';
        html += '<label for="contact_gender" class="col-sm-2 col-form-label col-form-label-sm">gender</label>';
        html += '<div class="col-sm-10">';
        html += '<select name="contact_gender[]" id="contact_gender" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($administrative_gender as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //gender-------------------------------------------


        //telecom-------------------------------------------
        html += '<div class="form-group row">';
        html += '<label for="telecom" class="col-sm-2 col-form-label col-form-label-sm">telecom</label>';
        html += '<div class="col-sm-10">';
        html += '<div class="callout callout-success">';
        
        //use----
        html += '<div class="form-group row">';
        html += '<label for="use" class="col-sm-3 col-form-label col-form-label-sm">Use</label>';
        html += '<div class="col-sm-9">';
        html += '<select name="contact_telecom_use[]" id="contact_telecom_use" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($telecom_use as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //use----

        //system----
        html += '<div class="form-group row">';
        html += '<label for="system" class="col-sm-3 col-form-label col-form-label-sm">system</label>';
        html += '<div class="col-sm-9">';
        html += '<select name="contact_telecom_system[]" id="contact_telecom_system" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($telecom_system as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //system----

        //value----
        html += '<div class="form-group row">';
        html += '<label for="value" class="col-sm-3 col-form-label col-form-label-sm">value</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_telecom_value[]" id="contact_telecom_value" type="text" class="form-control form-control-sm" required>';
        html += '</div></div>';
        //value----

        html += '</div>';
        html += '</div></div>';
        //telecom-------------------------------------------


        //address-------------------------------------------
        html += '<div class="form-group row">';
        html += '<label for="address" class="col-sm-2 col-form-label col-form-label-sm">address</label>';
        html += '<div class="col-sm-10">';
        html += '<div class="callout callout-success">';
        
        //use----
        html += '<div class="form-group row">';
        html += '<label for="use" class="col-sm-3 col-form-label col-form-label-sm">Use</label>';
        html += '<div class="col-sm-9">';
        html += '<select name="contact_address_use[]" id="contact_address_use" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($address_use as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //use----

        //type----
        html += '<div class="form-group row">';
        html += '<label for="type" class="col-sm-3 col-form-label col-form-label-sm">type</label>';
        html += '<div class="col-sm-9">';
        html += '<select name="contact_address_type[]" id="contact_address_type" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($address_type as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //type----

        //text----
        html += '<div class="form-group row">';
        html += '<label for="text" class="col-sm-3 col-form-label col-form-label-sm">text</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_address_text[]" id="contact_address_text" type="text" class="form-control form-control-sm" required>';
        html += '</div></div>';
        //text----

        //line----
        html += '<div class="form-group row">';
        html += '<label for="line" class="col-sm-3 col-form-label col-form-label-sm">line</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_address_line[]" id="contact_address_line" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //line----

        //city----
        html += '<div class="form-group row">';
        html += '<label for="city" class="col-sm-3 col-form-label col-form-label-sm">city</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_address_city[]" id="contact_address_city" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //city----

        //district----
        html += '<div class="form-group row">';
        html += '<label for="district" class="col-sm-3 col-form-label col-form-label-sm">district</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_address_district[]" id="contact_address_district" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //district----


        //state----
        html += '<div class="form-group row">';
        html += '<label for="state" class="col-sm-3 col-form-label col-form-label-sm">state</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_address_state[]" id="contact_address_state" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //state----

        //postalCode----
        html += '<div class="form-group row">';
        html += '<label for="postalCode" class="col-sm-3 col-form-label col-form-label-sm">postalCode</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_address_postalCode[]" id="contact_address_postalCode" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //postalCode----


        //country----
        html += '<div class="form-group row">';
        html += '<label for="country" class="col-sm-3 col-form-label col-form-label-sm">country</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_address_country[]" id="contact_address_country" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //country----

        html += '</div>';
        html += '</div></div>';
        //address-------------------------------------------

        

        //organization----
        html += '<div class="form-group row">';
        html += '<label for="organization" class="col-sm-3 col-form-label col-form-label-sm">organization</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="contact_organization[]" id="contact_organization" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //organization----

        
        

        //period----
        html += '<div class="form-group row">';
        html += '<label for="period" class="col-sm-2 col-form-label col-form-label-sm">period</label>';
        html += '<div class="col-sm-10">';
        html += '<div class="callout callout-success">';
        html += '<small>Time period when name was/is in use</small>';
        //start
        html += '<div class="form-group row">';
        html += '<label for="period_start" class="col-sm-2 col-form-label col-form-label-sm">start</label>';
        html += '<div class="col-sm-10">';
        html += '<input name="period_start[]" id="period_start" type="date" class="form-control form-control-sm" >';
        html += '</div></div>';
        //start
        //end
        html += '<div class="form-group row">';
        html += '<label for="period_end" class="col-sm-2 col-form-label col-form-label-sm">end</label>';
        html += '<div class="col-sm-10">';
        html += '<input name="period_end[]" id="period_end" type="date" class="form-control form-control-sm" >';
        html += '</div></div>';
        //end
        html += '</div>';
        html += '</div></div>';
        //period----

        //--------------------------------------------------
        html += '<button class="btn btn-sm btn-block btn-outline-danger btn-remove">hapus</button>';
        html += '</div></div></div>';
    $(add).click(function(e) {
        e.preventDefault();
        $(form).append(html); //add input box
        $('select').selectize({
            sortField: 'text'
        });
    });
    $(form).on("click", ".btn-remove", function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure ?',
            text: "apakah anda yakin menghapus item ini?? ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent('div').remove();
                x--;
            }
        });
    });

})
</script>
@endpush
@endsection
