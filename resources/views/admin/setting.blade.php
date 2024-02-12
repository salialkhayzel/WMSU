<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin setting - WMSU TEC</title>
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
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <!--   js File -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
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
            <h1>Setting</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Setting</li>
                </ol>
            </nav>
        </div>

        <!-- First-level Tabs -->
        <ul class="nav nav-tabs" id="firstLevelTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#modify-content-tab">MODIFY CONTENT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#modify-website-tab">MODIFY WEBSITE</a>
            </li>
        </ul>

        <!-- Second-level Tabs -->
        <div class="tab-content">
            <!-- MODIFY CONTENT Tab -->
            <div class="tab-pane fade show active" id="modify-content-tab">
                <!-- Second-level Tabs -->
                <ul class="nav nav-tabs" id="secondLevelTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#carousel-tab">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#about-us-tab">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#why-us-tab">Why Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cta-tab">CTA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#faq-tab">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#footer-tab">Footer</a>
                    </li>
                </ul>

                <!-- Second-level Tab Content -->
                <div class="tab-content">
                    <!-- Carousel Tab -->
                    <div class="tab-pane fade show active" id="carousel-tab">
                        <!--  Carousel content goes here -->
                    </div>

                    <!-- About Us Tab -->
                    <div class="tab-pane fade" id="about-us-tab">
                        <!--  About Us content goes here -->
                    </div>

                    <!-- Why Us Tab -->
                    <div class="tab-pane fade" id="why-us-tab">
                        <!--  Why Us content goes here -->
                    </div>

                    <!-- CTA Tab -->
                    <div class="tab-pane fade" id="cta-tab">
                        <!--  CTA content goes here -->
                    </div>

                    <!-- FAQ Tab -->
                    <div class="tab-pane fade" id="faq-tab">
                        <!--  FAQ content goes here -->
                    </div>

                    <!-- Footer Tab -->
                    <div class="tab-pane fade" id="footer-tab">
                        <!--  Footer content goes here -->
                    </div>
                </div>
                <!-- End Second-level Tab Content -->
            </div>
            <!-- End MODIFY CONTENT Tab -->

            <!-- MODIFY WEBSITE Tab -->
            <div class="tab-pane fade" id="modify-website-tab">
                <h2 class="section-heading">Modify Website</h2>

                <!-- Modify Website Content -->
                <div>
                    <label for="website-name">Website Name:</label>
                    <input type="text" id="website-name" name="website-name" placeholder="Enter new website name">
                </div>

                <div>
                    <label for="website-logo">Website Logo:</label>
                    <input type="file" id="website-logo" name="website-logo">
                </div>

                <button id="updateWebsiteInfo">Update Website Info</button>
                <!-- End of Modify Website Content -->
            </div>
            <!-- End MODIFY WEBSITE Tab -->
        </div>
        <!-- End Second-level Tabs -->
    </main>

    <!-- Include Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Initialize Bootstrap Tabs -->
    <script>
        $(document).ready(function () {
            $('.nav-tabs a').click(function () {
                $(this).tab('show');
            });
        });
    </script>

    <!-- ... ( existing scripts) ... -->
</body>

</html>