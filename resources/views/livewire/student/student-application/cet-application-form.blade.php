<div class="container border border-dark  mt-5 mb-5" id="cet-form">
    <form wire:submit.prevent="cet_application()">
        <div @if($page == 2) class="d-none"@endif>
            <div class="row ">
                <div class="col-sm  border-danger my-4 mx-2 d-flex align-items-center justify-content-center mx-5" style="height:300px;">
                    <span class="text-center text-danger"> <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo"></span>
                </div>
                <div class="col-sm  my-4 mx-2  text-center py-5 mx-5">
                    <p class="text-danger font-weight-bold">Western Mindanao State University <br> TESTING AND EVALUATION CENTER  <br> Zamboanga City</p>
                    <p class="text-danger font-weight-bold">WMSU-CET APPLICATION FORM  <br> For School Year {{(date("Y")+1).' - '.(date("Y")+2)}}</p>
                </div>
                <div class="col-sm text-center border border-danger  d-flex align-items-end justify-content-center mr-5 mt-3" style="height:310px;">
                    <div class="">
                            @if(isset($cet_form['t_a_formal_photo']))
                            <span class="text-center text-danger">
                                <img src="{{ $cet_form['t_a_formal_photo']->temporaryUrl() }}" width="250px" height="250px" style="object-fit: cover;">
                            </span>
                            @else
                            <div class="align-items-center justify-content-center">
                                <label for="formFile" class="form-label ">Upload 2x2 Image <br> With Name Tag</label>
                            </div>
                            @endif
                            <input class="forms-control" type="file" wire:model="cet_form.t_a_formal_photo"  id="t_a_formal_photo-{{$cet_form['t_a_formal_photo_id']}}" required>
                    </div>
                </div>
            </div> 
            <legend class="text-danger font-weight-bold">TO THE APPLICANTS:Forms with incomplete entries/requirements will not be processed</legend>
            <div class="container border border-4 w-80">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="first-name" class="form-label">First name </label>
                        <input type="text" class="form-control"  wire:model="user_details.user_firstname" name="first_name" placeholder="First name" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="last-name" class="form-label">Middle name</label>
                        <input type="text" class="form-control"   wire:model="user_details.user_middlename" name="last_name" placeholder="Middle name" >
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="last-name" class="form-label">Last name </label>
                        <input type="text" class="form-control"   wire:model="user_details.user_lastname" name="last_name" placeholder="Last name" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="last-name" class="form-label">Suffix</label>
                        <div class="col-lg-8">
                            <select wire:model="user_details.user_suffix" class="form-control">
                                @if(isset($user_details['user_suffix']) && strlen($user_details['user_suffix']>0))
                                    <option value="$user_details['user_suffix']">
                                @else
                                    <option value="">Select suffix</option>
                                @endif
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
                        <input type="date" class="form-control" wire:model="user_details.user_birthdate" name="birthdate">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="contact-number" class="form-label">Contact Number</label>
                        <input type="text"  wire:model="user_details.user_phone" class="form-control" required placeholder="Contact Number" >
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="contact-number" class="form-label">Age</label>
                        <input type="number"   wire:model="user_details.user_age" class="form-control" disabled placeholder="Age" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="contact-number" class="form-label">Email Address</label>
                        <input type="text" wire:model="user_details.user_email" class="form-control" disabled required placeholder="Email Address" >
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="contact-number" class="form-label">Citizenship </label>
                        <input type="text"  wire:model="user_details.user_citizenship" class="form-control" required placeholder="Citizenship" >
                    </div>
                </div>
            </div>
            <legend class="text-danger font-weight-bold">TYPE OF APPLICANT (CHECK ONE of the categories that applies to you):</legend>
            <select class="form-control form-select-lg mb-4" aria-label=".form-select-lg example" style="width: 380px; height: 50px; " wire:change="update_cet_type()" wire:model.defer="cet_form.t_a_cet_type_details">
                @foreach ($cet_type_data as $key=> $value)
                    <option value="{{$value->cet_type_details }}">{{$value->cet_type_details }}</option>
                @endforeach
            </select>
            @if($cet_form['t_a_cet_type_details'] == 'SENIOR HIGH SCHOOL GRADUATING STUDENT')
                <div>
                    <div class="form-check"> 
                        <label class="form-check-label">
                            <span class="text-danger font-weight-bold">SENIOR HIGH SCHOOL GRADUATING STUDENT</span>
                        </label>
                    </div>
                    <div class="container border border-4 w-80">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="first-name" class="form-label">Name Of School </label>
                                <input type="text" class="form-control" list="schools"  wire:model="cet_form.t_a_school_school_name"  placeholder="Name Of School" required>
                                    <datalist id="schools">
                                    @if($high_schools)
                                        @foreach($high_schools as $key =>$value)
                                        <option value="{{$value->high_school_name}}" >
                                        @endforeach
                                    @endif
                                </datalist>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="last-name" class="form-label">Expected Date of Graduation</label>
                                <input type="date" class="form-control"  wire:key="date" wire:model="cet_form.t_a_date_of_graduation" name="graduation_date" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="last-name" class="form-label">School Address </label>
                                <input type="text" class="form-control" wire:model="cet_form.t_a_school_address" name="last_name" placeholder="School Address " required>
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
                                        <input type="file" class="form-controls"  wire:model="cet_form.t_a_school_principal_certification" id="t_a_school_principal_certification-{{$cet_form['t_a_school_principal_certification_id']}}" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            @elseif($cet_form['t_a_cet_type_details'] == 'SENIOR HIGH SCHOOL GRADUATE')
                <div>
                    <div class="form-check"> 
                        <label class="form-check-label">
                            <span class="text-danger font-weight-bold">SENIOR HIGH SCHOOL GRADUATE who has not enrolled in college</span>
                        </label>
                    </div>
                    <div class="container border border-4 w-80">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="first-name" class="form-label">From what School </label>
                                <input type="text" class="form-control" list="school" id="first-name" wire:model="cet_form.t_a_school_school_name" name="first_name" placeholder="Name Of School" required>
                                    <datalist id="school">
                                    @if($high_schools)
                                        @foreach($high_schools as $key =>$value)
                                        <option value="{{$value->high_school_name}}" >
                                        @endforeach
                                    @endif
                                </datalist>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="last-name" class="form-label"> Date/Year Graduated</label>
                                <input type="date" class="form-control"  wire:key="date" wire:model="cet_form.t_a_date_of_graduation" name="graduation_date" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="last-name" class="form-label">School Address</label>
                                <input type="text" class="form-control" id="last-name"  wire:model="cet_form.t_a_school_address" name="last_name" placeholder="School Address " required>
                            </div>
                        </div>
                        <fieldset class="mb-2">
                            <legend class="form-legend">Required Documents</legend>
                            <div class="border border-secondary">
                                <div class="row px-4 py-2">
                                    
                                    <div class="col-md-12 mb-2 ">
                                        <label for="senior-card-original">Original Senior High School Card</label>
                                            <i class="fa fa-info-circle info-icon" title='Original senior high school card'style="padding: 11px 0 0 5px;"></i>
                                        
                                        <input type="file" class="forms-control" wire:model="cet_form.t_a_original_senior_high_school_card"  id="t_a_original_senior_high_school_card-{{$cet_form['t_a_original_senior_high_school_card_id']}}"  name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                    </div>
                                    @if( $cet_form['t_a_times_taken']== 1)
                                    <div class="col-md-12 mb-2 ">
                                        <label for="enrollment-certification" class="form-label">CET Payment Receipt  <span style="color:red;">*</span>
                                            <i class="fa fa-info-circle info-icon" title='You have taken a cet previously hence you need to pay and upload the receipt photo here Thank you'style="padding: 11px 0 0 5px;"></i>
                                        </label>
                                        <input type="file" class="form-controls" wire:model="cet_form.t_a_receipt_photo"  id="t_a_receipt_photo-{{$cet_form['t_a_receipt_photo_id']}}" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            @elseif($cet_form['t_a_cet_type_details'] == 'SHIFTEE / TRANSFEREE STUDENT')
                <div>
                    <div class="form-check"> 
                        <label class="form-check-label">
                            <span class="text-danger font-weight-bold">SHIFTEE / TRANSFEREE STUDENT</span>
                        </label>
                    </div>
                    <div class="container border border-4 w-80">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="first-name" class="form-label">School enrolled in/last attended</label>
                                <input type="text" class="form-control" list="school" id="first-name" wire:model="cet_form.t_a_school_school_name" name="first_name" placeholder="Name Of School" required>
                                    <datalist id="school">
                                    @if($high_schools)
                                        @foreach($high_schools as $key =>$value)
                                        <option value="{{$value->high_school_name}}" >
                                        @endforeach
                                    @endif
                                </datalist>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="last-name" class="form-label">Course</label>
                                <input type="text" class="form-control" id="last-name"  wire:key="date" wire:model="cet_form.t_a_course" name="last_name" placeholder="Course" required >
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="last-name" class="form-label">School Address </label>
                                <input type="text" class="form-control" id="last-name"  wire:model="cet_form.t_a_school_address" name="last_name" placeholder="School Address " required>
                            </div>
                        </div>
                        <fieldset class="mb-2">
                            <legend class="form-legend">Required Documents</legend>
                            <div class="border border-secondary">
                                <div class="row px-4 py-2">
                                    
                                    <div class="col-md-6 mb-2 ">
                                        <label for="senior-card-original">Transcript of Records ( TOR ) <span style="color:red;">*</span></label>
                                        <i class="fa fa-info-circle info-icon" title='Transcript of records from registrar'style="padding: 11px 0 0 5px;"></i>
                                        <input type="file" class="forms-control" wire:model="cet_form.t_a_transcript_of_records"  id="t_a_transcript_of_records-{{$cet_form['t_a_transcript_of_records_id']}}" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                    </div>
                                    <div class="col-md-6 mb-2 ">
                                        <label for="barangay-clearance">Endorsement letter from WMSU Dean <span style="color:red;">*</span></label>
                                        <i class="fa fa-info-circle info-icon" title='Transcript of records from registrar'style="padding: 11px 0 0 5px;"></i>
                                        <input type="file" class="forms-control"  wire:model="cet_form.t_a_endorsement_letter_from_wmsu_dean"  id="t_a_endorsement_letter_from_wmsu_dean-{{$cet_form['t_a_endorsement_letter_from_wmsu_dean_id']}}" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                    </div>
                                    <div class="col-md-12 mb-2 ">
                                        <label for="enrollment-certification" class="form-label">CET Payment Receipt  <span style="color:red;">*</span>
                                            <i class="fa fa-info-circle info-icon" title='You have taken a cet previously hence you need to pay and upload the receipt photo here Thank you'style="padding: 11px 0 0 5px;"></i>
                                        </label>
                                        <input type="file" class="form-controls" wire:model="cet_form.t_a_receipt_photo"  id="t_a_receipt_photo-{{$cet_form['t_a_receipt_photo_id']}}" name="enrollment_certification" accept=".pdf,.jpg,.png,.jpeg" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            @endif
            <div align="end" class="py-4">
                <button type="submit" style="width: 100px;" class="btn btn-primary">Next</a>
            </div>
        </div>
        <div @if($page == 1) class="d-none" @endif> 
            <div class="container border border-4 w-80" >
                <div class="text-danger font-weight-bold"> Course to take up:(Choose from the list of WMSU Campuses and Undergraduate degree programs/courses offered by WMSU posted in your school's bulletin board.)</div>
                    <div class="row px-2 py-3">
                        <div class="col-md-4">
                            <select class="form-control form-select-lg mb-4" aria-label=".form-select-lg example" style="width: 380px; height: 50px;" wire:model="cet_form.t_a_1st_choice" required>
                                <option value="0" selected>1st Choice</option>
                                @foreach($course_data as $key => $value)
                                    @if($cet_form['t_a_2nd_choice'] == $value->department_id || $cet_form['t_a_3rd_choice'] == $value->department_id)
                                    @else
                                    <option value="{{$value->department_id}}">{{$value->department_name.' - '.$value->campus_name}}</option>
                                    @endif
                                @endforeach    
                            
                            </select>

                            <select class="form-control form-select-lg mb-4" aria-label=".form-select-lg example" style="width: 380px; height: 50px; " wire:model="cet_form.t_a_3rd_choice" required>
                                <option value="0" selected>3rd Choice</option>
                                @foreach($course_data as $key => $value)
                                    @if($cet_form['t_a_1st_choice'] == $value->department_id || $cet_form['t_a_2nd_choice'] == $value->department_id)
                                    @else
                                    <option value="{{$value->department_id}}">{{$value->department_name.' - '.$value->campus_name}}</option>
                                    @endif
                                @endforeach   
                            </select>
                        </div>
                        <div class="col-md-4">           
                            <select class="form-control form-select-lg mb-4" aria-label=".form-select-lg example" style="width: 380px; height: 50px; margin-left: 50px;" wire:model="cet_form.t_a_2nd_choice"required>
                                <option value="0" selected>2nd Choice</option>
                                @foreach($course_data as $key => $value)
                                    @if($cet_form['t_a_1st_choice'] == $value->department_id || $cet_form['t_a_3rd_choice'] == $value->department_id)
                                    @else
                                    <option value="{{$value->department_id}}">{{$value->department_name.' - '.$value->campus_name}}</option>
                                    @endif
                                @endforeach    
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-danger font-weight-bold">Socio Economic Data: Furnish all required information. Under Column "Highest Education Finished" indicate the educational level actually completed (eg. Grade III, Third Year high school, High School Gradute, Second Year, College Graduate,etc) </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Parents</th>
                                <th scope="col">Citizenship</th>
                                <th scope="col">Highest Education Finished</th>
                                <th scope="col">Work/Occupation</th>
                                <th scope="col">Employer/Place of Work</th>
                                <th scope="col">Monthly Income/Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Father</th>
                                <td>
                                    <input type="text"  wire:model="cet_form.t_a_f_citizenship" class="form-control"  placeholder="Citizenship" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="cet_form.t_a_f_hef" name="high_school_name" placeholder="Highest Education Finished"  >
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="cet_form.t_a_f_occupation" name="high_school_name" placeholder="Work/Occupation" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="cet_form.t_a_f_place_of_work" name="high_school_name" placeholder="Employer/Place of Work" >
                                </td>
                                <td>
                                    <select class="form-control" aria-label="Default select example" style="width: 180px; height: 50px;" wire:model="cet_form.t_a_f_monthly_salary">
                                        <option value="N/A" selected>Select</option>
                                        <option value="Below ₱5,000">Below ₱5,000</option>
                                        <option value="₱5,000 - ₱15,000">₱5,000 - ₱15,000</option>
                                        <option value="₱15,000 - ₱20,000">₱15,000 - ₱20,000 </option>
                                        <option value="Above ₱20,000">Above ₱20,000 </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Mother</th>
                                <td>
                                    <input type="text"  wire:model="cet_form.t_a_m_citizenship" class="form-control" placeholder="Citizenship" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="cet_form.t_a_m_hef" name="high_school_name" placeholder="Highest Education Finished" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="cet_form.t_a_m_occupation" name="high_school_name" placeholder="Work/Occupation" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="cet_form.t_a_m_place_of_work" name="high_school_name" placeholder="Employer/Place of Work" >
                                </td>
                                <td>
                                    <select class="form-control" aria-label="Default select example" style="width: 180px; height: 50px;" wire:model="cet_form.t_a_m_monthly_salary">
                                        <option value="N/A" selected>Select</option>
                                        <option value="Below ₱5,000">Below ₱5,000</option>
                                        <option value="₱5,000 - ₱15,000">₱5,000 - ₱15,000</option>
                                        <option value="₱15,000 - ₱20,000">₱15,000 - ₱20,000 </option>
                                        <option value="Above ₱20,000">Above ₱20,000 </option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-danger font-weight-bold">
                        <p style="display: inline;">Do you know how to use a computer?</p>
                        <input type="radio" wire:model="cet_form.t_a_computer_literate" value="1" id="checkbox1"> <label for="checkbox1">Yes</label>
                        <input type="radio" wire:model="cet_form.t_a_computer_literate" value="0" id="checkbox1"> <label for="checkbox1">No</label>
                    </div>
                    <div class="text-danger font-weight-bold">
                        <p class="d-inline-block mr-3">Are you a member of a Cultural/Ethnic group? if yes, please check any one below</p>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Badjao" type="radio"  >
                            <label class="form-check-label mr-3" for="checkbox3">Badjao</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Kalibugan" type="radio">
                            <label class="form-check-label mr-3" for="checkbox4">Kalibugan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Maranaw" type="radio">
                            <label class="form-check-label mr-3" for="checkbox5">Maranaw</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Subanen" type="radio" >
                            <label class="form-check-label mr-3" for="checkbox6">Subanen</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Yakan" type="radio" >
                            <label class="form-check-label mr-3" for="checkbox7">Yakan</label>
                        </div>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Bagobo" type="radio" >
                            <label class="form-check-label mr-3" for="checkbox8">Bagobo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Maguindanao" type="radio" >
                            <label class="form-check-label mr-3" for="checkbox9">Maguindanao</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Samal" type="radio" >
                            <label class="form-check-label mr-3" for="checkbox10">Samal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Tausug" type="radio" >
                            <label class="form-check-label mr-3" for="checkbox11">Tausug</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="" type="radio" id="checkbox12">
                            <input type="text" class="form-control" wire:model="cet_form.t_a_ethnic_group" name="high_school_name" placeholder="Others Specify">
                        </div>
                    </div>
                    <div  class="text-danger font-weight-bold mt-2">
                        <p class="mb-1" >Religous affiliation </p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Protestant" wire:model="cet_form.t_a_religious_affiliation">
                            <label class="form-check-label mr-3" for="checkbox10">Protestant</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Islam" wire:model="cet_form.t_a_religious_affiliation">
                            <label class="form-check-label mr-3" for="checkbox11">Islam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Roman Catholic" wire:model="cet_form.t_a_religious_affiliation">
                            <label class="form-check-label mr-3" for="checkbox11">Roman Catholic</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="" wire:model="cet_form.t_a_religious_affiliation">
                            <input type="text" class="form-control"  wire:model="cet_form.t_a_religious_affiliation" name="high_school_name" placeholder="Others Specify" >
                        </div>
                    </div>
                    <div class="container border border-danger mt-5 rounded">
                        <div class="form-check form-check-inline">
                            <p class="text-danger mt-2"> 
                                <input class="form-check-input" wire:model="cet_form.t_a_accept" value="1" type="checkbox" id="checkbox11"> 
                                <label class="form-check-label mr-3" for="checkbox11">Accept</label>
                                I herby accept that i have read and understood all the instructions in connection with my application for the WMSU-CET. I further accept that all information supplied herein and the supporting documents attached are true and correct if found otherwise, my exam shall be considered null and void. I also allow WMSU-TECT to process and store the data i have provided in this form in accordance with the provision of the Data Privacy Act of 2012</p>
                        </div>
                        
                    </div>
                    <div>
                        <p class="text-danger mt-5">Only prospective freshmen will be allowed to take the WMSU CET schedule for November 2023. Transferess Should join in the Febraruary 2024 exam.</p>
                    </div>
                        <div>
                            <Span class="text-danger font-weight-bold">IMPORTANT</Span>
                            <p class="text-danger">1. An Applicant can take  the WMSU-CET for S.Y 2024-2025, <span class="text-danger font-weight-bold text-decoration-underline" >ONLY ONCE,</span>wheter in the Main Campus or any other test Venue</p>
                            <p class="text-danger">For further inquries, Call WMSU-Testing and Evaluation Center at 09066131868 or email at tec@wmsu.edu.ph</p>
                        </div>
                        <div class="text-center" >
                            <legend class="text-danger font-weight-bold">REMINDERS</legend>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-md-6 text-danger">a. You must be at the test venue <span class="text-danger font-weight-bold">30 minutes before the test time </span><br>b. Bring your Test Permit and one (1) short-sized transparent plastic envelope with the following materials inside: 
                                <ul>
                                    <li>At least 2 Mongol No.2 pencils </li>
                                    <li>Sharpener </li>
                                    <li>Eraser of good quality </li>
                                </ul> c. For your Snacks, you are only allowed to bring water, biscuits and candies.
                            </div>
                            <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0 text-danger mb-5 px-2">d. Mobile Phones, calculators, smart watches, cameras and other eletronic gadgets are not ALLOWED during the test. <br> e. Observer proper dress code when you are in the test venue. Slippers, shorts, sleeveless shirts and blouses, jackets/sweatshirts and hats/caps are NOT allowed. <br> <span class="text-danger font-weight-bold">f. Present this Test Permit when claiming results.</span>
                            </div>
                        </div>
                
                <div class="d-flex justify-content-between mb-3 py-4">
                    <div class="p-2 "><button type="button" class="btn btn-danger" wire:click="page(1)">Back</button></div>
                
                    <div class="p-2 "><button type="submit" class="btn btn-primary">Submit Application</button></div>
                </div>     
            </div>
        </div>
    </form>
</div>
                                                
                                              