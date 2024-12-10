<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <title></title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="assets/css/multi.min.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">

                <h2><a href="dashboard.php" class="navbar-brand p-0">Gym Management</a></h2>

            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        Membership Type
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;"
                            viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color" id="homeSubmenu">
                        <li>
                            <a href="{{ route('showMembership') }}">Membership</a>
                        </li>
                        <li>
                            <a href="{{ route('showCategory') }}">Category</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        Member Management
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;"
                            viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color" id="homeSubmenu1">
                        <li>
                            <a href="{{ route('showStaff') }}">Staff Member</a>
                        </li>
                        <li>
                            <a href="{{ route('showMember') }}">Member</a>
                        </li>
                        <li>
                            <a href="{{ route('showRole') }}">Role</a>
                        </li>
                        <li>
                            <a href="{{ route('showspecial') }}">Specialization</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('showGroup') }}">Group</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        Attendance
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;"
                            viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color" id="pageSubmenu">
                        <li>
                            <a href="{{ route('memberAttendance') }}">Member Attendance</a>
                        </li>
                        <li>
                            <a href="{{ route('staffAttendance') }}">Staff Member Attendance</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        Reports
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;"
                            viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color" id="reports">
                        <li>
                            <a href="{{ route('reportView') }}">Attendance Report</a>
                        </li>
                        <li>
                            <a href="membership-report.php">Membership Report</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <div class="container-fluid p-0">
            <div class="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-info">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            <!-- <span>Toggle Sidebar</span> -->
                        </button>
                        <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button> -->
                        <div class="dropdown" style="padding:12px 0;">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi, {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('profile') }}">My Profile</a>
                                <!-- Replace this with the Breeze logout form -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </div>
                        </div>

                    </div>

                </nav>




                @yield('content')




                <!-- <footer class="bg-danger p-2 text-white text-center" style="margin-left:250px;">
©  | <a class="text-white" href="https://www.yahoobaba.net/" target="_blank">YahooBaba</a>
</footer> -->

                <script src="{{ asset('assets/js/jquery.js') }}"></script>
                <script src="{{ asset('assets/js/popper.min.js') }}"></script>
                <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
                <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
                <script src="{{ asset('assets/js/datatables.bootstrap.min.js') }}"></script>
                <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
                <script src="{{ asset('assets/js/dataTables.buttons.html5.min.js') }}"></script>
                <script src="{{ asset('assets/js/dataTables.print.min.js') }}"></script>
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <script src="{{ asset('assets/js/dataTables.vfs_fonts.min.js') }}"></script>
                <script src="{{ asset('assets/js/multi.min.js') }}"></script>
                <script src="{{ asset('assets/js/admin.js') }}"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.table-data').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'excel', 'pdf', 'print'
                            ]
                        });


                        $('.select2').select2();

                        // load image with jquery
                        $('.image').change(function() {
                            readURL(this);
                        });

                        // preview image before upload
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#image').attr('src', e.target.result);
                                }
                                reader.readAsDataURL(input.files[0]); // convert to base64 string
                            }
                        }

                        $('#sidebarCollapse').on('click', function() {
                            $('#sidebar').toggleClass('active');
                        });

                    });
                </script>

</body>

</html>
