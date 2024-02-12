<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Exam Management - WMSU TEC</title>
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
    <!--  Main CSS File -->
    <link href="{{ asset('css/ADMIN.css') }}" rel="stylesheet">
    <!--   js File -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/addexam.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</head>
   <!--  NOT FINAL YET ON THIS PAGE -->
<body class="admin-dashboard">

    <!-- ======= Header ======= -->
    @include('admin-components.admin-header');
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin-components.admin-sidebar');
    <!-- End Sidebar -->

    <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Admin Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Examination</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#result-management-tab">Result Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#individualresult-management-tab">Individual result Management</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Result Management Tab -->
            <div class="tab-pane fade show active" id="result-management-tab">
                <div class="container-fluid">
                    <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#uploadResultModal">
                        Upload Result
                    </button>
                    <!-- Modal for Upload Result -->
                    <div class="modal fade" id="uploadResultModal" tabindex="-1" role="dialog" aria-labelledby="uploadResultModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadResultModalLabel">Upload Result</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Upload Result Form -->
                                    <form id="uploadResultForm">
                                        <div class="form-group">
                                            <label for="examType">Exam Type:</label>
                                            <select class="form-control" id="examType" name="examType">
                                                <option value="CET">CET</option>
                                                <option value="NAT">NAT</option>
                                                <option value="EAT">EAT</option>
                                                <option value="GSAT">GSAT</option>
                                                <option value="LSAT">LSAT</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="examYear">Exam Year:</label>
                                            <input type="text" class="form-control" id="examYear" name="examYear" placeholder="Enter Exam Year">
                                        </div>
                                        <div class="form-group">
                                            <label for="resultFile">Upload Result File:</label>
                                            <input type="file" class="form-control-file" id="resultFile" name="resultFile">
                                        </div>
                                    </form>
                                    <!-- End Upload Result Form -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success" id="submitResult">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Result Table -->
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Exam Type</th>
                                    <th>Exam Year</th>
                                    <th>Uploaded File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example row -->
                                <tr>
                                    <td>CET</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <a href="link_to_uploaded_file.pdf" target="_blank">View File</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary">Edit</button>
                                        <button class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <!-- End Result Table -->
                </div>
            </div>
            <!-- End Result Management Tab -->


<!-- Individual Result Management Tab -->
<div class="tab-pane fade" id="individualresult-management-tab">
    <div class="container">
        <!-- Individual Result Search Form -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form id="search-individual-result-form">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="applicant-no">Applicant No.</label>
                            <input type="text" class="form-control" id="applicant-no" placeholder="Applicant No.">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="applicant-name">Applicant Name</label>
                            <input type="text" class="form-control" id="applicant-name" placeholder="Applicant Name">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="senior-high-school">Senior High School</label>
                            <input type="text" class="form-control" id="senior-high-school" placeholder="Senior High School">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="school-year">School Year Took</label>
                            <input type="text" class="form-control" id="school-year" placeholder="School Year Took">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Search Result</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- List of Pending Requests -->
        <div class="row">
            <div class="col-md-12">
                <h3>Pending Requests</h3>
                <div id="pending-requests">
                    <!-- Pending requests list will be displayed here -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Requester Name</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Requester 1</td>
                                <td>2023-01-15</td>
                                <td>
                                    <button class="btn btn-success">Approve</button>
                                    <button class="btn btn-danger">Reject</button>
                                </td>
                            </tr>
                            <!-- Add more pending requests here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Display Individual Result -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Student Result</h3>
                <div id="individual-result">
                    <!-- Individual result content will be displayed here -->
                    <table class="table table-bordered table-striped result-table">
                        <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>CET PARTS</th>
                                <th>English Proficiency</th>
                                <th>Reading Comprehension</th>
                                <th>Science Process Skills</th>
                                <th>Quantitative Skills</th>
                                <th>Abstract Thinking Skills</th>
                                <th>OVERALL ABILITY PERCENTILE RANK (OAPR)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="individual-result-body">
                            <tr>
                                <td>CET</td>
                                <td>85</td>
                                <td>90</td>
                                <td>88</td>
                                <td>92</td>
                                <td>87</td>
                                <td>85</td>
                                <td>90%</td>
                                <td>
                                    <button class="btn btn-primary">Send Result</button>
                                </td>
                            </tr>
                            <!--  can add more rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





        <!-- End Tab Content -->
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>
