@push('scripts')
<script>
$(document).ready(function() {

    //identifier=============================================================================================
    var add_identifier = $(".btn-add-identifier");
    var form_identifier= $('#form-identifier');
    var x_identifier = 1;

    var html_identifier = '<div class="callout callout-info">';

        //use------------------------------------------------------------------------------------------
        html_identifier += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
        html_identifier += '<select name="use[]" id="use" class="form-control form-control-sm">';
        html_identifier += '<option value="">select item...</option>';
        html_identifier += '<option value="usual">usual</option>';
        html_identifier += '<option value="official">official</option>';
        html_identifier += '<option value="temp">temp</option>';
        html_identifier += '<option value="secondary">secondary</option>';
        html_identifier += '<option value="old">old</option>';
        html_identifier += '</select></div></div>';
        //use------------------------------------------------------------------------------------------

        //type------------------------------------------------------------------------------------------------
        html_identifier += '<div class="form-group row"><label for="type" class="col-sm-2 col-form-label">Type</label><div class="col-sm-10"><div class="callout callout-success">';
            //text--------------------------------------------------------------------------------------------
            html_identifier += '<div class="form-group row"><label for="type_text" class="col-sm-2 col-form-label">Text</label><div class="col-sm-10">';
            html_identifier += '<input type="text" class="form-control form-control-sm" id="type_text"name="type_text[]" placeholder="text">';
            html_identifier += '</div></div>';
            //text--------------------------------------------------------------------------------------------

            //coding------------------------------------------------------------------------------------------
            html_identifier += '<label for="type_coding" class="col-sm-12 col-form-label">Coding</label><div class="callout callout-warning">';

                //system--------------------------------------------------------------------------------------
                html_identifier += '<div class="form-group row"><label for="type_coding_system" class="col-sm-2 col-form-label">System</label>';
                html_identifier += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="type_coding_system" name="type_coding_system[]" placeholder="uri">';
                html_identifier += '</div></div>';
                //system--------------------------------------------------------------------------------------

                //version--------------------------------------------------------------------------------------
                html_identifier += '<div class="form-group row"><label for="type_coding_version" class="col-sm-2 col-form-label">version</label>';
                html_identifier += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="type_coding_version" name="type_coding_version[]" placeholder="version">';
                html_identifier += '</div></div>';
                //version--------------------------------------------------------------------------------------

                //code--------------------------------------------------------------------------------------
                html_identifier += '<div class="form-group row"><label for="type_coding_code" class="col-sm-2 col-form-label">code</label>';
                html_identifier += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="type_coding_code" name="type_coding_code[]" placeholder="code">';
                html_identifier += '</div></div>';
                //code--------------------------------------------------------------------------------------

                //display--------------------------------------------------------------------------------------
                html_identifier += '<div class="form-group row"><label for="type_coding_display" class="col-sm-2 col-form-label">display</label>';
                html_identifier += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="type_coding_display" name="type_coding_display[]" placeholder="display">';
                html_identifier += '</div></div>';
                //display--------------------------------------------------------------------------------------

                //userSelected--------------------------------------------------------------------------------------
                html_identifier += '<div class="form-group row"><label for="type_coding_userSelected" class="col-sm-2 col-form-label">userSelected</label>';
                html_identifier += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="type_coding_userSelected" name="type_coding_userSelected[]" placeholder="userSelected">';
                html_identifier += '</div></div>';
                //userSelected--------------------------------------------------------------------------------------

            html_identifier += '</div>';
            //coding------------------------------------------------------------------------------------------
        html_identifier += '</div></div></div>';
        //type------------------------------------------------------------------------------------------------

        //system------------------------------------------------------------------------------------------------
        html_identifier += '<div class="form-group row"><label for="system" class="col-sm-2 col-form-label">System</label>';
        html_identifier += '<div class="col-sm-10">';
        html_identifier += '<input name="system[]" type="text" class="form-control form-control-sm" id="system" placeholder="uri" >';
        html_identifier += '</div></div>';
        //system------------------------------------------------------------------------------------------------

        //value------------------------------------------------------------------------------------------------
        html_identifier += '<div class="form-group row"><label for="value" class="col-sm-2 col-form-label">value</label>';
        html_identifier += '<div class="col-sm-10">';
        html_identifier += '<input name="value[]" type="text" class="form-control form-control-sm" id="value" placeholder="value" >';
        html_identifier += '</div></div>';
        //value------------------------------------------------------------------------------------------------


        //peroide------------------------------------------------------------------------------------------------
        html_identifier += '<div class="form-group row"><label for="peroide" class="col-sm-2 col-form-label">peroide</label>';
        html_identifier += '<div class="col-sm-10">';
        html_identifier += '<div class="callout callout-success">';
            //start---------------------------------------------------------------------------------------------
            html_identifier += '<div class="form-group row"> <label for="peroide_start" class="col-sm-2 col-form-label">Start</label>';
            html_identifier += '<div class="col-sm-10">';
            html_identifier += '<input type="date" class="form-control form-control-sm" id="peroide_start" name="peroide_start[]" placeholder="Start" >';
            html_identifier += '</div></div>';
            //start---------------------------------------------------------------------------------------------

            //end---------------------------------------------------------------------------------------------
            html_identifier += '<div class="form-group row"> <label for="peroide_end" class="col-sm-2 col-form-label">end</label>';
            html_identifier += '<div class="col-sm-10">';
            html_identifier += '<input type="date" class="form-control form-control-sm" id="peroide_end" name="peroide_end[]" placeholder="end" >';
            html_identifier += '</div></div>';
            //end---------------------------------------------------------------------------------------------
        html_identifier += '</div></div></div>';
        //peroide------------------------------------------------------------------------------------------------

        //assigner------------------------------------------------------------------------------------------------
        html_identifier += '<div class="form-group row"><label for="assigner" class="col-sm-2 col-form-label">assigner</label>';
        html_identifier += '<div class="col-sm-10">';
        html_identifier += '<input name="assigner[]" type="text" class="form-control form-control-sm" id="assigner" placeholder="assigner" >';
        html_identifier += '</div></div>';
        //assigner------------------------------------------------------------------------------------------------

        html_identifier += '<hr>';
        html_identifier += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-identifier"><i class="fas fa-minus-circle"></i> Remove</button>';

        html_identifier += '</div>';
    
    $(add_identifier).click(function(e) {
        e.preventDefault();
        $(form_identifier).append(html_identifier); //add input box
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




    //telecom=============================================================================================
    var add_telecom = $(".btn-add-telecom");
    var form_telecom= $('#form-telecom');
    var x_telecom = 1;


    var html_telecom = '<div class="callout callout-info">';

        //system------------------------------------------------------------------------------------------------
        html_telecom += '<div class="form-group row"><label for="system" class="col-sm-2 col-form-label">System</label>';
        html_telecom += '<div class="col-sm-10">';
        html_telecom += '<input name="system[]" type="text" class="form-control form-control-sm" id="system" placeholder="uri" >';
        html_telecom += '</div></div>';
        //system------------------------------------------------------------------------------------------------


        //value------------------------------------------------------------------------------------------------
        html_telecom += '<div class="form-group row"><label for="value" class="col-sm-2 col-form-label">value</label>';
        html_telecom += '<div class="col-sm-10">';
        html_telecom += '<input name="value[]" type="text" class="form-control form-control-sm" id="value" placeholder="value" >';
        html_telecom += '</div></div>';
        //value------------------------------------------------------------------------------------------------


        //use------------------------------------------------------------------------------------------
        html_telecom += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
        html_telecom += '<select name="use[]" id="use" class="form-control form-control-sm">';
        html_telecom += '<option value="">select item...</option>';
        html_telecom += '<option value="home">home</option>';
        html_telecom += '<option value="work">work</option>';
        html_telecom += '<option value="temp">temp</option>';
        html_telecom += '<option value="old">old</option>';
        html_telecom += '<option value="mobile">mobile</option>';
        html_telecom += '</select></div></div>';
        //use------------------------------------------------------------------------------------------


        //rank------------------------------------------------------------------------------------------------
        html_telecom += '<div class="form-group row"><label for="rank" class="col-sm-2 col-form-label">rank</label>';
        html_telecom += '<div class="col-sm-10">';
        html_telecom += '<input name="rank[]" type="text" class="form-control form-control-sm" id="rank" placeholder="rank" >';
        html_telecom += '</div></div>';
        //rank------------------------------------------------------------------------------------------------


        //peroide------------------------------------------------------------------------------------------------
        html_telecom += '<div class="form-group row"><label for="peroide" class="col-sm-2 col-form-label">peroide</label>';
        html_telecom += '<div class="col-sm-10">';
        html_telecom += '<div class="callout callout-success">';
            //start---------------------------------------------------------------------------------------------
            html_telecom += '<div class="form-group row"> <label for="peroide_start" class="col-sm-2 col-form-label">Start</label>';
            html_telecom += '<div class="col-sm-10">';
            html_telecom += '<input type="date" class="form-control form-control-sm" id="peroide_start" name="peroide_start[]" placeholder="Start" >';
            html_telecom += '</div></div>';
            //start---------------------------------------------------------------------------------------------

            //end---------------------------------------------------------------------------------------------
            html_telecom += '<div class="form-group row"> <label for="peroide_end" class="col-sm-2 col-form-label">end</label>';
            html_telecom += '<div class="col-sm-10">';
            html_telecom += '<input type="date" class="form-control form-control-sm" id="peroide_end" name="peroide_end[]" placeholder="end" >';
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
    //telecom=============================================================================================



    //address=============================================================================================
    var add_address = $(".btn-add-address");
    var form_address= $('#form-address');
    var x_address = 1;

    var html_address = '<div class="callout callout-info">';

        //use------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
        html_address += '<select name="use[]" id="use" class="form-control form-control-sm">';
        html_address += '<option value="">select item...</option>';
        html_address += '<option value="home">home</option>';
        html_address += '<option value="work">work</option>';
        html_address += '<option value="temp">temp</option>';
        html_address += '<option value="old">old</option>';
        html_address += '<option value="billing">billing</option>';
        html_address += '</select></div></div>';
        //use------------------------------------------------------------------------------------------


        //type------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="type" class="col-sm-2 col-form-label">type</label><div class="col-sm-10">';
        html_address += '<select name="type[]" id="type" class="form-control form-control-sm">';
        html_address += '<option value="">select item...</option>';
        html_address += '<option value="postal">postal</option>';
        html_address += '<option value="physical">physical</option>';
        html_address += '<option value="both">both</option>';
        html_address += '</select></div></div>';
        //type------------------------------------------------------------------------------------------


        //text------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="text" class="col-sm-2 col-form-label">text</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<input name="text[]" type="text" class="form-control form-control-sm" id="text" placeholder="text" >';
        html_address += '</div></div>';
        //text------------------------------------------------------------------------------------------------


        //line------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="line" class="col-sm-2 col-form-label">line</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<input name="line[]" type="text" class="form-control form-control-sm" id="line" placeholder="line" >';
        html_address += '</div></div>';
        //line------------------------------------------------------------------------------------------------


        //city------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="city" class="col-sm-2 col-form-label">city</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<input name="city[]" type="text" class="form-control form-control-sm" id="city" placeholder="city" >';
        html_address += '</div></div>';
        //city------------------------------------------------------------------------------------------------


        //district------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="district" class="col-sm-2 col-form-label">district</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<input name="district[]" type="text" class="form-control form-control-sm" id="district" placeholder="district" >';
        html_address += '</div></div>';
        //district------------------------------------------------------------------------------------------------


        //state------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="state" class="col-sm-2 col-form-label">state</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<input name="state[]" type="text" class="form-control form-control-sm" id="state" placeholder="state" >';
        html_address += '</div></div>';
        //state------------------------------------------------------------------------------------------------


        //postalCode------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="postalCode" class="col-sm-2 col-form-label">postalCode</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<input name="postalCode[]" type="text" class="form-control form-control-sm" id="postalCode" placeholder="postalCode" >';
        html_address += '</div></div>';
        //postalCode------------------------------------------------------------------------------------------------


        //country------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="country" class="col-sm-2 col-form-label">country</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<input name="country[]" type="text" class="form-control form-control-sm" id="country" placeholder="country" >';
        html_address += '</div></div>';
        //country------------------------------------------------------------------------------------------------


        //peroide------------------------------------------------------------------------------------------------
        html_address += '<div class="form-group row"><label for="peroide" class="col-sm-2 col-form-label">peroide</label>';
        html_address += '<div class="col-sm-10">';
        html_address += '<div class="callout callout-success">';
            //start---------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"> <label for="peroide_start" class="col-sm-2 col-form-label">Start</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input type="date" class="form-control form-control-sm" id="peroide_start" name="peroide_start[]" placeholder="Start" >';
            html_address += '</div></div>';
            //start---------------------------------------------------------------------------------------------

            //end---------------------------------------------------------------------------------------------
            html_address += '<div class="form-group row"> <label for="peroide_end" class="col-sm-2 col-form-label">end</label>';
            html_address += '<div class="col-sm-10">';
            html_address += '<input type="date" class="form-control form-control-sm" id="peroide_end" name="peroide_end[]" placeholder="end" >';
            html_address += '</div></div>';
            //end---------------------------------------------------------------------------------------------
        html_address += '</div></div></div>';
        //peroide------------------------------------------------------------------------------------------------


        html_address += '<hr>';
        html_address += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-address    "><i class="fas fa-minus-circle"></i> Remove</button>';
        html_address += '</div>';


    $(add_address).click(function(e) {
        e.preventDefault();
        $(form_address).append(html_address); //add input box
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
    //address=============================================================================================




    //communication=============================================================================================
    var add_communication   = $(".btn-add-communication");
    var form_communication  = $('#form-communication');
    var x_communication     = 1;


    var html_communication = '<div class="callout callout-info">';

        //text--------------------------------------------------------------------------------------------
        html_communication += '<div class="form-group row"><label for="type_text" class="col-sm-2 col-form-label">Text</label><div class="col-sm-10">';
        html_communication += '<input type="text" class="form-control form-control-sm" id="text"name="text[]" placeholder="text">';
        html_communication += '</div></div>';
        //text--------------------------------------------------------------------------------------------

        //coding------------------------------------------------------------------------------------------
        html_communication += '<label for="type_coding" class="col-sm-12 col-form-label">Coding</label><div class="callout callout-warning">';
            //system--------------------------------------------------------------------------------------
            html_communication += '<div class="form-group row"><label for="coding_system" class="col-sm-2 col-form-label">System</label>';
            html_communication += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="coding_system" name="coding_system[]" placeholder="uri">';
            html_communication += '</div></div>';
            //system--------------------------------------------------------------------------------------
            //version--------------------------------------------------------------------------------------
            html_communication += '<div class="form-group row"><label for="coding_version" class="col-sm-2 col-form-label">version</label>';
            html_communication += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="coding_version" name="coding_version[]" placeholder="version">';
            html_communication += '</div></div>';
            //version--------------------------------------------------------------------------------------
            //code--------------------------------------------------------------------------------------
            html_communication += '<div class="form-group row"><label for="coding_code" class="col-sm-2 col-form-label">code</label>';
            html_communication += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="coding_code" name="coding_code[]" placeholder="code">';
            html_communication += '</div></div>';
            //code--------------------------------------------------------------------------------------
            //display--------------------------------------------------------------------------------------
            html_communication += '<div class="form-group row"><label for="coding_display" class="col-sm-2 col-form-label">display</label>';
            html_communication += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="coding_display" name="coding_display[]" placeholder="display">';
            html_communication += '</div></div>';
            //display--------------------------------------------------------------------------------------
            //userSelected--------------------------------------------------------------------------------------
            html_communication += '<div class="form-group row"><label for="coding_userSelected" class="col-sm-2 col-form-label">userSelected</label>';
            html_communication += ' <div class="col-sm-10"><input type="text" class="form-control form-control-sm" id="coding_userSelected" name="coding_userSelected[]" placeholder="userSelected">';
            html_communication += '</div></div>';
            //userSelected--------------------------------------------------------------------------------------
        html_communication += '</div>';
        //coding------------------------------------------------------------------------------------------

        html_communication += '<hr>';
        html_communication += '<button type="button" class="btn btn-sm btn-danger btn-block btn-remove-communication    "><i class="fas fa-minus-circle"></i> Remove</button>';
        html_communication += '</div>';


    $(add_communication).click(function(e) {
        e.preventDefault();
        $(form_communication).append(html_communication); //add input box
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


});
</script>
@endpush
