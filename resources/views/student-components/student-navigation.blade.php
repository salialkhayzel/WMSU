<nav class="navbar navbar-expand-lg navbar-dark bg-crimson">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo/logo.png') }}" alt="WMSU Logo" height="60px">
            <span class="company-name">Testing and Evaluation Center</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appointment') }}">Appointment</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="testApplicationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Test Application
                    </a>
                    <div class="dropdown-menu" aria-labelledby="testApplicationDropdown">
                        <a class="dropdown-item" href="{{ Route('test-application.Cet') }}">CET</a>
                        <a class="dropdown-item" href="{{ Route('test-application.Nat') }}">NAT</a>
                        <a class="dropdown-item" href="{{ Route('test-application.Eat') }}">EAT</a>
                        <a class="dropdown-item" href="{{ Route('test-application.Gsat') }}">GSAT</a>
                        <a class="dropdown-item" href="{{ Route('test-application.Lsat') }}">LSAT</a>
                    </div>
                </li>
                <!-- Add "Contact Us" navigation link here -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">Contact Us</a>
                </li>
            </ul>

            <!-- Notification Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-danger">3</span> <!-- You can dynamically update this number -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                        <h6 class="dropdown-header">Notifications</h6>
                        <a class="dropdown-item" href="#">
                            <div class="notification-content">
                                <div class="notification-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notification-text">
                                    <p>New notification 1</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="notification-content">
                                <div class="notification-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notification-text">
                                    <p>New notification 2</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="notification-content">
                                <div class="notification-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notification-text">
                                    <p>New notification 3</p>
                                </div>
                            </div>
                        </a>
                        <!-- Add more notification items dynamically here -->
                    </div>
                </li>
            </ul>

            <!-- Profile Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('images/contents/profile_picture/thumbnail/default.png')}}" width="50" alt="">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('student.profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('student.application') }}">Application</a>
                        <a class="dropdown-item" href="{{ route('student.status') }}">Status</a>
                        <a class="dropdown-item" href="{{ route('student.results') }}">Results</a>
                        <a class="dropdown-item" href="{{ route('student.schedule') }}">Schedule</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
