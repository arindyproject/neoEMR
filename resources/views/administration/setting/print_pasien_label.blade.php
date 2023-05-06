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
                        <i class="fas fa-id-badge"></i> Template LABEL Pasien
                    </h3>
                </div>

                <div class="card-body">
                    
                    <form action="{{Route('administration.setting.print.pasien.label.store')}}" method="POST">
                        @csrf
                        @foreach($list as $i=>$file)
                        @php
                            $tm = str_replace(".blade.php","",$file->getFilename());
                        @endphp
                        <div class="form-check">
                            <input {{$data == $tm ? 'checked' : ''}}  class="form-check-input" type="radio" name="template" id="{{$tm}}" value="{{$tm}}">
                            <label class="form-check-label" for="{{$tm}}">
                                <h2>
                                    Model-{{$i + 1}} - {{$tm}}
                                @if ($data == $tm)
                                <i class="fas fa-check"></i>
                                @endif
                                </h2> 
                            </label>
                            <div id="pdf-{{ $i }}" ></div>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-block btn-info">Simpan</button>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/plugins/pdfobject/pdfobject.js') }}"></script>

<script>
    var options = {
        height: "800px"
    };
    @foreach($list as $i=>$file)
    PDFObject.embed("{{Route('print.patient.label',[1, str_replace(".blade.php","",$file->getFilename())])}}", "#pdf-{{ $i }}", options);
    @endforeach

</script>
@endpush


@include('administration.m_float')
@endsection
