@section('sidebar')
<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
    </div>
    @if(auth()->user() != null)
    <div class="info">
        <a href="#" class="d-block">Welcome, {{auth()->user()->name}}!</a>
    </div>
    @endif
    @if(auth()->user() == null)
    {{header("Location: /logout")}}
    {{exit()}}
    @endif
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <!-- assign roll type privillage for the side bar options -->

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    Dashboards
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Main dashboard</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    Settings
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('send_sms')
                <li class="nav-item">
                    <a href="{{ url('/sms') }}" class="nav-link {{ Request::is('sms') ? 'active' : '' }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>Send SMS</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>

        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('admin-rights')
                <li class="nav-item">
                    <a href="{{ url('./users_list') }}" class="nav-link {{ Request::is('/users') ? 'active' : '' }}">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Create User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('./privillege_add') }}" class="nav-link {{ Request::is('/privillege_add') ? 'active' : '' }}">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Privillege Add</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('./rolls') }}" class="nav-link {{ Request::is('rolls') ? 'active' : '' }}">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Create Role</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

@endsection