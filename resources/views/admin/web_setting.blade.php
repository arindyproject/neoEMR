@extends('layouts.app')
@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <i class="fas fa-unlock"></i> <b>Admin</b>
    </a>
</li>
@endpush
@section('content')
<div class="">
    <div class="row ">

        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 d-none d-sm-inline-block">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <i class="fas fa-bars"></i>
                        <b>MENU ADMIN</b>
                    </h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @include('admin.menus')
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-xl-10 col-lg-10 col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}}">
                    <h3 class="card-title">
                        <i class="fas fa-tools"></i>
                        -
                        WEB Setting
                    </h3>


                </div>
                <div class="card-body ">
                    <form action="{{ route('admin.web_setting_submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nama WEB"
                                    required value="{{$data['name']}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tag_line" class="col-sm-2 col-form-label">Tag Line</label>
                            <div class="col-sm-10">
                                <input name="tag_line" type="text" class="form-control" id="tag_line" placeholder="tag_line"
                                    required value="{{$data['tag_line']}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input name="email" type="text" class="form-control" id="email" placeholder="email"
                                    required value="{{$data['email']}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_tlp" class="col-sm-2 col-form-label">No Tlp</label>
                            <div class="col-sm-10">
                                <input name="no_tlp" type="text" class="form-control" id="no_tlp" placeholder="no_tlp"
                                    required value="{{$data['no_tlp']}}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea required name="alamat"  class="form-control" id="alamat" cols="3" rows="2">{{$data['alamat']}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dark_mode" class="col-sm-2 col-form-label">Dark Mode</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="dark_mode" >
                                    <option value="0" {{$data['dark_mode'] == '0' ? 'selected' : ''}}>Non Aktif</option>
                                    <option value="1" {{$data['dark_mode'] == '1' ? 'selected' : ''}}>Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="navbar_variants" class="col-sm-2 col-form-label">Navbar Variants</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="navbar_variants" >
                                    <option value="white" {{$data['navbar_variants'] == 'white' ? 'selected' : ''}}>None</option>
                                    <option value="primary" {{$data['navbar_variants'] == 'primary' ? 'selected' : ''}}>primary</option>
                                    <option value="secondary" {{$data['navbar_variants'] == 'secondary' ? 'selected' : ''}}>secondary</option>
                                    <option value="info" {{$data['navbar_variants'] == 'info' ? 'selected' : ''}}>info</option>
                                    <option value="success" {{$data['navbar_variants'] == 'success' ? 'selected' : ''}}>success</option>
                                    <option value="danger" {{$data['navbar_variants'] == 'danger' ? 'selected' : ''}}>danger</option>
                                    <option value="indigo" {{$data['navbar_variants'] == 'indigo' ? 'selected' : ''}}>indigo</option>
                                    <option value="purple" {{$data['navbar_variants'] == 'purple' ? 'selected' : ''}}>purple</option>
                                    <option value="pink" {{$data['navbar_variants'] == 'pink' ? 'selected' : ''}}>pink</option>
                                    <option value="navy" {{$data['navbar_variants'] == 'navy' ? 'selected' : ''}}>navy</option>
                                    <option value="lightblue" {{$data['navbar_variants'] == 'lightblue' ? 'selected' : ''}}>lightblue</option>
                                    <option value="teal" {{$data['navbar_variants'] == 'teal' ? 'selected' : ''}}>teal</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="navbar_fixed" class="col-sm-2 col-form-label">Navbar Fixed</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="navbar_fixed" >
                                    <option value="0" {{$data['navbar_fixed'] == '0' ? 'selected' : ''}}>Non Aktif</option>
                                    <option value="1" {{$data['navbar_fixed'] == '1' ? 'selected' : ''}}>Aktif</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="footer" class="col-sm-2 col-form-label">Footer</label>
                            <div class="col-sm-10">
                                <select class="form-control"  name="footer" >
                                    <option value="0" {{$data['footer'] == '0' ? 'selected' : ''}}>Non Aktif</option>
                                    <option value="1" {{$data['footer'] == '1' ? 'selected' : ''}}>Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pop_up" class="col-sm-2 col-form-label">Pop Up</label>
                            <div class="col-sm-10">
                                <select class="form-control"  name="pop_up" >
                                    <option value="0" {{$data['pop_up'] == '0' ? 'selected' : ''}}>Non Aktif</option>
                                    <option value="1" {{$data['pop_up'] == '1' ? 'selected' : ''}}>Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon_mini" class="col-sm-2 col-form-label">Icon Mini (128x128)</label>
                            <div class="col-sm-10">
                                <input name="icon_mini" type="file" class="form-control" id="icon_mini" value="{{$data['icon_mini']}}">
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon_medium" class="col-sm-2 col-form-label">Icon Medium</label>
                            <div class="col-sm-10">
                                <input name="icon_medium" type="file" class="form-control" id="icon_medium">
                               
                            </div>
                        </div>





                        <button type="submit" class="btn btn-primary btn-block bg-{{\App\Models\Config::get()['navbar_variants']}}">Simpan</button>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>
@include('admin.m_float')
@include('admin.scripts')
@endsection
