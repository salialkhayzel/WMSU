   <div>   <!-- Main Content -->
      <main id="main" class="main">
            <div class="pagetitle">
                <h1>Manage Appointment</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Appointment</li>
                    </ol>
                </nav>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="adminTabs">
                <li class="nav-item">
                    <a class="nav-link  @if($active == 'Unassign Appointments') show active @endif " wire:click="active_page('Unassign Appointments')" data-bs-toggle="tab" href="#UnassignedAppointment-tab">Unassign Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if($active == 'Assigned Appointments') show active @endif " data-bs-toggle="tab"  wire:click="active_page('Assigned Appointments')" href="#AssignedAppointment-tab">Assigned Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if($active == 'Completed Appointments') show active @endif " data-bs-toggle="tab"  wire:click="active_page('Completed Appointments')" href="#CompletedAppointment-tab">Completed Appointments</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Unassigned Appoinment Tab -->
                <div class="tab-pane fade show @if($active == 'Unassign Appointments') show active @else fade @endif" id="appointment-pending-tab">
                    <div class="d-flex mt-2">
                        <div class="col-md-3 sort-container">
                            <div class="d-flex">
                                @if(1)
                                <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn" type="button" data-bs-toggle="modal" data-bs-target="#application-management-filter">
                                    <i class="bi bi-funnel-fill me-1"></i>
                                    <div><span class='btn-text'>Columns</span></div>
                                </button>
                                @endif
                                <input class="form-control" type="text" id="search" placeholder="Search "  wire:change="search_applicant()"/> 
                                <!-- wire:model.debounce.500ms="search" -->
                               
                            </div>
                        </div> 
                        <div class="modal fade" id="application-management-filter" tabindex="-1" role="dialog" aria-labelledby="application-management-filterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns</h5>
                                    </div>
                                    <hr>
                                    <div class="modal-body">
                                        @foreach($unassigned_appointment_data_filter as $item => $value)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                                wire:model.defer="unassigned_appointment_data_filter.{{$item}}">
                                            <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                                {{$item}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button wire:click="filter_view()" data-bs-dismiss="modal" 
                                            class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-10">
                            <button class="btn btn-success mx-1" wire:click="accept_appointment_modal()" >Accept </button>
                            <button class="btn btn-danger mx-1"  wire:click="delete_appointment_modal()" >Decline </button>
                        </div>
                    </div>
                    <table class="appointment-table">
                        <thead>
                            <tr>
                                @foreach ($unassigned_appointment_data_filter as $item => $value)
                                    @if ($loop->first && $value)
                                        <th><input wire:model="unassigned_appointment_selected_all" wire:change="unassigned_appointment_select_all()" type="checkbox"></th> 
                                    @elseif($loop->last && $value )
                                        <th>
                                            <!--  for loop for access role-->
                                            Action
                                        </th>
                                    @elseif($value)
                                        <th>{{$item}}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($unassigned_appointment_data as $item => $value)
                            <tr wire:key="item-{{ $value->appointment_id }}">
                                
                                @if($unassigned_appointment_data_filter['Select all'])
                                    <td><input type="checkbox" 
                                        wire:model="unassigned_appointment_selected.{{$loop->index}}.{{$value->appointment_id}}"
                                        >
                                    </td>
                                @endif
                                @if($unassigned_appointment_data_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($unassigned_appointment_data_filter['Full name'])
                                    <td>{{ $value->user_fullname }}</td>
                                @endif
                                @if($unassigned_appointment_data_filter['Email Address'])
                                    <td>{{$value->user_email}}</td>
                                @endif
                                @if($unassigned_appointment_data_filter['Phone #'])
                                    <td>{{$value->user_phone}}</td>
                                @endif
                                
                                @if($unassigned_appointment_data_filter['Preferred Date'])
                                    <td class="text-align center">{{date_format(date_create($value->appointment_preferred_date),"F d, Y ")}}</td>
                                @endif
                                @if($unassigned_appointment_data_filter['Purpose'])
                                    <td>{{$value->appointment_purpose}}</td>
                                @endif
                                @if($unassigned_appointment_data_filter['Message'])
                                    <td>{{$value->appointment_message}}</td>
                                @endif
                                @if($unassigned_appointment_data_filter['Status'])
                                    <td>Pending</td>
                                @endif
                                @if($unassigned_appointment_data_filter['Action'])
                                    <td>1</td>
                                @endif
                            
                            </tr>
                        @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                NO RECORDS 
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="modal fade" id="acceptAppointment" tabindex="-1" role="dialog" aria-labelledby="requestRescheduleModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="requestRescheduleModalLabel">Appointment Schedule</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="accept_appointment()">
                                    <div class="modal-body">
                                        <p>Please provide your preferred date and time:</p>
                                        <input type="datetime-local" wire:model="unassigned_appointment_datetime" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" >Appoint</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteAppointment" tabindex="-1" role="dialog" aria-labelledby="deleteAppointment" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAppointment">Decline Appointment</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="delete_appointment()">
                                    <div class="modal-body">
                                        <p>Are you sure you want to decline the selected appointments?</p>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" >Decline</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
             
                
                </div>

                

                <!-- Assigned Appointment  Tab -->
                <div class="tab-pane show @if($active == 'Assigned Appointments') show active @else fade @endif" id="appointment-accepted-tab">
                    <div class="d-flex mt-2">
                        <div class="col-md-3 sort-container">
                            <div class="d-flex">
                                @if(1)
                                <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn" type="button" data-bs-toggle="modal" data-bs-target="#assigned-filter">
                                    <i class="bi bi-funnel-fill me-1"></i>
                                    <div><span class='btn-text'>Columns</span></div>
                                </button>
                                @endif
                                <input class="form-control" type="text" id="search" placeholder="Search "  wire:change="search_applicant()"/> 
                                <!-- wire:model.debounce.500ms="search" -->
                            </div>
                        </div> 
                        <div class="modal fade" id="assigned-filter" tabindex="-1" role="dialog" aria-labelledby="assigned-filterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns</h5>
                                    </div>
                                    <hr>
                                    <div class="modal-body">
                                        @foreach($assigned_appointment_data_filter as $item => $value)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                                wire:model.defer="assigned_appointment_data_filter.{{$item}}">
                                            <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                                {{$item}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button wire:click="filter_view()" data-bs-dismiss="modal" 
                                            class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-10">
                            <button class="btn btn-primary mx-1" wire:click="reschedule_appointment_modal()" >ReSchedule </button>
                            <button class="btn btn-danger mx-1" wire:click="remove_reschedule_appointment_modal()" >Remove-schedule </button>
                            <button class="btn btn-danger mx-1"  wire:click="delete_reschedule_appointment_modal()" >Decline </button>
                        </div>
                    </div>
                    <table class="appointment-table">
                        <thead>
                            <tr>
                                @foreach ($assigned_appointment_data_filter as $item => $value)
                                    @if ($loop->first && $value)
                                        <th><input wire:model="assigned_appointment_selected_all" wire:change="assigned_appointment_select_all()" type="checkbox"></th> 
                                    @elseif($loop->last && $value )
                                        <th>
                                            <!--  for loop for access role-->
                                            Action
                                        </th>
                                    @elseif($value)
                                        <th>{{$item}}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($assigned_appointment_data as $item => $value)
                            <tr wire:key="item-{{ $value->appointment_id }}">
                                
                                @if($assigned_appointment_data_filter['Select all'])
                                    <td><input type="checkbox" 
                                        wire:model="assigned_appointment_selected.{{$loop->index}}.{{$value->appointment_id}}"
                                        >
                                    </td>
                                @endif
                                @if($assigned_appointment_data_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($assigned_appointment_data_filter['Full name'])
                                    <td>{{ $value->user_fullname }}</td>
                                @endif
                                @if($assigned_appointment_data_filter['Email Address'])
                                    <td>{{$value->user_email}}</td>
                                @endif
                                @if($assigned_appointment_data_filter['Phone #'])
                                    <td>{{$value->user_phone}}</td>
                                @endif
                                
                                @if($assigned_appointment_data_filter['Appointment Datetime'])
                                    <td class="text-align center">{{date_format(date_create($value->appointment_datetime),"F d, Y h:i A")}}</td>
                                @endif
                                @if($assigned_appointment_data_filter['Purpose'])
                                    <td>{{$value->appointment_purpose}}</td>
                                @endif
                                    @if($assigned_appointment_data_filter['Message'])
                                    <td>{{$value->appointment_message}}</td>
                                @endif
                                @if($assigned_appointment_data_filter['Status'])
                                    <td>Accepted</td>
                                @endif
                                @if($assigned_appointment_data_filter['Action'])
                                    <td>
                                        <button class="btn btn-success" wire:click="complete_appointment({{$value->appointment_id}})"> Complete</button>
                                    </td>
                                @endif
                            
                            </tr>
                        @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                NO RECORDS 
                            </td>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="modal fade" id="ReassigneAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="ReassigneAppointmentModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ReassigneAppointmentModalLabel">Appointment Re-schedule</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="reschedule_appointment()">
                                    <div class="modal-body">
                                        <p>Please provide your preferred date and time:</p>
                                        <input type="datetime-local" wire:model="assigned_appointment_datetime" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning" >Re-schedule</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="RemoveScheduleAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="RemoveScheduleAppointmentModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="RemoveScheduleAppointmentModalLabel">Appointment Remove-schedule</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="remove_schedule_appointment()">
                                    <div class="modal-body">
                                        <p>Are you sure you want to remove schedule?:</p>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" >Remove-schedule</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="DeleteScheduleAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="DeleteScheduleAppointmentModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteScheduleAppointmentModalLabel">Decline Appointments</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="delete_appointment_assgned()">
                                    <div class="modal-body">
                                        <p>Are you sure you want to decline?</p>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" >Decline</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="tab-pane show @if($active == 'Completed Appointments') show active @else fade @endif" id="appointment-completed-tab">
                    <div class="d-flex mt-2">
                        <div class="col-md-3 sort-container">
                            <div class="d-flex">
                                @if(1)
                                <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn" type="button" data-bs-toggle="modal" data-bs-target="#complete-filter">
                                    <i class="bi bi-funnel-fill me-1"></i>
                                    <div><span class='btn-text'>Columns</span></div>
                                </button>
                                @endif
                                <input class="form-control" type="text" id="search" placeholder="Search "  wire:change="search_applicant()"/> 
                                <!-- wire:model.debounce.500ms="search" -->
                            </div>
                        </div> 
                        <div class="modal fade" id="complete-filter" tabindex="-1" role="dialog" aria-labelledby="complete-filterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns</h5>
                                    </div>
                                    <hr>
                                    <div class="modal-body">
                                        @foreach($complete_appointment_data_filter as $item => $value)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                                wire:model.defer="complete_appointment_data_filter.{{$item}}">
                                            <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                                {{$item}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button wire:click="filter_view()" data-bs-dismiss="modal" 
                                            class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <table class="appointment-table">
                        <thead>
                            <tr>
                                @foreach ($complete_appointment_data_filter as $item => $value)
                                    @if($loop->last && $value )
                                        <th>
                                            <!--  for loop for access role-->
                                            Action
                                        </th>
                                    @elseif($value)
                                        <th>{{$item}}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($complete_appointment_data as $item => $value)
                            <tr wire:key="item-{{ $value->appointment_id }}">
                                @if($complete_appointment_data_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($complete_appointment_data_filter['Full name'])
                                    <td>{{ $value->user_fullname }}</td>
                                @endif
                                @if($complete_appointment_data_filter['Email Address'])
                                    <td>{{$value->user_email}}</td>
                                @endif
                                @if($complete_appointment_data_filter['Phone #'])
                                    <td>{{$value->user_phone}}</td>
                                @endif
                                
                                @if($complete_appointment_data_filter['Appointment Datetime'])
                                    <td class="text-align center">{{date_format(date_create($value->appointment_datetime),"F d, Y h:i A")}}</td>
                                @endif
                                @if($complete_appointment_data_filter['Purpose'])
                                    <td>{{$value->appointment_purpose}}</td>
                                @endif
                                @if($complete_appointment_data_filter['Status'])
                                    <td>Completed</td>
                                @endif
                               
                            
                            </tr>
                        @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                NO RECORDS 
                            </td>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="modal fade" id="ReassigneAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="ReassigneAppointmentModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ReassigneAppointmentModalLabel">Appointment Re-schedule</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="reschedule_appointment()">
                                    <div class="modal-body">
                                        <p>Please provide your preferred date and time:</p>
                                        <input type="datetime-local" wire:model="assigned_appointment_datetime" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning" >Re-schedule</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="RemoveScheduleAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="RemoveScheduleAppointmentModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="RemoveScheduleAppointmentModalLabel">Appointment Remove-schedule</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="remove_schedule_appointment()">
                                    <div class="modal-body">
                                        <p>Are you sure you want to remove schedule?:</p>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" >Remove-schedule</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="DeleteScheduleAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="DeleteScheduleAppointmentModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteScheduleAppointmentModalLabel">Decline Appointments</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <form wire:submit.prevent="delete_appointment_assgned()">
                                    <div class="modal-body">
                                        <p>Are you sure you want to decline?</p>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" >Decline</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

            
               
        </main>

        <!-- Back to Top Button -->
        <a href="#"
            class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </div>