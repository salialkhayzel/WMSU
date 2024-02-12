<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>WMSU TEC - homepage</title>
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

    <!-- Carousel Section -->
    <section class="hero" id="hero">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- First Carousel Item -->
                <div class="carousel-item active">
                    <div class="carousel-background">
                    <img src="{{ asset('images/slider/campus.jpg') }}" alt="">
                        <div class="carousel-container">
                            <div class="carousel-content-container">
                                <h2>Welcome to Western Mindanao State University</h2>
                                <p>Testing And Evaluation Center</p>
                                <div class="buttons">
                                    <a href="#" class="button1">Our Services</a>
                                    <a href="#" class="button1">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Second Carousel Item -->
                <div class="carousel-item">
                    <div class="carousel-background">
                    <img src="{{ asset('images/slider/wm.jpg') }}" alt="">
                        <div class="carousel-container">
                            <div class="carousel-content-container">
                                <h2>Application for CET is now Open</h2>
                                <p>Register and Submit your Application by clicking the apply now</p>
                                <div class="buttons">
                                    <a href="#" class="button1">More details</a>
                                    <a href="#" class="button1">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Third Carousel Item -->
                <div class="carousel-item">
                    <div class="carousel-background">
                        <img src="./images/slider/wm.jpg" alt="">
                        <div class="carousel-container">
                            <div class="carousel-content-container">
                                <h2>Important Announcement</h2>
                                <p>CET Application is Now Open</p>
                                <p>December 23, 2023 to January 07, 2023</p>
                                <div class="buttons">
                                    <a href="#" class="button1">Apply</a>
                                    <a href="#" class="button1">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- Carousel Section -->

    @include('components.chatbox');

        <!--  announcement items  
    <section id="news-section" class="grid-container">
    <div class="announcements">
        <h2 class="section-title">Latest News and Announcements</h2>
        <div class="announcement">
            <div>
                <h3>Important Exam Dates</h3>
                <p>Stay informed about the upcoming exam dates for various programs.</p>
            </div>
        </div>
        <div class="announcement">
            <div>
                <h3>Online Registration Now Open</h3>
                <p>Register online for the upcoming testing sessions and save time at the center.</p>
            </div>
        </div>
 
    </div>
    <div class="step-by-step">
        <h3>Step-by-Step Guide to Apply</h3>
        <ol>
            <li>Create an account on our website.</li>
            <li>Choose the test you want to take.</li>
            <li>Fill out the online application form with your personal information and test preferences.</li>
            <li>Upload the required documents.</li>
            <li>Submit your application.</li>
        </ol>
        <p>Follow these steps to complete the application process. If you have questions, contact our support team.</p>
    </div>
    </section>
     announcement items  -->

    <!-- Feature Info Section -->
    <section class="features mt-4 mb-4">
        <div class="container">
            <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mb-5">Our Feature</h2>
            </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-feature-box">
                        <div class="icon">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h3>Expert TEC Employees</h3>
                        <p>Our team of experienced professionals is dedicated to providing top-notch testing and
                            evaluation services to help you succeed.</p>
                        <a href="faq.php" class="feature-link">Learn More <i
                                class="bi bi-arrow-right-circle-fill"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-feature-box">
                        <div class="icon">
                            <i class="bi bi-align-center"></i>
                        </div>
                        <h3>Quality Education Services</h3>
                        <p>We are committed to delivering high-quality education services to help you prepare for exams
                            and excel in your academic journey.</p>
                        <a href="services.php" class="feature-link">Explore<i
                                class="bi bi-arrow-right-circle-fill"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-feature-box">
                        <div class="icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <h3>Simple Registration Process</h3>
                        <p>Our user-friendly registration process ensures a smooth experience, making it convenient for
                            you to access our services.</p>
                        <a href="registration.php" class="feature-link">Get Started <i
                                class="bi bi-arrow-right-circle-fill"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-feature-box">
                        <div class="icon">
                            <i class="bi bi-bank2-fill"></i>
                        </div>
                        <h3>Engaging Learning Environment</h3>
                        <p>Join our community of motivated learners and engage in interactive educational experiences to
                            achieve your goals.</p>
                        <a href="about.php#community" class="feature-link">Discover <i
                                class="bi bi-arrow-right-circle-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature Info Section -->

    <!-- Separation Line -->
    <hr class="separation-line">

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

    <!-- Why Choose Us Section -->
    <section class="why-choose-us mt-5 mb-5">
        <div class="container">
            <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mb-4">Why Choose Us</h2>
            </div>
                <div class="col-md-4">
                    <div class="choose-item border">
                    <img src="{{ asset('images/logo/logo.png') }}" width="60px" alt="#">
                        <div class="choose-content">
                            <h3>Expert Instructors</h3>
                            <p>Our team of highly qualified instructors brings years of experience and expertise to
                                guide you through your learning journey.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="choose-item border">
                    <img src="{{ asset('images/logo/logo.png') }}" width="60px" alt="#">
                        <div class="choose-content">
                            <h3>Project-Based Learning</h3>
                            <p>Engage in hands-on, project-based learning that allows you to apply theoretical knowledge
                                to real-world scenarios.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="choose-item border">
                        <img src="{{ asset('images/logo/logo.png') }}" width="60px" alt="#">
                        <div class="choose-content">
                            <h3>Real-World Development</h3>
                            <p>Gain practical skills and experience in a dynamic learning environment that prepares you
                                for success in your chosen field.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section 
    <section class="testimonials mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="mb-4">Testimonials</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="testimonial-item border p-4">
                            <div class="testimonial-text">
                                <p>"The support and guidance I received from WMSU Testing and Evaluation Center played a
                                    crucial role in my success. The instructors are knowledgeable and dedicated to
                                    helping
                                    students excel."</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-image">
                                    <img src="./image/testimonials/person1.jpg" class="img-fluid"
                                        alt="Testimonial Author">
                                </div>
                                <div class="author-info">
                                    <h4>Jane Doe</h4>
                                    <p>Graduate Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial-item border p-4">
                            <div class="testimonial-text">
                                <p>"WMSU Testing and Evaluation Center provided me with the tools and resources I needed
                                    to
                                    improve my skills and confidence. The personalized approach made all the
                                    difference."
                                </p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-image">
                                    <img src="./image/testimonials/person2.jpg" class="img-fluid"
                                        alt="Testimonial Author">
                                </div>
                                <div class="author-info">
                                    <h4>John Smith</h4>
                                    <p>Professional</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial-item border p-4">
                            <div class="testimonial-text">
                                <p>"I can't thank WMSU Testing and Evaluation Center enough for helping me achieve my
                                    goals.
                                    The comprehensive study materials and mock tests were invaluable."</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-image">
                                    <img src="./image/testimonials/person3.jpg" class="img-fluid"
                                        alt="Testimonial Author">
                                </div>
                                <div class="author-info">
                                    <h4>Susan Johnson</h4>
                                    <p>Aspiring Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    Testimonials Section -->

    <!-- Call to Action Section -->
    <section class="cta mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="mb-4">Take the Next Step</h2>
                    <p>Ready to explore our services and start your journey to success? Choose one of the options below:
                    </p>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-4">
                    <div class="cta-item text-center border p-4">
                        <i class="bi bi-bookmark-star"></i>
                        <h3>Learn More</h3>
                        <p>Discover the full range of services we offer and how they can benefit you.</p>
                        <a href="services.php" class="btn-primary1">Explore Services</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cta-item text-center border p-4">
                        <i class="bi bi-pencil"></i>
                        <h3>Register Now</h3>
                        <p>Join our community and register for our upcoming testing and evaluation sessions.</p>
                        <a href="registration.php" class="btn-primary1">Register</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cta-item text-center border p-4">
                        <i class="bi bi-envelope"></i>
                        <h3>Contact Us</h3>
                        <p>Have questions or need assistance? Reach out to our team for support.</p>
                        <a href="contact.php" class="btn-primary1">Get in Touch</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action Section -->

    <!-- Footer -->
    @include('components.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>