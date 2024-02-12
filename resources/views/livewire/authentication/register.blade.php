<div style="background: linear-gradient(to top, #990000, #ccc); background-size: 100% 200%; animation: gradientAnimation 5s infinite;">
    <style>
        @keyframes gradientAnimation {
          0%, 100% {
            background-position: 0 0;
          }
          50% {
            background-position: 0 100%;
          }
        }
        
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-15">
                <div class="card">
                <span class="text-signup mt-3 d-block text-center">Sign up your details</span>
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <br>
                            <form>
                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="middleName">
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                                    </div>
                                </div>
                
                                <div class="row mb-1">
                                    <div class="col-md-5">
                                        <label for="suffix" class="form-label">Suffix (if applicable)</label>
                                        <input type="text" class="form-control" id="suffix" name="suffix" placeholder="E.g., Jr., Sr., III">
                                        <small class="form-text text-muted">Include any suffix associated with your name.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="col-md-12 ">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label for="birthDate" class="form-label">Birthday</label>
                                        <input type="date" class="form-control" id="birthDate" name="birthDate" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                            <label for="seniorHighschool" class="form-label">Senior Highschool</label>
                                            <input type="text"   class="form-control" id="seniorHighschool" name="seniorHighschool" required>
                                    </div>
                                    <button type="submit" class="btn-block button-color col-md-5 mx-auto">Sign Up</button>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>