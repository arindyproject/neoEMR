<li class="nav-item active">
    <div class="text-center">
        @if($data->photo != "")
        <img class="profile-user-img img-fluid img-circle" src="/images/profile/{{$data->photo}}">
        @else
        <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/dist/img/avatar5.png')}}">
        @endif
    </div>
    <h3 class="profile-username text-center"><b>{{$data->name}}</b></h3>
    <p class="text-muted text-center">{{$data->username}}</p>
    <a href="{{route('profile',$data->id )}}" type="button" class="btn btn-block btn-success bg-{{$bg}}">
        <i class="fas fa-eye"></i>Lihat
    </a>
</li>


<li class="nav-item active">
    <a href="{{ route('profile.edit', $data->id) }}" class="nav-link">
        <i class="fas fa-user-edit"></i>
        @if( request()->is('profile/edit/*') &&  !request()->is('profile/edit/advance/*')  )
        <b>Edit Profile</b>
        @else
        Edit Profile
        @endif
    </a>
</li>


<li class="nav-item active">
    <a href="{{ route('profile.file.create', $data->id) }}" class="nav-link">
        <i class="fas fa-file-import"></i>
        @if( request()->is('profile/file/create/*') || request()->is('profile/file/edit/*') )
        <b>Upload File</b>
        @else
        Upload File
        @endif
    </a>
</li>

<li class="nav-item active">
    <a href="{{ route('profile.signature', $data->id) }}" class="nav-link">
        <i class="fas fa-signature"></i>
        @if( request()->is('profile/signature/*')  )
        <b>Signature</b>
        @else
        Signature
        @endif
    </a>
</li>

<li class="nav-item active">
    <a href="{{ route('profile.edit.advance', $data->id) }}" class="nav-link">
        <i class="fas fa-info-circle"></i>
        @if(request()->is('profile/edit/advance/*'))
        <b>Edit Advance Profile</b>
        @else
        Edit Advance Profile
        @endif
    </a>
</li>

<li class="nav-item active">
    <a href="{{ route('profile.ganti_password', $data->id) }}" class="nav-link">
        <i class="fas fa-key"></i>
        @if(request()->is('profile/ganti_password/*'))
        <b>Ganti Password</b>
        @else
        Ganti Password
        @endif
    </a>
</li>


@if (Auth::user()->hasRole('admin'))
<li class="nav-item active">
    <a href="{{ route('profile.edit.role', $data->id) }}" class="nav-link">
        <i class="fas fa-user-lock"></i>
        @if(request()->is('profile/edit_role/*'))
        <b>Edit Roles</b>
        @else
        Edit Roles
        @endif
    </a>
</li>   
@endif





