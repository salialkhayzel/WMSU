<div>
<div class="container">
    <ul class="nav nav-tabs" id="notificationTabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#allNotifications"  wire:ignore.self>
                <i class="fas fa-bell"></i> All Notifications
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#unreadNotifications"  wire:ignore.self>
                <i class="fas fa-bell"></i> Unread
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#settings"  wire:ignore.self>
                <i class="fas fa-cog"></i> Notification Settings
            </a>
        </li> -->
    </ul>

    <div class="tab-content">
        <!-- Tab 1: All Notifications -->
        <div class="tab-pane fade show active" id="allNotifications"  wire:ignore.self>
            <table class="table table-striped">
                <thead style="background-color: #990000; color: white; position: sticky; top: 0;">
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Title</th>
                        <th scope="col"><i class="far fa-comment"></i></th>
                        <th scope="col"><i class="far fa-clock"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($notifications_list as $key =>$value)
                    <tr>
                        <td><?php echo $value->notification_icon_icon?></i> {{$value->notification_title}}</td>
                        <td>{{$value->notification_content}}</td>
                        <td>{{$value->notification_timestamp}}</td>
                        <td>
                            @if($value->notiication_isread)
                                <button class="btn btn-secondary" wire:click="mark_as_read({{$value->notification_id}},0)">Mark as read</button></td>
                            @else
                                <button class="btn btn-danger" wire:click="mark_as_read({{$value->notification_id}},1)">Mark as unread</button></td>
                            @endif
                    </tr>
                @empty
                    <tr>No notifications</tr>
                @endforelse
                </tbody>
                <!-- <tbody>
                    <tr>
                        <td><i class="fas fa-file-alt text-primary"></i> Application Submitted</td>
                        <td>Your application has been successfully submitted.</td>
                        <td>Just now</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-hourglass-half text-warning"></i> Application Under Review</td>
                        <td>Your application is currently under review.</td>
                        <td>2 days ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-file-export text-success"></i> Application Processed</td>
                        <td>Your application has been processed.</td>
                        <td>4 hours ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-check-circle text-success" href=""></i> Application Accepted Notification</td>
                        <td>Notification message for an accepted application.</td>
                        <td>2 hours ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-download text-primary"></i> Application Download Permit Notification</td>
                        <td>Notification message for a download permit.</td>
                        <td>5 hours ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-times-circle text-danger"></i> Application Declined Notification</td>
                        <td>Notification message for a declined application.</td>
                        <td>1 day ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-plus text-primary"></i> New Appointment Scheduled</td>
                        <td>Your appointment has been successfully scheduled.</td>
                        <td>1 hour ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-times text-danger"></i> Appointment Canceled</td>
                        <td>Your appointment has been canceled.</td>
                        <td>3 days ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-check text-success"></i> Appointment Confirmed</td>
                        <td>Your appointment has been confirmed.</td>
                        <td>Just now</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-alt text-primary"></i> Scheduled Notification Title</td>
                        <td>Notification message for a scheduled event.</td>
                        <td>Next week</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-bell text-warning"></i> Appointment Reminder</td>
                        <td>Your appointment reminder notifications have been disabled.</td>
                        <td>Just now</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-check text-success"></i> Appointment Attended</td>
                        <td>You have successfully attended your scheduled appointment.</td>
                        <td>1 hour ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-times text-danger"></i> Missed Scheduled Appointment</td>
                        <td>The scheduled appointment was missed.</td>
                        <td>3 days ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-plus text-info"></i> Requested New Appointment</td>
                        <td>Your request for a new appointment has been received.</td>
                        <td>Just now</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-alt text-warning"></i><i class="fas fa-times-circle text-danger"></i> Declined Scheduled Notification</td>
                        <td>Notification message for a declined scheduled event.</td>
                        <td>Yesterday</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-calendar-alt text-primary"></i><i class="fas fa-sync-alt text-info"></i> Rescheduled Event Notification</td>
                        <td>Notification message for a rescheduled event.</td>
                        <td>Tomorrow</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-bell"></i> Default Notification Title</td>
                        <td>Default notification message.</td>
                        <td>3 days ago</td>
                    </tr>

                    <tr>
                        <td><i class="fas fa-bullhorn text-info"></i>   Announcement Notification Title</td>
                        <td>Notification message for an announcement.</td>
                        <td>Just now</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-user-edit text-info"></i>   Account Updated</td>
                        <td>Your student account details have been updated.</td>
                        <td>2 hours ago</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-lock text-success"></i>   Password Changed</td>
                        <td>Your account password has been successfully changed.</td>
                        <td>Just now</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-user-edit text-info"></i>   Profile Updated</td>
                        <td>Your profile information has been successfully updated.</td>
                        <td>Just now</td>
                    </tr>
                </tbody> -->
            </table>
        </div>

        <!-- Tab 2: Unread Notifications -->
        <div class="tab-pane fade" id="unreadNotifications" wire:ignore.self>
            <h2>Unread Notifications</h2>
            <p>Welcome to the Unread Notifications tab. Here, you can view all your unread notifications.</p>
            <table class="table table-striped">
                <thead style="background-color: #990000; color: white; position: sticky; top: 0;">
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Title</th>
                        <th scope="col"><i class="far fa-comment"></i></th>
                        <th scope="col"><i class="far fa-clock"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($unread_notifications_list as $key =>$value)
                    <tr>
                        <td><?php echo $value->notification_icon_icon?></i> {{$value->notification_title}}</td>
                        <td>{{$value->notification_content}}</td>
                        <td>{{$value->notification_timestamp}}</td>
                        <td>
                            @if($value->notiication_isread)
                                <button class="btn btn-secondary" wire:click="mark_as_read({{$value->notification_id}},0)">Mark as read</button></td>
                            @else
                                <button class="btn btn-danger" wire:click="mark_as_read({{$value->notification_id}},1)">Mark as unread</button></td>
                            @endif
                    </tr>
                @empty
                    <tr>No notifications</tr>
                @endforelse
                </tbody>
                <!-- <tbody>
                    <tr>
                        <td>Unread Notification Title 1</td>
                        <td>Unread notification message goes here. This notification has not been marked as read.</td>
                        <td>1 day ago</td>
                    </tr>
                    <tr>
                        <td>Unread Notification Title 2</td>
                        <td>Another unread notification message for demonstration.</td>
                        <td>2 days ago</td>
                    </tr>
                </tbody> -->
            </table>
        </div>

        <!-- Tab 3: Notification Settings -->
        <div class="tab-pane fade" id="settings"  wire:ignore.self>
            <h2><i class="fas fa-cog"></i> Notification Settings</h2>
            <p>Welcome to the Notification Settings tab. Here, you can customize your notification preferences.</p>
            <form>
                <div class="form-group">
                    <label for="emailNotifications"><i class="fas fa-envelope"></i> Email Notifications</label>
                    <select class="form-control" id="emailNotifications">
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notificationFrequency"><i class="fas fa-clock"></i> Notification Frequency</label>
                    <select class="form-control" id="notificationFrequency">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Settings</button>
            </form>
        </div>
    </div>
</div>

</div>

