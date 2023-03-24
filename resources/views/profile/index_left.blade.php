<div class="col-lg-3 col-xl-3 col-md-3 col-sm-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                @if($data->photo != "")
                <img class="profile-user-img img-fluid img-circle" src="/images/profile/{{$data->photo}}">
                @else
                <img class="profile-user-img img-fluid img-circle"
                    src="{{asset('assets/dist/img/avatar5.png')}}">
                @endif
            </div>

            <h3 class="profile-username text-center">
                {{$data->name}}
            </h3>
            <p class="text-muted text-center">
                {{$data->username}}
            </p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    Email <b class="float-right">{{$data->email}}</b>
                </li>
                <li class="list-group-item">
                    No HP <b class="float-right">{{$data->no_tlp}}</b>
                </li>

                <li class="list-group-item">
                    Status
                    <b class="float-right">
                        @if($data->status == 1)
                        AKTIF
                        @else
                        NON AKTIF
                        @endif
                    </b>
                </li>

                <li class="list-group-item">
                    Roles
                    <b class="float-right">
                        @foreach($data->getRoleNames() as $a)
                        @if ($a == 'admin')
                        <span class="float-right badge bg-danger">{{$a}}</span>
                        @else
                        <span class="float-right badge bg-success">{{$a}}</span>
                        @endif
                        @endforeach
                    </b>
                </li>
            </ul>

            @if(Auth::user()->id == $id || Auth::user()->hasRole('admin'))
            <a href="{{route('profile.edit',$data->id )}}" type="button"
                class="btn btn-block btn-success bg-{{$bg}}">
                <i class="fas fa-user-edit"></i>EDIT
            </a>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
     <!-- Profile Image -->


     <!-- About Me Box -->
    <div class="card card-{{$bg}}">
        <div class="card-header ">
          <h3 class="card-title">About Me</h3>
        </div>
        <div class="card-body">
            <hr>
            <strong><i class="fas fa-phone-alt mr-1"></i> Telecom </strong>
            <p class="text-muted">No HP : {{$data->no_tlp}}</p>
            @foreach ($data->telecom as $item)
            <p class="text-muted">
                {{$item['use']}} : {{$item['value']}}, {{$item['rank']}}
            </p>
            @endforeach

            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
            <p class="text-muted">{{$data->address_alamat}}</p>
            @foreach ($data->address as $item)
            <p class="text-muted">
                {{$item['use']}} : {{$item['type']}}, {{$item['text']}}, {{$item['line']}},
                {{$item['city']}}, {{$item['district']}}, {{$item['state']}}, {{$item['postalCode']}}
                , {{$item['country']}}
            </p>
            @endforeach
            
            <hr>
            <strong><i class="fas fa-comments mr-1"></i> Communication </strong>
            @foreach ($data->communication as $item)
            <p class="text-muted">
                {{$item['text']}}
            </p>
            @endforeach


            <hr>
            <strong><i class="fas fa-info-circle mr-1"></i> Info </strong>
            <p class="text-muted">
                Last Update : {{$data->updated_at}} <br>
                Last Login  : {{$data->last_login_at}}
                @if(Auth::user()->id == $id || Auth::user()->hasRole('admin'))
                <br>
                Last Login IP     : {{$data->last_login_ip}}
                @endif
            </p>


        </div>
      </div>
</div>