<div class="container border border-dark  mt-5 mb-5">
  <div class="row ">
    <div class="col-sm border border-danger my-4 mx-2 d-flex align-items-center justify-content-center mx-5" style="height:300px;">
        <span class="text-center text-danger"> <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo"></span>
    </div>

    <div class="col-sm  my-4 mx-2  text-center py-5 mx-5">
        
      <p class="text-danger font-weight-bold">Western Mindanao State University <br> TESTING AND EVALUATION CENTER  <br> Zamboanga City</p>
      <p class="text-danger font-weight-bold">WMSU-CET APPLICATION FORM  <br> For School Year 2024-2025</p>
    </div>
    <div class="col-sm text-center border border-danger my-4 mx-2 d-flex align-items-center justify-content-center mx-5">
        <div class="mb-3">
                <label for="formFile" class="form-label">Upload 2x2 Image</label>
                <input class="forms-control" type="file" id="formFile">
        </div>
    </div>
  </div> 
                                        <legend class="text-danger font-weight-bold">TO THE APPLICANTS:Forms with incomplete entries/requirements will not be processed</legend>
                                                 <div class="container border border-4 w-80">
                                                    <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <label for="first-name" class="form-label">First name </label>
                                                                <input type="text" class="form-control" id="first-name" wire:model="firstname" name="first_name" placeholder="First name" required>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label for="last-name" class="form-label">Middle name</label>
                                                                <input type="text" class="form-control" id="last-name"  wire:model="middlename" name="last_name" placeholder="Middle name" >
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label for="last-name" class="form-label">Last name </label>
                                                                <input type="text" class="form-control" id="last-name"  wire:model="lastname" name="last_name" placeholder="Last name" required>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label for="last-name" class="form-label">Suffix</label>
                                                                <div class="col-lg-8">
                                                                    <select wire:model="suffix" class="form-control">
                                                                        <option value="">Select suffix</option>
                                                                        <option value="Jr.">Jr.</option>
                                                                        <option value="Sr.">Sr.</option>
                                                                        <option value="II">II</option>
                                                                        <option value="III">III</option>
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 mb-2">
                                                                <label for="birthdate">Birthday:</label>
                                                                <input type="date" class="form-control" id="birthdate" name="birthdate">
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label for="contact-number" class="form-label">Contact Number</label>
                                                                <input type="text"  wire:model="phone" class="form-control" required placeholder="Contact Number" >
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label for="contact-number" class="form-label">Age</label>
                                                                <input type="number"  wire:model="phone" class="form-control" required placeholder="Age" >
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <label for="contact-number" class="form-label">Email Address</label>
                                                                <input type="text"  wire:model="phone" class="form-control" required placeholder="Email Address" >
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label for="contact-number" class="form-label">Citizenship </label>
                                                                <input type="text"  wire:model="phone" class="form-control" required placeholder="Citizenship" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <legend class="text-danger font-weight-bold">TYPE OF APPLICANT (CHECK ONE of the categories that applies to you):</legend>
                                                    <div class="form-check"> 
                                                        <label class="form-check-label">
                                                            <input class="form-check-input mt-2" type="checkbox" value="" id="flexCheckDefault">
                                                            <span class="text-danger font-weight-bold">SENIOR HIGH SCHOOL GRADUATING STUDENT</span>
                                                        </label>
                                                    </div>
                                                     <div class="container border border-4 w-80">
                                                         <div class="row">
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="first-name" class="form-label">Name Of School </label>
                                                                    <input type="text" class="form-control" id="first-name" wire:model="firstname" name="first_name" placeholder="Name Of School" required>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="last-name" class="form-label">Expected Date of Graduation</label>
                                                                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="last-name" class="form-label">School Address </label>
                                                                    <input type="text" class="form-control" id="last-name"  wire:model="lastname" name="last_name" placeholder="School Address " required>
                                                                </div>
                                                            </div>
                                                            <fieldset class="mb-2">
                                                                <legend class="form-legend">Required Documents</legend>
                                                                <div class="border border-secondary">
                                                                    <div class="row px-4 py-2">
                                                                       
                                                                        <div class="col-md-12 mb-2 ">
                                                                            <label for="enrollment-certification" class="form-label">School Principal Certification  <span style="color:red;">*</span>
                                                                                <i class="fa fa-info-circle info-icon" title='Certification from the school principal / registar that you are currently enrolled as Grade 12 Stundent'style="padding: 11px 0 0 5px;"></i>
                                                                            </label>
                                                                            <input type="file" class="form-controls"  wire:model="t_a_school_principal_certification"  name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-12 mb-2 ">
                                                                            <label for="enrollment-certification" class="form-label">CET Payment Receipt  <span style="color:red;">*</span>
                                                                                <i class="fa fa-info-circle info-icon" title='You have taken a cet previously hence you need to pay and upload the receipt photo here Thank you'style="padding: 11px 0 0 5px;"></i>
                                                                            </label>
                                                                            <input type="file" class="form-controls"  wire:model="t_a_receipt_photo" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                                        </div>
                                                                    
                                                                    </div>
                                                                </div>
                                                          </fieldset>
                                                        </div>
                                                            

                                                        <div class="form-check"> 
                                                        <label class="form-check-label">
                                                            <input class="form-check-input mt-2" type="checkbox" value="" id="flexCheckDefault">
                                                            <span class="text-danger font-weight-bold">SENIOR HIGH SCHOOL GRADUATE who has not enrolled in college</span>
                                                        </label>
                                                    </div>
                                                     <div class="container border border-4 w-80">
                                                         <div class="row">
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="first-name" class="form-label">From what School </label>
                                                                    <input type="text" class="form-control" id="first-name" wire:model="firstname" name="first_name" placeholder="Name Of School" required>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="last-name" class="form-label"> Date/Year Graduated</label>
                                                                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="last-name" class="form-label">School Address</label>
                                                                    <input type="text" class="form-control" id="last-name"  wire:model="lastname" name="last_name" placeholder="School Address " required>
                                                                </div>
                                                            </div>
                                                            <fieldset class="mb-2">
                                                                <legend class="form-legend">Required Documents</legend>
                                                                <div class="border border-secondary">
                                                                    <div class="row px-4 py-2">
                                                                       
                                                                        <div class="col-md-12 mb-2 ">
                                                                            <label for="senior-card-original">Original Senior High School Card</label>
                                                                                <i class="fa fa-info-circle info-icon" title='Original senior high school card'style="padding: 11px 0 0 5px;"></i>
                                                                            
                                                                            <input type="file" class="forms-control" wire:model="t_a_original_senior_high_school_card"  name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                                        </div>
                                                                   
                                                                        <div class="col-md-12 mb-2 ">
                                                                            <label for="enrollment-certification" class="form-label">CET Payment Receipt  <span style="color:red;">*</span>
                                                                                <i class="fa fa-info-circle info-icon" title='You have taken a cet previously hence you need to pay and upload the receipt photo here Thank you'style="padding: 11px 0 0 5px;"></i>
                                                                            </label>
                                                                            <input type="file" class="forms-control"  wire:model="t_a_receipt_photo"  name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                                        </div>
                                                                     
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <div class="form-check"> 
                                                        <label class="form-check-label">
                                                            <input class="form-check-input mt-2" type="checkbox" value="" id="flexCheckDefault">
                                                            <span class="text-danger font-weight-bold">COLLEGE STUDENT</span>
                                                        </label>
                                                    </div>
                                                     <div class="container border border-4 w-80">
                                                         <div class="row">
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="first-name" class="form-label">School enrolled in/last attended</label>
                                                                    <input type="text" class="form-control" id="first-name" wire:model="firstname" name="first_name" placeholder="Name Of School" required>
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="last-name" class="form-label">Course</label>
                                                                    <input type="text" class="form-control" id="last-name"  wire:model="middlename" name="last_name" placeholder="Course" >
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="last-name" class="form-label">School Address </label>
                                                                    <input type="text" class="form-control" id="last-name"  wire:model="lastname" name="last_name" placeholder="School Address " required>
                                                                </div>
                                                            </div>
                                                             <fieldset class="mb-2">
                                                                <legend class="form-legend">Required Documents</legend>
                                                                <div class="border border-secondary">
                                                                    <div class="row px-4 py-2">
                                                                       
                                                                        <div class="col-md-6 mb-2 ">
                                                                            <label for="senior-card-original">Transcript of Records ( TOR ) <span style="color:red;">*</span></label>
                                                                            <i class="fa fa-info-circle info-icon" title='Transcript of records from registrar'style="padding: 11px 0 0 5px;"></i>
                                                                            <input type="file" class="forms-control" wire:model="t_a_transcript_of_records" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2 ">
                                                                            <label for="barangay-clearance">Endorsement letter from WMSU Dean <span style="color:red;">*</span></label>
                                                                            <i class="fa fa-info-circle info-icon" title='Transcript of records from registrar'style="padding: 11px 0 0 5px;"></i>
                                                                            <input type="file" class="forms-control"  wire:model="t_a_endorsement_letter_from_wmsu_dean"  name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                                        </div>
                                                                       
                                                                        <div class="col-md-12 mb-2 ">
                                                                            <label for="enrollment-certification" class="form-label">CET Payment Receipt  <span style="color:red;">*</span>
                                                                                <i class="fa fa-info-circle info-icon" title='You have taken a cet previously hence you need to pay and upload the receipt photo here Thank you'style="padding: 11px 0 0 5px;"></i>
                                                                            </label>
                                                                            <input type="file" class="forms-control"   accept=".pdf,.jpg,.png,.jpeg" required>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                       
                
                                <div align="end" class="py-4">
                            <a href="http://wmsutec/student/application-back" style="width: 100px;" class="btn btn-danger">Next</a>
                            </div>

   </div>
                                                
                                              