<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMSU TEC - about us</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">

</head>

<body>
    <!-- Navigation -->
    @include('components.navigation');
    <!-- Navigation -->

    <!-- About Us Section -->
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-lg-flex">
                    <img src="./images/about/about.jpg" class="img-fluid" alt="WMSU Testing Center">
                </div>
                <div class="col-md-6">
                    <div class="about-content">
                        <span>About Us</span>
                        <h2>Welcome to WMSU Testing and Evaluation Center</h2>
                        <p>WMSU Testing and Evaluation Center is dedicated to providing exceptional testing and
                            evaluation services to students and individuals pursuing their academic and professional
                            aspirations. With a strong commitment to excellence and innovation, we strive to empower our
                            community with the tools they need to succeed.</p>
                        <p>Our mission is to offer comprehensive and reliable testing solutions that help individuals
                            showcase their knowledge and skills, enabling them to make informed decisions about their
                            educational and career paths.</p>
                        <p>At WMSU Testing and Evaluation Center, we understand the significance of accurate assessments
                            in shaping the future of our students. Our experienced team of professionals is dedicated to
                            upholding the highest standards of integrity and fairness, ensuring that every test-taker's
                            experience is equitable and meaningful.</p>
                        <div class="buttons">
                            <a href="about.php" class="button3">Learn More <i
                                    class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section -->


    <!-- Footer -->
    @include('components.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>