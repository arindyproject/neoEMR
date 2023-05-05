<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('administration')}}" class="nav-link {{ request()->is('administration') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt nav-icon"></i>
        <b>Dashboard</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('patient.index')}}" class="nav-link {{ request()->is('patient') ? 'active' : '' }} ">
        <i class="fas fa-user-injured nav-icon"></i>
        <b>Patients</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('patient.index2')}}" class="nav-link {{ request()->is('patient2') ? 'active' : '' }} ">
        <i class="fas fa-user-injured nav-icon"></i>
        <b>Patients V2</b>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('patient.create')}}" class="nav-link {{ request()->is('patient/create') ? 'active' : '' }} ">
        <i class="fas fa-user-plus nav-icon"></i>
        <b>Add NEW Patient</b>
    </a>
</li>

@if(Auth::user()->hasRole('admin'))
<li class="nav-item d-none d-sm-inline-block">
    <a href="{{route('administration.setting.index')}}" class="nav-link {{ request()->is('administration/setting') || request()->is('administration/setting/*') ? 'active' : '' }} ">
        <i class="fas fa-tools"></i>
        <b>Setting</b>
    </a>
</li>
@endif
