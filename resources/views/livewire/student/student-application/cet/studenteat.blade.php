<link rel="stylesheet" href="{{ asset('css/application.css') }}">
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


    <div role="tabpanel" class="tab-pane" id="application">
        <section class="test-application-section ml-5">
            <div class="container">
                <div class="row">
              
                <div class="col-lg-10 offset-lg-1 col-xl-10">
                        <div class="guide-section guide-section col-10 offset-xl-1">
                        <button type="button" class="btn-close" id="modalCloseButton" aria-label="Close"></button>
                        
                        <div class="container3">
                <div class="eat-header">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="eat-logo">
                    <div class="header-eat-text">
                        <h2>Western Mindanao State University</h2>
                        <span class="mb-2 custom-class">Engineering Aptitude Test</span>
                    </div>
                </div>
    <form method="POST" action="{{ url('submit.application') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row mt-2">
            <div class="form-group1 col">
                <label for="first-name" class="form-label">First Name:</label>
                <input type="text" id="first-name" name="first_name" class="form-control-eat" required>
            </div>
            <div class="form-group1 col">
                <label for="middle-name" class="form-label">Middle Name:</label>
                <input type="text" id="middle-name" name="middle_name" class="form-control-eat">
            </div>
            <div class="form-group1 col">
                <label for="last-name" class="form-label">Last Name:</label>
                <input type="text" id="last-name" name="last_name" class="form-control-eat" required>
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

        <legend>Required Documents</legend>
        <div class="border border-secondary mb-2 px-2 mt-2">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="test-result" class="form-label">College Entrance Test Result (70.00 And Above)</label>
                    <input type="file" class="form-control" id="test-result" name="test_result" accept=".pdf,.jpg,.png,.jpeg" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="photo" class="form-label">2x2 Picture with Name Tag (Selfie not Allowed)</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept=".pdf,.jpg,.png,.jpeg" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="payment-receipt" class="form-label" style="color: red;">Payment Receipt<br> To Complete your examination registration, please make the payment for the examination permit at the University cashier's office.<br> After Payment Upload the payment Receipt below </label>
                    <input type="file" class="form-control" id="payment-receipt" name="payment_receipt" accept=".pdf,.jpg,.png,.jpeg" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">            
                <legend class="father form-legend">Father's Information</legend>
                <div class="border border-secondary">

                <div class="row px-3">
                    <div class="father col-md-8 mb-3 mt-2">
                        <label for="father-first-name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="father-first-name" placeholder="First Name" required>
                    </div>
                    <div class="father col-md-8 mb-3">
                        <label for="father-middle-name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="father-middle-name" placeholder="Middle Name" required>
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
        <div class="col-md-6"> 
            <legend class="mother form-legend">Mother's Information</legend>
            <div class="border border-secondary">
               
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

                                                                                     
        <legend class="form-legend">Guardian's Information (If Applicable)</legend>
        <div class="border border-secondary">
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

<script>
    document.getElementById("modalCloseButton").addEventListener("click", function() {
        window.location.href = "{{ route('student.application') }}"; 
    });
</script>