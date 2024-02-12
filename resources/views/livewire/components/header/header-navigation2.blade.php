<div>
    <!-- Navigation homepage-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #990000;">
            <div class="container">
            <div class="mx-auto">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo/logo.png') }}" width="50px" alt="#">
                </a>
                <a class="navbar-brand nav-linklogo" href="{{ route('home') }}">Testing and Evaluation Center</a>
                <img src="{{ asset('images/logo/tec.png') }}" width="50px" alt="#">
            </div>
                <!-- Navigation toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navigation links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto px-2">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('services') }}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('programs') }}">Programs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                        </li>
                        
                        @if(!isset($user_details['user_id']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                            </li>
                        @else 
                        </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell  "style="font-size: 17px;"></i>
                                        @if($unread_notification_count >0 )<span class="badge badge-warning">{{$unread_notification_count}}</span> @endif
                                    </a>
                                    @if($notifications)
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" wire:ignore.self>
                                            <h6 class="dropdown-header">Notifications</h6>
                                            @foreach($notifications as $key => $value)
                                            <a class="dropdown-item" href="{{$value->notification_link}}">
                                                <div class="notification-content">
                                                    <div class="notification-icon">
                                                        <?php echo $value->notification_icon_icon ?>
                                                    </div>
                                                    <div class="notification-text">
                                                        <p>{{$value->notification_title}}</p>
                                                    </div>
                                                </div>
                                            </a>

                                            @endforeach
                                            <a class="dropdown-item" href="{{route ('student.notifications') }}">
                                                <div class="notification-content">
                                                    <div class="notification-icon">
                                                        <i class="fas fa-bell"></i>
                                                    </div>
                                                    <div class="notification-text">
                                                        <p>Show All Notifications</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                </li>
                            </ul>

                        <!-- Profile Dropdown -->
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img style="border-radius: 50%;" src="@if($user_details['user_profile_picture']== 'default.png'){{asset('images/contents/profile_picture/thumbnail/default.png')}} @else {{asset('storage/images/thumbnail/'.$user_details['user_profile_picture'])}} @endif" width="50" alt="">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                    @if(isset($user_details['user_role_details']) && $user_details['user_role_details'] == 'student')
                                        @if(isset($user_details['user_status_details']) && $user_details['user_status_details'] == 'active')
                                            <a class="dropdown-item" href="{{ route('student.profile') }}"><i class="fas fa-user" style="color: maroon; margin-right: 8px;"></i> Profile</a>
                                            <a class="dropdown-item" href="{{ route('student.application') }}"><i class="fas fa-file" style="color: maroon; margin-right: 8px;"></i> Application</a>
                                            <a class="dropdown-item" href="{{ route('student.status') }}"><i class="fas fa-info-circle" style="color: maroon; margin-right: 8px;"></i> Status</a>
                                            <a class="dropdown-item" href="{{ route('student.results') }}"><i class="fas fa-poll" style="color: maroon; margin-right: 8px;"></i> Results</a>
                                            <a class="dropdown-item" href="{{ route('student.appointment') }}"><i class="fas fa-calendar-alt" style="color: maroon; margin-right: 8px;"></i> Appointments</a>
                                            <a class="dropdown-item" href="{{ route('student.notifications') }}"><i class="fas fa-bell" style="color: maroon; margin-right: 8px;"></i> Notifications</a>
                                            <div class="dropdown-divider"></div>
                                        @endif
                                    @else
                                        <a class="dropdown-item" href="{{ Route('profile')}}"><i class="fas fa-user" style="color: maroon; margin-right: 8px;"></i> Profile</a>
                                        <a class="dropdown-item" href="{{ Route('notification') }}"><i class="fas fa-bell" style="color: maroon; margin-right: 8px;"></i> Notifications</a>
                                        <a class="dropdown-item" href="{{ Route('setting') }}"><i class="fas fa-cog" style="color: maroon; margin-right: 8px;"></i> Settings</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt" style="color: #990000; margin-right: 8px;"></i> Log out</a>
                                </div>
                            </li>
                        </ul>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navigation homepage -->

    <!-- Dropdown items will be added here dynamically -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="admissionDropdown" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Test Application</a>
        <div class="dropdown-menu" aria-labelledby="admissionDropdown" id="examDropdown">
            <!-- Dropdown items will be added here dynamically -->
        </div>
    </li>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    
            const exams = [
                { name: "CET", route: "{{ Route('application.cet') }}" },
                { name: "NAT", route: "{{ Route('application.nat') }}" },
                { name: "EAT", route: "{{ Route('application.eat') }}" },
                { name: "GSAT", route: "{{ Route('application.gsat') }}" },
                { name: "LSAT", route: "{{ Route('application.lsat') }}" },
                // Add more exams as needed
            ];

            const examDropdown = document.getElementById("examDropdown");

            exams.forEach((exam) => {
                const dropdownItem = document.createElement("a");
                dropdownItem.className = "dropdown-item";
                dropdownItem.href = exam.route;
                dropdownItem.textContent = `${exam.name} Application`;

                examDropdown.appendChild(dropdownItem);
            });
        });
    </script>

</div>
