<div class="vertical-menu">

    <div data-simplebar class="h-100">


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>All pages Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('home.slide')}} ">Home slide</a></li>
                        <li><a href="{{route('about.page')}} ">Add About page</a></li>
                        <li><a href="{{route('about.multi.image')}} ">Add multi image</a></li>
                        <li><a href="{{route('all.multi.image')}} ">Display multi images</a></li>
                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Other sections Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Footer setup</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('footer.setup')}}"> Footer</a></li>
                            </ul>
                        </li>

                    </ul>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Portfolio setup</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('all.portfolio')}}"> All portfolio</a></li>
                                <li><a href="{{route('create.portfolio')}}"> Create portfolio</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login.html">Login</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-recoverpw.html">Recover Password</a></li>
                        <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                    </ul>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

