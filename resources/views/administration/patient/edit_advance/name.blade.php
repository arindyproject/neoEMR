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
                    @foreach ($data['name'] as $item)

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="use" class="col-sm-2 col-form-label col-form-label-sm">Use</label>
                                    <div class="col-sm-10">
                                        <select name="use[]" id="use" class="form-control form-control-sm" required>
                                            <option value="" >select item...</option>
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
                                    <label for="period"
                                        class="col-sm-2 col-form-label col-form-label-sm">period</label>
                                    <div class="col-sm-10">
                                        <div class="callout callout-success">
                                            <small>Time period when name was/is in use</small>
                                            <div class="form-group row">
                                                <label for="period_start"
                                                    class="col-sm-3 col-form-label col-form-label-sm">start</label>
                                                <div class="col-sm-9">
                                                    <input
                                                    value="{{@$item['period']['start'] ? $item['period']['start'] : '' }}"
                                                        type="date" class="form-control form-control-sm"
                                                        id="period_start" name="period_start[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="period_start"
                                                    class="col-sm-3 col-form-label col-form-label-sm">end</label>
                                                <div class="col-sm-9">
                                                    <input
                                                        value="{{@$item['period']['end'] ? $item['period']['end'] : '' }}"
                                                        type="date" class="form-control form-control-sm"
                                                        id="iperiod_end" name="period_end[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

    var html = '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">';
        html += '<div class="card"><div class="card-body">';
        //--------------------------------------------------
        
        //use----
        html += '<div class="form-group row">';
        html += '<label for="use" class="col-sm-2 col-form-label col-form-label-sm">Use</label>';
        html += '<div class="col-sm-10">';
        html += '<select name="use[]" id="use" class="form-control form-control-sm" required>';
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
        html += '<input name="text[]" id="text" type="text" class="form-control form-control-sm" required>';
        html += '</div></div>';
        //text----

        //family----
        html += '<div class="form-group row">';
        html += '<label for="family" class="col-sm-2 col-form-label col-form-label-sm">family</label>';
        html += '<div class="col-sm-10">';
        html += '<input name="family[]" id="family" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //family----

        //given----
        html += '<div class="form-group row">';
        html += '<label for="given" class="col-sm-2 col-form-label col-form-label-sm">given</label>';
        html += '<div class="col-sm-10">';
        html += '<input name="given[]" id="given" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //given----

        //prefix----
        html += '<div class="form-group row">';
        html += '<label for="prefix" class="col-sm-2 col-form-label col-form-label-sm">prefix</label>';
        html += '<div class="col-sm-10">';
        html += '<input name="prefix[]" id="prefix" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //prefix----

        //suffix----
        html += '<div class="form-group row">';
        html += '<label for="suffix" class="col-sm-2 col-form-label col-form-label-sm">suffix</label>';
        html += '<div class="col-sm-10">';
        html += '<input name="suffix[]" id="suffix" type="text" class="form-control form-control-sm" >';
        html += '</div></div>';
        //suffix----

        //period----
        html += '<div class="form-group row">';
        html += '<label for="period" class="col-sm-2 col-form-label col-form-label-sm">period</label>';
        html += '<div class="col-sm-10">';
        html += '<div class="callout callout-success">';
        html += '<small>Time period when name was/is in use</small>';
        //start
        html += '<div class="form-group row">';
        html += '<label for="period_start" class="col-sm-3 col-form-label col-form-label-sm">start</label>';
        html += '<div class="col-sm-9">';
        html += '<input name="period_start[]" id="period_start" type="date" class="form-control form-control-sm" >';
        html += '</div></div>';
        //start
        //end
        html += '<div class="form-group row">';
        html += '<label for="period_end" class="col-sm-3 col-form-label col-form-label-sm">end</label>';
        html += '<div class="col-sm-9">';
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
