<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('companies.index') }}" class="nav-link {{ Route::is('companies.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-university"></i>
        <p>Companies</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('clients.index') }}" class="nav-link {{ Route::is('clients.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-friends"></i>
        <p>Clients</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('apiTest') }}" class="nav-link {{ Route::is('apiTest') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-friends"></i>
        <p>Api Test</p>
    </a>
</li>
