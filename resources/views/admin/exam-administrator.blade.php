<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Exam Administrator - WMSU TEC</title>
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
    <link href="{{ asset('css/ADMIN.css') }}" rel="stylesheet">
    <!-- JS Files -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/addexam.js') }}"></script>
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
            <h1>Exam administrator</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Administrator</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#exam-administrator">Proctors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#attendance-list">Attendance List</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Proctor Table -->
            <div class="tab-pane active" id="exam-administrator">
                <div class="table-responsive">
                    <table class="application-table" id="proctor-table">
                        <thead>
                            <tr>
                                <th>Proctor Name</th>
                                <th>Venue</th>
                                <th>Room</th>
                                <th>School Year</th>
                                <th>Capacity</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample data for proctors (replace with actual data) -->
                            <tr>
                                <td>John Smith</td>
                                <td>Exam Venue 101</td>
                                <td>Room A</td>
                                <td>2023-2024</td>
                                <td>30</td>
                                <td>First Floor CLA Building</td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#proctorInstructionsModal">View</button>
                                    <button class="btn btn-danger">Edit</button>
                                </td>
                            </tr>
                            <!-- Add more proctor entries as needed -->
                        </tbody>
                    </table>
                </div>
            </div>

        <!-- Attendance List -->
        <div class="tab-pane" id="attendance-list">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block" id="scanQRCodeButton">Scan QR Code</button>
                        <div id="preview"></div>
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <table class="table table-bordered" id="attendanceListTable">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Attendance data will be displayed here -->
                        <tr>
                            <td>John Doe</td>
                            <td>Present</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Present</td>
                        </tr>
                        <!-- Add more rows as needed with JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Instructions Modal -->
        <div class="modal fade" id="proctorInstructionsModal" tabindex="-1" role="dialog" aria-labelledby="proctorInstructionsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="proctorInstructionsModalLabel">Proctor Instructions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your proctor instructions here -->
                        <p>Welcome, Proctor! Here are your instructions:</p>
                        <ol>
                            <li>Scan the QR code to check the applicants' information.</li>
                            <li>Ensure that all registered applicants are present.</li>
                            <li>Report any issues or discrepancies to the exam administrators.</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </main>
</body>

</html>
