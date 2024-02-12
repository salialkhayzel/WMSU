<div>
    <x-loading-indicator/>
        <!-- Main Content -->
        <main id="main" class="main">
        <div class="pagetitle">
            <h1>Exam administrator</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Exam Administrator</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link   @if($active == 'exam_admin') show active @endif "wire:key="exam_admin" href="#" wire:click="active_page('exam_admin')">Assigned Rooms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($active == 'attendance_list') show active @endif "wire:key="attendance_list" href="#" wire:click="active_page('attendance_list')">Attendance Rooms</a>
            </li>
          
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Proctor Table -->
            <div class="tab-pane @if($active == 'exam_admin') show active @endif " id="exam-administrator">
                <div class="d-flex mt-2">
                    <label class="filter-label align-self-center " for="exam-filter">Filter by Test Date:</label>
                    <select class="filter-select " wire:model.defer="test_date" wire:change="view_schedule_change('AM')">
                        @foreach ($assigned_test_date as $item => $value)
                            <option wire:key="assigned-{{$value->test_schedule_id}}"value="{{$value->test_schedule_id}}" >{{$value->test_date}}</option>
                        @endforeach
                        
                        <!-- Add more options as needed -->
                    </select>
                
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#unassigned-room-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            <input class="form-control" type="text" id="search" placeholder="Search "  wire:change="search_applicant()"/> 
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                

                    <div class="modal fade" id="unassigned-room-filter" tabindex="-1" role="dialog" aria-labelledby="unassigned-room-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns for Assigned Rooms</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($assigned_proctor_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="assigned-filtering-{{$loop->iteration}}"
                                            wire:model.defer="assigned_proctor_filter.{{$item}}">
                                        <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="assigned_proctor_filterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-10 d-none">
                        <button class="btn btn-success mx-1" type="button" wire:click="download_examinees_list()">Download All Examinees</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="application-table" id="proctor-table">
                        <thead>
                            <tr>
                            @foreach ($assigned_proctor_filter as $item => $value)
                               @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assigned_room_data as $item => $value)
                                <tr wire:key="item-{{ $value->school_room_id }}">
                                    @if($assigned_proctor_filter['#'])
                                        <td>{{ $loop->index+1 }}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Proctor'])
                                        <td>@if(isset($value->user_id) ){{$value->user_lastname.', '.$value->user_firstname." ".$value->user_middlename}}@endif</td>
                                    @endif
                                    @if($assigned_proctor_filter['Test Date'])
                                        <td>{{ $value->test_date }}</td>
                                    @endif
                                    
                                    @if($assigned_proctor_filter['Test Center Name'])
                                        <td>{{ $value->test_center_name }}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Test Center Code'])
                                        <td>{{ $value->test_center_code}}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Building name'])
                                        <td>{{ $value->school_room_bldg_name}}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Room name'])
                                        <td>{{ $value->school_room_name}}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Room no.'])
                                        <td>{{ $value->school_room_number}}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Room Description'])
                                        <td>{{ $value->school_room_description}}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Capacity'])
                                        <td>{{ $value->school_room_max_capacity}}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Capacity'])
                                        <td>{{ $value->total_examinees_count}}</td>
                                    @endif
                                    @if($assigned_proctor_filter['Status'])
                                        <td>@if($value->school_room_isactive ) Active @else Inactive @endif</td>
                                    @endif
                                    @if($assigned_proctor_filter['Actions'] )
                                        <td class="text-center">
                                            @if($access_role['R']==0)
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewRoomModal" wire:click="view_room_details({{$value->school_room_id }})">View</button>
                                            @endif
                                            @if($access_role['R']==1)
                                            <button class="btn btn-primary" wire:click="view_examinees_list({{$value->test_schedule_id.','.$value->school_room_id }})">Student List</button>
                                            @endif
                                            @if($access_role['R']==0)
                                                <button class="btn btn-warning" wire:click="attendance_list({{$value->school_room_id }})">Attendance</button>
                                            @endif
                                            @if($access_role['D']==0)
                                                @if($value->school_room_isactive)
                                                    <button class="btn btn-danger" wire:key="delete" id="confirmDeleteRoom" wire:click="delete_room({{ $value->school_room_id }})">Delete</button>
                                                @else
                                                    <button class="btn btn-warning" wire:key="delete" wire:click="activate_room({{ $value->school_room_id}})">Activate</button>
                                                @endif
                                        
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <td class="text-center font-weight-bold" colspan="42">
                                    NO RECORDS 
                                </td>
                            @endforelse
                            <!-- Add more proctor entries as needed -->
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Attendance List -->
            <div class="tab-pane @if($active == 'attendance_list') show active @endif " id="attendance-list">
                <div class="d-flex mt-2">
                    <label class="filter-label align-self-center " for="exam-filter">Filter by Test Date:</label>
                    <select class="filter-select " wire:model.defer="a_test_schedule_id" wire:change="view_schedule_change('AM')">
                        @foreach ($a_test_schedule as $item => $value)
                            <option wire:key="assigned-{{$value->test_schedule_id}}"value="{{$value->test_schedule_id}}" >{{$value->test_date}}</option>
                        @endforeach
                        
                        <!-- Add more options as needed -->
                    </select>
                    <label class="filter-label align-self-center " for="exam-filter">Filter by Room:</label>
                    <select class="filter-select " wire:model.defer="a_school_room_id" wire:change="update_attendance_data()">
                        @foreach ($a_room_details as $item => $value)
                            <option wire:key="assigned-{{$value->school_room_id}}"value="{{$value->school_room_id}}" >{{$value->school_room_name}}</option>
                        @endforeach
                        
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="container text-center mt-3">
                    @if($room_schedule['ampm'] == 'AM')
                    <button type="button" class="btn btn-primary"  wire:click="view_schedule_change('AM')">AM</button>
                        <button type="button" class="btn btn-secondary"  wire:click="view_schedule_change('PM')">PM</button>
                    @else
                        <button type="button" class="btn btn-secondary"  wire:click="view_schedule_change('AM')">AM</button>
                        <button type="button" class="btn btn-primary"  wire:click="view_schedule_change('PM')">PM</button>
                    @endif
                </div>
               
                <!-- Attendance Table -->
                <div class="container mt-3">
                    <table class="table table-bordered" id="attendanceListTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Applicant Photo</th>
                                <th>Applicant Name</th>
                                <th>Attendance Status</th>
                                <th>Attendance Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Attendance data will be displayed here -->
                            <?php $count = 0 ?>
                            @forelse($a_examinees as $key =>$value)
                                @if($room_schedule['ampm'] == $value->t_a_ampm)
                                    <?php $count++?>
                                    <tr wire:key="examinees-{{$key}}" class="align-middle">
                                        <td>{{ $count }}</td>
                                        <td><img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$value->t_a_formal_photo)}}" alt="Student Picture" width="70" height="70" style="object-fit: cover;"></td>
                                        <td>{{$value->user_lastname.', '.$value->user_firstname." ".$value->user_middlename}}</td>
                                        <td>@if($value->ispresent) Present @else  @endif</td>
                                        <td>
                                            <!-- Checkbox for attendance done -->
                                            <div class="form-check">
                                                <input type="checkbox" @if($value->ispresent) checked @endif class="form-check-input" wire:click="check_attendance({{$value->t_a_id}} @if($value->ispresent) ,{{0}} @else, {{1}}@endif , '{{$room_schedule['ampm']}}')" id="attendanceDone1">
                                                <label class="form-check-label" for="attendanceDone1">Present</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <td class="text-center font-weight-bold" colspan="42">
                                    NO RECORDS 
                                </td>
                            @endforelse
                            @if($count == 0 )
                                <td class="text-center font-weight-bold" colspan="42">
                                    NO RECORDS 
                                </td>
                            @endif

                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>



            <!-- Instructions Modal -->
            <div class="modal fade" id="proctorInstructionsModal" tabindex="-1" role="dialog" aria-labelledby="proctorInstructionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="proctorInstructionsModalLabel">Proctor Instructions</h5>
                            <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <!-- Add your proctor instructions here -->
                            <p>Welcome, Proctor (NAME). Here are your instructions:</p>
                                <!-- Download Button for Applicant List -->
                                <a href="#" class="btn btn-primary mt-2 align-center mb-2">Download Applicant List</a>
                            <ol>
                                <li>Scan the QR code to check the applicants' information.</li>
                                <li>Ensure that all registered applicants are present.</li>
                                <li>Report any issues or discrepancies to the exam administrators.</li>
                            </ol>

                            <!-- Applicant List and Download Button -->
                            <h1></h1>
                            <p>Applicant List:</p>
                            <table class="application-table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Applicant Name</th>
                                        <th>CET</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Code 1</td>
                                        <td>hanz dumapit</td>
                                        <td>CET</td>
                                    </tr>
                                    <tr>
                                        <td>Code 2</td>
                                        <td>dap dap</td>
                                        <td>CET</td>
                                    </tr>
                                    <!-- Add more rows for additional applicants -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="viewExamineesWithProctorModal" tabindex="-1" role="dialog" aria-labelledby="viewExamineesWithProctorModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewExamineesWithProctorModalLabel">Examinees details</h5>
                            <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                        </div>
                        
                        <div class="modal-body">
                           
                            @if($room_details)
                                <p class="modal-title" >Proctor:  {{$room_details[0]->user_lastname.', '.$room_details[0]->user_firstname.' '.$room_details[0]->user_middlename}}</p>
                  
                                <table class="table">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="col">Test Center</th>
                                            <td>{{$room_details[0]->school_room_test_center}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Room venue</th>
                                            <td>{{$room_details[0]->school_room_venue}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Room code</th>
                                            <td>{{$room_details[0]->school_room_id.' - '.$room_details[0]->school_room_name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Room name</th>
                                            <td>{{$room_details[0]->school_room_name}}</td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>                               
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($examinees)
                                    @foreach ($examinees as $key => $value)
                                    <tr>
                                        <td>{{$value->user_name}}</td>
                                        <td>{{$value->user_lastname.', '.$value->user_firstname.' '.$value->user_middlename}}</td>
                                        <td>{{$value->user_address}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table> 
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student List Modal -->
            <div class="modal fade" id="studentListModal" tabindex="-1" aria-labelledby="studentListModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @if(isset($room_schedule['school_room_id']) && isset($room_schedule['ampm']))
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="addRoomCapacity">Proctor: ( @if(isset($user_details['user_id']) ){{$user_details['user_lastname'].', '.$user_details['user_firstname']." ".$user_details['user_middlename']}}@endif )</label>
                                    <br>
                                    <label for="addRoomCapacity">Test Center code - name: ( {{$room_schedule['test_center_code'].' - '.$room_schedule['test_center_name']}} )</label>
                                    <br>
                                    <label for="addRoomCapacity">Test Date: ( {{date_format(date_create(  $room_schedule['test_date']), "F d ")}} )</label>
                                    <br>
                                    <label for="addRoomCapacity">Room No.: ( {{$room_schedule['school_room_number']}} )</label>
                                    <br>
                                    <br>
                                    <div class="container text-center">
                                        @if($room_schedule['ampm'] == 'AM')
                                        <button type="button" class="btn btn-primary"  wire:click="view_schedule_change('AM')">AM</button>
                                            <button type="button" class="btn btn-secondary"  wire:click="view_schedule_change('PM')">PM</button>
                                        @else
                                            <button type="button" class="btn btn-secondary"  wire:click="view_schedule_change('AM')">AM</button>
                                            <button type="button" class="btn btn-primary"  wire:click="view_schedule_change('PM')">PM</button>
                                        @endif
                                    </div>
                                    
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Picture</th>
                                        <th>Name</th>
                                        <th>Application Code</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0 ?>
                                        @forelse($examinees_data as $key => $value)
                                            @if($room_schedule['ampm'] == $value->t_a_ampm)
                                                <?php $count ++ ?>
                                                <tr class="align-middle">
                                                    <td>{{ $count }}</td>
                                                    <td><img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$value->t_a_formal_photo)}}" alt="Student Picture" width="70" height="70" style="object-fit: cover;"></td>
                                                    <td>{{$value->user_lastname.', '.$value->user_firstname." ".$value->user_middlename}}</td>
                                                    <td>{{$value->applied_date.'-'.$value->t_a_id }}</td>
                                                    <td><button class="btn btn-primary" wire:click="view_application({{$value->t_a_id}})">View</button></td>
                                                </tr>
                                            @endif
                                        @empty
                                            <td class="text-center font-weight-bold" colspan="42">
                                                NO RECORDS 
                                            </td>
                                        @endforelse
                                        @if($count == 0 )
                                            <td class="text-center font-weight-bold" colspan="42">
                                                NO RECORDS 
                                            </td>
                                        @endif
                                        <!-- Add more rows for other students -->
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success" onclick="print_this('studentListModal')" >Print</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="proctor-list">
                <div class="table-responsive">
                <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addProctorModal">Add Proctor</button>
                    <table class="application-table" id="proctorListTable">
                        <thead>
                            <tr>
                                <th>Proctor Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Proctor names will be displayed here -->
                            <tr>
                                <td>John Smith</td>
                            </tr>
                            <!-- Add more proctor names as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Add Proctor Modal -->
            <div class="modal fade" id="addProctorModal" tabindex="-1" role="dialog" aria-labelledby="addProctorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProctorModalLabel">Add Proctor</h5>
                            <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <!-- Add form fields for adding a new proctor here -->
                            <form>
                                <div class="form-group">
                                    <label for="proctorName">Proctor Name</label>
                                    <input type="text" class="form-control" id="proctorName" placeholder="Enter Proctor Name">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="addProctorButton">Add Proctor</button>
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
                                                <p class="text-danger font-weight-bold">WMSU-CET APPLICATION FORM  <br> For School Year {{(date("Y")+1).' - '.(date("Y")+2)}}</p>
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
                                                    <input disabled type="text" class="form-control"  wire:model="applicant_details.user_firstname" name="first_name" placeholder="First name" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="last-name" class="form-label">Middle name</label>
                                                    <input disabled type="text" class="form-control"   wire:model="applicant_details.user_middlename" name="last_name" placeholder="Middle name" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="last-name" class="form-label">Last name </label>
                                                    <input disabled type="text" class="form-control"   wire:model="applicant_details.user_lastname" name="last_name" placeholder="Last name" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="last-name" class="form-label">Suffix</label>
                                                    <div class="col-lg-8">
                                                        <select disabled wire:model="applicant_details.user_suffix" class="form-control">
                                                            @if(isset($applicant_details['user_suffix']) && strlen($applicant_details['user_suffix']>0))
                                                                <option value="$applicant_details['user_suffix']">
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
                                                    <input disabled type="date" class="form-control" wire:model="applicant_details.user_birthdate" name="birthdate">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="contact-number" class="form-label">Contact Number</label>
                                                    <input disabled type="text"  wire:model="applicant_details.user_phone" class="form-control"  placeholder="Contact Number" >
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="contact-number" class="form-label">Age</label>
                                                    <input disabled type="number"   wire:model="applicant_details.user_age" class="form-control" disabled placeholder="Age" >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="contact-number" class="form-label">Email Address</label>
                                                    <input disabled type="text" wire:model="applicant_details.user_email" class="form-control" disabled  placeholder="Email Address" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="contact-number" class="form-label">Citizenship </label>
                                                    <input disabled type="text"  wire:model="applicant_details.user_citizenship" class="form-control"  placeholder="Citizenship" >
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

    </div>
        <!-- Back to Top Button -->
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
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
