@push('scripts')
    <script>
        

        function del_btn_c(e){
            let id = e.getAttribute('data-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda Yakin?',
                text: "Anda akan menghapus user ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                            type:'DELETE',
                            url:'{{url("/admin/delete")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    Swal.fire({
                                        text: "Berhasil Di Hapus!",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        } 
                                    });
                                }else{
                                    Swal.fire('Gagal Di Hapus');
                                }
                            }
                        });
                    }
                } 
            });   
        }

        function set_non_aktif_btn_c(e){
            let id = e.getAttribute('data-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda Yakin?',
                text: "Anda akan meng non aktifkan user ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                            type:'PUT',
                            url:'{{url("/admin/set_aktif")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    Swal.fire({
                                        text: "Berhasil Di Non Aktifkan!",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        } 
                                    });
                                }else{
                                    Swal.fire('Gagal Di Non Aktifkan');
                                }
                            }
                        });
                    }
                }
            });   
        }


        function set_aktif_btn_c(e){
            let id = e.getAttribute('data-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda Yakin?',
                text: "Anda akan meng aktifkan user ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                            type:'PUT',
                            url:'{{url("/admin/set_aktif")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    Swal.fire({
                                        text: "Berhasil Di Aktifkan!",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        } 
                                    });
                                }else{
                                    Swal.fire('Gagal Di Aktifkan');
                                }
                            }
                        });
                    }
                }
            });   
        }

        function set_admin_btn_c(e){
            let id = e.getAttribute('data-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda Yakin?',
                text: "Anda akan Menjadikan User ini menjadi Admin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                            type:'PUT',
                            url:'{{url("/admin/set_admin")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    Swal.fire({
                                        text: "Berhasil Di Jadikan Admin!",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        } 
                                    });
                                }else{
                                    Swal.fire('Gagal Di Jadikan Admin');
                                }
                            }
                        });
                    }
                }
            });   
        }


        function set_non_admin_btn_c(e){
            let id = e.getAttribute('data-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda Yakin?',
                text: "Anda menjadian Admin ini menjadian User Biasa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                            type:'PUT',
                            url:'{{url("/admin/set_admin")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    Swal.fire({
                                        text: "Berhasil Di Jadikan User biasa!",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        } 
                                    });
                                }else{
                                    Swal.fire('Gagal Di Jadikan User Biasa');
                                }
                            }
                        });
                    }
                }
            });   
        }


    

    </script>
@endpush



@push('styles')
    <!-- Select2-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
     
@endpush

