<!DOCTYPE html>
<html lang="en">


<!-- index  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('Res/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Res/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('Res/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Res/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('Res/assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Res/assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Res/assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('Res/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Res/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('Res/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Res/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('Res/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('Res/assets/img/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i
                                    data-feather="align-justify"></i></a></li>

                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                                src="{{ asset('Res/assets/img/user.png') }}" class="user-img-radious-style"> <span
                                class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <a href="profile" class="dropdown-item has-icon"> <i class="far
										fa-user"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="auth-login" class="dropdown-item has-icon text-danger"> <i
                                    class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index"> <img alt="image" src="{{ asset('Res/assets/img/logo.png') }}"
                                class="header-logo" /> <span class="logo-name">Welcome</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown active">
                            <a href="" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="/program" class="nav-link"><i
                                    data-feather="monitor"></i><span>Programs</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="/class" class="nav-link"><i
                                    data-feather="monitor"></i><span>Classes</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="/section" class="nav-link"><i
                                    data-feather="monitor"></i><span>Section</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="/subjects" class="nav-link"><i
                                    data-feather="monitor"></i><span>Subjects</span></a>
                        </li>
                        <li class="menu-header">Student Section</li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="layout"></i><span>Student Form</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/student-form">Add Student Form</a></li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="datatables">Manage Student</a></li>
                            </ul>
                        </li>




                        {{-- Parents drop down --}}
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="layout"></i><span>Parents </span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/parents-advanced-form">Add Parent</a></li>
                                <li><a class="nav-link" href="/parents-datatables">Manage Parents</a></li>
                            </ul>
                        </li>

                        {{-- DateSheet drop down --}}
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="layout"></i><span>DateSheet </span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/datesheet-form">Make new DateSheet</a></li>
                                <li><a class="nav-link" href="/dateSheet-datatable">show DateSheet</a></li>
                            </ul>
                        </li>
                        {{-- Promotion --}}
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="layout"></i><span>Students Promotion</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/promote-student">Promote Student Form</a></li>
                            </ul>
                            {{-- <ul class="dropdown-menu">
                                <li><a class="nav-link" href="">Manage Student</a></li>
                            </ul> --}}
                        </li>
                        {{-- timeTable --}}
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="layout"></i><span>Time Tables</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/timetable">Make new TimeTable</a></li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/timetable-datatable">show TimeTables</a></li>
                            </ul>
                        </li>

                        {{-- Passout student --}}
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="layout"></i><span>Student passout</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/passoutstudent">Moving students Out</a></li>
                            </ul>
                            {{-- <ul class="dropdown-menu">
                                <li><a class="nav-link" href="">Show passed out student</a></li>
                            </ul> --}}
                        </li>

                    </ul>
                </aside>
            </div>
