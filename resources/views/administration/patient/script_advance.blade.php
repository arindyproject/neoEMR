@push('scripts')
<script src="{{ asset('assets/plugins/selectize/selectize.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('select').selectize({
          sortField: 'text'
        });



        //name=============================================================================================
        var add_name     = $(".btn-add-name");
        var form_name    = $('#form-name');
        var x_name       = 1;

        var html_name    = '<div class="callout callout-info">';

            //use------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
            html_name += '<select name="name_use[]" id="use" class="form-control form-control-sm " required>';
            html_name += '<option value="">select item...</option>';
            @foreach($name_use as $itm)
            html_name += '<option value="{!! $itm['code'] !!}">{!! $itm['display'] !!}</option>';
            @endforeach
            html_name += '</select>';
            html_name += '</div></div>';
            //use------------------------------------------------------------------------------------------

            //text------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="text" class="col-sm-2 col-form-label">Text</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_text[]" type="text" class="form-control form-control-sm" id="text" placeholder="text" required>';
            html_name += '<small>Text representation of the full name</small>';
            html_name += '</div></div>';
            //text------------------------------------------------------------------------------------------------


            //family------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="family" class="col-sm-2 col-form-label">Family</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_family[]" type="text" class="form-control form-control-sm" id="family" placeholder="family" >';
            html_name += '<small>Family name (often called "Surname")</small>';
            html_name += '</div></div>';
            //family------------------------------------------------------------------------------------------------
            

            //given------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="given" class="col-sm-2 col-form-label">Given</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_given[]" type="text" class="form-control form-control-sm" id="given" placeholder="given" >';
            html_name += "<small>Given names (not always 'first'). Includes middle names This repeating element order: Given Names appear in the correct order for presenting the name</small>";
            html_name += '</div></div>';
            //given------------------------------------------------------------------------------------------------


            //prefix------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="prefix" class="col-sm-2 col-form-label">Prefix</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_prefix[]" type="text" class="form-control form-control-sm" id="prefix" placeholder="prefix" >';
            html_name += '<small>Parts that come before the name This repeating element order: Prefixes appear in the correct order for presenting the name</small>';
            html_name += '</div></div>';
            //prefix------------------------------------------------------------------------------------------------


            //suffix------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="suffix" class="col-sm-2 col-form-label">Suffix</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_suffix[]" type="text" class="form-control form-control-sm" id="suffix" placeholder="suffix" >';
            html_name += '<small>Parts that come after the name This repeating element order: Suffixes appear in the correct order for presenting the name</small>';
            html_name += '</div></div>';
            //suffix------------------------------------------------------------------------------------------------
            
            //peroide------------------------------------------------------------------------------------------------
            html_name += '<label for="peroide" class="col-sm-12 col-form-label">peroide</label><div class="form-group row">';
            html_name += '<div class="col-sm-12">';
            html_name += '<div class="callout callout-success">';
            html_name += '<small>Time period when name was/is in use</small>';
                //start---------------------------------------------------------------------------------------------
                html_name += '<div class="form-group row"> <label for="peroide_start" class="col-sm-4 col-form-label">Start</label>';
                html_name += '<div class="col-sm-8">';
                html_name += '<input type="date" class="form-control form-control-sm" id="peroide_start" name="name_peroide_start[]" placeholder="Start" >';
                html_name += '</div></div>';
                //start---------------------------------------------------------------------------------------------

                //end---------------------------------------------------------------------------------------------
                html_name += '<div class="form-group row"> <label for="peroide_end" class="col-sm-4 col-form-label">end</label>';
                html_name += '<div class="col-sm-8">';
                html_name += '<input type="date" class="form-control form-control-sm" id="peroide_end" name="name_peroide_end[]" placeholder="end" >';
                html_name += '</div></div>';
                //end---------------------------------------------------------------------------------------------
            html_name += '</div></div></div>';
            //peroide------------------------------------------------------------------------------------------------

            html_name += '<hr>';
            html_name += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-name"><i class="fas fa-minus-circle"></i> Remove</button>';
            html_name += '</div>';

            $(add_name).click(function(e) {
                e.preventDefault();
                $(form_name).append(html_name); //add input box
                $('select').selectize({
                    sortField: 'text'
                });
            });
            $(form_name).on("click", ".btn-remove-name", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure ?',
                    text: "apakah anda yakin menghapus item ini?? ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent('div').remove();
                        x_name--;
                    }
                });
            });
        //name=============================================================================================


        
        //identifier=============================================================================================
        var add_identifier     = $(".btn-add-identifier");
        var form_identifier    = $('#form-identifier');
        var x_identifier       = 1;

        var html_identifier    = '<div class="callout callout-info">';

            //use------------------------------------------------------------------------------------------
            html_identifier += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
            html_identifier += '<select name="identifier_use[]" id="identifier_use" class="form-control form-control-sm " required>';
            html_identifier += '<option value="">select item...</option>';
            @foreach($identifier_use as $itm)
            html_identifier += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
            @endforeach
            html_identifier += '</select>';
            html_identifier += '</div></div>';
            //use------------------------------------------------------------------------------------------


            //type------------------------------------------------------------------------------------------
            html_identifier += '<div class="form-group row"><label for="type" class="col-sm-2 col-form-label">Type</label><div class="col-sm-10">';
            html_identifier += '<select name="identifier_type[]" id="identifier_type" class="form-control form-control-sm " required>';
            html_identifier += '<option value="">select item...</option>';
            @foreach($identifier_type as $itm)
            html_identifier += '<option value="{{ $itm['code'] }}">{{ $itm['code'] }} : {{ $itm['display'] }}</option>';
            @endforeach
            html_identifier += '</select>';
            html_identifier += '</div></div>';
            //type------------------------------------------------------------------------------------------


            //system------------------------------------------------------------------------------------------------
            html_identifier += '<div class="form-group row"><label for="system" class="col-sm-2 col-form-label">System</label>';
            html_identifier += '<div class="col-sm-10">';
            html_identifier += '<input name="identifier_system[]" type="text" class="form-control form-control-sm" id="system" placeholder="system uri/url" >';
            html_identifier += '<small>The namespace for the identifier value</small>';
            html_identifier += '</div></div>';
            //system------------------------------------------------------------------------------------------------
            
            //value------------------------------------------------------------------------------------------------
            html_identifier += '<div class="form-group row"><label for="value" class="col-sm-2 col-form-label">Value</label>';
            html_identifier += '<div class="col-sm-10">';
            html_identifier += '<input name="identifier_value[]" type="text" class="form-control form-control-sm" id="value" placeholder="value" required>';
            html_identifier += '<small>	The value that is unique</small>';
            html_identifier += '</div></div>';
            //value------------------------------------------------------------------------------------------------

            //peroide------------------------------------------------------------------------------------------------
            html_identifier += '<label for="peroide" class="col-sm-12 col-form-label">peroide</label><div class="form-group row">';
            html_identifier += '<div class="col-sm-12">';
            html_identifier += '<div class="callout callout-success">';
            html_identifier += '<small>Time period when name was/is in use</small>';
                //start---------------------------------------------------------------------------------------------
                html_identifier += '<div class="form-group row"> <label for="peroide_start" class="col-sm-4 col-form-label">Start</label>';
                html_identifier += '<div class="col-sm-8">';
                html_identifier += '<input type="date" class="form-control form-control-sm" id="identifier_peroide_start" name="identifier_peroide_start[]" placeholder="Start" >';
                html_identifier += '</div></div>';
                //start---------------------------------------------------------------------------------------------

                //end---------------------------------------------------------------------------------------------
                html_identifier += '<div class="form-group row"> <label for="peroide_end" class="col-sm-4 col-form-label">end</label>';
                html_identifier += '<div class="col-sm-8">';
                html_identifier += '<input type="date" class="form-control form-control-sm" id="identifier_peroide_end" name="identifier_peroide_end[]" placeholder="end" >';
                html_identifier += '</div></div>';
                //end---------------------------------------------------------------------------------------------
                html_identifier += '</div></div></div>';
            //peroide------------------------------------------------------------------------------------------------

        html_identifier += '<hr>';
        html_identifier += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-identifier"><i class="fas fa-minus-circle"></i> Remove</button>';
        html_identifier += '</div>';

        
        $(add_identifier).click(function(e) {
            e.preventDefault();
            $(form_identifier).append(html_identifier); //add input box
            $('select').selectize({
                sortField: 'text'
            });
        });
        $(form_identifier).on("click", ".btn-remove-identifier", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: "apakah anda yakin menghapus item ini?? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('div').remove();
                    x_identifier--;
                }
            });
        });
        //identifier=============================================================================================






        //communication=============================================================================================
        var add_communication     = $(".btn-add-communication");
        var form_communication    = $('#form-communication');
        var x_communication       = 1;

        var html_communication    = '<div class="callout callout-info">';

            //language------------------------------------------------------------------------------------------
            html_communication += '<div class="form-group row"><label for="type" class="col-sm-2 col-form-label">Language</label><div class="col-sm-10">';
            html_communication += '<select name="language[]" id="language" class="form-control form-control-sm " required>';
            html_communication += '<option value="">select item...</option>';
            @foreach($valueset_languages as $itm)
            html_communication += '<option value="{{ $itm['code'] }}">{{ $itm['code'] }} : {{ $itm['display'] }}</option>';
            @endforeach
            html_communication += '</select>';
            html_communication += '</div></div>';
            //language------------------------------------------------------------------------------------------

        html_communication += '<hr>';
        html_communication += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-communication"><i class="fas fa-minus-circle"></i> Remove</button>';
        html_communication += '</div>';

        $(add_communication).click(function(e) {
            e.preventDefault();
            $(form_communication).append(html_communication); //add input box
            $('select').selectize({
                sortField: 'text'
            });
        });
        $(form_communication).on("click", ".btn-remove-communication", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: "apakah anda yakin menghapus item ini?? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('div').remove();
                    x_communication--;
                }
            });
        });
        //communication=============================================================================================




        //address==================================================================================================
        var add_address     = $(".btn-add-address");
        var form_address    = $('#form-address');
        var x_address       = 1;

        var html_address    = '<div class="callout callout-info">';
            //use------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
            html_address += '<select name="address_use[]" id="address_use" class="form-control form-control-sm " required>';
            html_address += '<option value="">select item...</option>';
            @foreach($address_use as $itm)
            html_address += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
            @endforeach
            html_address += '</select>';
            html_address += '</div></div>';
            //use------------------------------------------------------------------------------------------

            //type------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="type" class="col-sm-2 col-form-label">Type</label><div class="col-sm-10">';
            html_address += '<select name="address_type[]" id="address_type" class="form-control form-control-sm " required>';
            html_address += '<option value="">select item...</option>';
            @foreach($address_type as $itm)
            html_address += '<option value="{{ $itm['code'] }}">{{ $itm['code'] }} : {{ $itm['display'] }}</option>';
            @endforeach
            html_address += '</select>';
            html_address += '</div></div>';
            //type------------------------------------------------------------------------------------------

            //text------------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="text" class="col-sm-2 col-form-label">Text</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input name="address_text[]" type="text" class="form-control form-control-sm" id="text" placeholder="text" >';
            html_address += '<small>Text representation of the address</small>';
            html_address += '</div></div>';
            //text------------------------------------------------------------------------------------------------

            //line------------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="text" class="col-sm-2 col-form-label">Line</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input name="address_line[]" type="text" class="form-control form-control-sm" id="line" placeholder="line" >';
            html_address += '<small>Street name, number, direction & P.O. Box etc. This repeating element order: The order in which lines should appear in an address label</small>';
            html_address += '</div></div>';
            //line------------------------------------------------------------------------------------------------

            //city------------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="city" class="col-sm-2 col-form-label">City</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input name="address_city[]" type="text" class="form-control form-control-sm" id="city" placeholder="city" >';
            html_address += '<small>Name of city, town etc.</small>';
            html_address += '</div></div>';
            //city------------------------------------------------------------------------------------------------

            //district------------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="district" class="col-sm-2 col-form-label">District</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input name="address_district[]" type="text" class="form-control form-control-sm" id="district" placeholder="district" >';
            html_address += '<small>District name (aka county)</small>';
            html_address += '</div></div>';
            //district------------------------------------------------------------------------------------------------

            //state------------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="state" class="col-sm-2 col-form-label">State</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input name="address_state[]" type="text" class="form-control form-control-sm" id="state" placeholder="state" >';
            html_address += '<small>Sub-unit of country (abbreviations ok)</small>';
            html_address += '</div></div>';
            //state------------------------------------------------------------------------------------------------

            //postalCode------------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="postalCode" class="col-sm-2 col-form-label">postalCode</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input name="address_postalCode[]" type="text" class="form-control form-control-sm" id="postalCode" placeholder="postalCode" >';
            html_address += '<small>Postal code for area</small>';
            html_address += '</div></div>';
            //postalCode	------------------------------------------------------------------------------------------------

            //country------------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"><label for="country" class="col-sm-2 col-form-label">Country</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input name="address_country[]" type="text" class="form-control form-control-sm" id="country" placeholder="country" >';
            html_address += '<small>Country (e.g. may be ISO 3166 2 or 3 letter code)</small>';
            html_address += '</div></div>';
            //country------------------------------------------------------------------------------------------------

            //peroide------------------------------------------------------------------------------------------------
            html_address += '<label for="peroide" class="col-sm-12 col-form-label">peroide</label><div class="form-group row">';
            html_address += '<div class="col-sm-12">';
            html_address += '<div class="callout callout-success">';
            html_address += '<small>Time period when name was/is in use</small>';
                //start---------------------------------------------------------------------------------------------
                html_address += '<div class="form-group row"> <label for="peroide_start" class="col-sm-4 col-form-label">Start</label>';
                html_address += '<div class="col-sm-8">';
                html_address += '<input type="date" class="form-control form-control-sm" id="address_peroide_start" name="address_peroide_start[]" placeholder="Start" >';
                html_address += '</div></div>';
                //start---------------------------------------------------------------------------------------------

                //end---------------------------------------------------------------------------------------------
                html_address += '<div class="form-group row"> <label for="peroide_end" class="col-sm-4 col-form-label">end</label>';
                html_address += '<div class="col-sm-8">';
                html_address += '<input type="date" class="form-control form-control-sm" id="address_peroide_end" name="address_peroide_end[]" placeholder="end" >';
                html_address += '</div></div>';
                //end---------------------------------------------------------------------------------------------
                html_address += '</div></div></div>';
            //peroide------------------------------------------------------------------------------------------------


        
        html_address += '<hr>';
        html_address += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-address"><i class="fas fa-minus-circle"></i> Remove</button>';
        html_address += '</div>';


        $(add_address).click(function(e) {
            e.preventDefault();
            $(form_address).append(html_address); //add input box
            $('select').selectize({
                sortField: 'text'
            });
        });
        $(form_address).on("click", ".btn-remove-address", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: "apakah anda yakin menghapus item ini?? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('div').remove();
                    x_address--;
                }
            });
        });
        //address==================================================================================================




        //telecom==================================================================================================
        var add_telecom     = $(".btn-add-telecom");
        var form_telecom    = $('#form-telecom');
        var x_telecom       = 1;

        var html_telecom    = '<div class="callout callout-info">';
            
            //use------------------------------------------------------------------------------------------
            html_telecom += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
            html_telecom += '<select name="telecom_use[]" id="telecom_use" class="form-control form-control-sm " required>';
            html_telecom += '<option value="">select item...</option>';
            @foreach($telecom_use as $itm)
            html_telecom += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
            @endforeach
            html_telecom += '</select>';
            html_telecom += '</div></div>';
            //use------------------------------------------------------------------------------------------


            //system------------------------------------------------------------------------------------------
            html_telecom += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">System</label><div class="col-sm-10">';
            html_telecom += '<select name="telecom_system[]" id="telecom_system" class="form-control form-control-sm " required>';
            html_telecom += '<option value="">select item...</option>';
            @foreach($telecom_system as $itm)
            html_telecom += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
            @endforeach
            html_telecom += '</select>';
            html_telecom += '</div></div>';
            //system------------------------------------------------------------------------------------------


            //value------------------------------------------------------------------------------------------------
            html_telecom += '<div class="form-group row"><label for="value" class="col-sm-2 col-form-label">Value</label>';
            html_telecom += '<div class="col-sm-10">';
            html_telecom += '<input name="telecom_value[]" type="text" class="form-control form-control-sm" id="value" placeholder="value" required>';
            html_telecom += '<small>The actual contact point details</small>';
            html_telecom += '</div></div>';
            //value	------------------------------------------------------------------------------------------------

            //rank------------------------------------------------------------------------------------------------
            html_telecom += '<div class="form-group row"><label for="rank" class="col-sm-2 col-form-label">Rank</label>';
            html_telecom += '<div class="col-sm-10">';
            html_telecom += '<input name="telecom_rank[]" type="number" min="1" class="form-control form-control-sm" id="rank" placeholder="rank" >';
            html_telecom += '<small>Specify preferred order of use (1 = highest)</small>';
            html_telecom += '</div></div>';
            //rank	------------------------------------------------------------------------------------------------   
            

            //peroide------------------------------------------------------------------------------------------------
            html_telecom += '<label for="peroide" class="col-sm-12 col-form-label">peroide</label><div class="form-group row">';
            html_telecom += '<div class="col-sm-12">';
            html_telecom += '<div class="callout callout-success">';
            html_telecom += '<small>Time period when name was/is in use</small>';
                //start---------------------------------------------------------------------------------------------
                html_telecom += '<div class="form-group row"> <label for="peroide_start" class="col-sm-4 col-form-label">Start</label>';
                html_telecom += '<div class="col-sm-8">';
                html_telecom += '<input type="date" class="form-control form-control-sm" id="telecom_peroide_start" name="telecom_peroide_start[]" placeholder="Start" >';
                html_telecom += '</div></div>';
                //start---------------------------------------------------------------------------------------------

                //end---------------------------------------------------------------------------------------------
                html_telecom += '<div class="form-group row"> <label for="peroide_end" class="col-sm-4 col-form-label">end</label>';
                html_telecom += '<div class="col-sm-8">';
                html_telecom += '<input type="date" class="form-control form-control-sm" id="telecom_peroide_end" name="telecom_peroide_end[]" placeholder="end" >';
                html_telecom += '</div></div>';
                //end---------------------------------------------------------------------------------------------
                html_telecom += '</div></div></div>';
            //peroide------------------------------------------------------------------------------------------------


        html_telecom += '<hr>';
        html_telecom += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-telecom"><i class="fas fa-minus-circle"></i> Remove</button>';
        html_telecom += '</div>';


        $(add_telecom).click(function(e) {
            e.preventDefault();
            $(form_telecom).append(html_telecom); //add input box
            $('select').selectize({
                sortField: 'text'
            });
        });
        $(form_telecom).on("click", ".btn-remove-telecom", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: "apakah anda yakin menghapus item ini?? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('div').remove();
                    x_telecom--;
                }
            });
        });
        //telecom==================================================================================================

        
        //contact==================================================================================================
        var add_contact     = $(".btn-add-contact");
        var form_contact    = $('#form-contact');
        var x_contact       = 1;

        var html_contact    = '<div class="callout callout-info">';

            //relationship------------------------------------------------------------------------------------------
            html_contact += '<div class="form-group row"><label for="relationship" class="col-sm-3 col-form-label">Relationship</label><div class="col-sm-9">';
            html_contact += '<select name="contact_relationship[]" id="contact_relationship" class="form-control form-control-sm " >';
            html_contact += '<option value="">select item...</option>';
            @foreach($contact_relationship as $itm)
            html_contact += '<option value="{{ $itm['code'] }}">{{ $itm['code'] }} : {{ $itm['display'] }}</option>';
            @endforeach
            html_contact += '</select>';
            html_contact += '</div></div>';
            // relationship------------------------------------------------------------------------------------------


            //name------------------------------------------------------------------------------------------------
            html_contact += '<label for="name" class="col-sm-12 col-form-label">name</label><div class="form-group row">';
            html_contact += '<div class="col-sm-12">';
            html_contact += '<div class="callout callout-success">';
                //use------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="use" class="col-sm-3 col-form-label">Use</label><div class="col-sm-9">';
                html_contact += '<select name="contact_name_use[]" id="use" class="form-control form-control-sm " required>';
                html_contact += '<option value="">select item...</option>';
                @foreach($name_use as $itm)
                html_contact += '<option value="{!! $itm['code'] !!}">{!! $itm['display'] !!}</option>';
                @endforeach
                html_contact += '</select>';
                html_contact += '</div></div>';
                //use------------------------------------------------------------------------------------------

                //text------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="text" class="col-sm-3 col-form-label">Text</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_name_text[]" type="text" class="form-control form-control-sm" id="text" placeholder="text" >';
                html_contact += '<small>Text representation of the full name</small>';
                html_contact += '</div></div>';
                //text------------------------------------------------------------------------------------------------

            html_contact += '</div></div></div>';
            //name------------------------------------------------------------------------------------------------
            
            // gender------------------------------------------------------------------------------------------
            html_contact += '<div class="form-group row"><label for="use" class="col-sm-3 col-form-label">Gender</label><div class="col-sm-9">';
            html_contact += '<select name="contact_gender[]" id="contact_gender" class="form-control form-control-sm " required>';
            html_contact += '<option value="">select item...</option>';
            @foreach($administrative_gender as $itm)
            html_contact += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
            @endforeach
            html_contact += '</select>';
            html_contact += '</div></div>';
            // gender------------------------------------------------------------------------------------------
            

            //telecom------------------------------------------------------------------------------------------
            html_contact += '<label for="address" class="col-sm-12 col-form-label">Telecom</label><div class="form-group row">';
            html_contact += '<div class="col-sm-12">';
            html_contact += '<div class="callout callout-success">';
                //use------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
                html_contact += '<select name="contact_telecom_use[]" id="contact_telecom_use" class="form-control form-control-sm " required>';
                html_contact += '<option value="">select item...</option>';
                @foreach($telecom_use as $itm)
                html_contact += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
                @endforeach
                html_contact += '</select>';
                html_contact += '</div></div>';
                //use------------------------------------------------------------------------------------------


                //system------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">System</label><div class="col-sm-10">';
                html_contact += '<select name="contact_telecom_system[]" id="contact_telecom_system" class="form-control form-control-sm " required>';
                html_contact += '<option value="">select item...</option>';
                @foreach($telecom_system as $itm)
                html_contact += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
                @endforeach
                html_contact += '</select>';
                html_contact += '</div></div>';
                //system------------------------------------------------------------------------------------------


                //value------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="value" class="col-sm-2 col-form-label">Value</label>';
                html_contact += '<div class="col-sm-10">';
                html_contact += '<input name="contact_telecom_value[]" type="text" class="form-control form-control-sm" id="value" placeholder="value" required>';
                html_contact += '<small>The actual contact point details</small>';
                html_contact += '</div></div>';
                //value	------------------------------------------------------------------------------------------------

            html_contact += '</div></div></div>';
            //telecom------------------------------------------------------------------------------------------


            //address------------------------------------------------------------------------------------------
            html_contact += '<label for="address" class="col-sm-12 col-form-label">Address</label><div class="form-group row">';
            html_contact += '<div class="col-sm-12">';
            html_contact += '<div class="callout callout-success">';
                //use------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="use" class="col-sm-3 col-form-label">Use</label><div class="col-sm-9">';
                html_contact += '<select name="contact_address_use[]" id="contact_address_use" class="form-control form-control-sm " required>';
                html_contact += '<option value="">select item...</option>';
                @foreach($address_use as $itm)
                html_contact += '<option value="{{ $itm['code'] }}">{{ $itm['display'] }}</option>';
                @endforeach
                html_contact += '</select>';
                html_contact += '</div></div>';
                //use------------------------------------------------------------------------------------------

                //type------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="type" class="col-sm-3 col-form-label">Type</label><div class="col-sm-9">';
                html_contact += '<select name="contact_address_type[]" id="contact_address_type" class="form-control form-control-sm " required>';
                html_contact += '<option value="">select item...</option>';
                @foreach($address_type as $itm)
                html_contact += '<option value="{{ $itm['code'] }}">{{ $itm['code'] }} : {{ $itm['display'] }}</option>';
                @endforeach
                html_contact += '</select>';
                html_contact += '</div></div>';
                //type------------------------------------------------------------------------------------------

                //text------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="text" class="col-sm-3 col-form-label">Text</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_address_text[]" type="text" class="form-control form-control-sm" id="text" placeholder="text" >';
                html_contact += '<small>Text representation of the address</small>';
                html_contact += '</div></div>';
                //text------------------------------------------------------------------------------------------------

                //line------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="text" class="col-sm-3 col-form-label">Line</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_address_line[]" type="text" class="form-control form-control-sm" id="line" placeholder="line" >';
                html_contact += '<small>Street name, number, direction & P.O. Box etc. This repeating element order: The order in which lines should appear in an address label</small>';
                html_contact += '</div></div>';
                //line------------------------------------------------------------------------------------------------

                //city------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="city" class="col-sm-3 col-form-label">City</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_address_city[]" type="text" class="form-control form-control-sm" id="city" placeholder="city" >';
                html_contact += '<small>Name of city, town etc.</small>';
                html_contact += '</div></div>';
                //city------------------------------------------------------------------------------------------------

                //district------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="district" class="col-sm-3 col-form-label">District</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_address_district[]" type="text" class="form-control form-control-sm" id="district" placeholder="district" >';
                html_contact += '<small>District name (aka county)</small>';
                html_contact += '</div></div>';
                //district------------------------------------------------------------------------------------------------

                //state------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="state" class="col-sm-3 col-form-label">State</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_address_state[]" type="text" class="form-control form-control-sm" id="state" placeholder="state" >';
                html_contact += '<small>Sub-unit of country (abbreviations ok)</small>';
                html_contact += '</div></div>';
                //state------------------------------------------------------------------------------------------------

                //postalCode------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="postalCode" class="col-sm-3 col-form-label">postalCode</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_address_postalCode[]" type="text" class="form-control form-control-sm" id="postalCode" placeholder="postalCode" >';
                html_contact += '<small>Postal code for area</small>';
                html_contact += '</div></div>';
                //postalCode	------------------------------------------------------------------------------------------------

                //country------------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"><label for="country" class="col-sm-3 col-form-label">Country</label>';
                html_contact += '<div class="col-sm-9">';
                html_contact += '<input name="contact_address_country[]" type="text" class="form-control form-control-sm" id="country" placeholder="country" >';
                html_contact += '<small>Country (e.g. may be ISO 3166 2 or 3 letter code)</small>';
                html_contact += '</div></div>';
                //country------------------------------------------------------------------------------------------------
            html_contact += '</div></div></div>';
            //address------------------------------------------------------------------------------------------

            //peroide------------------------------------------------------------------------------------------------
            html_contact += '<label for="peroide" class="col-sm-12 col-form-label">peroide</label><div class="form-group row">';
            html_contact += '<div class="col-sm-12">';
            html_contact += '<div class="callout callout-success">';
            html_contact += '<small>Time period when name was/is in use</small>';
                //start---------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"> <label for="peroide_start" class="col-sm-4 col-form-label">Start</label>';
                html_contact += '<div class="col-sm-8">';
                html_contact += '<input type="date" class="form-control form-control-sm" id="contact_peroide_start" name="telecom_peroide_start[]" placeholder="Start" >';
                html_contact += '</div></div>';
                //start---------------------------------------------------------------------------------------------

                //end---------------------------------------------------------------------------------------------
                html_contact += '<div class="form-group row"> <label for="peroide_end" class="col-sm-4 col-form-label">end</label>';
                html_contact += '<div class="col-sm-8">';
                html_contact += '<input type="date" class="form-control form-control-sm" id="contact_peroide_end" name="telecom_peroide_end[]" placeholder="end" >';
                html_contact += '</div></div>';
                //end---------------------------------------------------------------------------------------------
                html_contact += '</div></div></div>';
            //peroide------------------------------------------------------------------------------------------------
        html_contact += '<hr>';
        html_contact += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-contact"><i class="fas fa-minus-circle"></i> Remove</button>';
        html_contact += '</div>';

        $(add_contact).click(function(e) {
            e.preventDefault();
            $(form_contact).append(html_contact); //add input box
            $('select').selectize({
                sortField: 'text'
            });
        });
        $(form_contact).on("click", ".btn-remove-contact", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: "apakah anda yakin menghapus item ini?? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('div').remove();
                    x_contact--;
                }
            });
        });
        //contact==================================================================================================

    });
</script>
@endpush