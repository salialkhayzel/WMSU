<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Application</title>
    <link rel="stylesheet" href="{{ asset('css/User.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

@include('student-components.student-navigation')

@include('student-components.student-navtabs')

<!-- Application Tab Content -->
<div role="tabpanel" class="tab-pane" id="application">
    <section class="test-application-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="test-section">
                        <h2>Choose Your Test</h2>
                        <p>Select the test you would like to take from the options below:</p>
                        <ul class="test-list">
                        <li class="custom-dropdown" id="cetDropdownContainer">
                            <span class="test-list-item">CET Form Applications<span class="dropdown-indicator">&#9662;</span></span>
                            <ul class="dropdown-content" id="cetDropdown">
                                <li><a href="{{ Route('test-application.Cet') }}">CET SHS Undergraduate Form</a></li>
                                <li><a href="{{ Route('test-application.Cetgraduate') }}">CET SHS Graduated form</a></li>
                                <li><a href="{{ Route('test-application.Cetshiftee') }}">CET Shiftee</a></li>
                                <li><a href="{{ Route('test-application.Cettransferee') }}">CET Transferee</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="test-list-item" href="{{ url('test-application.Nat') }}">
                                NAT Application
                                <button class="btn btn-primary apply-button">Unavailabe</button>
                            </a>
                        </li>
                        <li>
                            <a class="test-list-item" href="{{ url('test-application.Eat') }}">
                                EAT Application
                                <button class="btn btn-primary apply-button">Unavailabe</button>
                            </a>
                        </li>
                        <li>
                            <a class="test-list-item" href="{{ url('test-application.Gsat') }}">
                                GSAT Application
                                <button class="btn btn-primary apply-button">Unavailabe</button>
                            </a>
                        </li>
                        <li>
                            <a class="test-list-item" href="{{ url('test-application.Lsat') }}">
                                LSAT Application
                                <button class="btn btn-primary apply-button">Unavailabe</button>
                            </a>
                        </li>
                    </ul>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="guide-section">
                        <h3>Step-by-Step Guide to Apply</h3>
                        <ol class="step-list">
                            <li>Create an account on our website.</li>
                            <li>Choose the test you want to take.</li>
                            <li>Upload the required documents.</li>
                            <li>Submit your application.</li>
                        </ol>
                        <p>Follow these steps to complete the application process. If you have questions, contact our support team.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
