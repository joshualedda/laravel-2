use App\Livewire\AddUser;
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed " href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('student') }}">
                <i class="bi bi-person-plus"></i>
                <span>Student</span>
            </a>
        </li>
        <!-- End Student Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse">
                <i class="bi bi-book"></i><span>Scholarships</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('viewGrantee') }}">
                        <i class="bi bi-circle"></i><span>View</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="forms-layouts.html">
                        <i class="bi bi-circle"></i><span>Grantee</span>
                    </a>
                </li> --}}
            </ul>
        </li>
        <!-- End Scholarship Nav -->

        @can('admin-access')
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-wrench"></i><span>Settings</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('userAccount') }}">
                        <i class="bi bi-circle"></i><span>Account Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('scholarView') }}">
                        <i class="bi bi-circle"></i><span>Add Scholarships</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('registerUser' )}}">
                        <i class="bi bi-circle"></i><span>Add User Accounts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('auditTrail') }}">
                        <i class="bi bi-circle"></i><span>Audit Trail</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('backUp') }}">
                        <i class="bi bi-circle"></i><span>Data back-up</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('programCampus') }}">
                        <i class="bi bi-circle"></i><span>Programs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('schoolYear') }}">
                        <i class="bi bi-circle"></i><span>School Year</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Settings Nav -->
        @endcan
        @can('staff-access')
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse">
                <i class="bi bi-wrench"></i><span>Settings</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a  href="{{ url('scholarView') }}">
                        <i class="bi bi-circle"></i><span>Add Scholarships</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('auditTrail') }}">
                        <i class="bi bi-circle"></i><span>Audit Trail</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('backUp')}}">
                        <i class="bi bi-circle"></i><span>Data back-up</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('programCampus') }}">
                        <i class="bi bi-circle"></i><span>Programs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('schoolYear') }}">
                        <i class="bi bi-circle"></i><span>School Year</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Settings Nav -->
        @endcan
        @can('incharge-access')
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-wrench"></i><span>Settings</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a  href="{{ url('scholarView') }}">
                        <i class="bi bi-circle"></i><span>Add Scholarships</span>
                    </a>
                </li>
                <a href="{{ url('auditTrail') }}">
                    <i class="bi bi-circle"></i><span>Audit Trail</span>
                </a>
        </li>
        <li>
            <a href="{{ url('programCampus') }}">
                <i class="bi bi-circle"></i><span>Programs</span>
            </a>
        </li>
        <li>
            <a href="{{ url('schoolYear') }}">
                <i class="bi bi-circle"></i><span>School Year</span>
            </a>
        </li>
    </ul>
    </li>
    <!-- End Settings Nav -->

    @endcan

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('studentReports') }}">
            <i class="bi bi-clipboard-data"></i>
            <span>Reports</span>
        </a>
    </li>
    <!-- End Reports Nav -->

    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link collapsed">
                <i class="bi bi-arrow-left-circle"></i>
                <span>Log out</span>
            </button>
        </form>
    </li>
    <!-- End Log out Nav -->

</aside>
<!-- End Sidebar-->