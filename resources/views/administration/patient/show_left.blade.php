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
                {{@$data->title ? $data->title . '.' : ''}} {{$data->full_name}}
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
                    <i class="far fa-credit-card"></i> BPJS/JKN {{$data->jenis_bpjs_id != '' ? ' : '. $data->jenis_bpjs->nama : ''}}
                    <b class="float-right">{{$data->no_bpjs}} (kelas {{$data->kelas_bpjs}})</b>
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
                <li class="list-group-item">
                    <i class="fas fa-map-marker-alt"></i> Alamat
                    <b class="float-right text-right">
                        {{$data->address_alamat}}
                        {{$data->address_kelurahan_id   != '' ? $data->kelurahan->nama : ''}},
                        {{$data->address_kecamatan_id   != '' ? $data->kecamatan->nama : ''}},
                        {{$data->address_kota_id        != '' ? $data->kota->nama : ''}},
                        {{$data->address_provinsi_id    != '' ? $data->provinsi->nama : ''}},
                        {{$data->postalCode}}
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


                <li class="list-group-item">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-print"></i> Cetak / Print
                        </button>
                        <div class="dropdown-menu" style="">
                            <a  data-link="{{Route('print.patient.profil', $data->id)}}"  class="pdf-link dropdown-item" target="_blank"><i class="fas fa-id-badge"></i> Profil</a>
                            <a  data-link="{{Route('print.patient.card', $data->id)}}"  class="pdf-link dropdown-item" target="_blank"><i class="far fa-id-card"></i> Card</a>
                            <a  data-link="{{Route('print.patient.label', $data->id)}}"  class="pdf-link dropdown-item" target="_blank"><i class="fas fa-tag"></i> Label</a>
                        </div>
                    </div>
                </li>

            </ul>

            <div class="row">
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('administration'))
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user-edit"></i> Edit Advance
                        </button>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item" href="{{Route('patient.edit_advance', ['name', $data->id] )}}"><i class="far fa-id-badge"></i> Name</a>
                            <a class="dropdown-item" href="{{Route('patient.edit_advance', ['identifier', $data->id] )}}"><i class="fas fa-id-card"></i> Identifier</a>
                            <a class="dropdown-item" href="{{Route('patient.edit_advance', ['contact', $data->id] )}}"><i class="far fa-address-book"></i> Contact</a>
                            <a class="dropdown-item" href="{{Route('patient.edit_advance', ['communication', $data->id] )}}"><i class="fas fa-language"></i> Communication</a>
                            <a class="dropdown-item" href="{{Route('patient.edit_advance', ['address', $data->id] )}}"><i class="fas fa-map-marker-alt"></i> Address</a>
                            <a class="dropdown-item" href="{{Route('patient.edit_advance', ['telecom', $data->id] )}}"><i class="fas fa-phone"></i> Telecom</a>
                            <hr>
                            <a class="dropdown-item" href="{{Route('patient.edit_pasien_gratis', $data->id )}}"><i class="fab fa-creative-commons-nc"></i> Pasien Gratis</a>
                            <hr>
                            <form action="{{Route('patient.set_activator', $data->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <button onclick="return confirm('Are you sure?')" type="submit"  class="btn btn-sm btn-block btn-{{$data->active == 1 ? 'success' : 'danger'}}">
                                    <i class="fas fa-power-off"></i> {{$data->active == 1 ? 'Non Aktifkan' : 'Aktifkan'}}
                                </button>
                            </form>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                    <a href="{{route('patient.edit',$data->id )}}" type="button"
                        class="btn btn-block btn-success bg-{{$bg}}">
                        <i class="fas fa-user-edit"></i>EDIT
                    </a>
                </div>
            
            @endif
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- Profile Image -->


    <!-- About Me Box -->
    <div class="card card-{{$bg}} collapsed-card">
        <div class="card-header ">
            <h3 class="card-title">About Patient</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- -------------------------------------------------------------------- -->
            @if ($data->is_pasien_gratis == '1')
            <hr>
            <strong><i class="fab fa-creative-commons-nc"></i> Pasien Gratis</strong>
            <p class="text-muted">
                {{$data->ket_pasien_gratis}} <br>
                oleh : {{$data->author_pasien_gratis_id != '' ? $data->authorGratis->name : ''}} <br>
                pada : {{$data->pasien_gratis_at}}
            </p>
            @endif
            <!-- -------------------------------------------------------------------- -->


            <!-- -------------------------------------------------------------------- -->
            @if ($data->contact != '')
            <hr>
            <strong><i class="far fa-address-book"></i> Contact</strong>
            @foreach ($data->contact as $item)
            <p class="text-muted">
               {{@$item['relationship']['code']['code'] ? $item['relationship']['code']['code'] . ' : ' : ''}}
               {{@$item['relationship']['text'] ? $item['relationship']['text'] : ''}}
               <br>
               Name : ({{@$item['name']['use'] ? $item['name']['use'] : ''}})
               {{@$item['name']['text'] ? $item['name']['text'] : ''}} 
               -> {{@$item['gender'] ? $item['gender'] : ''}} 
               <br>
               ({{@$item['telecom']['use'] ? $item['telecom']['use'] : ''}}) 
               {{@$item['telecom']['system'] ? $item['telecom']['system'] : ''}} =
               {{@$item['telecom']['value'] ? $item['telecom']['value'] : ''}}
               <br>
               ({{@$item['address']['use'] ? $item['address']['use'] : ''}} / {{@$item['address']['type'] ? $item['address']['type'] : ''}}) 
               {{@$item['address']['text'] ? $item['address']['text'] :''}}, {{@$item['address']['line'] ? $item['address']['line'] : ''}},
               {{@$item['address']['city'] ? $item['address']['city'] : ''}}, {{@$item['address']['district'] ? $item['address']['district'] :''}},
               {{@$item['address']['state'] ? $item['address']['state'] : ''}}, {{@$item['address']['postalCode'] ? $item['address']['postalCode'] :''}}
               ,{{@$item['address']['country'] ? $item['address']['country'] : ''}}
            </p>
            @endforeach
            @endif
            <!-- -------------------------------------------------------------------- -->


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
                {{@$item['use'] ? $item['use'] : ''}} : {{@$item['type'] ? $item['type'] :''}},
                {{@$item['text'] ? $item['text'] :''}}, {{@$item['line'] ? $item['line'] : ''}},
                {{@$item['city'] ? $item['city'] : ''}}, {{@$item['district'] ? $item['district'] :''}},
                {{@$item['state'] ? $item['state'] : ''}}, {{@$item['postalCode'] ? $item['postalCode'] :''}}
                , {{@$item['country'] ? $item['country'] : ''}}
            </p>
            @endforeach
            @endif


            <!-- -------------------------------------------------------------------- -->
            @if ($data->telecom != '')
            <hr>
            <strong><i class="fas fa-phone-alt mr-1"></i> Telecom </strong>
            @foreach ($data->telecom as $item)
            <p class="text-muted">
                {{@$item['use'] ? $item['use'] : ''}} : {{@$item['value'] ? $item['value'] : ''}},
                {{@$item['rank'] ? $item['rank'] : ''}}
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
                {{@$item['language']['text'] ? $item['language']['text'] : ''}}
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
                        <td>{{$data->updated_at != $data->created_at ? $data->updated_at : ''}}</td>
                    </tr>
                    <tr>
                        <td>Activator</td>
                        <td>:</td>
                        <td>{{$data->activated_by != '' ? $data->activator->name : ''}} ( to {{$data->active ? 'ON' : 'OFF'}})</td>
                    </tr>
                    <tr>
                        <td>Activated_at</td>
                        <td>:</td>
                        <td>{{$data->activated_by != '' ? $data->activated_at : ''}}</td>
                    </tr>
                </table>
                <a href="{{Route('patient.fhir.json', $data->id)}}" target="_blank">fhir json</a>
            </p>
            <!-- -------------------------------------------------------------------- -->


        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.pdf-link').click(function() {
                var w = 1000;
                var h = 800;
                var left = (screen.width/2)-(w/2);
                var top = (screen.height/2)-(h/2);
                window.open($(this).data('link'),  '_blank', 'toolbar=0,location=0,menubar=0,scrollbars=yes,resizable=yes,width='+w+',height='+h+',top='+top+',left='+left);
                return false;
            });
        });
    </script>
@endpush