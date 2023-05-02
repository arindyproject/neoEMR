<li class="nav-item">
    <a class="nav-link {{ request()->is('patient/show/'.$data->no_rm)  ? 'active' : '' }}" href="{{Route('patient.show', $data->no_rm)}}" ><i class="fas fa-tachometer-alt"></i> <b>Dashboard</b></a>
</li>

@if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('administration'))
@if ($data->active)
<li class="nav-item">
    <a class="nav-link {{ request()->is('administration/pendaftaran/'.$data->id)  ? 'active' : '' }}" href="{{Route('administration.pendaftaran', $data->id)}}" ><i class="fas fa-calendar-plus"></i> <b>Pendaftaran</b></a>
</li>
@endif
@endif

<li class="nav-item">
    <a class="nav-link {{ request()->is('administration/history/'.$data->id)  ? 'active' : '' }}" href="{{Route('administration.history', $data->id)}}" ><i class="fas fa-history"></i> <b>History</b></a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('file/patient/'.$data->id)  ? 'active' : '' }}" href="{{Route('file.patient.index', $data->id)}}" ><i class="fas fa-file-medical"></i> <b>File</b></a>
</li>