<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin manage appointment - WMSU TEC</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/boxicons/2.0.7/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <!-- js File -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/appointment.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</head>

<body class="admin-dashboard">

    <!-- Header -->
    @include('admin-components.admin-header');

    <!-- Sidebar -->
    @include('admin-components.admin-sidebar');

    <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Appointment</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Appointment</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#appointment-pending-tab">Appointment Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#appointment-accepted-tab">Appointment Accepted</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#appointment-completed-tab">Appointment Completed</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Appointment Pending Tab -->
            <div class="tab-pane fade show active" id="appointment-pending-tab">

                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Client Showed</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table content for appointment pending -->
                    </tbody>
                </table>
            </div>

            <!-- Appointment Accepted Tab -->
            <div class="tab-pane fade" id="appointment-accepted-tab">

                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Client Showed</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table content for appointment accepted -->
                    </tbody>
                </table>
            </div>

            <!-- Appointment Completed Tab -->
            <div class="tab-pane fade" id="appointment-completed-tab">

                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Client Showed</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table content for appointment completed -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>
