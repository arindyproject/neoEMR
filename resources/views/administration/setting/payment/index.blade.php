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
            
            <div class="card collapsed-card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle"></i> Add New Payment (Cara Bayar)
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-2">
                    <form action="" method="POST" class="form form-sm">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input value="{{old('code')}}" type="text" name="code"
                                        class="form-control form-control-sm" required placeholder="code payment">
                                    @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="{{old('name')}}" type="text" name="name"
                                        class="form-control form-control-sm" required
                                        placeholder="nama payment / cara bayar">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type" id="type" class="form-control form-control-sm" required>
                                        <option value="">pilih ...</option>
                                        <option {{old('type') == 'TUNAI' ? 'selected' : '' }} value="TUNAI">TUNAI
                                        </option>
                                        <option {{old('type') == 'BPJS' ? 'selected' : '' }} value="BPJS">BPJS</option>
                                        <option {{old('type') == 'ASURANSI' ? 'selected' : '' }} value="ASURANSI">
                                            ASURANSI</option>
                                        <option {{old('type') == 'GRATIS' ? 'selected' : '' }} value="GRATIS">GRATIS
                                        </option>
                                    </select>
                                    @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="ket" id="" cols="30" rows="2" class="form-control form-control-sm"
                                        required>{{old('ket')}}</textarea>
                                    @if ($errors->has('ket'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('ket') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" onclick="if (!confirm('Apakah Anda Yakin??')) { return false }"
                            class="btn btn-sm btn-info btn-block"><b><i class="fas fa-save"></i> SIMPAN</b></button>
                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-money-bill-wave"></i> Payment (Cara Bayar)
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-sm">
                        <thead>
                            <th>No</th>
                            <th>Code</th>
                            <th>Nama</th>
                            <th>Type</th>
                            <th>Keterangan</th>
                            <th>Author</th>
                            <th>Editor</th>
                            <th>Menu</th>
                        </thead>
                        <tbody>
                            @foreach ($data_aktif as $i=>$item)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->ket}}</td>
                                <td>
                                    {{$item->author_id != '' ? $item->author->name : '-' }} <br>
                                    {{$item->created_at}}
                                </td>
                                <td>
                                    {{$item->edithor_id != '' ? $item->edithor->name : '-' }} <br>
                                    {{$item->created_at != $item->updated_at ? $item->updated_at : ''}}
                                </td>
                                <td class="btn-group">
                                    <a href="{{Route('administration.setting.payment.edit', $item->id)}}"
                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <button data-name="{{$item->name}}" data-id="{{$item->id}}"
                                        class="btn btn-sm btn-danger btn-edit"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="card collapsed-card">
                <div class="card-header bg-danger">
                    <h3 class="card-title">
                        <i class="fas fa-trash-alt"></i> Payment (Cara Bayar) deleted
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-sm">
                        <thead>
                            <th>No</th>
                            <th>Code</th>
                            <th>Nama</th>
                            <th>Type</th>
                            <th>Keterangan</th>
                            <th>Author</th>
                            <th>Editor</th>
                            <th>Deleted</th>
                        </thead>
                        <tbody>
                            @foreach ($data_off as $i=>$item)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->ket}}</td>
                                <td>
                                    {{$item->author_id != '' ? $item->author->name : '-' }} <br>
                                    {{$item->created_at}}
                                </td>
                                <td>
                                    {{$item->edithor_id != '' ? $item->edithor->name : '-' }} <br>
                                    {{$item->created_at != $item->updated_at ? $item->updated_at : ''}}
                                </td>
                                <td>
                                    {{$item->deleted_by != '' ? $item->deletedBy->name : '-' }} <br>
                                    {{$item->deleted_at }}
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>



@include('administration.m_float')

@push('scripts')
<script>
    $('.btn-edit').click(function () {
        const id = $(this).data('id');
        const name = $(this).data('name');

        // Menampilkan SweetAlert2 untuk konfirmasi edit
        Swal.fire({
            title: 'Hapus Data!!',
            icon: 'question',
            html: `Alasan di hapus data ( ${name} ) <input id="swal-input-ket" class="swal2-input" value="" required>`,
            confirmButtonText: 'OK, hapus!!',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            preConfirm: () => {
                // Mengambil nilai input dari SweetAlert2
                const ket = $('#swal-input-ket').val();
                if (ket) {
                    let token = "{{ csrf_token() }}";

                    $.ajax({
                        url: `/administration/setting/payment/delete/${id}`,
                        type: 'PUT',
                        method: 'PUT',
                        data: {
                            "_token": token,
                            "ket": ket
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Berhasil diDelete',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload(true);
                                    }
                                })
                                
                            } else {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat mengupload data',
                                    'error');
                            }

                        },
                        error: function (xhr) {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat mengedit data',
                                'error');
                        }
                    });
                } else {
                    Swal.showValidationMessage('Alasan tidak boleh kosong');
                }

            }
        });
    });

</script>
@endpush
@endsection
