<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/Test-application.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LSAT Application Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="body-lsat">
    <div class="lsat-container">
        <div class="lsat-header">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="lsat-logo">
            <div class="header-eat-text">
                <span>Western Mindanao State University</span>
                <h3>Law School Admission Test (LSAT)</h3>
            </div>
        </div>
        <form method="POST" action="{{ url('submit.lsat.application') }}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row mb-3 mt-4">
                    <div class="col">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                    </div>
                    <div class="col">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middle_name">
                    </div>
                    <div class="col">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" id="address" name="address" rows="3" required></input>
                    </div>
                </div><label class="form-label">Document Uploads</label>
                <div class="school-information3 px-2 py-2">
                <div class="mb-3">
                    
                    <div class="row">
                        <div class="col">
                            <input type="file" class="form-control" id="bachelorDegree" name="bachelor_degree" accept=".pdf,.doc,.docx" required>
                            <label for="bachelorDegree">Bachelor Degree (Original)</label>
                        </div>
                        <div class="col">
                            <input type="file" class="form-control" id="tor" name="tor" accept=".pdf,.doc,.docx" required>
                            <label for="tor">TOR (Original)</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">2x2 Photo with Name Tag</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Barangay Clearance</label>
                        <input type="file" class="form-control" id="barangayClearance" name="barangay_clearance" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Medical Certificate</label>
                    <input type="file" class="form-control" id="medicalCertificate" name="medical_certificate" accept=".pdf,.doc,.docx" required>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
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
</div>
  <legend class="form-legend">Guardian's Information (If Applicable)</legend>
  <div class="guardian">
  <div class="mother col-md-8 mb-3 mt-2">
  
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
        <label for="last-name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last-name" placeholder="Last Name" required>
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
  </div>
                   
                    <button type="submit" class="submit-button mt-2">Submit Application</button>
            </div>
        </form>
    </div>
</body>
</html>
