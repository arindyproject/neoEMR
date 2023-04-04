<li class="nav-item active">
<b>>> User Management</b>
</li>

<li class="nav-item active">
    <a href="{{ route('admin') }}" class="nav-link">
        <i class="fas fa-user-plus"></i>
        @if(request()->is('admin'))
        <b>Tambahkan User</b>
        @else
        Tambahan User
        @endif
    </a>
</li>

<li class="nav-item active">
    <a href="{{ route('admin.list_aktif') }}" class="nav-link">
        <i class="fas fa-users"></i>
        @if(request()->is('admin/list_aktif'))
        <b>Daftar User Aktif</b>
        @else
        Daftar User Aktif
        @endif
    </a>
</li>

<li class="nav-item active">
    <a href="{{ route('admin.list_non_aktif') }}" class="nav-link">
        <i class="fas fa-users-slash"></i>
        @if(request()->is('admin/list_non_aktif'))
        <b>Daftar User Non Aktif</b>
        @else
        Daftar User Non Aktif
        @endif
    </a>
</li>

<li class="nav-item active">
    <a href="{{ route('admin.list_admin') }}" class="nav-link">
        <i class="fas fa-user-lock"></i>
        @if(request()->is('admin/list_admin'))
        <b>Daftar Admin</b>
        @else
        Daftar Admin
        @endif
    </a>
</li>

<li class="nav-item active">
<b>>> WEB Management</b>
</li>

<li class="nav-item active">
    <a href="{{ route('admin.web_setting') }}" class="nav-link">
        <i class="fas fa-tools"></i>
        @if(request()->is('admin/web_setting'))
        <b>WEB Setting</b>
        @else
        WEB Setting
        @endif
    </a>
</li>


<li class="nav-item active">
    <b>>> Permission and Roles</b>
</li>

<li class="nav-item active">
    <a href="{{ route('admin.roles') }}" class="nav-link">
        <i class="fas fa-unlock-alt"></i>
        @if(request()->is('admin/roles') || request()->is('admin/roles/*'))
        <b>Roles</b>
        @else
        Roles
        @endif
    </a>
</li>

<li class="nav-item active">
    <a href="{{ route('admin.permissions') }}" class="nav-link">
        <i class="fas fa-key"></i>
        @if(request()->is('admin/permissions') || request()->is('admin/permissions/*'))
        <b>Permission</b>
        @else
        Permission
        @endif
    </a>
</li>

<li class="nav-item active">
    <b>>> Settings </b>
</li>

<li class="nav-item active">
    <a href="{{ route('admin.setting.form.mode') }}" class="nav-link">
        <i class="fab fa-wpforms"></i>
        @if(request()->is('admin/setting/form/mode') || request()->is('admin/setting/form/mode/*'))
        <b>Form Mode</b>
        @else
        Form Mode
        @endif
    </a>
</li>


