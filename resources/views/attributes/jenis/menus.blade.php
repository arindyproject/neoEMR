<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('attributes.jenis.index')}}" class="nav-link {{ request()->is('attributes/jenis') ? 'active' : '' }} ">
        <i class="fas fa-tags"></i>
        <b>Index</b>
    </a>
</li>


<li class="nav-item dropdown d-none d-sm-inline-block">
    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
        <i class="fas fa-bold"></i><b>asic</b>
    </a>
    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
        @include('attributes.jenis.menu_basic')
    </ul>
</li>




