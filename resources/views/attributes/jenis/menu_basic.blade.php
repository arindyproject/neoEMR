
<li class="nav-item  d-sm-inline-block ">
    <a href="{{route('attributes.jenis.agama.index')}}" class="nav-link {{ request()->is('attributes/jenis/agama') ? 'active' : '' }} {{ request()->is('attributes/jenis/agama/*') ? 'active' : '' }}">
        <i class="fas fa-praying-hands nav-icon"></i>
        <b>Agama</b>
    </a>
</li>


<li class="nav-item  d-sm-inline-block">
    <a href="{{route('attributes.jenis.kartu_identitas.index')}}" class="nav-link {{ request()->is('attributes/jenis/kartu_identitas') ? 'active' : '' }} {{ request()->is('attributes/jenis/kartu_identitas/*') ? 'active' : '' }}">
        <i class="nav-icon far fa-id-card"></i>
        <b>Kartu Identitas</b>
    </a>
</li>


<li class="nav-item  d-sm-inline-block">
    <a href="{{route('attributes.jenis.kelamin.index')}}" class="nav-link {{ request()->is('attributes/jenis/kelamin') ? 'active' : '' }} {{ request()->is('attributes/jenis/kelamin/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-venus-mars"></i>
        <b>Kelamin / Sex</b>
    </a>
</li>


<li class="nav-item  d-sm-inline-block">
    <a href="{{route('attributes.jenis.pekerjaan.index')}}" class="nav-link {{ request()->is('attributes/jenis/pekerjaan') ? 'active' : '' }} {{ request()->is('attributes/jenis/pekerjaan/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-tie"></i>
        <b>Pekerjaan</b>
    </a>
</li>

<li class="nav-item  d-sm-inline-block">
    <a href="{{route('attributes.jenis.pendidikan.index')}}" class="nav-link {{ request()->is('attributes/jenis/pendidikan') ? 'active' : '' }} {{ request()->is('attributes/jenis/pendidikan/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-graduation-cap"></i>
        <b>Pendidikan</b>
    </a>
</li>

<li class="nav-item  d-sm-inline-block">
    <a href="{{route('attributes.jenis.pernikahan.index')}}" class="nav-link {{ request()->is('attributes/jenis/pernikahan') ? 'active' : '' }} {{ request()->is('attributes/jenis/pernikahan/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-hand-holding-heart"></i>
        <b>Pernikahan</b>
    </a>
</li>

