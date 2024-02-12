<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMSU TEC - Services</title>
    <link href="{{ asset('css/STYLES.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    @include('components.navigation');
    <!-- Navigation -->

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                        <img src="{{ asset('images/logo/logo.png') }}" width="50px" alt="wmsu logo">
                        </div>
                        <h3>College Entrance Exam Evaluation</h3>
                        <p>We provide comprehensive evaluation services for college entrance exams to help applicants succeed in their academic journey.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                        <img src="{{ asset('images/logo/logo.png') }}" width="50px" alt="wmsu logo">
                        </div>
                        <h3>Professional Certification Testing</h3>
                        <p>Our center offers a range of professional certification testing services to validate and enhance your skills in various industries.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                        <img src="{{ asset('images/logo/logo.png') }}" width="50px" alt="wmsu logo">   
                        </div>
                        <h3>Standardized Testing</h3>
                        <p>We conduct standardized testing to measure knowledge and skills objectively, providing valuable insights for educational institutions and learners.</p>
                    </div>
                </div>

                <!-- Add more services here if needed -->

            </div>
        </div>
    </section>
    <!-- Services Section -->

    <!-- Footer -->
    @include('components.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
