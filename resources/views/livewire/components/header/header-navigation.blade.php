<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-crimson">
        <div class="container">
        <div class="mx-auto">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo/logo.png') }}" width="50px" alt="WMSU Logo">
                <span class="company-name">Testing and Evaluation Center</span>
                <img src="{{ asset('images/logo/tec.png') }}" width="50px" alt="WMSU Logo">
            </a>
        </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link px-4 " href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="{{ route('programs') }}">Programs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="{{route ('contact' )}}">Contact Us</a>
                    </li>
                </ul>
                @if(!isset($user_details['user_id']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                        </li>
                @else 
                    <ul class="navbar-nav"  wire:poll="update_nofitication()" >
                        <li class="nav-item dropdown"  wire:ignore.self>
                            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell " style="font-size: 15px;"></i>
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
                        <li class="nav-item dropdown"  wire:ignore.self>
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img style="border-radius: 50%;" src="@if($user_details['user_profile_picture']== 'default.png'){{ asset('images/contents/profile_picture/thumbnail/default.png') }}@else{{ asset('storage/images/thumbnail/'.$user_details['user_profile_picture']) }}@endif" width="50" alt="">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown"  wire:ignore.self>
                                @if(isset($user_details['user_role_details']) && $user_details['user_role_details'] == 'student')
                                    @if(isset($user_details['user_status_details']) && $user_details['user_status_details'] == 'active')
                                        <a class="dropdown-item" href="{{ route('student.profile') }}"><i class="fas fa-user" style="color: #990000;"></i> Profile</a>
                                        <a class="dropdown-item" href="{{ route('student.application') }}"><i class="fas fa-file" style="color: #990000;"></i> Application</a>
                                        <a class="dropdown-item" href="{{ route('student.status') }}"><i class="fas fa-info-circle" style="color: #990000;"></i> Status</a>
                                        <a class="dropdown-item" href="{{ route('student.results') }}"><i class="fas fa-poll" style="color: #990000;"></i> Results</a>
                                        <a class="dropdown-item" href="{{ route('student.appointment') }}"><i class="fas fa-calendar-alt" style="color: #990000;"></i> Appointments</a>
                                        <a class="dropdown-item" href="{{ route('student.notifications') }}"><i class="fas fa-bell" style="color: #990000;"></i> Notifications</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                @else
                                    <a class="dropdown-item" href="{{ Route('profile') }}"><i class="fas fa-user" style="color: #990000;"></i> Profile</a>
                                    <a class="dropdown-item" href="{{ Route('notification') }}"><i class="fas fa-bell" style="color: #990000;"></i> Notifications</a>
                                    <a class="dropdown-item" href="{{ Route('setting') }}"><i class="fas fa-cog" style="color: #990000;"></i> Settings</a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt" style="color: #990000;"></i> Log out</a>
                            </div>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</div>
