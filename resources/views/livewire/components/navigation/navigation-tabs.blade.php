<div class="container">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/profile*') ? 'active' : ''}}" href="{{ route('student.profile') }}" role="tab">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/application*') ? 'active' : ''}}" href="{{ route('student.application') }}" role="tab">Application</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/requirements*') ? 'active' : ''}}" href="{{ route('student.requirements') }}" role="tab">Requirements</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/status*') ? 'active' : ''}}" href="{{ route('student.status') }}" role="tab">Status</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/results*') ? 'active' : ''}}" href="{{ route('student.results') }}" role="tab">Results</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/appointment*') ? 'active' : ''}}" href="{{ route('student.appointment') }}" role="tab">Appointments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/announcement*') ? 'active' : ''}}" href="{{ route('student.announcement') }}" role="tab">Announcement</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/chat*') ? 'active' : ''}}" href="{{ route('student.chat') }}" role="tab">Chat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->is('student/notifications*') ? 'active' : ''}}" href="{{ route('student.notifications') }}" role="tab">Notifications</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Add tab panes for each tab -->
    </div>
</div>