<div>
    <link rel="stylesheet" href="{{ asset('css/application.css') }}">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <div role="tabpanel" class="tab-pane" id="application">
        <section class="test-application-section ml-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 col-xl-10">
                        <div class="guide-section col-10 offset-xl-1">
                        <button type="button" class="btn-close" id="modalCloseButton" aria-label="Close"></button>
                            <div class="container4 ">
                                <div class="header-eat">
                                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo">
                                    <div class="header-eat-text">
                                        <span>Western Mindanao State University</span>
                                        <h2 class="mb-2">College Entrance Exam Application Form</h2>
                                        <span class="mb-2 custom-class">Senior Highschool Graduating Student Form</span>
                                    </div>
                                </div>
                                <div class="container4">
                                    <div class="form-container">
                                        <form wire:submit.prevent="submit_application()">
                                            <fieldset class="mb-2">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="first-name" class="form-label">First name <span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control" id="first-name" wire:model="firstname" name="first_name" placeholder="First name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="last-name" class="form-label">Middle name</label>
                                                        <input type="text" class="form-control" id="last-name"  wire:model="middlename" name="last_name" placeholder="Middle name" >
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="last-name" class="form-label">Last name <span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control" id="last-name"  wire:model="lastname" name="last_name" placeholder="Last name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="last-name" class="form-label">Suffix</label>
                                                        <input type="text" class="form-control" id="last-name"  wire:model="suffix" name="last_name" placeholder="Suffix" >
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="email" class="form-label">Email <span style="color:red;">*</span></label>
                                                        <input type="email" class="form-control" id="email"  wire:model="email" name="email" placeholder="Email" required disabled>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="contact-number" class="form-label">Contact Number <span style="color:red;">*</span></label>
                                                        <input type="text"  wire:model="phone" class="form-control" required placeholder="Contact Number"  oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11);">
                                                        
                                                    </div>
                                                </div>
                                                <legend class="form-legend">Senior School information</legend>
                                                <div class="border border-secondary ">
                                                    <div class=" row px-4 py-2 col-lg-12">
                                                        <div class=" mb-3 col-lg-15">
                                                            <label for="high-school-name" class="form-label">Senior School Name <span style="color:red;">*</span></label>
                                                            
                                                            <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="High School Name" required>
                                                        </div>
                                                        <div class="col-lg-15 mb-3">
                                                            <label for="high-school-address" class="form-label">Senior School Address <span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" id="high-school-address" wire:model="ueb_shs_address" name="high_school_address" placeholder="High School Address" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="mb-2">
                                                <legend class="form-legend">Required Documents</legend>
                                                <div class="border border-secondary">
                                                    <div class="row px-4 py-2">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="graduation-certification" class="form-label">Formal Photo with name tag <span style="color:red;">*</span></label>
                                                            <i class="fa fa-info-circle info-icon" title='e.g. 2x2 with name tag'style="padding: 11px 0 0 5px;"></i>
                                                            <input type="file" class="form-control" wire:model="t_a_formal_photo" id="{{$t_a_formal_photo_id}}" name="graduation_certification" accept=".pdf,.jpg,.png,.jpeg" >
                                                        </div>
                                                        <div class="col-md-12 mb-2 ">
                                                            <label for="enrollment-certification" class="form-label">School Principal Certification  <span style="color:red;">*</span>
                                                                <i class="fa fa-info-circle info-icon" title='Certification from the school principal / registar that you are currently enrolled as Grade 12 Stundent'style="padding: 11px 0 0 5px;"></i>
                                                            </label>
                                                            <input type="file" class="form-control"  wire:model="t_a_school_principal_certification" id="{{$t_a_school_principal_certification_id}}" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                        </div>
                                                        @if($required_receipt_photo)
                                                        <div class="col-md-12 mb-2 ">
                                                            <label for="enrollment-certification" class="form-label">CET Payment Receipt  <span style="color:red;">*</span>
                                                                <i class="fa fa-info-circle info-icon" title='You have taken a cet previously hence you need to pay and upload the receipt photo here Thank you'style="padding: 11px 0 0 5px;"></i>
                                                            </label>
                                                            <input type="file" class="form-control"  wire:model="t_a_receipt_photo" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="row">
                                                <div class="col-md-6">            
                                                    <legend class="father form-legend">Father's Information</legend>
                                                    <div class="border border-secondary">
                                                    <div class="row px-3">
                                                        <div class="mother col-md-8 mb-3 mt-2">
                                                            <label for="mother-first-name" class="form-label">First Name <span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" wire:model="f_firstname" id="mother-first-name"  placeholder="First Name" required >
                                                        </div>
                                                        <div class="mother col-md-8 mb-3">
                                                            <label for="mother-middle-name" class="form-label">Middle Name </label>
                                                            <input type="text" class="form-control" wire:model="f_middlename" id="mother-middle-name" placeholder="Middle Name" >
                                                        </div>
                                                        <div class="father col-md-8 mb-3">
                                                            <label for="father-last-name" class="form-label">Last Name <span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" wire:model="f_lastname" id="father-last-name" placeholder="Last Name" required>
                                                        </div>
                                                        <div class="father col-md-8 mb-3">
                                                            <label for="father-last-name" class="form-label">Suffix</label>
                                                            <input type="text" class="form-control" wire:model="f_suffix" id="father-last-name" placeholder="Suffix" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <legend class="mother form-legend">Mother's Information</legend>
                                                <div class="border border-secondary">
                                                    <div class="mother col-md-8 mb-3 mt-2">
                                                        <label for="mother-first-name" class="form-label">First Name <span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control" wire:model="m_firstname" id="mother-first-name" placeholder="First Name" required>
                                                    </div>
                                                    <div class="mother col-md-8 mb-3">
                                                        <label for="mother-middle-name" class="form-label">Middle Name </label>
                                                        <input type="text" class="form-control" wire:model="m_middlename" id="mother-middle-name" placeholder="Middle Name" >
                                                    </div>
                                                    <div class="mother col-md-8 mb-3">
                                                        <label for="mother-last-name" class="form-label">Last Name <span style="color:red;">*</span></label>
                                                        <input type="text" class="form-control" wire:model="m_lastname" id="mother-last-name" placeholder="Last Name" required>
                                                    </div>
                                                    <div class="father col-md-8 mb-3">
                                                        <label for="father-last-name" class="form-label">Suffix</label>
                                                        <input type="text" class="form-control" wire:model="m_suffix" id="father-last-name" placeholder="Suffix" >
                                                    </div>
                                                </div>
                                            </div>
                                            <fieldset class="mb-2">
                                                <legend class="form-legend">Guardian's Information <i class="fa fa-info-circle info-icon" title='If applicable'style="padding: 11px 0 0 5px;"></i></legend>
                                                <div class="border border-secondary">
                                                    <div class="row px-4 py-2">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="first-name" class="form-label">First Name <span style="color:red;"></span></label>
                                                            <input type="text" class="form-control" wire:model="g_firstname" id="first-name" placeholder="First Name" >
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="middle-name" class="form-label">Middle Name</label>
                                                            <input type="text" class="form-control" wire:model="g_middlename" id="middle-name" placeholder="Middle Name" >
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="last-name" class="form-label">Last Name <span style="color:red;"></span></label>
                                                            <input type="text" class="form-control" wire:model="g_lastname" id="last-name" placeholder="Last Name" >
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="father-suffix" class="form-label">Suffix</label>
                                                            <input type="text" class="form-control" wire:model="g_suffix" id="father-suffix" aria-label="Father's Suffix" placeholder="Enter Suffix">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="middle-name" class="form-label">Relationship <span style="color:red;"></span></label>
                                                            <input type="text" class="form-control" wire:model="g_relationship" id="middle-name" placeholder="Relationship" >
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="submit-button mt-2" >Submit Application</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById("modalCloseButton").addEventListener("click", function() {
            window.location.href = "{{ route('student.application') }}"; 
        });
    </script>

</div>


