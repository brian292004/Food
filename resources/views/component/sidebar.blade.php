<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.adminDashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.adminDashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item {{ request()->routeIs('admin.showUser', 'admin.addUser') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser"
            aria-expanded="{{ request()->routeIs('admin.showUser', 'admin.addUser') ? 'true' : 'false' }}" aria-controls="collapseUser">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản lý tài khoản</span>
        </a>
        <div id="collapseUser" class="collapse {{ request()->routeIs('admin.showUser', 'admin.showShop') ? 'show' : '' }}" 
            aria-labelledby="headingUser" data-bs-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tác vụ:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.showUser') ? 'active' : '' }}" 
                    href="{{ route('admin.showUser') }}">Tài khoản người dùng</a>
                <a class="collapse-item {{ request()->routeIs('admin.showShop') ? 'active' : '' }}" 
                    href="{{ route('admin.showShop') }}">Quán</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.showFood', 'admin.showSale') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseShop"
            aria-expanded="{{ request()->routeIs('admin.showFood', 'admin.showSale') ? 'true' : 'false' }}" aria-controls="collapseShop">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý cửa hàng</span>
        </a>
        <div id="collapseShop" class="collapse {{ request()->routeIs('admin.showFood', 'admin.showSale') ? 'show' : '' }}" 
            aria-labelledby="headingShop" data-bs-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tiện ích của cửa hàng:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.showFood') ? 'active' : '' }}" 
                    href="{{route('admin.showFood')}}">Quản lý món ăn</a>
                <a class="collapse-item" 
                href="{{route('admin.showSale')}}">Quản lý khuyến mãi</a>
                <a class="collapse-item" 
                href="utilities-animation.html">Quản lý giao hàng</a>
                <a class="collapse-item" 
                href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

</ul>