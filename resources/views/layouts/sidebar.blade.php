<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="45">
            </span>
            <span class="logo-lg" >
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="120" style="margin-block:20px">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="45">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="120" style="margin-block:20px">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/dashboard') }}"  role="button" >
                        <i data-feather="home" class="icon-dual"></i> <span>@lang('translation.dashboards')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.pages')</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/courrire" role="button" >
                        <i data-feather="layout" class="icon-dual"></i> <span>@lang('translation.courrire')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="/decharge" role="button" >
                        <i data-feather="layout" class="icon-dual"></i> <span>@lang('translation.decharge')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/emetteur" role="button" >
                        <i data-feather="layout" class="icon-dual"></i> <span>@lang('translation.emetteur')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
