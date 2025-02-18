<!DOCTYPE html>
<html lang="{{ session('lang', 'en') }}">

<head>
    @include('component.Default.headerU')
</head>

<body id="page-top" class="{{ session('theme', 'dark') }}">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="content">
                @include('component.Default.navbarU')
                @include('component.Default.sidebarU')
                <div class="container-fluid">
                    @yield('guestBody')
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('component.Default.scriptU')
</body>

<style>
    body.light {
        background-color: white;
        color: black;
    }
    body.dark {
        background-color: #1e1e1e;
        color: #e0e0e0;
    }
    body.dark .container-fluid {
        margin-left: 42px;
        margin-top: 42px;
        width: calc(100vw - 25px);
        padding: 20px;
        box-sizing: border-box;
        background-color: #1e1e1e;
        color: #e0e0e0;
    }
</style>
</html>
