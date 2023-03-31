@push('scripts')
<script>
    $(document).ready(function() {
        //name=============================================================================================
        var add_name     = $(".btn-add-name");
        var form_name    = $('#form-name');
        var x_name       = 1;

        var html_name    = '<div class="callout callout-info">';

            //use------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="use" class="col-sm-2 col-form-label">Use</label><div class="col-sm-10">';
            html_name += '<select name="name_use[]" id="use" class="form-control form-control-sm">';
            html_name += '<option value="">select item...</option>';
            html_name += '<option value="usual">usual</option>';
            html_name += '<option value="official">official</option>';
            html_name += '<option value="temp">temp</option>';
            html_name += '<option value="secondary">secondary</option>';
            html_name += '<option value="old">old</option>';
            html_name += '</select></div></div>';
            //use------------------------------------------------------------------------------------------

            //text------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="text" class="col-sm-2 col-form-label">Text</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_text[]" type="text" class="form-control form-control-sm" id="text" placeholder="text" >';
            html_name += '</div></div>';
            //text------------------------------------------------------------------------------------------------


            //family------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="family" class="col-sm-2 col-form-label">Family</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_family[]" type="text" class="form-control form-control-sm" id="family" placeholder="family" >';
            html_name += '</div></div>';
            //family------------------------------------------------------------------------------------------------
            

            //given------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="given" class="col-sm-2 col-form-label">Given</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_given[]" type="text" class="form-control form-control-sm" id="given" placeholder="given" >';
            html_name += '</div></div>';
            //given------------------------------------------------------------------------------------------------


            //prefix------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="prefix" class="col-sm-2 col-form-label">Prefix</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_prefix[]" type="text" class="form-control form-control-sm" id="prefix" placeholder="prefix" >';
            html_name += '</div></div>';
            //prefix------------------------------------------------------------------------------------------------


            //suffix------------------------------------------------------------------------------------------------
            html_name += '<div class="form-group row"><label for="suffix" class="col-sm-2 col-form-label">Suffix</label>';
            html_name += '<div class="col-sm-10">';
            html_name += '<input name="name_suffix[]" type="text" class="form-control form-control-sm" id="suffix" placeholder="suffix" >';
            html_name += '</div></div>';
            //suffix------------------------------------------------------------------------------------------------
            
            //peroide------------------------------------------------------------------------------------------------
            html_name += '<label for="peroide" class="col-sm-12 col-form-label">peroide</label><div class="form-group row">';
            html_name += '<div class="col-sm-12">';
            html_name += '<div class="callout callout-success">';
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
    });
</script>
@endpush