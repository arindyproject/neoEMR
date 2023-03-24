<li class="nav-item">
    <a class="nav-link {{ request()->is('profile/*') && !request()->is('profile/*/file') ? 'active' : '' }}" href="{{Route('profile', $id)}}" ><i class="fas fa-tachometer-alt"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('profile/*/file') ? 'active' : '' }}" href="{{Route('profile.file', $id)}}" ><i class="fas fa-folder-open"></i> Files</a>
</li>