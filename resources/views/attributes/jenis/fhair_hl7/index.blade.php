@extends('layouts.app')

@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@include('attributes.jenis.menus')
@endpush
@section('content')

<div class="row">
    <!-- ------------------------------------------------ -->
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title"><i class="fas fa-fire"></i> {{$title}}</h3>
            </div>
            <div class="card-body">
                <form action="{{Route($url_name_use)}}" method="POST" class="form ">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                        </div>
                        <input type="text" class="form-control" name="url" value="{{$data['url']}}">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i> save url</button>
                            <button type="button" class="btn btn-success btn-flat"><i class="fas fa-file-download"></i> download</button>
                        </span>
                    </div>
                </form>

                @if ($json != '' && $json['text']['div'] != '')
                    <div class="p-4">
                        {!! $json['text']['div'] !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------ -->


    <!-- ------------------------------------------------ -->
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header bg-{{$bg}}">
                <h3 class="card-title"><i class="fas fa-code"></i> JSON - {{$title}}</h3>
            </div>
            <div class="card-body">
                <textarea id="json-input" autocomplete="off" hidden>
                    {{json_encode($json)}}
                </textarea>

                <pre id="json-display"></pre>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------ -->
</div>

@push('scripts')
<script src="{{ asset('assets/plugins/Beautiful-JSON-Viewer-Editor/dist/jquery.json-editor.min.js') }}"></script>
<script type="text/javascript">
    function getJson() {
        try {
            return JSON.parse($('#json-input').val());
        } catch (ex) {
            alert('Wrong JSON Format: ' + ex);
        }
    }

    var editor = new JsonEditor('#json-display', getJson());
    $('#translate').on('click', function () {
        editor.load(getJson());
    });
</script>
@endpush

@include('attributes.jenis.fhair_hl7.m_float')
@endsection
