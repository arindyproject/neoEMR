@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('assets/plugins/selectize/selectize.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select_search').selectize({
          sortField: 'text'
        });


        var table = $("#patient-table").DataTable({
            dom: 'Blfrtip',
            buttons: [
                'copy', 'excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A3'
                }, {
                    extend: 'print',
                    orientation: 'landscape'
                }
            ],
            processing: true,
            serverSide: true,
            //responsive: true, 
            autoWidth: false,
            lengthMenu: [25, 30, 50, 100, 200, 500],
            info: true,
            ajax: {
                type: 'GET',
                url: "{!! route('patient.data_json') !!}" ,
                data: { 
                    'full_name'         : "{{request('full_name')}}",
                    'place_of_birth'    : "{{request('place_of_birth')}}",

                    'birthDate_samadengan'   : "{{request('birthDate_samadengan')}}",
                    'birthDate_kurandari'    : "{{request('birthDate_kurandari')}}",
                    'birthDate_lebihdari'    : "{{request('birthDate_lebihdari')}}",

                    'gender_id' : "{{request('gender_id')}}",

                    'address_provinsi_id'   : "{{request('address_provinsi_id')}}",
                    'address_kota_id'       : "{{request('address_kota_id')}}",
                    'address_kecamatan_id'  : "{{request('address_kecamatan_id')}}",
                    'address_kelurahan_id'  : "{{request('address_kelurahan_id')}}",
                    'address_alamat'        : "{{request('address_alamat')}}",

                    'identity_type_id'  : "{{request('identity_type_id')}}",
                    'identity_number'   : "{{request('identity_number')}}",

                    'no_bpjs'           : "{{request('no_bpjs')}}",
                    'no_tlp'            : "{{request('no_tlp')}}",

                    'maritalStatus_id'  : "{{request('maritalStatus_id')}}",

                    'agama_id'          : "{{request('agama_id')}}",

                    'pendidikan_id'     : "{{request('pendidikan_id')}}",
                    'pekerjaan_id'      : "{{request('pekerjaan_id')}}",

                    'kewarganegaraan_id': "{{request('kewarganegaraan_id')}}",
                    'bahasa'            : "{{request('bahasa')}}",
                    'suku'              : "{{request('suku')}}",

                    'blood'             : "{{request('blood')}}",
                },
            },

            columns: [
                {
                    "targets": 0,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_rm'
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'place_of_birth'
                },
                {
                    data: 'birthDate'
                },
                {
                    data: 'usia'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'full_address'
                },
                {
                    data: 'kelurahan'
                },
                {
                    data: 'kecamatan'
                },
                {
                    data: 'kota'
                },
                {
                    data: 'provinsi'
                },
                {
                    data: 'kartu_identitas'
                },
                {
                    data: 'no_bpjs'
                },
                {
                    data: 'no_tlp'
                },
                {
                    data: 'status_nikah'
                },
                {
                    data: 'agama'
                },
                {
                    data: 'pendidikan'
                },
                {
                    data: 'pekerjaan'
                },
                {
                    data: 'kewarganegaraan'
                },
                {
                    data: 'bahasa'
                },
                {
                    data: 'suku'
                },
                {
                    data: 'blood'
                },
                {
                    data: 'author'
                },
                

                
            ],
            columnDefs: [{
                targets: 6,
                className: 'dt-body-nowrap'
            }, {
                targets: 10,
                className: 'dt-body-nowrap'
            }],
            bAutoWidth: false,

        });




        //----------------------------------------------------------------------------
        
        var id_provinsi = "";
        var id_kota     = "";
        var id_kecamatan= "";
        var id_kelurahan= ""; 
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        var s_kelurahan = $('#address_kelurahan_id').select2({
            allowClear: true,
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kelurahan.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_kecamatan: id_kecamatan
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kelurahan.on('select2:select', function (e) {
            var data = e.params.data;
            id_kelurahan   = data.id;
        });
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        var s_kecamatan = $('#address_kecamatan_id').select2({
            allowClear: true,
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kecamatan.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_kota: id_kota
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kecamatan.on('select2:select', function (e) {
            var data = e.params.data;
            id_kecamatan   = data.id;

            s_kelurahan.val(null).trigger("change"); 
        });
        //----------------------------------------------------------------------------

        //----------------------------------------------------------------------------
        var s_kota = $('#address_kota_id').select2({
            allowClear: true,
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.kota.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        id_provinsi: id_provinsi
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_kota.on('select2:select', function (e) {
            var data = e.params.data;
            id_kota   = data.id;

            s_kecamatan.val(null).trigger("change");
            s_kelurahan.val(null).trigger("change"); 
        });
        //----------------------------------------------------------------------------


        //----------------------------------------------------------------------------
        var s_provinsi = $('#address_provinsi_id').select2({
            allowClear: true,
            placeholder: "Choose items...",
            minimumInputLength: 2,
            ajax: {
                url: '{!! Route('attributes.alamat.provinsi.autocomplete') !!}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text:  item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        s_provinsi.on('select2:select', function (e) {
            var data = e.params.data;
            id_provinsi   = data.id;

            s_kota.val(null).trigger("change");
            s_kecamatan.val(null).trigger("change");
            s_kelurahan.val(null).trigger("change"); 
        });
        //----------------------------------------------------------------------------
    })
</script>

@endpush