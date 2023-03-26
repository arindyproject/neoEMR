<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('administration')}}" class="nav-link {{ request()->is('administration') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt nav-icon"></i>
        <b>Dashboard</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('patient.index')}}" class="nav-link {{ request()->is('patient') ? 'active' : '' }}">
        <i class="fas fa-user-injured nav-icon"></i>
        <b>Patients</b>
    </a>
</li>
