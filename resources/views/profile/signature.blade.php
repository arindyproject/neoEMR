@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@push('styles')
<style>
    /* mengatur ukuran canvas tanda tangan  */
    canvas {
        border: 1px solid #ccc;
        border-radius: 0.5rem;
        width: 100%;
        height: 300px;
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
                <div class="card-body ">

                    <div class="row">

                        <div class="col-12">
                            @if($data->signature != '')
                            <img id='show-ttd' src="{!! $data->signature !!}"
                                class="img-thumbnail rounded mx-auto d-block">
                            @endif
                        </div>

                        <div class="col-12">
                            <form action="">
                                <canvas id="signature-pad" class="signature-pad"></canvas>
                                <div class="row">
                                    <div class="col-9">
                                        <button type="button" id="btn-submit"
                                            class="btn btn-primary btn-block bg-{{$bg}}">Simpan</button>
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

                    </div>

                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/plugins/signature_pad/signature_pad.min.js') }}"></script>
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

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });

    $(document).on('click', '#btn-submit', function () {
        Swal.fire({
            title: 'Are you sure ?',
            text: "apakah anda yakin menyimpan tanda tangan ini?? ",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                var signature = signaturePad.toDataURL();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('profile.signature.store', $data->id)}}",
                    type: 'PUT',
                    data: {
                        signature: signature,
                    },
                    success: function (data) {
                        console.log(data)
                        $('#show-ttd').attr("src", data.signature);
                        if (data.status) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil di Update'
                            })
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Gagal di Update'
                            })
                        }
                    },
                    error: function () {
                        Toast.fire({
                            icon: 'error',
                            title: 'Terjadi ERROR!!'
                        })
                    }
                });
            }
        });    
    });

</script>
@endpush
@endsection
