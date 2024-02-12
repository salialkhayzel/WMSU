<div class="container" style="margin-top: 20px;">

<!-- About Us Section -->
<!-- About Us Section -->
<section class="about mt-5 mb-1">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            @if($aboutus_data)
                @foreach ($aboutus_data as $item => $value)
                    <div class="col-lg-6 col-md-12 text-center">
                        <img src="{{asset('storage/content/about_us/'.$value->au_image)}}" alt="WMSU Testing Center" style="width: 600px; height: 350px; object-fit: cover;" class="img-thumbnail mt-4">
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-content text-center mb-5">
                            <span class="mb-1 mt-4">About</span>
                            <h2 class="mb-4">{{$value->au_header}}</h2>
                            <p>{{$value->au_content}}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-center">
                    <img src="./images/about/about.jpg" class="custom-img-size mb-4" alt="WMSU Testing Center">
                    <div class="about-content">
                        <span class="text-primary font-weight-bold">About</span>
                        <h2>WMSU Testing and Evaluation Center</h2>
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
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<section id="services" class="services section-bg">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="row">
                                            <!-- =========== MAIN =========== -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="https://accubooksystem.com/" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/favicon-1594379785.png" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="https://accubooksystem.com/" target="_blank">ACCUBOOKS</a></h4>
                                <p>Accubooks Accounting System is a secure cloud accounting and inventory application platform that assist different businesses from different industries on the management of data and information. It is also an ERP!</p>
                                <a href="https://accubooksystem.com/" target="_blank"><button class="services-button btn-sm">Learn More</button></a>
                            </div>
                        </div>
                       
                                                                    <!-- =========== MAIN =========== -->
                                                                    <!-- =========== MAIN =========== -->
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="https://atgspay.com/" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/Untitled design (1)-1631167427.png" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="https://atgspay.com/" target="_blank">ATGS PAY</a></h4>
                                <p>ATGS Pay Management System is a secure cloud application system that makes your payroll computation Hassle Free. It allows easy management of employees' salaries, wages, taxes and other deductions with corresponding reports and related BIR Forms.</p>
                                <a href="https://atgspay.com/" target="_blank"><button class="services-button btn-sm">Learn More</button></a>
                            </div>
                        </div>
                       
                                                                    <!-- =========== MAIN =========== -->
                                                                    <!-- =========== MAIN =========== -->
                                                                    <!-- =========== MAIN =========== -->
                                                                    <!-- =========== MAIN =========== -->
                                                                    <!-- =========== MAIN =========== -->
                                                            </div>
                <div class="row">
                                            <!-- =========== MAIN =========== -->
                                                                    <!-- =========== MAIN =========== -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="https://accuschools.atgscorp.com/" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/accuschools-1594379887.png" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="https://accuschools.atgscorp.com/" target="_blank">ACCUSCHOOLS</a></h4>
                                <p>AccuSchools Management System is a secure cloud application designed to automate and streamline the registration, assessment, enrolment, payment monitoring and grading system of our educational institutions.</p>
                                <!-- <a href="https://accuschools.atgscorp.com/" target="_blank"><button class="services-button btn-sm">Learn More</button></a> -->
                            </div>
                        </div>
                        
                                                                    <!-- =========== MAIN =========== -->
                                                                    <!-- =========== MAIN =========== -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="https://accubooksystem.com/" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/computer-1602562730.JPG" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="https://accubooksystem.com/" target="_blank">ACCUCMS</a></h4>
                                <p>AccuCMS is a content management system designed to allow multiple users to create, manage and easily modify digital or web content located in a single database. It increases collaboration between authors, editors and admins through a defined workflow management.</p>
                                <!-- <a href="https://accubooksystem.com/" target="_blank"><button class="services-button btn-sm">Learn More</button></a> -->
                            </div>
                        </div>
                        
                                                                    <!-- =========== MAIN =========== -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/apps-1602566980.JPG" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="" target="_blank">ACCUAPPS</a></h4>
                                <p>AccuApps is one of the core services of the company which focuses on optimizing and automating business processes based on specific enterprise requirements using the latest and most innovative technologies.</p>
                                <!-- <a href="" target="_blank"><button class="services-button btn-sm">Learn More</button></a> -->
                            </div>
                        </div>
                        
                                                                    <!-- =========== MAIN =========== -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/emails-1602562825.JPG" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="" target="_blank">ACCUMAIL</a></h4>
                                <p>AccuMail is one of our services that helps businesses established a more credible and professional communications and exchanges between internal staff and external customers and stakeholders.</p>
                                <!-- <a href="" target="_blank"><button class="services-button btn-sm">Learn More</button></a> -->
                            </div>
                        </div>
                        
                                                                    <!-- =========== MAIN =========== -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/1-1602567150.jpg" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="" target="_blank">ACCUCONSULT</a></h4>
                                <p>AccuConsult is one of our services that provides practical and tailored IT consultancy services and business IT support to organizations of any size. It mainly helps these organizations design highly effective strategies and implement innovative solutions.</p>
                                <!-- <a href="" target="_blank"><button class="services-button btn-sm">Learn More</button></a> -->
                            </div>
                        </div>
                        
                                                                    <!-- =========== MAIN =========== -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 equal-height mt-2 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5%">
                            <div class="icon-box iconbox-blue equal-width">
                                <div class="icon">
                                    <a href="https://atgscorp.com/" target="_blank">
                                        <img src="https://atgscorp.com/images/assets/logo AccuDesks-1604218888.jpg" class="img-fluid">
                                    </a>
                                </div>
                                <h4><a href="https://atgscorp.com/" target="_blank">ATGS DESK</a></h4>
                                <p>ATGS Desk is an online ticketing system processes and catalogs customer service requests. Users have the visibility to track the progress of their tickets (issues or concerns). It makes collaboration between the requestors and your helpdesk simpler and more efficient.</p>
                                <!-- <a href="https://atgscorp.com/" target="_blank"><button class="services-button btn-sm">Learn More</button></a> -->
                            </div>
                        </div>
                        
                </div>
            </div>
        </section>
<!-- About Us Section -->








    <!-- About Us Section -->


    <!-- <div class="row">
        <div class="col-lg-4">
            <div class="single-service p-3">
                <div class="service-icon">
                    <img src="{{ asset('images/about/about.jpg') }}" width="150px" alt="wmsu logo">
                </div>
                <h3>About us of WMSU Testing and Evaluation Center</h3>
                <p class="text-justify">
                    WMSU Testing and Evaluation Center is dedicated to providing exceptional testing and evaluation services to students and individuals pursuing their academic and professional aspirations. With a strong commitment to excellence and innovation, we strive to empower our community with the tools they need to succeed.
                </p>
                <div class="buttons">
                    <a href="about.php" class="btn btn-primary">Learn More <i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="single-service p-3">
                <div class="service-icon">
                    <img src="{{ asset('images/about/dedication.png') }}" width="150px" alt="wmsu logo">
                </div>
                <h3>About mission of WMSU Testing and Evaluation Center</h3>
                <p class="text-justify">
                    Our mission is to offer comprehensive and reliable testing solutions that help individuals showcase their knowledge and skills, enabling them to make informed decisions about their educational and career paths.
                </p>
                <div class="buttons">
                    <a href="about.php" class="btn btn-primary">Learn More <i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="single-service p-3">
                <div class="service-icon">
                    <img src="{{ asset('images/about/tite.png') }}" width="150px" alt="wmsu logo">
                </div>
                <h3>About quality of WMSU Testing and Evaluation Center</h3>
                <p class="text-justify">
                    At WMSU Testing and Evaluation Center, we understand the significance of accurate assessments in shaping the future of our students. Our experienced team of professionals is dedicated to upholding the highest standards of integrity and fairness, ensuring that every test-taker's experience is equitable and meaningful.
                </p>
                <div class="buttons">
                    <a href="about.php" class="btn btn-primary">Learn More <i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        </div>
    </div> -->
</div>
