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

    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
        <div class="card" id="data-patient">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    @include('administration.patient.show_menu')
                </ul>
            </div>
            <div class="card-body p-1">
              
                <!-- ---------------------------------------------------- -->
                @foreach ($history as $item)
                     <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <div class="time-label">
                            @php
                                $is_batal = false;
                                if($tgl_now == $item->tgl_pemeriksaan){
                                    $sts_tgl = 'success';
                                }elseif($tgl_now > $item->tgl_pemeriksaan){
                                    $sts_tgl =  'info';
                                }elseif ($tgl_now < $item->tgl_pemeriksaan) {
                                    $sts_tgl =  'warning';
                                }else {
                                    $sts_tgl = 'danger';
                                }

                                if($item->deleted_at != '' && $item->alasan_menghapus != ''){
                                    $sts_tgl = 'danger';
                                    $is_batal = true;
                                }
                            @endphp
                            <span class="bg-{{$sts_tgl}}">
                              {!! $is_batal ? ' <i class="fas fa-times-circle"></i>' : '' !!} {{$item->tgl_pemeriksaan}}
                            </span>
                        </div>
                        <!-- timeline time label -->

                        <!-- timeline item -->
                        <div>
                            <i class="{{$is_batal ? 'fas fa-times-circle' : 'fas fa-info-circle'}} bg-{{$sts_tgl}}"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header bg-{{$sts_tgl}}"><b>
                                    <i class="fas fa-info-circle"></i> Pendaftaran
                                </b></h3>
      
                                <div class="timeline-body">
                                    <div class="row ">
                                        <!-- 1 ------------------------------------------------------------->
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 table-responsive">
                                            <table class="table table-sm">
                                                <tr valign="top">
                                                    <td>Antrian Admin</td>
                                                    <td>:</td>
                                                    <td><b>{{$item->antrian_urut}}</b></td>
                                                </tr>
                                                <tr valign="top">
                                                    <td>Jenis Layanan</td>
                                                    <td>:</td>
                                                    <td><b>{{$item->type_layanan}}</b></td>
                                                </tr>
                                                <tr valign="top">
                                                    <td>Jenis Kunjungan</td>
                                                    <td>:</td>
                                                    <td><b>{{$item->type_kunjungan}}</b></td>
                                                </tr>
                                               
                                              </table>
                                        </div>
                                        <!-- 1 ------------------------------------------------------------->

                                        <!-- 2 ------------------------------------------------------------->
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 table-responsive">
                                            <table class="table table-sm">
                                                @if ($item->payment_json != '')
                                                @foreach (json_decode($item->payment_json) as $i=>$p)
                                                <tr valign="top">
                                                    <td>{{$i}}</td>
                                                    <td>:</td>
                                                    <td><b>{{$p}}</b></td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </table>
                                        </div>
                                        <!-- 2 ------------------------------------------------------------->

                                        <!-- 2 ------------------------------------------------------------->
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 table-responsive">
                                            <table class="table table-sm">
                                                <tr valign="top">
                                                    <td>Di daftar Oleh</td>
                                                    <td>:</td>
                                                    <td>{{$item->author_id != '' ? $item->author->name : '--'}}</td>
                                                </tr>
                                                <tr valign="top">
                                                    <td>Di daftar Pada</td>
                                                    <td>:</td>
                                                    <td>{{$item->tgl_mendaftar}}</td>
                                                </tr>
                                                <tr valign="top">
                                                    <td>CHECK IN </td>
                                                    <td>:</td>
                                                    <td>{{$item->cekin_at}}</td>
                                                </tr>
                                                @if ($item->created_at != $item->updated_at)
                                                <tr valign="top">
                                                    <td>Di Edit Oleh</td>
                                                    <td>:</td>
                                                    <td>{{$item->edithor_id != '' ? $item->edithor->name : '--'}}</td>
                                                </tr>
                                                <tr valign="top">
                                                    <td>Di Edit Pada</td>
                                                    <td>:</td>
                                                    <td>{{$item->updated_at}}</td>
                                                </tr> 
                                                @endif
                                                @if ($is_batal)
                                                <tr valign="top">
                                                    <td>Di Batalkan Oleh</td>
                                                    <td>:</td>
                                                    <td>{{$item->deleted_by != '' ? $item->deletedBy->name : '--'}}</td>
                                                </tr>
                                                <tr valign="top">
                                                    <td>Di Batalkan Pada</td>
                                                    <td>:</td>
                                                    <td>{{$item->deleted_at}}</td>
                                                </tr>  
                                                <tr valign="top">
                                                    <td>Alasan di Batalkan</td>
                                                    <td>:</td>
                                                    <td>{{$item->alasan_menghapus}}</td>
                                                </tr>  
                                                @endif
                                            </table>
                                        </div>
                                        <!-- 2 ------------------------------------------------------------->
                                    </div>
                                </div>
                                @if ($tgl_now <= $item->tgl_pemeriksaan && !$is_batal)
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-danger btn-sm">Batalkan</a>
                                </div> 
                                @endif
                                
                            </div>
                        </div>
                        <!-- timeline item -->
                    </div>
                    <!-- The timeline -->
                @endforeach
                <!-- ---------------------------------------------------- -->
             
            </div>
        </div>
    </div>

</div>



@include('administration.m_float')
@endsection
