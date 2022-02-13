@section('sidebar-header')
    <img src="{{ asset('/assets/images/logo.svg') }}" alt="" srcset="">
@endsection

@section('sidebar-menu')

    <ul class="menu">
        
        <li class='sidebar-title'>Main Menu</li>

        <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }} ">
        <a href="{{ url('/') }}" class='sidebar-link'>
                <i data-feather="home" width="20"></i> 
                <span>Dashboard</span>
            </a>
        </li>

        <li class="
            sidebar-item  has-sub 
            {{ Request::is('course', 'course/*') ? 'active' : '' }}
        ">
            <a href="#" class='sidebar-link'>
                <i data-feather="layers" width="20"></i> 
                <span>Program</span>
            </a>
            
            <ul class="
                submenu 
                {{ Request::is('course') ? 'active' : '' }}
            ">
                <li style="
                    {{ 
                        Request::is('course') ? 'color: #96d4f9;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('/course') }}">Courses</a>
                </li>
                <li style="
                    {{ 
                        Request::is('webinar') ? 'color: #96d4f9;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('/webinar') }}">Webinar</a>
                </li>
                <li style="
                    {{ 
                        Request::is('seminar') ? 'color: #96d4f9;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('/seminar') }}">Seminar</a>
                </li>
            </ul>
        </li>

        <li class="
            sidebar-item  has-sub 
            {{-- {{ Request::is('course', 'course/*') ? 'active' : '' }} --}}
        ">
            <a href="#" class='sidebar-link'>
                <i data-feather="layers" width="20"></i> 
                <span>Konten</span>
            </a>
            
            <ul class="
                submenu 
                {{ Request::is('blog') ? 'active' : '' }}
            ">
                <li style="
                    {{ 
                        Request::is('blog') ? 'color: #96d4f9;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('/blog') }}">Blogs</a>
                </li>
                <li style="
                    {{ 
                        Request::is('about') ? 'color: #96d4f9;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('/about') }}">About us</a>
                </li>
                <li style="
                    {{ 
                        Request::is('kontak') ? 'color: #96d4f9;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('/kontak') }}">Kontak</a>
                </li>
            </ul>
        </li>
@endsection

@section('navbar')

    <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
        <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar mr-1">
                            <img src="{{ asset('/assets/images/avatar/avatar-s-1.png') }}" alt="" srcset="">
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">Hi, {{Session::get('nama')}}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                        <a class="dropdown-item" href="#"><i data-feather="mail"></i> Messages</a>
                        <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('logout') }}"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

@endsection