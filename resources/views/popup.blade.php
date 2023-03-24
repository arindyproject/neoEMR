@if (\App\Models\Config::get()['pop_up'] == "1")
    @push('scripts')
    <script>
        $(function(){
            $('#modal-pop-up').modal('show');
        });
    </script>
    @endpush


    <div class="modal fade" id="modal-pop-up">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 text-center">
                            <img src="{{ asset('images/icon') .'/'. \App\Models\Config::get()['icon_mini'] }}"  class="profile-user-img img-fluid img-circle" >
                        </div>

                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 text-center">
                            <h5><b>{{ \App\Models\Config::get()['name'] }}</b></h5>
                            <h6><b><i>{{ \App\Models\Config::get()['tag_line'] }}</i></b></h6>
                            <p>
                                {{ \App\Models\Config::get()['alamat'] }} , {{ \App\Models\Config::get()['email'] }} - {{ \App\Models\Config::get()['no_tlp'] }}
                            </p>
                        </div>
                        
                        <hr>
                        <div class="col-12">
                            <b>Jangan Lupa diFollow ya..</b>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                            <a href="https://github.com/arindyproject" target="_blank" class="btn btn-app bg-{{\App\Models\Config::get()['navbar_variants']}}"> 
                                <i class="fab fa-github"></i> 
                                GitHub
                            </a>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                            <a href="https://www.youtube.com/@arindyproject" target="_blank" class="btn btn-app bg-{{\App\Models\Config::get()['navbar_variants']}}"> 
                                <i class="fab fa-youtube"></i> 
                                Youtube
                            </a>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                            <a href="https://www.instagram.com/arindyproject" target="_blank" class="btn btn-app bg-{{\App\Models\Config::get()['navbar_variants']}}"> 
                                <i class="fab fa-instagram"></i> 
                                arindyproject
                            </a>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                            <a href="https://www.instagram.com/devarindy" target="_blank" class="btn btn-app bg-{{\App\Models\Config::get()['navbar_variants']}}"> 
                                <i class="fab fa-instagram"></i> 
                                devarindy
                            </a>
                        </div>


                    </div>
                </div>

                <div class="modal-footer justify-content-right">
                    <button type="button" class="btn bg-{{\App\Models\Config::get()['navbar_variants']}}" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif