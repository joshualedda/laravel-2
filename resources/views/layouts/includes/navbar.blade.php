@if(Auth::user()->role === 1)
<style>
#header {
background-color:lightcoral;
}
</style>
@elseif(Auth::user()->role === 0)
<style>
#header {
background-color:lightyellow;
}
</style>
@elseif(Auth::user()->role === 2)
<style>
#header {
background-color:lightgreen;
}
</style>
@endif
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <div class="logo d-flex align-items-center">
            <img src="{{ asset('assets/images/updated.png') }}" alt="">
            <span>DMMMSU</span>
        </div>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul>
                <!-- End Notification Dropdown Items -->
            </li>
            <!-- End Notification Nav -->


            <li class="nav-item pe-3">

                <div class="nav-profile align-items-center p-2" href="#">
                    <h6 class="profile-name">{{ auth()->user()->name }}</h6>
                    <span class="profile-role">{{ auth()->user()->getRoleText() }}</span>
                </div>
                <!-- End Profile Iamge Icon -->
            </li>
            <!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
