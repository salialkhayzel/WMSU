<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<div>
    <x-loading-indicator/>
    <main id="main" class="main">
        <div class="container">
            <ul class="nav nav-tabs" id="notificationTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#allNotifications">
                        <i class="fas fa-bell"></i> All Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#unreadNotifications">
                        <i class="fas fa-envelope-open"></i> Unread
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#notificationSettings">
                        <i class="fas fa-cog"></i> Notification Settings
                    </a>
                </li>
            </ul>
            <div class="tab-content">

            <!-- Tab 1: All Notifications -->
            <div class="tab-pane fade show active" id="allNotifications">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Title</th>
                            <th scope="col"><i class="far fa-comment"></i></th>
                            <th scope="col"><i class="far fa-clock"></i></th>
                        </tr>
                    </thead>
                    <tbody id="notification-content">
                        <tr>
                            <!-- <th scope="row">1</th> -->
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Scheduled</td>
                            <td>An appointment for John Doe has been scheduled for CET testing.</td>
                            <td>2023-09-18 14:25:57</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Online Application Submitted</td>
                            <td>Student ID 12345 has submitted an online CET application.</td>
                            <td>2023-09-19 09:30:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Processing</td>
                            <td>An application is currently being processed for CET.</td>
                            <td>2023-09-20 11:45:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>Account Update</td>
                            <td>Account information for Jane Smith has been updated.</td>
                            <td>2023-09-21 15:00:00</td>
                        </tr>
                        <!-- Add more notification items -->
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Rescheduled</td>
                            <td>Appointment for Mary Johnson has been rescheduled.</td>
                            <td>2023-09-22 16:30:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>New Online Application</td>
                            <td>New application received from Student ID 67890 for CET.</td>
                            <td>2023-09-23 09:45:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Review</td>
                            <td>An application is pending review for CET.</td>
                            <td>2023-09-24 12:10:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>Account Deactivated</td>
                            <td>Account for Mark Lee has been deactivated.</td>
                            <td>2023-09-25 14:20:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>New Appointment Request</td>
                            <td>New appointment requested for CET testing.</td>
                            <td>2023-09-26 17:00:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Application Denied</td>
                            <td>Application from Student ID 24680 has been denied for CET.</td>
                            <td>2023-09-27 10:30:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Approved</td>
                            <td>An application has been approved for CET.</td>
                            <td>2023-09-28 13:15:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>New Account Created</td>
                            <td>New account created for Sarah Johnson.</td>
                            <td>2023-09-29 11:40:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Cancelled</td>
                            <td>An appointment for CET testing has been cancelled.</td>
                            <td>2023-09-30 09:00:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Online Application Updated</td>
                            <td>Student ID 13579 has updated their online application for CET.</td>
                            <td>2023-10-01 14:50:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Review Complete</td>
                            <td>Application review process completed for CET.</td>
                            <td>2023-10-02 16:20:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>Password Reset</td>
                            <td>Password reset request for John Smith's account.</td>
                            <td>2023-10-03 10:10:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Completed</td>
                            <td>Appointment for CET testing has been successfully completed.</td>
                            <td>2023-10-04 13:00:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Online Application Reviewed</td>
                            <td>Student ID 56789's application reviewed for CET.</td>
                            <td>2023-10-05 11:05:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Account Activated</td>
                            <td>Account activation for Emily White's account.</td>
                            <td>2023-10-06 14:30:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

                <!-- Tab 2: Unread Notifications -->
                <div class="tab-pane fade" id="unreadNotifications">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Title</th>
                            <th scope="col"><i class="far fa-comment"></i></th>
                            <th scope="col"><i class="far fa-clock"></i></th>
                        </tr>
                    </thead>
                    <tbody id="notification-content">
                        <tr>
                            <!-- <th scope="row">1</th> -->
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Scheduled</td>
                            <td>An appointment for John Doe has been scheduled for CET testing.</td>
                            <td>2023-09-18 14:25:57</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Online Application Submitted</td>
                            <td>Student ID 12345 has submitted an online CET application.</td>
                            <td>2023-09-19 09:30:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Processing</td>
                            <td>An application is currently being processed for CET.</td>
                            <td>2023-09-20 11:45:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>Account Update</td>
                            <td>Account information for Jane Smith has been updated.</td>
                            <td>2023-09-21 15:00:00</td>
                        </tr>
                        <!-- Add more notification items -->
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Rescheduled</td>
                            <td>Appointment for Mary Johnson has been rescheduled.</td>
                            <td>2023-09-22 16:30:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>New Online Application</td>
                            <td>New application received from Student ID 67890 for CET.</td>
                            <td>2023-09-23 09:45:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Review</td>
                            <td>An application is pending review for CET.</td>
                            <td>2023-09-24 12:10:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>Account Deactivated</td>
                            <td>Account for Mark Lee has been deactivated.</td>
                            <td>2023-09-25 14:20:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>New Appointment Request</td>
                            <td>New appointment requested for CET testing.</td>
                            <td>2023-09-26 17:00:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Application Denied</td>
                            <td>Application from Student ID 24680 has been denied for CET.</td>
                            <td>2023-09-27 10:30:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Approved</td>
                            <td>An application has been approved for CET.</td>
                            <td>2023-09-28 13:15:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>New Account Created</td>
                            <td>New account created for Sarah Johnson.</td>
                            <td>2023-09-29 11:40:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Cancelled</td>
                            <td>An appointment for CET testing has been cancelled.</td>
                            <td>2023-09-30 09:00:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Online Application Updated</td>
                            <td>Student ID 13579 has updated their online application for CET.</td>
                            <td>2023-10-01 14:50:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Application Review Complete</td>
                            <td>Application review process completed for CET.</td>
                            <td>2023-10-02 16:20:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-cog"></i></td>
                            <td>Password Reset</td>
                            <td>Password reset request for John Smith's account.</td>
                            <td>2023-10-03 10:10:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td>Appointment Completed</td>
                            <td>Appointment for CET testing has been successfully completed.</td>
                            <td>2023-10-04 13:00:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt"></i></td>
                            <td>Online Application Reviewed</td>
                            <td>Student ID 56789's application reviewed for CET.</td>
                            <td>2023-10-05 11:05:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-cogs"></i></td>
                            <td>Account Activated</td>
                            <td>Account activation for Emily White's account.</td>
                            <td>2023-10-06 14:30:00</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!-- Tab 3: Notification Settings -->
                <div class="tab-pane fade" id="notificationSettings">
                    <h2><i class="fas fa-cog"></i> Notification Settings</h2>
                    <p>Welcome to the Notification Settings tab. Here, you can customize your notification preferences.</p>
                    <form>
                        <div class="form-group">
                            <label for="emailNotifications">
                                <i class="fas fa-envelope"></i> Email Notifications
                            </label>
                            <select class="form-control" id="emailNotifications">
                                <option value="enabled">Enabled</option>
                                <option value="disabled">Disabled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notificationFrequency">
                                <i class="fas fa-clock"></i> Notification Frequency
                            </label>
                            <select class="form-control" id="notificationFrequency">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>
</div>
