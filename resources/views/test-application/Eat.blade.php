<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/test-application.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineering Aptitude Test Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="body-eat">
<div class="container3">
    <div class="header-eat">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="eat-logo">
        <div class="header-eat-text">
            <span>Western Mindanao State University</span>
            <h2 class="mb-4">Engineering Aptitude Test Application</h2>
        </div>
    </div>
    <form method="POST" action="{{ url('submit.application') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group1 col">
                <label for="first-name" class="form-label">First Name:</label>
                <input type="text" id="first-name" name="first_name" class="form-control" required>
            </div>
            <div class="form-group1 col">
                <label for="middle-name" class="form-label">Middle Name:</label>
                <input type="text" id="middle-name" name="middle_name" class="form-control">
            </div>
            <div class="form-group1 col">
                <label for="last-name" class="form-label">Last Name:</label>
                <input type="text" id="last-name" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
        </div>
<div class="school-information2 mb-2 px-2 mt-2">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="test-result" class="form-label">College Entrance Test Result (70.00 And Above):</label>
                <input type="file" class="form-control" id="test-result" name="test_result" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="photo" class="form-label">2x2 Picture with Name Tag (Selfie not Allowed):</label>
                <input type="file" class="form-control" id="photo" name="photo" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-2">
                <label for="payment-receipt" class="form-label" style="color: red;">Payment Receipt<br> To Complete your examination registration, please make the payment for the examination permit at the University cashier's office.<br> After Payment Upload the payment Receipt below: </label>
                <input type="file" class="form-control" id="payment-receipt" name="payment_receipt" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
            </div>
        </div></div>
        <div class="row">
        <div class="col-md-6">            
                <legend class="father form-legend">Father's Information</legend>
            <div class="father-information">

              <div class="row">
    <div class="father col-md-8 mb-3 mt-2">
        <label for="father-first-name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="father-first-name" placeholder="First Name" required>
    </div>
    <div class="father col-md-8 mb-3">
        <label for="father-middle-name" class="form-label">Middle Name</label>
        <input type="text" class="form-control" id="father-middle-name" placeholder="Middle Name" required>
    </div>
</div>

                <div class="father col-md-8 mb-3">
                    <label for="father-last-name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="father-last-name" placeholder="Last Name" required>
                </div>
                <div class="father col-md-8 mb-3">
                    <label for="father-last-name" class="form-label">Suffix</label>
                    <input type="text" class="form-control" id="father-last-name" placeholder="Suffix" required>
                </div>
            </div>
        </div>
        <div class="col-md-6"> <legend class="mother form-legend">Mother's Information</legend>
            <div class="mother-information">
               
                <div class="mother col-md-8 mb-3 mt-2">
                    <label for="mother-first-name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="mother-first-name" placeholder="First Name" required>
                </div>
                <div class="mother col-md-8 mb-3">
                    <label for="mother-middle-name" class="form-label">Middle Name </label>
                    <input type="text" class="form-control" id="mother-middle-name" placeholder="Middle Name" required>
                </div>
                <div class="mother col-md-8 mb-3">
                    <label for="mother-last-name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="mother-last-name" placeholder="Last Name" required>
                </div>
                <div class="father col-md-8 mb-3">
                    <label for="father-last-name" class="form-label">Suffix</label>
                    <input type="text" class="form-control" id="father-last-name" placeholder="Suffix" required>
                </div>
            </div>
        </div>
    </div>


  <div class="guardian-eat">
  <div class="mother col-md-8 mb-3">
    <legend class="form-legend">Guardian's Information (If Applicable)</legend>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first-name" placeholder="First Name" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="middle-name" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middle-name" placeholder="Middle Name" required>
        </div>
    </div>


                
<div class="row">
        <div class="col-md-6 mb-3">
            <label for="first-name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="first-name" placeholder="Last Name" required>
        </div>
        <div class="col-md-6 mb-3">
    <label for="father-suffix" class="form-label">Suffix</label>
<input type="text" class="form-control" id="father-suffix" aria-label="Father's Suffix" placeholder="Enter Suffix">
</div>
        <div class="col-md-6 mb-3">
            <label for="middle-name" class="form-label">Relationship</label>
            <input type="text" class="form-control" id="middle-name" placeholder="Relationship" required>
        </div>
    </div>
  </div>
  </div> <button type="submit" class="submit-button mt-2">Submit Application</button>

 </div>
       
    </form>
</div>
</div>
</body>
</html>
