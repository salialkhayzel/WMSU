<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/test-application.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSAT Application Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="gsat-body">
<div class="gsat-container">
    <div class="gsat-header">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="gsat-logo">
        <div class="header-eat-text">
            <span>Western Mindanao State University</span>
            <h3>GRADUATE SCHOOL ADMISSION TEST (GSAT)</h3>
        </div>
    </div>
    <form method="POST" action="{{ url('submit.gsat.application') }}" enctype="multipart/form-data">
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
            </div>
            <div class="mb-3">
                <label class="form-label">Document Uploads</label>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="file" class="form-control" id="bachelorDegree" name="bachelor_degree" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                        <label for="bachelorDegree">Bachelor Degree (Original)</label>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="file" class="form-control" id="torOriginal" name="tor_original" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                        <label for="torOriginal">TOR (Original)</label>
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
                <input type="file" class="form-control" id="medicalCertificate" name="medical_certificate" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="payment-receipt" class="form-label" style="color: red;">Payment Receipt<br> To Complete your examination registration, please make the payment for the examination permit at the University cashier's office.<br> After Payment Upload the payment Receipt below: </label>
                    <input type="file" class="form-control" id="payment-receipt" name="payment_receipt" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                </div>
            </div>
            <div class="family-background">
                <div class="father-information">
                <div class="father col-md-8 mb-3">
                <legend class="form-legend">Father's Information</legend>
                            <label for="high-school-name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="high-school-name"  placeholder="First Name" required>
                        </div>
                
                <div class="father col-md-8 mb-3">
               
                            <label for="high-school-name" class="form-label">Middle Name </label>
                            <input type="text" class="form-control" id="high-school-name"  placeholder="Middle Name" required>
                        </div>
                
                <div class="father col-md-8 mb-3">
                
                            <label for="high-school-name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="high-school-name"  placeholder="Last Name" required>
                        </div>
                        <div class="father col-md-8 mb-3">
                    <label for="father-last-name" class="form-label">Suffix</label>
                    <input type="text" class="form-control" id="father-last-name" placeholder="Suffix" required>
                </div>
           </div>
                
 <div class="mother-information">
 <div class="mother col-md-8 mb-3">
                <legend class="form-legend">Mother's Information</legend>
                         
                <label for="high-school-name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="high-school-name"  placeholder="First Name" required>
                        </div>
                
                <div class="mother col-md-8 mb-3">
               
                            <label for="high-school-name" class="form-label">Middle Name </label>
                            <input type="text" class="form-control" id="high-school-name"  placeholder="Middle Name" required>
                        </div>
                
                <div class="mother col-md-8 mb-3">
                
                            <label for="high-school-name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="high-school-name"  placeholder="Last Name" required>
                        </div>
                        <div class="father col-md-8 mb-3">
                    <label for="father-last-name" class="form-label">Suffix</label>
                    <input type="text" class="form-control" id="father-last-name" placeholder="Suffix" required>
                </div>
  </div>

  <div class="guardian-gsat">
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
  </div>

 </div>
            <button type="submit" class="submit-button">Submit Application</button>
        </div>
    </form>
</div>
</body>
</html>
