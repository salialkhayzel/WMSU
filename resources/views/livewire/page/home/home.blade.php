<div>
    <div>
        <!-- Carousel Section -->
        @if($carousel_data)
        <section class="hero" id="hero">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($carousel_data as $item => $value)
                        <div class="carousel-item active">
                            <div class="carousel-background">
                            <img src="{{asset('storage/content/carousel/'.$value->carousel_content_image)}}">
                                <div class="carousel-container">
                                    <div class="carousel-content-container">
                                        <h2>{{$value->carousel_header_title}}</h2>
                                        <p>{{$value->carousel_paragraph_paragraph}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
        
        @else
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
        @endif
        <!-- Carousel Section -->

        @include('components.chatbox');

<!-- Bootstrap 5 Animation -->
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Animate.css Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">



<!-- About Us Section -->
<section class="about mt-1 mb-1">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            @if($aboutus_data)
                @foreach ($aboutus_data as $item => $value)
                    <div class="col-lg-6 col-md-12 text-center animate__animated animate__slideInRight">
                        <img src="{{asset('storage/content/about_us/'.$value->au_image)}}" alt="WMSU Testing Center" style="width: 600px; height: 350px; object-fit: cover;" class="img-thumbnail">
                    </div>
                    <div class="col-lg-6 col-md-12">
                    <div class="about-content text-center mb-5 animate__animated animate__slideInLeft">
                            <span class="mb-1 mt-2">About</span>
                            <h2 class="mb-4">{{$value->au_header}}</h2>
                            <p>{{$value->au_content}}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-center">
                    <img src="./images/about/about.jpg" alt="WMSU Testing Center" style="width: 300px; height: 200px; object-fit: cover;" class="img-thumbnail mb-4">
                    <div class="about-content">
                        <span class="text-primary font-weight-bold">About</span>
                        <h2>WMSU Testing and Evaluation Center</h2>
                        <p>WMSU Testing and Evaluation Center is dedicated to providing exceptional testing and
                            evaluation services to students and individuals pursuing their academic and professional
                            aspirations. With a strong commitment to excellence and innovation, we strive to empower our
                            community with the tools they need to succeed.</p>
                        <!-- Remaining content... -->
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- About Us Section -->

     <!-- Separation Line -->
     <hr class="separation-line">
        <!-- Feature Info Section -->
        @if($feature_data)
            <section class="features mt-1 mb-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2 class="mb-4">Our Feature</h2>
                        </div>
                        <div class="row justify-content-center">
                            @foreach($feature_data as $value)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="main-feature-box d-flex flex-column" style="height:300px;">
                                    <div>
                                        <div class="icon">
                                            <i class="bi bi-house-door-fill"></i>
                                        </div>
                                        <h3>{{$value->feature_header}}</h3>
                                        <p>{{$value->feature_content}}</p>
                                    </div>
                                    <div class="mt-auto">
                                        <a href="{{$value->feature_link}}" target="blank" class="feature-link">{{$value->feature_button_name}} <i
                                                class="bi bi-arrow-right-circle-fill"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
        <!-- Feature Info Section -->


        <!-- Why Choose Us Section -->
        @if($wcu_data)
            <section class="why-choose-us mt-1 mb-1">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <h2 class="mb-4">Why Choose Us</h2>
                        </div>
                        @foreach ($wcu_data as $item => $value)
                            <div class="col-md-4 my-3">
                                <div class="choose-item border">
                                <img src="{{asset('storage/content/whychooseus/'.$value->wcu_logo)}}" class="img-thumbnail mt-1 rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" alt="Why Choose Us Logo">
                                    <div class="choose-content">
                                        <h3>{{$value->wcu_header}}</h3>
                                        <p>{{$value->wcu_content}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
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
        @endif
    </div>
</div>

<script>
    // Function to check if an element is in the viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function animateElements() {
        const aboutContent = document.querySelectorAll('.about-content');
        const aboutImage = document.querySelectorAll('.animate__slideInRight');

        aboutContent.forEach(element => {
            if (isInViewport(element)) {
                element.classList.add('animate__slideInLeft');
            }
        });

        aboutImage.forEach(element => {
            if (isInViewport(element)) {
                element.classList.add('animate__slideInRight');
            }
        });
    }

    function handleScroll() {
        animateElements();
    }

    // Bind the scroll event to trigger the animations
    window.addEventListener('scroll', handleScroll);

    // Initially trigger animations if the section is already in view on page load
    document.addEventListener('DOMContentLoaded', () => {
        animateElements();
    });
</script>

