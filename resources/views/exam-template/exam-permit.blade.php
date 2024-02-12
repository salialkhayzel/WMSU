<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/Test-application.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exam permit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="body-eat">
<div class="container4">
    <div class="header-eat">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo">
        <div class="header-eat-text">
            <span>Western Mindanao State University</span>
            <h2 class="mb-4">College Entrance Exam Application Form</h2>
        </div>
    </div>
    <form method="POST" action="{{ url('submit.application') }}" enctype="multipart/form-data">
        @csrf
        <div class="container4">
            <div class="form-container">
                <form class="needs-validation" novalidate>
                    <fieldset class="mb-2">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="first-name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first-name" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="last-name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="contact-number" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contact-number" name="contact_number" placeholder="Contact Number">
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="high-school-name" class="form-label">High School Name</label>
                            <input type="text" class="form-control" id="high-school-name" name="high_school_name" placeholder="High School Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="high-school-address" class="form-label">High School Address</label>
                            <input type="text" class="form-control" id="high-school-address" name="high_school_address" placeholder="High School Address" required>
                        </div>
                    </div>
                    <fieldset class="mb-3">
                        <legend class="form-legend">Required Documents</legend>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="enrollment-certification" class="form-label">Enrollment Certification</label>
                                <input type="file" class="form-control" id="enrollment-certification" name="enrollment_certification" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="graduation-certification" class="form-label">Graduation Certification</label>
                                <input type="file" class="form-control" id="graduation-certification" name="graduation_certification" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                            </div>
                        </div>
                    </fieldset>
                   
                    <button type="submit" class="submit-button">Submit Application</button>
                </form>
            </div>
        </div>
    </form>
</div>
</body>
</html>
