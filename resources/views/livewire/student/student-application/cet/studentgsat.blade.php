<link rel="stylesheet" href="{{ asset('css/application.css') }}">
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div>
    
    <div role="tabpanel" class="tab-pane" id="application">
        <section class="test-application-section ml-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 col-xl-10">
                        <div class="guide-section guide-section col-10 offset-xl-1">
                        <button type="button" class="btn-close" aria-label="Close" id="modalCloseButton"></button>
                        <div class="nat-container">
        <div class="nat-header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="nat-logo">
            <div class="header-eat-text">
                <span>Western Mindanao State University</span>
                <h3>GRADUATE SCHOOL ADMISSION TEST (GSAT)</h3>
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
                    <div class="border border-dark px-2">
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
                    </div>



                <div class="family-background">
                                            <div class="row">
                                                <div class="col-md-6">            
                                                        <legend class="father form-legend">Father's Information</legend>
                                                        <div class="border border-secondary">
                                                            <div class="row px-3">
                                                                    <div class=" col-md-8 mb-3 mt-2">
                                                                        <label for="father-first-name" class="form-label">First Name</label>
                                                                        <input type="text" class="form-control" id="father-first-name" placeholder="First Name" required>
                                                                    </div>
                                                                    <div class=" col-md-8 mb-3">
                                                                        <label for="father-middle-name" class="form-label">Middle Name</label>
                                                                        <input type="text" class="form-control" id="father-middle-name" placeholder="Middle Name" required>
                                                                    </div>
                                                            
                                                                <div class=" col-md-8 mb-3">
                                                                    <label for="father-last-name" class="form-label">Last Name</label>
                                                                    <input type="text" class="form-control" id="father-last-name" placeholder="Last Name" required>
                                                                </div>
                                                                <div class=" col-md-8 mb-3">
                                                                    <label for="father-last-name" class="form-label">Suffix</label>
                                                                    <input type="text" class="form-control" id="father-suffix" placeholder="Suffix" required>
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
                                                                        <button type="submit" class="mt-3 submit-button">Submit Application</button>
 
                   </div>
        </form>
    </div>
    <script>
        document.getElementById("modalCloseButton").addEventListener("click", function() {
            // Implement the desired action upon button click
            window.location.href = "{{ route('student.application') }}"; // Replace with your action
        });
    </script>

