@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/float_menu/st.action-panel.css')}} ">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/float_menu/st.action-panel.js') }}"></script>
<script>
    $(document).ready(function(){
        $('st-actionContainer').launchBtn( { openDuration: 500, closeDuration: 300 } );
    });
</script>
@endpush



<div class="st-actionContainer right-bottom">
	<div class="st-panel">
		<div class="st-panel-header"><i class="fa fa-bars" aria-hidden="true"></i> Menu</div>
		<div class="card-body p-0 overflow-hidden">
            <a href="{{Route('home')}}" class="btn btn-sm btn-block btn-success"><i class="fas fa-home"></i> HOME</a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item ">
                    <a href="{{route('attributes.alamat.country.index')}}" class="nav-link {{ request()->is('attributes/alamat/country') ? 'active' : '' }} {{ request()->is('/attributes/alamat/country/*') ? 'active' : '' }}">
                        <i class="fas fa-flag nav-icon"></i>
                        <b>Country</b>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a href="{{route('attributes.alamat.provinsi.index')}}" class="nav-link {{ request()->is('attributes/alamat/provinsi') ? 'active' : '' }} {{ request()->is('/attributes/alamat/provinsi/*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt nav-icon"></i>
                        <b>Provinsi</b>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a href="{{route('attributes.alamat.kota.index')}}" class="nav-link {{ request()->is('attributes/alamat/kota') ? 'active' : '' }} {{ request()->is('/attributes/alamat/kota/*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt nav-icon"></i>
                        <b>Kota / Kabupaten</b>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a href="{{route('attributes.alamat.kecamatan.index')}}" class="nav-link {{ request()->is('attributes/alamat/kecamatan') ? 'active' : '' }} {{ request()->is('/attributes/alamat/kecamatan/*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt nav-icon"></i>
                        <b>Kecamatan</b>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a href="{{route('attributes.alamat.kelurahan.index')}}" class="nav-link {{ request()->is('attributes/alamat/kelurahan') ? 'active' : '' }} {{ request()->is('/attributes/alamat/kelurahan/*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt nav-icon"></i>
                        <b>Desa / Kelurahan</b>
                    </a>
                </li>
            </ul>
            <a href="{{Route('attributes.alamat.setting.index')}}" class="btn btn-sm btn-block btn-success"><i class="fas fa-cogs"></i> SETTING</a>
        </div>
        
	</div>
	<div class="st-btn-container right-bottom">
		<div class="st-button-main"><i class="fa fa-bars" aria-hidden="true"></i></div>
	</div>
</div>
