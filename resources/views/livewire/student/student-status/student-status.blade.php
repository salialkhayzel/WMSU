<div>
    <!-- Status Tab Content -->
    <script src="https://cdn.jsdelivr.net/npm/jspdf@1.5.3/dist/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <div role="tabpanel" class="tab-pane" id="status">
        <section class="application-status-section">
            <div class="container">
                <h2 class="section-title mt-2 font-weight-bold">Application Status</h2>
                <table class="table table-bordered">
                    <thead style="background-color: #990000; color: white; position: sticky; top: 0;">
                        <tr>
                            <th>#</th>
                            <th>Application Code</th>
                            <th>Exam Type</th>
                            <th class=" text-center align-middle">Description</th>
                            <th class="text-center align-middle">Date</th>
                            <th class="text-center align-middle">Status</th>
                            <th class="text-center align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($application_details as $item => $value)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $value->applied_date.'-'.$value->t_a_id }}</td>
                            <td>{{ $value->test_type_name }}</td>
                            <td>{{ $value->test_type_details }}</td>
                            <td>{{date_format(date_create( $value->applied_date),"F d, Y ")}} </td>
                            <td>{{ $value->test_status_details }}</td>
                            <td class="text-center align-middle" > 
                                <button id="modifyButtonDetails" wire:click="view_application({{$value->t_a_id}})" class="btn btn-primary " >
                                    <i class="fas fa-eye"></i>
                                    View
                                </button>
                            @if( $value->test_status_details == 'Pending')
                                <button id="modifyButtonDetails" wire:click="cancel_application({{$value->t_a_id}})" class="btn btn-danger " >
                                    <i class="fas fa-xmark"></i>
                                    Cancel
                                </button>
                            @endif
                            @if( $value->test_status_details == 'Accepted')
                                <button id="modifyButtonDetails" wire:click="exam_permit({{$value->t_a_id}})" class="btn btn-primary " >
                                    <i class="fas fa-eye"></i>
                                    View Permit
                                </button>
                                <br>
                            @endif
                            
                            </td>
                            
                            </tr>                            
                        @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                NO RECORDS 
                                <br>
                                <a  href="{{ route('student.application') }} "> 
                                <button type="button" class="btn btn-success " style="width: 70px;">Apply</button>
                                </a>
                            </td>
                        @endforelse
                        <!-- Add more rows for additional exam applications -->
                    </tbody>
                </table>
                <!-- Pagination for Application Status Table -->
                <div class="pagination">
                    <button class="btn btn-danger">Previous</button>
                    <button class="btn btn-primary">Next</button>
                </div>
                <br>
                <hr>


                <h2 class="section-title font-weight-bold">Exam History</h2>
                <table class="table table-bordered">
                    <thead style="background-color: #990000; color: white; position: sticky; top: 0;">
                        <tr>
                        <th>#</th>
                            <th class="text-center align-middle">Exam Type</th>
                            <th class="text-center align-middle">Description</th>
                            <th class="text-center align-middle">Date</th>
                            <th class="text-center align-middle">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($application_history as $item => $value)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td class="text-center align-middle">{{ $value->test_type_name }}</td>
                            <td>{{ $value->test_type_details }}</td>
                            <td class="text-center align-middle">{{date_format(date_create( $value->applied_date),"F d, Y ")}} </td>
                            <td class="text-center align-middle">{{ $value->test_status_details }}</td>
                        <tr>                    
                    @empty
                        <td class="text-center font-weight-bold" colspan="42">
                            NO RECORDS 
                            <br>
                            <a  href="{{ route('student.application') }} "> 
                                <button class="btn btn-warning"> Apply</button>
                            </a>
                        </td>
                    @endforelse
                   
                        <!-- Add more exam history rows as needed -->
                    </tbody>
                </table>
                <!-- Pagination for Application Status Table -->
                <div class="pagination">
                    <button class="btn btn-danger">Previous</button>
                    <button class="btn btn-primary">Next</button>
                </div>
            </div>

            <!--  MODAL Cancel-->
            <div class="modal fade" id="confirm_cancel_modal" tabindex="-1" role="dialog" aria-labelledby="confirm_cancel_modalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabelDetails">Application Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <!-- Full Name -->
                                @if($application['t_a_id'])
                                <form wire:submit.prevent="confirm_cancel({{$application['t_a_id']}})">

                                    <p> {{'Are you sure you want to cancel "'.$application['test_type_details']. '" that you applied on '. date_format(date_create( $application['applied_date']),"F d, Y ") }}</p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EXAM permit Modal -->
            <div class="modal fade" id="ExamPermitModal" tabindex="-1" role="dialog" aria-labelledby="ExamPermitModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="max-width: 80%; margin: 1.60rem auto;">
                    <div class="modal-content">
                        <div class="modal-body" id="to_print">
                          <div>
                            <div>
                                <section class="layout d-flex" style="justify-content: center; margin: right -100px;">
                                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo" style="height: 130px; margin-left: -130px;">
                                        <div class="text-danger" style="text-align: center;">
                                            <h4 >Western Mindanao State University</h4>
                                            <h5>Testing And Evaluation Center</h5>
                                            <h6>Normal Road, Baliwasa, Zamboanga City</h6>  
                                            <p class="text-danger font-weight-bold">WMSU-CET APPLICATION PERMIT  <br>  School Year {{(date("Y")+1).' - '.(date("Y")+2)}}</p>
                                        </div> 
                                    <img src="{{ asset('images/logo/tec.png') }}" alt="Logo" class="form-logo" style="height: 130px; margin-right: -130px;">
                                </section>
                                @if(isset($view_permit))
                                    <div style="text-align: center;" >
                                        <div >
                                            <!-- <legend>EXAM PERMIT</legend> -->
                                            <h3>{{$view_permit[0]->user_lastname.', '.$view_permit[0]->user_firstname.' '.$view_permit[0]->user_middlename}}</h3>
                                            <p style="font-size: 15px; margin-bottom: 5px;">{{$view_permit[0]->t_a_school_school_name}}</p>
                                    
                                        </div> 
                                        <table class="table border border-danger mt-2">
                                            <thead class="text-danger ">
                                                <tr>
                                                <th scope="col" class="table-text border border-danger" >Test Date</th>
                                                <th scope="col"class="table-text border border-danger" >Test Center</th>
                                                <th scope="col"class="table-text border border-danger" >Room No.</th>
                                                <th scope="col"class="table-tex border border-danger">Test Time</th>
                                                <th scope="col"class="table-text border border-danger" >Test Center Code</th>
                                                <th scope="col"class="table-text border border-danger" >High School Code</th>
                                                <!-- <th class="table-text" >High School Code</th> -->
                                                </tr>
                                            </thead>
                                            <tbody class="border border-danger">
                                                <tr>
                                                    <td scope="col"class="table-text border border-danger">{{date_format(date_create($view_permit[0]->test_date), "F d, Y ")}}</td>
                                                    <td scope="col"class="table-text border border-danger">{{$view_permit[0]->test_center_name}}</td>
                                                    <td scope="col"class="table-text border border-danger">{{ $view_permit[0]->school_room_id.' - '.$view_permit[0]->school_room_name }}</td>
                                                    <td scope="col"class="table-text border border-danger">@if($view_permit[0]->t_a_ampm == 'AM'){{ $view_permit[0]->am_start.' - '.$view_permit[0]->am_end }}@else {{$view_permit[0]->pm_start.' - '.$view_permit[0]->pm_end }} @endif</td>
                                                    <td scope="col"class="table-text border border-danger">{{$view_permit[0]->test_center_code }}</td>
                                                    <td scope="col"class="table-text border border-danger">{{$view_permit[0]->high_school_code.' - '.$view_permit[0]->high_school_name }}</td> 
                                                    <!-- <td>{{$view_permit[0]->test_center_code}}</td> -->
                                                </tr>
                                                <tr>  
                                            </tbody>
                                        </table>
                                        <div class="bottom-content mt-2">
                                            <div class="image-container-left  border border-danger rounded float-left">
                                                <img src=" {{$qrcode}}" alt="" width="250" height="250">
                                                <!-- <img src="http://wmsutec/images/logo/qr.png" alt="Logo" class="form-logo"> -->
                                            </div>
                                            <div class="image-container-right border border-danger float-right">
                                                <img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_permit[0]->t_a_formal_photo)}}" alt="" style="object-fit: cover;"width="250" height="250">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{$qrcode}}" download="qr-code.png" class="btn btn-success text-white me-2">
                                <span class="bi bi-download">&nbsp;&nbsp;Download QR</span>
                            </a>
                            <button class="btn btn-success" onclick="print_this('to_print')" >Print</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="view_application_modal_2" tabindex="-1" role="dialog" aria-labelledby="view_application_modalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-lg modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabelDetails">Application Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Full Name -->
                            <form wire:submit.prevent="confirm_cancel({{$t_a_id}})">
                                @if($view_details)
                                    <!--  check what type and display that -->
                                    <div class="col-lg-12">
                                        <div class="border border-dark pt-3" >
                                            <div class="container">
                                                <div class="header-eat " style="background:#990000;">
                                                    <div class="text-center py-3" style="color:#fff;">
                                                        <img src="{{ asset('images/logo/logo.png') }}" width="120" alt="Logo" class="mx-auto" >
                                                        <br>
                                                        <span>Western Mindanao State University</span>
                                                        <h2 class="mb-2">College Entrance Exam Application Form</h2>
                                                        
                                                        @if($view_details[0]->cet_type_name == 'shs_under_grad')
                                                            <span class="mb-2 custom-class">Senior Highschool Graduating Student Form</span>
                                                        @elseif($view_details[0]->cet_type_name == 'shs_grad')
                                                            <span class="mb-2 custom-class">Senior Highschool Graduate Form</span>
                                                        @elseif($view_details[0]->cet_type_name == 'shiftee/tranferee')
                                                            <span class="mb-2 custom-class">College Shiftee/Transferee Form</span>
                                                        @endif
                                                    </div>
                                                                                                        
                                                </div>
                                                <div class="container4">
                                                    <div class="form-container">
                                                        <form wire:submit.prevent="submit_application()">
                                                            <fieldset class="my-3">
                                                                <legend class="form-legend">Applicant information</legend>
                                                                <div class="border border-secondary mb-3">
                                                                    <div class=" row px-4 py-2 col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 mb-2">
                                                                                <label for="first-name" class="form-label">First name <span style="color:red;">*</span></label>
                                                                                <input disabled type="text" class="form-control" id="first-name" wire:model="view_details.0.user_firstname" name="first_name" placeholder="First name" >
                                                                            </div>
                                                                            <div class="col-lg-6 mb-2">
                                                                                <label for="last-name" class="form-label">Middle name</label>
                                                                                <input disabled type="text" class="form-control" id="last-name"  wire:model="view_details.0.user_middlename" name="last_name" placeholder="Middle name" >
                                                                            </div>
                                                                            <div class="col-lg-6 mb-2">
                                                                                <label for="last-name" class="form-label">Last name <span style="color:red;">*</span></label>
                                                                                <input disabled type="text" class="form-control" id="last-name"  wire:model="view_details.0.user_lastname" name="last_name" placeholder="Last name" ]>
                                                                            </div>
                                                                            <div class="col-lg-6 mb-2">
                                                                                <label for="last-name" class="form-label">Suffix</label>
                                                                                <input disabled type="text" class="form-control" id="last-name"  wire:model="view_details.0.user_suffix" name="last_name" placeholder="Suffix" >
                                                                            </div>
                                                                        
                                                                            <div class="col-lg-6 col-md-12 mb-2">
                                                                                <label for="email" class="form-label">Email <span style="color:red;">*</span></label>
                                                                                <input disabled type="email" class="form-control" id="email"  wire:model="view_details.0.user_email" name="email" placeholder="Email" ] disabled>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12 mb-2">
                                                                                <label for="contact-number" class="form-label">Contact Number <span style="color:red;">*</span></label>
                                                                                <input disabled type="text"  wire:model="view_details.0.user_phone" class="form-control" ] placeholder="Contact Number"  oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11);">
                                                                                
                                                                            </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="my-3">
                                                                <legend class="form-legend">Senior School information</legend>
                                                                <div class="border border-secondary mb-3">
                                                                    <div class=" row px-3 py-2 col-lg-12">
                                                                        <div class="col-lg-6 col-md-12 mb-2">
                                                                            <label for="high-school-name" class="form-label">Senior School Name <span style="color:red;">*</span></label>
                                                                            
                                                                            <input disabled type="text" class="form-control"  wire:model="view_details.0.t_a_school_school_name" name="high_school_name" placeholder="High School Name" ]>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12 mb-2">
                                                                            <label for="high-school-address" class="form-label">Senior School Address <span style="color:red;">*</span></label>
                                                                            <input disabled type="text" class="form-control" wire:model="view_details.0.t_a_school_address" name="high_school_address" placeholder="High School Address" ]>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            @if($view_details[0]->cet_type_name == 'shs_under_grad')
                                                            <fieldset class="mb-2">
                                                                <legend class="form-legend">Required Documents</legend>
                                                                <div class="border border-secondary">
                                                                    <label for="graduation-certification" class="form-label">Formal Photo with name tag <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_details[0]->t_a_formal_photo)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_details[0]->t_a_formal_photo)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    <br>
                                                                    <label for="enrollment-certification" class="form-label">School Principal Certification <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_school_principal_certification/'.$view_details[0]->t_a_school_principal_certification)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_school_principal_certification/'.$view_details[0]->t_a_school_principal_certification)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    <br>
                                                                    @if((strlen($view_details[0]->t_a_receipt_photo)>0))
                                                                    <label for="barangay-clearance">CET Payment Receipt  <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_receipt_photo/'.$view_details[0]->t_a_receipt_photo)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_receipt_photo/'.$view_details[0]->t_a_receipt_photo)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </fieldset>
                                                            @elseif($view_details[0]->cet_type_name == 'shs_grad')
                                                            <fieldset class="mb-2">
                                                                <legend class="form-legend">Required Documents</legend>
                                                                <div class="border border-secondary">
                                                                    <label for="graduation-certification" class="form-label">Formal Photo with name tag <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_details[0]->t_a_formal_photo)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_details[0]->t_a_formal_photo)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    <br>
                                                                    <label for="senior-card-original">Original Senior High School Card</label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_original_senior_high_school_card/'.$view_details[0]->t_a_original_senior_high_school_card)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_original_senior_high_school_card/'.$view_details[0]->t_a_original_senior_high_school_card)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    <br>
                                                                    @if((strlen($view_details[0]->t_a_receipt_photo)>0))
                                                                    <label for="barangay-clearance">CET Payment Receipt  <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_receipt_photo/'.$view_details[0]->t_a_receipt_photo)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_receipt_photo/'.$view_details[0]->t_a_receipt_photo)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </fieldset>
                                                            @elseif($view_details[0]->cet_type_name == 'shiftee/tranferee')
                                                            <fieldset class="mb-2">
                                                                <legend class="form-legend">Required Documents</legend>
                                                                <div class="border border-secondary">
                                                                    <label for="graduation-certification" class="form-label">Formal Photo with name tag <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_details[0]->t_a_formal_photo)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_details[0]->t_a_formal_photo)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    <br>
                                                                    <label for="senior-card-original">Transcript of Records ( TOR ) <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_transcript_of_records/'.$view_details[0]->t_a_transcript_of_records)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_transcript_of_records/'.$view_details[0]->t_a_transcript_of_records)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    <br>
                                                                    <label for="barangay-clearance">WMSU Dean endorsement letter <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_endorsement_letter_from_wmsu_dean/'.$view_details[0]->t_a_endorsement_letter_from_wmsu_dean)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_endorsement_letter_from_wmsu_dean/'.$view_details[0]->t_a_endorsement_letter_from_wmsu_dean)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    <br>
                                                                    @if((strlen($view_details[0]->t_a_receipt_photo)>0))
                                                                    <label for="barangay-clearance">CET Payment Receipt  <span style="color:red;">*</span></label>
                                                                    <div>
                                                                        <a target="blank"href="{{asset('storage/application-requirements/t_a_receipt_photo/'.$view_details[0]->t_a_receipt_photo)}}" >
                                                                            <img src="{{asset('storage/application-requirements/t_a_receipt_photo/'.$view_details[0]->t_a_receipt_photo)}}" height="300" alt="Logo"  >
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                </div> 
                                                            </fieldset>
                                                            @endif
                                                            <div class="row">
                                                                <div class="col-lg-6">            
                                                                    <legend class="father form-legend">Father's Information</legend>
                                                                    <div class="border border-secondary">
                                                                        <div class="row px-3">
                                                                            <div class="mother col-lg-12 mb-3 mt-2">
                                                                                <label for="mother-first-name" class="form-label">First Name <span style="color:red;">*</span></label>
                                                                                <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_f_firstname" name="high_school_address" placeholder="First Name"  >
                                                                            </div>
                                                                            <div class="mother col-lg-12 mb-3">
                                                                                <label for="mother-middle-name" class="form-label">Middle Name </label>
                                                                                <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_f_firstname" name="high_school_address"placeholder="Middle Name" >
                                                                            </div>
                                                                            <div class="father col-lg-12 mb-3">
                                                                                <label for="father-last-name" class="form-label">Last Name <span style="color:red;">*</span></label>
                                                                                <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_f_firstname" name="high_school_address" >
                                                                            </div>
                                                                            <div class="father col-lg-12 mb-3">
                                                                                <label for="father-last-name" class="form-label">Suffix</label>
                                                                                <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_f_firstname" name="high_school_address" placeholder="Suffix" >
                                                                            </div>
                                                                        </div>
                                                                        
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <legend class="mother form-legend">Mother's Information</legend>
                                                                <div class="border border-secondary">
                                                                    <div class="mother col-lg-12 mb-3 mt-2">
                                                                        <label for="mother-first-name" class="form-label">First Name <span style="color:red;">*</span></label>
                                                                        <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_m_firstname" placeholder="First Name" >
                                                                    </div>
                                                                    <div class="mother col-lg-12 mb-3">
                                                                        <label for="mother-middle-name" class="form-label">Middle Name </label>
                                                                        <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_m_firstname" placeholder="Middle Name" >
                                                                    </div>
                                                                    <div class="mother col-lg-12 mb-3">
                                                                        <label for="mother-last-name" class="form-label">Last Name <span style="color:red;">*</span></label>
                                                                        <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_m_firstname" placeholder="Last Name" >
                                                                    </div>
                                                                    <div class="father col-lg-12 mb-3">
                                                                        <label for="father-last-name" class="form-label">Suffix</label>
                                                                        <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_m_firstname" id="father-last-name" placeholder="Suffix" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <legend class="form-legend">Guardian's Information <i class="fa fa-info-circle info-icon" title='If applicable'style="padding: 11px 0 0 5px;"></i></legend>
                                                                <div class="border border-secondary mb-3">
                                                                    <div class="row px-3">
                                                                        <div class="col-lg-6 col-md-12  mb-3">
                                                                            <label for="first-name" class="form-label">First Name <span style="color:red;"></span></label>
                                                                            <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_g_firstname" placeholder="First Name" >
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12 mb-3">
                                                                            <label for="middle-name" class="form-label">Middle Name</label>
                                                                            <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_g_firstname" placeholder="Middle Name" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="row md-12 px-3">
                                                                        <div class="col-lg-6 col-md-12 mb-3">
                                                                            <label for="last-name" class="form-label">Last Name <span style="color:red;"></span></label>
                                                                            <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_g_firstname" placeholder="Last Name" >
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12 mb-3">
                                                                            <label for="father-suffix" class="form-label">Suffix</label>
                                                                            <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_g_firstname" aria-label="Father's Suffix" placeholder="Enter Suffix">
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 mb-3 ">
                                                                            <label for="middle-name" class="form-label">Relationship <span style="color:red;"></span></label>
                                                                            <input disabled type="text" class="form-control" wire:model="view_details.0.family_background_g_relationship" id="middle-name" placeholder="Relationship" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>                                        
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="view_application_modal" tabindex="-1" role="dialog" aria-labelledby="view_application_modalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-xl modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabelDetails">Application Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container border border-dark  mt-5 mb-5" id="cet-form">
                                <form wire:submit.prevent="cet_application()">
                                    <div @if($page == 2) class="d-none"@endif>
                                        <div class="row ">
                                            <div class="col-sm  border-danger my-4 mx-2 d-flex align-items-center justify-content-center mx-5" style="height:300px;">
                                                <span class="text-center text-danger"> 
                                                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo">
                                                </span>
                                            </div>
                                            <div class="col-sm  my-4 mx-2  text-center py-5 mx-5">
                                                <p class="text-danger font-weight-bold">Western Mindanao State University <br> TESTING AND EVALUATION CENTER  <br> Zamboanga City</p>
                                                <p class="text-danger font-weight-bold">WMSU-CET APPLICATION FORM  <br>  School Year {{(date("Y")+1).' - '.(date("Y")+2)}}</p>
                                            </div>
                                            <div class="col-sm text-center border border-danger  d-flex align-items-end justify-content-center mr-5 mt-3" style="height:252px;width:252px;">
                                                <div class="">
                                                     <a target="blank"href="{{asset('storage/application-requirements/t_a_formal_photo/'.$cet_form['t_a_formal_photo'])}}" >
                                                        <img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$cet_form['t_a_formal_photo'])}}"width="250px" height="250px" style="object-fit: cover;">
                                                    </a>
                                                </div>
                                            </div>
                                        </div> 
                                        <legend class="text-danger font-weight-bold">TO THE APPLICANTS:Forms with incomplete entries/requirements will not be processed</legend>
                                        <div class="container border border-4 w-80">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="first-name" class="form-label">First name </label>
                                                    <input disabled type="text" class="form-control"  wire:model="user_details.user_firstname" name="first_name" placeholder="First name" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="last-name" class="form-label">Middle name</label>
                                                    <input disabled type="text" class="form-control"   wire:model="user_details.user_middlename" name="last_name" placeholder="Middle name" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="last-name" class="form-label">Last name </label>
                                                    <input disabled type="text" class="form-control"   wire:model="user_details.user_lastname" name="last_name" placeholder="Last name" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="last-name" class="form-label">Suffix</label>
                                                    <div class="col-lg-8">
                                                        <select disabled wire:model="user_details.user_suffix" class="form-control">
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
                                                    <input disabled type="date" class="form-control" wire:model="user_details.user_birthdate" name="birthdate">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="contact-number" class="form-label">Contact Number</label>
                                                    <input disabled type="text"  wire:model="user_details.user_phone" class="form-control"  placeholder="Contact Number" >
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="contact-number" class="form-label">Age</label>
                                                    <input disabled type="number"   wire:model="user_details.user_age" class="form-control" disabled placeholder="Age" >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="contact-number" class="form-label">Email Address</label>
                                                    <input disabled type="text" wire:model="user_details.user_email" class="form-control" disabled  placeholder="Email Address" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="contact-number" class="form-label">Citizenship </label>
                                                    <input disabled type="text"  wire:model="user_details.user_citizenship" class="form-control"  placeholder="Citizenship" >
                                                </div>
                                            </div>
                                        </div>
                                        <legend class="text-danger font-weight-bold">TYPE OF APPLICANT (CHECK ONE of the categories that applies to you):</legend>
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
                                                            <input disabled type="text" class="form-control" id="first-name" wire:model="cet_form.t_a_school_school_name" name="first_name" placeholder="Name Of School" >
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <label for="last-name" class="form-label">Expected Date of Graduation</label>
                                                            <input disabled type="date" class="form-control"  wire:key="date" wire:model="cet_form.t_a_date_of_graduation" name="graduation_date" >
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <label for="last-name" class="form-label">School Address </label>
                                                            <input disabled type="text" class="form-control" wire:model="cet_form.t_a_school_address" name="last_name" placeholder="School Address " >
                                                        </div>
                                                    </div>
                                                    <fieldset class="mb-2">
                                                        <legend class="form-legend">Required Documents</legend>
                                                        <label for="senior-card-original">School Principal Certification<span style="color:red;">*</span></label>
                                                        <div>
                                                            <a target="blank"href="{{asset('storage/application-requirements/t_a_school_principal_certification/'.$cet_form['t_a_school_principal_certification'])}}" >
                                                                <img src="{{asset('storage/application-requirements/t_a_school_principal_certification/'.$cet_form['t_a_school_principal_certification'])}}" height="300" alt="Logo"  >
                                                            </a>
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
                                                            <input disabled type="text" class="form-control" id="first-name" wire:model="cet_form.t_a_school_school_name" name="first_name" placeholder="Name Of School" >
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <label for="last-name" class="form-label"> Date/Year Graduated</label>
                                                            <input disabled type="date" class="form-control"  wire:key="date" wire:model="cet_form.t_a_date_of_graduation" name="graduation_date" >
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <label for="last-name" class="form-label">School Address</label>
                                                            <input disabled type="text" class="form-control" id="last-name"  wire:model="cet_form.t_a_school_address" name="last_name" placeholder="School Address " >
                                                        </div>
                                                    </div>
                                                    <fieldset class="mb-2">
                                                        <legend class="form-legend">Required Documents</legend>
                                                        <label for="senior-card-original">Original Senior High School Card<span style="color:red;">*</span></label>
                                                        <div>
                                                            <a target="blank" href="{{asset('storage/application-requirements/t_a_original_senior_high_school_card/'.$cet_form['t_a_original_senior_high_school_card'])}}" >
                                                                <img src="{{asset('storage/application-requirements/t_a_original_senior_high_school_card/'.$cet_form['t_a_original_senior_high_school_card'])}}" height="300" alt="Logo"  >
                                                            </a>
                                                        </div>
                                                        @if( isset($cet_form['t_a_receipt_photo']))
                                                        <label for="senior-card-original">CET Payment Receipt <span style="color:red;">*</span></label>
                                                        <div>
                                                            <a target="blank"href="{{asset('storage/application-requirements/t_a_receipt_photo/'.$cet_form['t_a_receipt_photo'])}}" >
                                                                <img src="{{asset('storage/application-requirements/t_a_receipt_photo/'.$cet_form['t_a_receipt_photo'])}}" height="300" alt="Logo"  >
                                                            </a>
                                                        </div>
                                                        @endif

                                                       
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
                                                            <input disabled type="text" class="form-control" id="first-name" wire:model="cet_form.t_a_school_school_name" name="first_name" placeholder="Name Of School" >
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <label for="last-name" class="form-label">Course</label>
                                                            <input disabled type="text" class="form-control" id="last-name"  wire:key="date" wire:model="cet_form.t_a_course" name="last_name" placeholder="Course"  >
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <label for="last-name" class="form-label">School Address </label>
                                                            <input disabled type="text" class="form-control" id="last-name"  wire:model="cet_form.t_a_school_address" name="last_name" placeholder="School Address " ]>
                                                        </div>
                                                    </div>
                                                    <fieldset class="mb-2">
                                                        <legend class="form-legend">Required Documents</legend>
                                                        <label for="senior-card-original">Transcript of Records ( TOR ) <span style="color:red;">*</span></label>
                                                        <div>
                                                            <a target="blank" href="{{asset('storage/application-requirements/t_a_transcript_of_records/'.$cet_form['t_a_transcript_of_records'])}}" >
                                                                <img src="{{asset('storage/application-requirements/t_a_transcript_of_records/'.$cet_form['t_a_transcript_of_records'])}}" height="300" alt="Logo"  >
                                                            </a>
                                                        </div>
                                                        <label for="senior-card-original">Endorsement letter from WMSU Dean<span style="color:red;">*</span></label>
                                                        <div>
                                                            <a target="blank" href="{{asset('storage/application-requirements/t_a_endorsement_letter_from_wmsu_dean/'.$cet_form['t_a_endorsement_letter_from_wmsu_dean'])}}" >
                                                                <img src="{{asset('storage/application-requirements/t_a_endorsement_letter_from_wmsu_dean/'.$cet_form['t_a_endorsement_letter_from_wmsu_dean'])}}" height="300" alt="Logo"  >
                                                            </a>
                                                        </div>
                                                        @if( isset($cet_form['t_a_receipt_photo']))
                                                        <label for="senior-card-original">CET Payment Receipt <span style="color:red;">*</span></label>
                                                        <div>
                                                            <a target="blank"href="{{asset('storage/application-requirements/t_a_receipt_photo/'.$cet_form['t_a_receipt_photo'])}}" >
                                                                <img src="{{asset('storage/application-requirements/t_a_receipt_photo/'.$cet_form['t_a_receipt_photo'])}}" height="300" alt="Logo"  >
                                                            </a>
                                                        </div>
                                                        @endif

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
                                                    <div class="col-md-4 my-2">
                                                        <label for="senior-card-original">1st Choice</label>
                                                        <input disabled type="text"  wire:model="cet_form.t_a_1st_choice" class="form-control" >
                                                        <label for="senior-card-original">3rd Choice</label>
                                                        <input disabled type="text"  wire:model="cet_form.t_a_3rd_choice" class="form-control">
                                                    </div>
                                                    <div class="col-md-4 my-2">      
                                                        <label for="senior-card-original">2nd Choice</label>
                                                        <input disabled type="text"  wire:model="cet_form.t_a_2nd_choice" class="form-control"  >     
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-danger font-weight-bold">Socio Economic Data: Furnish all ] information. Under Column "Highest Education Finished" indicate the educational level actually completed (eg. Grade III, Third Year high school, High School Gradute, Second Year, College Graduate,etc) </div>
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
                                                                <input disabled type="text"  wire:model="cet_form.t_a_f_citizenship" class="form-control"  placeholder="Citizenship" >
                                                            </td>
                                                            <td>
                                                                <input disabled type="text" class="form-control" wire:model="cet_form.t_a_f_hef" name="high_school_name" placeholder="Highest Education Finished"  >
                                                            </td>
                                                            <td>
                                                                <input disabled type="text" class="form-control" wire:model="cet_form.t_a_f_occupation" name="high_school_name" placeholder="Work/Occupation" >
                                                            </td>
                                                            <td>
                                                                <input disabled type="text" class="form-control" wire:model="cet_form.t_a_f_place_of_work" name="high_school_name" placeholder="Employer/Place of Work" >
                                                            </td>
                                                            <td>
                                                                <select disabled class="form-control" aria-label="Default select example" style="width: 180px; height: 50px;" wire:model="cet_form.t_a_f_monthly_salary">
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
                                                                <input disabled type="text"  wire:model="cet_form.t_a_m_citizenship" class="form-control" placeholder="Citizenship" >
                                                            </td>
                                                            <td>
                                                                <input disabled type="text" class="form-control" wire:model="cet_form.t_a_m_hef" name="high_school_name" placeholder="Highest Education Finished" >
                                                            </td>
                                                            <td>
                                                                <input disabled type="text" class="form-control" wire:model="cet_form.t_a_m_occupation" name="high_school_name" placeholder="Work/Occupation" >
                                                            </td>
                                                            <td>
                                                                <input disabled type="text" class="form-control" wire:model="cet_form.t_a_m_place_of_work" name="high_school_name" placeholder="Employer/Place of Work" >
                                                            </td>
                                                            <td>
                                                                <select disabled class="form-control" aria-label="Default select example" style="width: 180px; height: 50px;" wire:model="cet_form.t_a_m_monthly_salary">
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
                                                    <input disabled type="radio" wire:model="cet_form.t_a_computer_literate" value="1" id="checkbox1"> <label for="checkbox1">Yes</label>
                                                    <input disabled type="radio" wire:model="cet_form.t_a_computer_literate" value="0" id="checkbox1"> <label for="checkbox1">No</label>
                                                </div>
                                                <div class="text-danger font-weight-bold">
                                                    <p class="d-inline-block mr-3">Are you a member of a Cultural/Ethnic group? if yes, please check any one below</p>
                                                    <br>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Badjao" type="radio"  >
                                                        <label class="form-check-label mr-3" for="checkbox3">Badjao</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Kalibugan" type="radio">
                                                        <label class="form-check-label mr-3" for="checkbox4">Kalibugan</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Maranaw" type="radio">
                                                        <label class="form-check-label mr-3" for="checkbox5">Maranaw</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Subanen" type="radio" >
                                                        <label class="form-check-label mr-3" for="checkbox6">Subanen</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Yakan" type="radio" >
                                                        <label class="form-check-label mr-3" for="checkbox7">Yakan</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Bagobo" type="radio" >
                                                        <label class="form-check-label mr-3" for="checkbox8">Bagobo</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Maguindanao" type="radio" >
                                                        <label class="form-check-label mr-3" for="checkbox9">Maguindanao</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Samal" type="radio" >
                                                        <label class="form-check-label mr-3" for="checkbox10">Samal</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="Tausug" type="radio" >
                                                        <label class="form-check-label mr-3" for="checkbox11">Tausug</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" wire:model="cet_form.t_a_ethnic_group" value="" type="radio" id="checkbox12">
                                                        <input disabled type="text" class="form-control" wire:model="cet_form.t_a_ethnic_group" name="high_school_name" placeholder="Others Specify">
                                                    </div>
                                                </div>
                                                <div  class="text-danger font-weight-bold mt-2">
                                                    <p class="mb-1" >Religous affiliation </p>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" type="radio" value="Protestant" wire:model="cet_form.t_a_religious_affiliation">
                                                        <label class="form-check-label mr-3" for="checkbox10">Protestant</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" type="radio" value="Islam" wire:model="cet_form.t_a_religious_affiliation">
                                                        <label class="form-check-label mr-3" for="checkbox11">Islam</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" type="radio" value="Roman Catholic" wire:model="cet_form.t_a_religious_affiliation">
                                                        <label class="form-check-label mr-3" for="checkbox11">Roman Catholic</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" type="radio" value="" wire:model="cet_form.t_a_religious_affiliation">
                                                        <input disabled type="text" class="form-control"  wire:model="cet_form.t_a_religious_affiliation" name="high_school_name" placeholder="Others Specify" >
                                                    </div>
                                                </div>
                                                <div class="container border border-danger mt-5 rounded">
                                                    <div class="form-check form-check-inline">
                                                        <p class="text-danger mt-2"> 
                                                            <input disabled class="form-check-input" wire:model="cet_form.t_a_accept" value="1" type="checkbox" id="checkbox11"> 
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
                                            
                                                <div class="p-2 "><button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button></div>
                                            </div>     
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              
            
        </section>
        <script>
            window.print_this = function(id) {
                var prtContent = document.getElementById(id);
                var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
                
                WinPrint.document.write('<link rel="stylesheet" type="text/css"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
                // To keep styling
                /*var file = WinPrint.document.createElement("link");
                file.setAttribute("rel", "stylesheet");
                file.setAttribute("type", "text/css");
                file.setAttribute("href", 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
                WinPrint.document.head.appendChild(file);*/

                
                WinPrint.document.write(prtContent.innerHTML);
                WinPrint.document.close();
                WinPrint.setTimeout(function(){
                WinPrint.focus();
                WinPrint.print();
                WinPrint.close();
                }, 1000);
            }
        </script>
    </div>
</div>



