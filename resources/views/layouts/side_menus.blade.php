<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            <b>
                Home
            </b>
        </p>

    </a>
</li>

@if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('administration'))
<li class="nav-item">
    <a href="{{ route('administration') }}" class="nav-link {{ request()->is('administration/*') ? 'active' : '' }} {{ request()->is('administration') ? 'active' : '' }} {{ request()->is('patient') ? 'active' : '' }} {{ request()->is('patient/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-hospital-user"></i>
        <p>
            <b>
                Administration
            </b>
        </p>

    </a>
</li>
@endif



@if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('kepegawaian'))
<li class="nav-item">
    <a href="{{ route('kepegawaian.index') }}" class="nav-link {{ request()->is('kepegawaian/*') ? 'active' : '' }} {{ request()->is('kepegawaian') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            <b>
                Kepegawaian
            </b>
        </p>

    </a>
</li>
@endif


@if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('attribute'))
<li class="nav-item">
    <a  class="nav-link {{ request()->is('attributes/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cogs"></i>
        <p>
            <b>
                Attributes
            </b>
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('attributes.alamat.country.index') }}" class="nav-link {{ request()->is('attributes/alamat/*') ? 'active' : '' }} ">
                <i class="fas fa-map-marked-alt nav-icon"></i>
                <p>Alamat</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('attributes.jenis.index') }}" class="nav-link {{ request()->is('attributes/jenis/*') ? 'active' : '' }} ">
                <i class="fas fa-tag nav-icon"></i>
                <p>Jenis-Jenis</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('attributes.kepegawaian.profesi.index') }}" class="nav-link {{ request()->is('attributes/kepegawaian/*') ? 'active' : '' }} ">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Kepegawaian</p>
            </a>
        </li>
    </ul>
</li>
@endif




@if (Auth::user()->hasRole('admin'))
<li class="nav-item  ">
    <a href="{{ route('admin') }}"
        class="nav-link {{ request()->is('admin/*') || request()->is('admin') ? 'active' : '' }}">
        <i class="nav-icon fas fa-unlock-alt"></i>
        <p><b>ADMIN</b></p>
    </a>
</li>
@endif
