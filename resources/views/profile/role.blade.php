@extends('layouts.app')

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
                        <i class="fas fa-user-lock"></i>
                        -
                        Edit Roles
                    </h3>

                </div>
                <div class="card-body">
                   <form action="{{Route('profile.store.role', $data->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" multiple="multiple" name="roles[]" data-dropdown-css-class="select2-purple" data-placeholder="Select a Roles" style="width: 100%;">
                                @foreach ($roles as $item)
                                    <option >{{$item->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('roles'))
                            <span class="help-block">
                                <strong>{{ $errors->first('roles') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block bg-{{$bg}}">Simpan</button>
                   </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>


@push('styles')
    <!-- Select2-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
     
@endpush


@push('scripts')

<script>
    $(function () {
        $('.select2').select2().val({!! $role !!}).trigger('change')
    });
</script>
@endpush
@endsection
