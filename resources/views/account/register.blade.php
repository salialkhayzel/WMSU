<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body class="signup-body">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <span class="text-signup">SignUp Form</span>
                        <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Reminders</h4>
                                <ol class="mb-0">
                                    <li>Sign Up with a valid and existing personal email address where we can send your activation link.</li>
                                    <li>Make sure that you can access your inbox, and that the email address is correct and can receive email.</li>
                                    <li>Enter your correct information to avoid delays in the processing of your application.</li>
                                    <li>Double-check your school name.</li>
                                    <li>You are only allowed to sign up once using the same email address you provided.</li>
                                    <li>Make sure to activate your account sent to your Email address.</li>
                                </ol>
                            </div>
                            <form>
            <form>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middleName">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="suffix" class="form-label">Suffix</label>
                        <input type="text" class="form-control" id="suffix" name="suffix">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-md-6 ">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-10 ">
                        <label class="form-label"></label>
                    </div>
                    <div class="row mb-2"> 
    <div class="col-md-4 mb-3">
        <label for="birthDate" class="form-label">Birthday</label>
        <input type="date" class="form-control" id="birthDate" name="birthDate" required>
    </div>
    <div class="col-md-8 mb-3">
        <label for="seniorHighschool" class="form-label">Senior Highschool</label>
        <input type="text" class="form-control" id="seniorHighschool" name="seniorHighschool" required>
    </div>
</div>

<div class="d-flex justify-content-start"> 
                                    <button type="button" class="btn-register">Signup</button>
                                </div>


            </form>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>
