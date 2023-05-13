@push('scripts')
<script src="{{ asset('assets/plugins/selectize/selectize.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script type="text/javascript">

        $(function () {
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            $('[data-mask]').inputmask()
        })

       

        $('.select-search').selectize({
          sortField: 'text'
        });

        //----------------------------------------------------------------------------
        @if(request()->is('patient/edit/*'))
        var id_provinsi = "{!! $data->address_provinsi_id !!}";
        var id_kota     = "{!! $data->address_kota_id !!}";
        var id_kecamatan= "{!! $data->address_kecamatan_id !!}";
        var id_kelurahan= "{!! $data->address_kelurahan_id !!}";
        @else
        var id_provinsi = "{!! $default['def_alamat_provinsi']['id'] !!}";
        var id_kota     = "{!! $default['def_alamat_kota']['id'] !!}";
        var id_kecamatan= "{!! $default['def_alamat_kecamatan']['id'] !!}";
        var id_kelurahan= "{!! $default['def_alamat_kelurahan']['id'] !!}";
        @endif  
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




    </script>
@endpush