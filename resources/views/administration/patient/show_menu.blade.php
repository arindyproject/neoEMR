<li class="nav-item">
    <a class="nav-link {{ request()->is('patient/show/'.$data->no_rm)  ? 'active' : '' }}" href="{{Route('patient.show', $data->no_rm)}}" ><i class="fas fa-tachometer-alt"></i> <b>Dashboard</b></a>
</li>

@if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('administration'))
<li class="nav-item">
    <a class="nav-link {{ request()->is('administration/pendaftaran/'.$data->no_rm)  ? 'active' : '' }}" href="{{Route('administration.pendaftaran', $data->no_rm)}}" ><i class="fas fa-calendar-plus"></i> <b>Pendaftaran</b></a>
</li>
@endif

<li class="nav-item">
    <a class="nav-link {{ request()->is('administration/history/'.$data->no_rm)  ? 'active' : '' }}" href="{{Route('administration.history', $data->no_rm)}}" ><i class="fas fa-history"></i> <b>History</b></a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('file/patient/'.$data->no_rm)  ? 'active' : '' }}" href="{{Route('file.patient.index', $data->no_rm)}}" ><i class="fas fa-file-medical"></i> <b>File</b></a>
</li>