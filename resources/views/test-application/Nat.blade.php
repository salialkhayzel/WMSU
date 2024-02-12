<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/Test-application.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursing Aptitude Test Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="body-nat">
    <div class="nat-container">
        <div class="nat-header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="nat-logo">
            <div class="header-eat-text">
                <span>Western Mindanao State University</span>
                <h3>Nursing Admission Test (NAT)</h3>
            </div>
        </div>
        <form>
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="middle-name">Middle Name:</label>
                    <input type="text" id="middle-name" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">Email:</label>
                    <input type="email" id="email" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Address:</label>
                    <input type="text" id="address" class="form-control" required>
                </div>
            </div>
            <div class="school-information4 px-4 py-2">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="test-result">College Entrance Test Result (70.00 And Above):</label>
                    <input type="file" class="form-control" id="tor1" name="test-result" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="photo">2x2 Picture with Name Tag (Selfie not Allowed):</label>
                    <input type="file" class="form-control" id="tor2" name="photo" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="payment-receipt" class="form-label" style="color: red;">Payment Receipt<br> To Complete your examination registration, please make the payment for the examination permit at the University cashier's office.<br> After Payment Upload the payment Receipt below: </label>
                    <input type="file" class="form-control" id="tor" name="payment-receipt" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required>
                </div>
            </div></div>
            <div class="family-background">
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
   <button type="submit" class="mt-3 submit-button">Submit Application</button>
 
                   </div>
                 
                </form>
            </div>
        </div>
    </form>
    </div>
</body>
</html>
