<div class="col-lg-3 col-xl-3 col-md-3 col-sm-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                @if($data->photo != "")
                <img class="profile-user-img img-fluid img-circle" src="/images/dp_patient/{{$data->photo}}">
                @endif
            </div>

            <h3 class="profile-username text-center">
                {{$data->full_name}}
            </h3>
            <p class="text-muted text-center">
                {{$data->no_rm}}
            </p>

            <ul class="list-group list-group-unbordered mb-3">
                <!-- ------------------------------------------------------ -->
                <li class="list-group-item">
                    <i class="fas fa-file"></i> - Data
                    <b class="float-right">
                        <a href="#data-patient" class="btn btn-sm btn-info">Go!!</a>
                    </b>
                </li>
                <!-- ------------------------------------------------------ -->
                <li class="list-group-item">
                    <i class="fas fa-venus-mars"></i> Gender 
                    <b class="float-right">
                        {{$data->gender_id != '' ? $data->gender->nama : ''}}
                    </b>
                </li>
                <!-- ------------------------------------------------------ -->
                <li class="list-group-item">
                    <i class="fas fa-hourglass-start"></i> Usia 
                    <b class="float-right">
                        {{$data->usia()}}
                    </b>
                </li>
                <!-- ------------------------------------------------------ -->
                <li class="list-group-item">
                    <i class="far fa-id-card"></i>
                    {{$data->identity_type_id != '' ? $data->identityType->nama : ''}} 
                    <b class="float-right">{{$data->identity_number}}</b>
                </li>
                <!-- ------------------------------------------------------ -->
                @if($data->no_bpjs != '')
                <li class="list-group-item">
                    <i class="far fa-credit-card"></i> BPJS/JKN 
                    <b class="float-right">{{$data->no_bpjs}}</b>
                </li>
                @endif
                <!-- ------------------------------------------------------ -->
                @if($data->no_tlp != '')
                <li class="list-group-item">
                    <i class="fas fa-phone"></i> No HP/TLP 
                    <b class="float-right">{{$data->no_tlp}}</b>
                </li>
                @endif
                <!-- ------------------------------------------------------ -->
                <li class="list-group-item">
                    <i class="fas fa-birthday-cake"></i> Tempat/TGL Lahir 
                    <b class="float-right">
                        {{$data->place_of_birth}}, {{$data->birthDate}}
                    </b>
                </li>
                <!-- ------------------------------------------------------ -->
                @if($data->maritalStatus_id != '')
                <li class="list-group-item">
                    <i class="fas fa-ring"></i> Status Nikah 
                    <b class="float-right">
                        {{$data->maritalStatus->nama}}
                    </b>
                </li>
                @endif
                <!-- ------------------------------------------------------ -->
                @if ($data->agama_id != '')
                <li class="list-group-item">
                    <i class="fas fa-praying-hands"></i> Agama 
                    <b class="float-right">
                        {{$data->agama->nama}}
                    </b>
                </li>
                @endif
                <!-- ------------------------------------------------------- -->
                @if ($data->pendidikan_id != '')
                <li class="list-group-item">
                    <i class="fas fa-graduation-cap"></i> Pendidikan 
                    <b class="float-right">
                        {{$data->pendidikan->nama}}
                    </b>
                </li>
                @endif
                <!-- ------------------------------------------------------ -->
                @if ($data->pekerjaan_id != '')
                <li class="list-group-item">
                    <i class="fas fa-user-tie"></i> Pekerjaan 
                    <b class="float-right">
                        {{$data->pekerjaan->nama}}
                    </b>
                </li>   
                @endif
                <!-- ------------------------------------------------------ -->
                @if ($data->nama_ibu != '')
                <li class="list-group-item">
                    <i class="fas fa-female"></i> Nama Ibu Kandung 
                    <b class="float-right">
                        {{$data->nama_ibu}}
                    </b>
                </li> 
                @endif
                <!-- ------------------------------------------------------ -->
                @if ($data->kewarganegaraan_id != '')
                <li class="list-group-item">
                    <i class="fas fa-flag"></i> Kewarganegaraan
                    <b class="float-right">
                        {{$data->kewarganegaraan->nama}}
                    </b>
                </li> 
                @endif
                <!-- ------------------------------------------------------ -->
                @if ($data->bahasa != '')
                <li class="list-group-item">
                    <i class="fas fa-language"></i> Bahasa
                    <b class="float-right">
                        {{$data->bahasa}}
                    </b>
                </li> 
                @endif
                <!-- ------------------------------------------------------ -->
                @if ($data->suku != '')
                <li class="list-group-item">
                    <i class="fas fa-users"></i> Suku
                    <b class="float-right">
                        {{$data->suku}}
                    </b>
                </li> 
                @endif
                <!-- ------------------------------------------------------ -->
                @if ($data->blood != '')
                <li class="list-group-item">
                    <i class="fas fa-tint"></i> Golongan Darah
                    <b class="float-right">
                        {{$data->blood}}
                    </b>
                </li> 
                @endif
                <!-- ------------------------------------------------------ -->

                <!-- ------------------------------------------------------ -->


                <li class="list-group-item">
                    <i class="fas fa-power-off"></i> Status
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
          
            <!-- -------------------------------------------------------------------- -->
            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
            <p class="text-muted">
                {{$data->address_alamat}}
                {{$data->address_kelurahan_id   != '' ? $data->kelurahan->nama : ''}},
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


            <!-- -------------------------------------------------------------------- -->
            @if ($data->telecom != '')
            <hr>
            <strong><i class="fas fa-phone-alt mr-1"></i> Telecom </strong>
            @foreach ($data->telecom as $item)
            <p class="text-muted">
                {{$item['use']}} : {{$item['value']}}, {{$item['rank']}}
            </p>
            @endforeach
            @endif
            <!-- -------------------------------------------------------------------- -->
            

            <!-- -------------------------------------------------------------------- -->
            @if ($data->communication != '')
            <hr>
            <strong><i class="fas fa-comments mr-1"></i> Communication </strong>
            @foreach ($data->communication as $item)
            <p class="text-muted">
                {{$item['text']}}
            </p>
            @endforeach
            @endif
            <!-- -------------------------------------------------------------------- -->


            <!-- -------------------------------------------------------------------- -->
            @if($data->note != '')
            <hr>
            <strong><i class="far fa-sticky-note"></i> Note</strong>
            <p class="text-muted">
                {{$data->note}}
            </p>
            @endif
            <!-- -------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------- -->
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
                <a href="{{Route('patient.fhir.json', $data->id)}}" target="_blank">fhir json</a>
            </p>
            <!-- -------------------------------------------------------------------- -->


        </div>
      </div>
</div>