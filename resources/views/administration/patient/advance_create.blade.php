@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/selectize/selectize.bootstrap3.min.css') }}"> 
@endpush

<!--Name ----------------------------------------------------------- -->
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card  collapsed-card">
        <div class="card-header bg-{{$bg}}">
            <h3 class="card-title">
                <i class="far fa-id-badge"></i> <b>Name</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div id="form-name">
                
            </div>
            <button type="button" class="btn btn-sm btn-info btn-block btn-add-name"><i class="fas fa-plus-circle"></i> ADD</button>
        </div>
    </div>
</div>
<!--Name ----------------------------------------------------------- -->


<!--Identifier ----------------------------------------------------------- -->
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card  collapsed-card">
        <div class="card-header bg-{{$bg}}">
            <h3 class="card-title">
                <i class="fas fa-id-card"></i> <b>Identifier</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div id="form-identifier">

            </div>
            <button type="button" class="btn btn-sm btn-info btn-block btn-add-identifier"><i class="fas fa-plus-circle"></i> ADD</button>
        </div>
    </div>
</div>
<!--Identifier ----------------------------------------------------------- -->


<!--contact ----------------------------------------------------------- -->
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card  collapsed-card">
        <div class="card-header bg-{{$bg}}">
            <h3 class="card-title">
                <i class="far fa-address-book"></i> <b>Contact</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>

            </div>
        </div>

        <div class="card-body">
        </div>
    </div>
</div>
<!--contact ----------------------------------------------------------- -->


<!--communication ----------------------------------------------------------- -->
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card  collapsed-card">
        <div class="card-header bg-{{$bg}}">
            <h3 class="card-title">
                <i class="fas fa-language"></i> <b>Communication</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>

            </div>
        </div>

        <div class="card-body">
        </div>
    </div>
</div>
<!--communication ----------------------------------------------------------- -->



<!--address ----------------------------------------------------------- -->
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card  collapsed-card">
        <div class="card-header bg-{{$bg}}">
            <h3 class="card-title">
                <i class="fas fa-map-marker-alt"></i> <b>Address</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>

            </div>
        </div>

        <div class="card-body">
        </div>
    </div>
</div>
<!--address ----------------------------------------------------------- -->



<!--telecom ----------------------------------------------------------- -->
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card  collapsed-card">
        <div class="card-header bg-{{$bg}}">
            <h3 class="card-title">
                <i class="fas fa-phone"></i> <b>Telecom</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>

            </div>
        </div>

        <div class="card-body">
        </div>
    </div>
</div>
<!--telecom ----------------------------------------------------------- -->