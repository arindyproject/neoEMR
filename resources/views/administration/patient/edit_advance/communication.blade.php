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
                    @if(@$data['communication'])
                    @foreach ($data['communication'] as $item)

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="language" class="col-sm-3 col-form-label col-form-label-sm">language</label>
                                    <div class="col-sm-9">
                                        <select name="language[]" id="language" class="form-control form-control-sm" required>
                                            <option value="" >select item...</option>
                                            @foreach ($valueset_languages as $i)
                                            <option {{ @$item['language']['code']['code'] ?  ($item['language']['code']['code'] == $i['code']? 'selected' : '') : ''}} 
                                                value="{{$i['code']}}">{{$i['display']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-sm btn-block btn-outline-danger btn-remove">hapus</button>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endif
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
        
        //language----
        html += '<div class="form-group row">';
        html += '<label for="use" class="col-sm-3 col-form-label col-form-label-sm">language</label>';
        html += '<div class="col-sm-9">';
        html += '<select name="language[]" id="language" class="form-control form-control-sm" required>';
        html += '<option value="" >select item...</option>';
        @foreach ($valueset_languages as $i)
        html += '<option value="{!! $i['code'] !!}">{!! $i['display'] !!}</option>';
        @endforeach
        html += '</select>';
        html += '</div></div>';
        //language----



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
