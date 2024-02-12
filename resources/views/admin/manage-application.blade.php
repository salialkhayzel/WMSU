    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Applicant management - WMSU TEC</title>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    </head>

    <body class="admin-dashboard">

        <!-- ======= Header ======= -->
        @include('admin-components.admin-header');
        <!-- End Header -->

        <!-- ======= Sidebar ======= -->
        @include('admin-components.admin-sidebar');
        <!-- End Sidebar -->
        
        <!-- ======= Main Content ======= -->
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Applicant management</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Applicant management</li>
                    </ol>
                </nav>
            </div><!-- End Right side columns -->
            <!-- Insert Section -->

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="adminTabs">
                <li class="nav-item">
                    <a class="nav-link show active " data-toggle="tab" href="#review-applicant-tab">Pending Applicant</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#accepted-applicant-tab">Accepted Applicant</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                
            <!-- pending applicant tab -->
            <div class="tab-pane show active" id="review-applicant-tab">
                <div class="examfilter-container">
                    <label class="filter-label" for="exam-filter">Filter by Type of Exam:</label>
                    <select class="filter-select" id="exam-filter">
                        <option value="">All</option>
                        <option value="College Entrance Exam">Cet</option>
                        <option value="Nursing aptitude test">Nat</option>
                        <option value="Engineering Aptitude test">Eat</option>
                        <!-- Add more options as needed -->
                    </select>
                    <button class="accept-btn">Accept </button>
                    <button class="decline-btn">Decline </button>
                </div>
                <!-- Application Review Table -->
                <table class="application-table">
                <thead>
                    <tr>
                        <th>
                            &#10003;   <!-- check icon -->
                        </th>
                        <th>#</th>
                        <th>Applicant Name</th>
                        <th>Type of Exam</th>

                        <th>School Year</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Application Form</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td> 
                        <td>1</td>
                        <td>John Doe</td>
                        <td>CET</td>
                
                        <td>2023-2024</td>
                        <td>2023-09-15</td>
                        <td>Pending</td>
                        <td>
                            <button class="btn btn-primary">View</button>
                        </td>
                    </tr>
        
                    <tr>
                        <td><input type="checkbox"></td> <!-- Checkmark input -->
                        <td>2</td>
                        <td>John Doe</td>
                        <td>CET</td>
                   
                        <td>2023-2024</td>
                        <td>2023-09-15</td>
                        <td>Pending</td>
                        <td>
                            <button class="btn btn-primary">View</button>
                        </td>
                    </tr>
        
                    <tr>
                        <td><input type="checkbox"></td> <!-- Checkmark input -->
                        <td>3</td>
                        <td>John Doe</td>
                        <td>CET</td>
                   
                        <td>2023-2024</td>
                        <td>2023-09-15</td>
                        <td>Pending</td>

                        <td>
                            <button class="btn btn-primary">View</button>
                        </td>
                    </tr>
                    <!-- Add more application rows here -->
                    
                </tbody>
            </table>
            </div>




<!-- Accepted Applicant Tab -->
<div class="tab-pane show" id="accepted-applicant-tab">
    <div class="examfilter-container">
        <label class="filter-label1" for="accepted-exam-filter">Filter accepted applicant by Exam:</label>

        <select class="filter-select1" id="accepted-exam-filter">
            <option value="">All</option>
            <option value="CET">CET</option>
            <option value="NAT">NAT</option>
            <option value="EAT">EAT</option>
            <!-- Add more options as needed -->
        </select>
        <button class="decline-btn">Decline </button>
    </div>
                    
    <table class="application-table">
        <thead>
            <tr>
                <th>
                    &#10003;   <!-- check icon -->
                </th>
                <th>#</th>
                <th>Applicant Name</th>
                <th>Exam Type</th>

                <th>School Year</th>
                <th>Date Applied</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox"></td> <!-- Checkmark input -->
                <td>2</td>
                <td>Accepted Applicant 1</td>
                <td>CET</td>

                <td>2023-2024</td>
                <td>2023-09-10</td>
                <td>
                <button class="btn btn-success">Edit</button>
                <button class="btn btn-primary">Venue</button>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox"></td> <!-- Checkmark input -->
                <td>2</td>
                <td>Accepted Applicant 2</td>
                <td>NAT</td>

                <td>2023-2024</td>
                <td>2023-09-11</td>
                <td>
                <button class="btn btn-success">Edit</button>
                <button class="btn btn-primary">Venue</button>
                </td>
            </tr>
            <!-- Add more accepted applicant rows here -->
        </tbody>
    </table>
</div>



            <!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </body>

    </html>
