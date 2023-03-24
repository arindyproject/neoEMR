@extends('layouts.app')


@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@endpush

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{$title}}</h1>
            </div>
            <div class="col-sm-6">
                <div class="col-md-8 offset-md-4">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control " name="name" value="{{request('name')}}"
                                placeholder="Type your keywords here">
                            <div class="input-group-append">
                                <button type="submit" class="btn  btn-default bg-{{$bg}}">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="content">

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($data as $item)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            {{$item->username}}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{$item->name}}</b></h2>
                                    <p class="text-muted text-sm">
                                        <b>Roles:
                                            @foreach($item->getRoleNames() as $a)
                                            {{$a}},
                                            @endforeach
                                        </b>
                                    </p>

                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span> Address:
                                            {{$item->address_alamat}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: {{$item->no_tlp}}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    @if($item->photo != "")
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="/images/profile/{{$item->photo}}">
                                    @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{asset('assets/dist/img/avatar5.png')}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="{{Route('profile', $item->id)}}" class="btn btn-sm btn-default bg-{{$bg}}">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                {{$data->appends(['name' => request('name')])->links()}}
            </nav>
        </div>

    </div>

</section>
@endsection
