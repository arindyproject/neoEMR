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

            <!--Identifier ----------------------------------------------------------- -->
            <div class="card  collapsed-card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="far fa-id-badge"></i> <b>Identifier</b>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                        
                    </div>
                </div>

                <div class="card-body">
                    <form  action="{{route('profile.edit_advance_identifier', $data->id)}}" method="post"
                        enctype="multipart/form-data" class="form form-sm">
                        @csrf
                        @method('PUT')

                        <div id="form-identifier">
                        @foreach ($data->identifier as $item)
                        <div class="callout callout-info">
                            <!-- use ---------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="use" class="col-sm-2 col-form-label">Use</label>
                                <div class="col-sm-10">
                                    <select name="use[]" id="use" class="form-control form-control-sm" value="{{$item['use']}}">
                                        <option value="">select item...</option>
                                        <option {{$item['use'] == 'usual' ? 'selected' : '' }} value="usual">usual</option>
                                        <option {{$item['use'] == 'official' ? 'selected' : '' }} value="official">official</option>
                                        <option {{$item['use'] == 'temp' ? 'selected' : '' }} value="temp">temp</option>
                                        <option {{$item['use'] == 'secondary' ? 'selected' : '' }} value="secondary">secondary</option>
                                        <option {{$item['use'] == 'old' ? 'selected' : '' }} value="old">old</option>
                                    </select>
                                </div>
                            </div>
                            <!-- use ---------------------------------------------------------------------->


                            <!-- type ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <div class="callout callout-success">
                                        <!-- text -->
                                        <div class="form-group row">
                                            <label for="type_text" class="col-sm-2 col-form-label">Text</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-sm" id="type_text"
                                                    name="type_text[]" placeholder="text"
                                                    value="{{$item['type']['text']}}">
                                            </div>
                                        </div>

                                        <!-- coding ------------------------------------------------------>
                                        <label for="type_coding" class="col-sm-12 col-form-label">Coding</label>
                                        <div class="callout callout-warning">
                                            <!-- system -->
                                            <div class="form-group row">
                                                <label for="type_coding_system"
                                                    class="col-sm-2 col-form-label">System</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-control-sm" id="type_coding_system"
                                                        name="type_coding_system[]" placeholder="uri"
                                                        value="{{$item['type']['coding']['system']}}">
                                                </div>
                                            </div>
                                            <!-- version -->
                                            <div class="form-group row">
                                                <label for="type_coding_version"
                                                    class="col-sm-2 col-form-label">version</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-control-sm" id="type_coding_system"
                                                        name="type_coding_version[]" placeholder="version"
                                                        value="{{$item['type']['coding']['version']}}">
                                                </div>
                                            </div>
                                            <!-- code -->
                                            <div class="form-group row">
                                                <label for="type_coding_code"
                                                    class="col-sm-2 col-form-label">code</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-control-sm" id="type_coding_code"
                                                        name="type_coding_code[]" placeholder="code"
                                                        value="{{$item['type']['coding']['code']}}">
                                                </div>
                                            </div>
                                            <!-- display -->
                                            <div class="form-group row">
                                                <label for="type_coding_display"
                                                    class="col-sm-2 col-form-label">display</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-control-sm" id="type_coding_display"
                                                        name="type_coding_display[]" placeholder="display"
                                                        value="{{$item['type']['coding']['display']}}">
                                                </div>
                                            </div>
                                            <!-- userSelected -->
                                            <div class="form-group row">
                                                <label for="type_coding_userSelected"
                                                    class="col-sm-2 col-form-label">userSelected</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="type_coding_userSelected" name="type_coding_userSelected[]"
                                                        placeholder="userSelected"
                                                        value="{{$item['type']['coding']['userSelected']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- coding ------------------------------------------------------>
                                    </div>
                                </div>
                            </div>
                            <!-- type ------------------------------------------------------------------->


                            <!-- system ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="system" class="col-sm-2 col-form-label">System</label>
                                <div class="col-sm-10">
                                    <input name="system[]" type="text" class="form-control form-control-sm" id="system"
                                        placeholder="uri" value="{{$item['system']}}">
                                </div>
                            </div>
                            <!-- system ------------------------------------------------------------------->


                            <!-- value ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="value" class="col-sm-2 col-form-label">Value</label>
                                <div class="col-sm-10">
                                    <input name="value[]" type="text" class="form-control form-control-sm" id="value"
                                        placeholder="value" value="{{$item['value']}}">
                                </div>
                            </div>
                            <!-- value ------------------------------------------------------------------->

                            <!-- peroide ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="peroide" class="col-sm-2 col-form-label">Peroide</label>
                                <div class="col-sm-10">
                                    <div class="callout callout-success">
                                        <!-- start -->
                                        <div class="form-group row">
                                            <label for="peroide_start" class="col-sm-2 col-form-label">Start</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control form-control-sm" id="peroide_start"
                                                    name="peroide_start[]" placeholder="Start"
                                                    value="{{$item['peroide']['start']}}">
                                            </div>
                                        </div>
                                        <!-- end -->
                                        <div class="form-group row">
                                            <label for="peroide_end" class="col-sm-2 col-form-label">End</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control form-control-sm" id="peroide_end"
                                                    name="peroide_end[]" placeholder="end"
                                                    value="{{$item['peroide']['end']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- peroide ------------------------------------------------------------------->

                            <!-- assigner ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="assigner" class="col-sm-2 col-form-label">Assigner</label>
                                <div class="col-sm-10">
                                    <input name="assigner[]" type="text" class="form-control form-control-sm" id="assigner"
                                        placeholder="assigner" value="{{$item['assigner']}}">
                                </div>
                            </div>
                            <!-- assigner ------------------------------------------------------------------->

                            <hr>
                            <button type="button" class="btn btn-sm btn-danger btn-block btn-remove-identifier"><i class="fas fa-minus-circle"></i> Remove</button>
                        </div>


                        @endforeach
                        <!--Identifier ----------------------------------------------------------- -->
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-info btn-block btn-add-identifier"><i class="fas fa-plus-circle"></i> ADD</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block "><i class="fas fa-save"></i> SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Identifier ----------------------------------------------------------- -->


            <!--Telecom ----------------------------------------------------------- -->
            <div class="card  collapsed-card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-phone-alt"></i> <b>Telecom</b>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                        
                    </div>
                </div>

                <div class="card-body">
                    <form  action="{{route('profile.edit_advance_telecom', $data->id)}}" method="post"
                        enctype="multipart/form-data" class="form form-sm">
                        @csrf
                        @method('PUT')
                        <div id="form-telecom">
                            @foreach ($data->telecom as $item)
                            <div class="callout callout-info">

                                <!-- system ------------------------------------------------------------------->
                                <div class="form-group row">
                                    <label for="system" class="col-sm-2 col-form-label">System</label>
                                    <div class="col-sm-10">
                                        <input name="system[]" type="text" class="form-control form-control-sm" id="system"
                                            placeholder="uri" value="{{$item['system']}}">
                                    </div>
                                </div>
                                <!-- system ------------------------------------------------------------------->

                                <!-- value ------------------------------------------------------------------->
                                <div class="form-group row">
                                    <label for="value" class="col-sm-2 col-form-label">Value</label>
                                    <div class="col-sm-10">
                                        <input name="value[]" type="text" class="form-control form-control-sm" id="value"
                                            placeholder="value" value="{{$item['value']}}">
                                    </div>
                                </div>
                                <!-- value ------------------------------------------------------------------->

                                <!-- use ---------------------------------------------------------------------->
                                <div class="form-group row">
                                    <label for="use" class="col-sm-2 col-form-label">Use</label>
                                    <div class="col-sm-10">
                                        <select name="use[]" id="use" class="form-control form-control-sm" value="{{$item['use']}}">
                                            <option value="">select item...</option>
                                            <option {{$item['use'] == 'home' ? 'selected' : '' }} value="home">home</option>
                                            <option {{$item['use'] == 'work' ? 'selected' : '' }} value="work">work</option>
                                            <option {{$item['use'] == 'temp' ? 'selected' : '' }} value="temp">temp</option>
                                            <option {{$item['use'] == 'old' ? 'selected' : '' }} value="old">old</option>
                                            <option {{$item['use'] == 'mobile' ? 'selected' : '' }} value="mobile">mobile</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- use ---------------------------------------------------------------------->

                                <!-- rank ------------------------------------------------------------------->
                                <div class="form-group row">
                                    <label for="rank" class="col-sm-2 col-form-label">rank</label>
                                    <div class="col-sm-10">
                                        <input name="rank[]" type="text" class="form-control form-control-sm" id="rank"
                                            placeholder="value" value="{{$item['rank']}}">
                                    </div>
                                </div>
                                <!-- rank ------------------------------------------------------------------->


                                <!-- peroide ------------------------------------------------------------------->
                                <div class="form-group row">
                                    <label for="peroide" class="col-sm-2 col-form-label">Peroide</label>
                                    <div class="col-sm-10">
                                        <div class="callout callout-success">
                                            <!-- start -->
                                            <div class="form-group row">
                                                <label for="peroide_start" class="col-sm-2 col-form-label">Start</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control form-control-sm" id="peroide_start"
                                                        name="peroide_start[]" placeholder="Start"
                                                        value="{{$item['peroide']['start']}}">
                                                </div>
                                            </div>
                                            <!-- end -->
                                            <div class="form-group row">
                                                <label for="peroide_end" class="col-sm-2 col-form-label">End</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control form-control-sm" id="peroide_end"
                                                        name="peroide_end[]" placeholder="end"
                                                        value="{{$item['peroide']['end']}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- peroide ------------------------------------------------------------------->
                                <hr>
                                <button type="button" class="btn btn-sm btn-danger btn-block btn-remove-telecom"><i class="fas fa-minus-circle"></i> Remove</button>
                            </div>
                            @endforeach
                            
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-info btn-block btn-add-telecom"><i class="fas fa-plus-circle"></i> ADD</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block "><i class="fas fa-save"></i> SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Telecom ----------------------------------------------------------- -->



            <!--Address ----------------------------------------------------------- -->
            <div class="card  collapsed-card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-map-marked-alt"></i> <b>Address</b>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <form  action="{{route('profile.edit_advance_address', $data->id)}}" method="post"
                        enctype="multipart/form-data" class="form form-sm">
                        @csrf
                        @method('PUT')
                        <div id="form-address">
                            @foreach ($data->address as $item)
                            <div class="callout callout-info">
                            <!-- use ---------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="use" class="col-sm-2 col-form-label">Use</label>
                                <div class="col-sm-10">
                                    <select name="use[]" id="use" class="form-control form-control-sm" value="{{$item['use']}}">
                                        <option value="">select item...</option>
                                        <option {{$item['use'] == 'home' ? 'selected' : '' }} value="home">home</option>
                                        <option {{$item['use'] == 'work' ? 'selected' : '' }} value="work">work</option>
                                        <option {{$item['use'] == 'temp' ? 'selected' : '' }} value="temp">temp</option>
                                        <option {{$item['use'] == 'old' ? 'selected' : '' }} value="old">old</option>
                                        <option {{$item['use'] == 'billing' ? 'selected' : '' }} value="billing">billing</option>
                                    </select>
                                </div>
                            </div>
                            <!-- use ---------------------------------------------------------------------->

                             <!-- type ---------------------------------------------------------------------->
                             <div class="form-group row">
                                <label for="use" class="col-sm-2 col-form-label">type</label>
                                <div class="col-sm-10">
                                    <select name="type[]" id="type" class="form-control form-control-sm" value="{{$item['type']}}">
                                        <option value="">select item...</option>
                                        <option {{$item['type'] == 'postal' ? 'selected' : '' }} value="postal">postal</option>
                                        <option {{$item['type'] == 'physical' ? 'selected' : '' }} value="physical">physical</option>
                                        <option {{$item['type'] == 'both' ? 'selected' : '' }} value="both">both</option>
                                    </select>
                                </div>
                            </div>
                            <!-- type ---------------------------------------------------------------------->

                            <!-- text ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="text" class="col-sm-2 col-form-label">text</label>
                                <div class="col-sm-10">
                                    <input name="text[]" type="text" class="form-control form-control-sm" id="text"
                                        placeholder="text" value="{{$item['text']}}">
                                </div>
                            </div>
                            <!-- text ------------------------------------------------------------------->


                            <!-- line ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="line" class="col-sm-2 col-form-label">line</label>
                                <div class="col-sm-10">
                                    <input name="line[]" type="text" class="form-control form-control-sm" id="line"
                                        placeholder="line" value="{{$item['line']}}">
                                </div>
                            </div>
                            <!-- line ------------------------------------------------------------------->

                            <!-- city ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="city" class="col-sm-2 col-form-label">city</label>
                                <div class="col-sm-10">
                                    <input name="city[]" type="text" class="form-control form-control-sm" id="city"
                                        placeholder="city" value="{{$item['city']}}">
                                </div>
                            </div>
                            <!-- city ------------------------------------------------------------------->

                            <!-- district ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="district" class="col-sm-2 col-form-label">district</label>
                                <div class="col-sm-10">
                                    <input name="district[]" type="text" class="form-control form-control-sm" id="district"
                                        placeholder="district" value="{{$item['district']}}">
                                </div>
                            </div>
                            <!-- district ------------------------------------------------------------------->


                            <!-- state ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="state" class="col-sm-2 col-form-label">state</label>
                                <div class="col-sm-10">
                                    <input name="state[]" type="text" class="form-control form-control-sm" id="state"
                                        placeholder="state" value="{{$item['state']}}">
                                </div>
                            </div>
                            <!-- state ------------------------------------------------------------------->

                            <!-- postalCode ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="postalCode" class="col-sm-2 col-form-label">postalCode</label>
                                <div class="col-sm-10">
                                    <input name="postalCode[]" type="text" class="form-control form-control-sm" id="postalCode"
                                        placeholder="postalCode" value="{{$item['postalCode']}}">
                                </div>
                            </div>
                            <!-- postalCode ------------------------------------------------------------------->

                             <!-- country ------------------------------------------------------------------->
                             <div class="form-group row">
                                <label for="country" class="col-sm-2 col-form-label">country</label>
                                <div class="col-sm-10">
                                    <input name="country[]" type="text" class="form-control form-control-sm" id="country"
                                        placeholder="country" value="{{$item['country']}}">
                                </div>
                            </div>
                            <!-- country ------------------------------------------------------------------->

                            <!-- peroide ------------------------------------------------------------------->
                            <div class="form-group row">
                                <label for="peroide" class="col-sm-2 col-form-label">Peroide</label>
                                <div class="col-sm-10">
                                    <div class="callout callout-success">
                                        <!-- start -->
                                        <div class="form-group row">
                                            <label for="peroide_start" class="col-sm-2 col-form-label">Start</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control form-control-sm" id="peroide_start"
                                                    name="peroide_start[]" placeholder="Start"
                                                    value="{{$item['peroide']['start']}}">
                                            </div>
                                        </div>
                                        <!-- end -->
                                        <div class="form-group row">
                                            <label for="peroide_end" class="col-sm-2 col-form-label">End</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control form-control-sm" id="peroide_end"
                                                    name="peroide_end[]" placeholder="end"
                                                    value="{{$item['peroide']['end']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- peroide ------------------------------------------------------------------->

                            <hr>
                            <button type="button" class="btn btn-sm btn-danger btn-block btn-remove-address"><i class="fas fa-minus-circle"></i> Remove</button>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-info btn-block btn-add-address"><i class="fas fa-plus-circle"></i> ADD</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block "><i class="fas fa-save"></i> SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Address ----------------------------------------------------------- -->



            <!--Communication ----------------------------------------------------------- -->
            <div class="card  collapsed-card">
                <div class="card-header bg-{{$bg}}">
                    <h3 class="card-title">
                        <i class="fas fa-comments"></i> <b>Communication</b>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <form  action="{{route('profile.edit_advance_communication', $data->id)}}" method="post"
                        enctype="multipart/form-data" class="form form-sm">
                        @csrf
                        @method('PUT')
                        <div id="form-communication">
                            @foreach ($data->communication as $item)
                            <div class="callout callout-info">
                                <!-- text ------------------------------------------------------------------->
                                <div class="form-group row">
                                    <label for="text" class="col-sm-2 col-form-label">text</label>
                                    <div class="col-sm-10">
                                        <input name="text[]" type="text" class="form-control form-control-sm" id="text"
                                            placeholder="text" value="{{$item['text']}}">
                                    </div>
                                </div>
                                <!-- text ------------------------------------------------------------------->

                                <!-- coding ------------------------------------------------------>
                                <label for="type_coding" class="col-sm-12 col-form-label">Coding</label>
                                <div class="callout callout-warning">
                                    <!-- system -->
                                    <div class="form-group row">
                                        <label for="type_coding_system"
                                            class="col-sm-2 col-form-label">System</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" id="coding_system"
                                                name="coding_system[]" placeholder="uri"
                                                value="{{$item['coding']['system']}}">
                                        </div>
                                    </div>
                                    <!-- version -->
                                    <div class="form-group row">
                                        <label for="type_coding_version"
                                            class="col-sm-2 col-form-label">version</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" id="coding_system"
                                                name="coding_version[]" placeholder="version"
                                                value="{{$item['coding']['version']}}">
                                        </div>
                                    </div>
                                    <!-- code -->
                                    <div class="form-group row">
                                        <label for="type_coding_code"
                                            class="col-sm-2 col-form-label">code</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" id="coding_code"
                                                name="coding_code[]" placeholder="code"
                                                value="{{$item['coding']['code']}}">
                                        </div>
                                    </div>
                                    <!-- display -->
                                    <div class="form-group row">
                                        <label for="type_coding_display"
                                            class="col-sm-2 col-form-label">display</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" id="coding_display"
                                                name="coding_display[]" placeholder="display"
                                                value="{{$item['coding']['display']}}">
                                        </div>
                                    </div>
                                    <!-- userSelected -->
                                    <div class="form-group row">
                                        <label for="type_coding_userSelected"
                                            class="col-sm-2 col-form-label">userSelected</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                id="coding_userSelected" name="coding_userSelected[]"
                                                placeholder="userSelected"
                                                value="{{$item['coding']['userSelected']}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- coding ------------------------------------------------------>

                                <hr>
                                <button type="button" class="btn btn-sm btn-danger btn-block btn-remove-communication"><i class="fas fa-minus-circle"></i> Remove</button>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-info btn-block btn-add-communication"><i class="fas fa-plus-circle"></i> ADD</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block "><i class="fas fa-save"></i> SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Communication ----------------------------------------------------------- -->


        </div>

    </div>
</div>

@include('profile.scripts')
@endsection
