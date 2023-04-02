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
            html_name += '<input name="name_text[]" type="text" class="form-control form-control-sm" id="text" placeholder="text" >';
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








            

    });
</script>
@endpush