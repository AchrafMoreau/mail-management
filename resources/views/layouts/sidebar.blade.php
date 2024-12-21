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
                <img src="{{ URL::asset('build/images/logo-lg-nav.png') }}" alt="" >
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="45">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-lg-nav.png') }}" alt="" >
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
                <li class="menu-title">
                    <span class="name">{{ Auth::user()->setting->name }}</span>
                    <div class="bar"></div>
                </li>
                <li class="menu-title"><span>@lang('translation.menu')</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/dashboard') }}"  role="button" >
                        <i class="ri-line-chart-line"></i> <span>@lang('translation.statistic')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.pages')</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url("/courrire")}}" role="button" >
                        <i class="ri-archive-line"></i> <span>@lang('translation.courrire')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/mail' )}}" role="button" >
                        <i class=" ri-mail-line"></i> <span>@lang('translation.mail')</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('destination') }}" role="button" >
                        <i class=" ri-inbox-archive-line"></i> <span>@lang('translation.destinations')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url("expediteur") }}" role="button" >
                        <i class="ri-inbox-unarchive-line"></i> <span>@lang('translation.expediteur')</span>
                    </a>
                </li> <!-- end Dashboard Menu --> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
