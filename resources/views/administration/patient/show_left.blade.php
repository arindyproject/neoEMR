<div class="col-lg-3 col-xl-3 col-md-3 col-sm-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                @if($data->photo != "")
                <img class="profile-user-img img-fluid img-circle" src="/images/profile/{{$data->photo}}">
                @endif
            </div>

            <h3 class="profile-username text-center">
                {{$data->full_name}}
            </h3>
            <p class="text-muted text-center">
                {{$data->no_rm}}
            </p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    {{$data->identity_type_id != '' ? $data->identityType->nama : ''}} <b class="float-right">{{$data->identity_number}}</b>
                </li>
                <li class="list-group-item">
                    No HP/TLP <b class="float-right">{{$data->no_tlp}}</b>
                </li>
                <li class="list-group-item">
                    BPJS/JKN <b class="float-right">{{$data->no_bpjs}}</b>
                </li>

                <li class="list-group-item">
                    Status
                    <b class="float-right">
                        @if($data->active == 1)
                        <i class="text-success">AKTIF</i>
                        @else
                        <i class="text-danger">NON AKTIF</i>
                        @endif
                    </b>
                </li>

            </ul>

            @if(Auth::user()->hasRole('admin'))
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
          <h3 class="card-title">About Patient</h3>
        </div>
        <div class="card-body">
            <hr>
            <strong><i class="fas fa-phone-alt mr-1"></i> Telecom </strong>
            <p class="text-muted">No HP :</p>
            @if ($data->telecom != '')
            @foreach ($data->telecom as $item)
            <p class="text-muted">
                {{$item['use']}} : {{$item['value']}}, {{$item['rank']}}
            </p>
            @endforeach
            @endif
            

            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
            <p class="text-muted">
                {{$data->address_alamat}}
                {{$data->address_kelurahan_id   != '' ? $data->keluarahan->nama : ''}},
                {{$data->address_kecamatan_id   != '' ? $data->kecamatan->nama : ''}},
                {{$data->address_kota_id        != '' ? $data->kota->nama : ''}},
                {{$data->address_provinsi_id    != '' ? $data->provinsi->nama : ''}},
                {{$data->postalCode}}
            </p>
            @if ($data->address != '')
            @foreach ($data->address as $item)
            <p class="text-muted">
                {{$item['use']}} : {{$item['type']}}, {{$item['text']}}, {{$item['line']}},
                {{$item['city']}}, {{$item['district']}}, {{$item['state']}}, {{$item['postalCode']}}
                , {{$item['country']}}
            </p>
            @endforeach
            @endif
            
            <hr>
            <strong><i class="fas fa-comments mr-1"></i> Communication </strong>
            @if ($data->communication != '')
            @foreach ($data->communication as $item)
            <p class="text-muted">
                {{$item['text']}}
            </p>
            @endforeach
            @endif


            <hr>
            <strong><i class="fas fa-info-circle mr-1"></i> Info </strong>
            <p class="text-muted">
                <table>
                    <tr>
                        <td>Author</td>
                        <td>:</td>
                        <td>{{$data->author_id != '' ? $data->author->name : ''}}</td>
                    </tr>
                    <tr>
                        <td>Created at</td>
                        <td>:</td>
                        <td>{{$data->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Edithor</td>
                        <td>:</td>
                        <td>{{$data->edithor_id != '' ? $data->edithor->name : ''}}</td>
                    </tr>
                    <tr>
                        <td>Last Update</td>
                        <td>:</td>
                        <td>{{$data->updated_at}}</td>
                    </tr>
                </table>
            </p>


        </div>
      </div>
</div>