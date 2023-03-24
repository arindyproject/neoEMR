@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
<style>
    /* mengatur ukuran canvas tanda tangan  */
    canvas {
        border: 1px solid #ccc;
        border-radius: 0.5rem;
        width: 100%;
        height: 400px;
    }
    .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row ">

        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-bars"></i>
                        <b>USER SETTING </b>
                    </h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @include('profile.menus')
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-signature"></i>
                        -
                        My Signature
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{route('profile.signature.store', $data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="sig" ></div>
                            <br/>
                            
                            <textarea id="signature64" name="signed" style="display: none"></textarea>

                        <div class="row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-primary btn-block bg-{{$bg}}">Simpan</button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-danger btn-block" id="clear">
                                    <span class="fas fa-eraser"></span>
                                    Clear
                                </button>
                            </div>
                        </div>
                        

                    </form>
                    
    
                   
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>

@push('scripts')

<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>


<script>
    // script di dalam ini akan dijalankan pertama kali saat dokumen dimuat
    document.addEventListener('DOMContentLoaded', function () {
        resizeCanvas();
    })

    //script ini berfungsi untuk menyesuaikan tanda tangan dengan ukuran canvas
    function resizeCanvas() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }


    var canvas = document.getElementById('signature-pad');

    //warna dasar signaturepad
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        syncField: '#signature64', 
        syncFormat: 'PNG'
    });

    //saat tombol clear diklik maka akan menghilangkan seluruh tanda tangan
    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
        $("#signature64").val('');
    });



    //saat tombol change color diklik maka akan merubah warna pena
    document.getElementById('change-color').addEventListener('click', function () {
        //jika warna pena biru maka buat menjadi hitam dan sebaliknya
        if(signaturePad.penColor == "rgba(0, 0, 255, 1)"){
            signaturePad.penColor = "rgba(0, 0, 0, 1)";
        }else{
            signaturePad.penColor = "rgba(0, 0, 255, 1)";
        }
    })
</script>
@endpush
@endsection



