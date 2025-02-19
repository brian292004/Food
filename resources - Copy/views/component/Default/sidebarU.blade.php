<div class="sidebar">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="text-decoration: none;">
        <img src="{{ asset('img/logo_chef.png') }}" alt="Logo" style="height: 66px; width: auto; margin-right: 10px;">
        <span class="nav_web-title">Balancia</span>
    </a>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Sidebar Items -->
    <ul class="menu-items">
        <li>
            <a href="{{ route('home') }}">
                <i class="fas fa-search"></i>
                <span class="sidebar-text" data-lang-key="search">Search</span>
            </a>
        </li>
        <li>
            <a href="{{ route('product-catalog') }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="sidebar-text" data-lang-key="product_catalog"></span>
            </a>
        </li>
        <li>
            <a href="{{ route('food-list') }}">
                <i class="fas fa-chart-bar"></i>
                <span class="sidebar-text" data-lang-key="dashboard"></span>
            </a>
        </li>
        <li>
            <a href="{{ route('/') }}">
                <i class="fas fa-bell"></i>
                <span class="sidebar-text" data-lang-key="notifications">Notifications</span>
            </a>
        </li>
        <li>
            <a href="{{ route('/') }}">
                <i class="fas fa-heart"></i>
                <span class="sidebar-text" data-lang-key="favorites">Favorites</span>
            </a>
        </li>
        <li>
            <a href="{{ route('/') }}">
                <i class="fas fa-folder"></i>
                <span class="sidebar-text" data-lang-key="files">Files</span>
            </a>
        </li>
    </ul>

    <div class="divider"></div>

    <!-- Utility Items -->
    <ul>
        <li>
            <a href="" class="toggle-dark-mode">
                <i class="fas fa-moon"></i>
                <span class="sidebar-text" data-lang-key="dark_mode">Dark Mode</span>
            </a>
        </li>
        <li>
            <a href="" class="toggle-language">
                <i class="fas fa-language"></i>
                <span class="sidebar-text" data-lang-key="language">Language</span>
            </a>
        </li>
    </ul>

    <div class="divider"></div>

    <!-- Auth Items -->
    <ul class="auth-items">
        <li>
            <a href="{{ route('/') }}">
                <i class="fas fa-user-plus"></i>
                <span class="sidebar-text" data-lang-key="sign_up">Sign Up</span>
            </a>
        </li>
        <li>
            <a href="{{ route('/') }}">
                <i class="fas fa-sign-in-alt"></i>
                <span class="sidebar-text" data-lang-key="sign_in">Sign In</span>
            </a>
        </li>
    </ul>
</div>