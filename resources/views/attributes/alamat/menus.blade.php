<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('attributes.alamat.country.index')}}" class="nav-link {{ request()->is('attributes/alamat/country') ? 'active' : '' }} {{ request()->is('/attributes/alamat/country/*') ? 'active' : '' }}">
        <i class="fas fa-flag nav-icon"></i>
        <b>Country</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('attributes.alamat.provinsi.index')}}" class="nav-link {{ request()->is('attributes/alamat/provinsi') ? 'active' : '' }} {{ request()->is('/attributes/alamat/provinsi/*') ? 'active' : '' }}">
        <i class="fas fa-map-marker-alt nav-icon"></i>
        <b>Provinsi</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('attributes.alamat.kota.index')}}" class="nav-link {{ request()->is('attributes/alamat/kota') ? 'active' : '' }} {{ request()->is('/attributes/alamat/kota/*') ? 'active' : '' }}">
        <i class="fas fa-map-marker-alt nav-icon"></i>
        <b>Kota / Kabupaten</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('attributes.alamat.kecamatan.index')}}" class="nav-link {{ request()->is('attributes/alamat/kecamatan') ? 'active' : '' }} {{ request()->is('/attributes/alamat/kecamatan/*') ? 'active' : '' }}">
        <i class="fas fa-map-marker-alt nav-icon"></i>
        <b>Kecamatan</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('attributes.alamat.kelurahan.index')}}" class="nav-link {{ request()->is('attributes/alamat/kelurahan') ? 'active' : '' }} {{ request()->is('/attributes/alamat/kelurahan/*') ? 'active' : '' }}">
        <i class="fas fa-map-marker-alt nav-icon"></i>
        <b>Desa / Kelurahan</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('attributes.alamat.setting.index')}}" class="nav-link {{ request()->is('attributes/alamat/setting') ? 'active' : '' }} {{ request()->is('/attributes/alamat/setting/*') ? 'active' : '' }}">
        <i class="fas fa-cogs nav-icon"></i>
        <b>Setting</b>
    </a>
</li>
