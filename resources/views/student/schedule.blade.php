<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>schedule</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

@include('student-components.student-navigation')

@include('student-components.student-navtabs')

        <!-- Schedule Tab Content -->
<div role="tabpanel" class="tab-pane" id="schedule">
    <section class="schedule-section">
        <div class="container">
        <h2 class="section-title">Schedule of Examinations</h2>
        <ul class="exam-list">
            <li class="exam-item">
                <h3 class="exam-title">College Entrance Test (CET)</h3>
                <p class="exam-date">Date: October 10, 2023</p>
                <p class="exam-description">The College Entrance Test (CET) will be held on the specified date. Make sure to prepare!</p>
            </li>
            <li class="exam-item">
                <h3 class="exam-title">Nursing Aptitude Test (NAT)</h3>
                <p class="exam-date">Date: November 15, 2023</p>
                <p class="exam-description">Get ready for the Nursing Aptitude Test (NAT) coming up on the given date.</p>
            </li>
            <li class="exam-item">
                <h3 class="exam-title">Graduate School Admission Test (GSAT)</h3>
                <p class="exam-date">Date: December 5, 2023</p>
                <p class="exam-description">The Graduate School Admission Test (GSAT) is scheduled for the specified date. Don't miss it!</p>
            </li>
            <!-- Add more exam items as needed -->
        </ul>
        </div>
    </section>
</div>



<!-- Include Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>