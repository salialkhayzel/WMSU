<div>
    <!-- Content -->
    <div class="container">
        <!-- Tab Navigation -->
        <!-- <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#schedule-appointment">Schedule Appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#view-appointments">My Appointments</a>
            </li>
        </ul> -->

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Tab 1: Schedule Appointment -->
            <!-- <div class="tab-pane fade show active" id="schedule-appointment">
                <div class="details-box w-50 mx-auto">
                    <div class="appointment-form">
                        <h4>Schedule Appointment</h4>
                        <form wire:submit.prevent="add_apointment()">
                            <div class="form-group">
                                <label for="appointment-date">Preferred Appointment Date:</label>
                                <input type="date" class="form-control" wire:model.defer="appointment.appointment_preferred_date" required>
                            </div>
                            <div class="form-group">
                                <label for="appointment-purpose">Purpose:</label>
                                <input type="text" class="form-control" wire:model.defer="appointment.appointment_purpose" required >
                            </div>
                            <div class="form-group">
                                <label for="appointment-message">Message (optional):</label>
                                <input type="text" class="form-control" wire:model.defer="appointment.appointment_message">
                            </div>
                            <button type="submit" class="btn btn-warning">Schedule</button>
                        </form>
                    </div>
                </div>
            </div> -->

        <!-- Tab 2: View Appointments -->
        <div class="tab-pane fade show active" id="view-appointments">
                <div class="d-flex my-3">
                    <div class="col-md-4 sort-container">
                        <div class="d-flex">
                            <button class="btn btn-success" wire:click="add_appointment_modal()">
                                Schedule Appointment 
                            </button>
                            @if(1)
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn ml-1" type="button" data-bs-toggle="modal" data-bs-target="#user-data-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                        <!-- wire:model.debounce.500ms="search" -->
                    </div>
                </div> 
                <div class="modal fade" id="user-data-filter" tabindex="-1" role="dialog" aria-labelledby="user-data-filterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns for Appointments</h5>
                            </div>
                            <hr>
                            <div class="modal-body">
                                @foreach($appointment_filter as $item => $value)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="assigned-filtering-{{$loop->iteration}}"
                                        wire:model.defer="appointment_filter.{{$item}}">
                                    <label class="form-check-label" for="assigned-filtering-{{$loop->iteration}}">
                                        {{$item}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                                <button type="button" wire:click="appointment_filterView()"  data-bs-dismiss="modal" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                </div>
            </div>   
            <table class="table table-striped">
                <thead style="background-color: #990000; color: white; position: sticky; top: 0;"> 
                    <tr>
                        @foreach ($appointment_filter as $item => $value)
                            @if($value)
                            <th scope="col">{{$item}}</th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appointment_data as $item => $value )
                        <tr>
                        @if($appointment_filter['#'])
                            <td>{{ $loop->index+1 }}</td>
                        @endif
                        @if($appointment_filter['Date'])
                            <td>{{ $value->appointment_preferred_date }}</td>
                        @endif
                        @if($appointment_filter['Time'])
                            <td>@if($value->appointment_preferred_time) {{ $value->appointment_preferred_time }} @else @endif</td>
                        @endif
                        @if($appointment_filter['Schedule'])
                            <td class="text-align center"> @if($value->appointment_datetime){{date_format(date_create($value->appointment_datetime),"F d, Y h:i A")}} @else @endif</td>
                        @endif
                        
                        @if($appointment_filter['Purpose'])
                            <td>{{ $value->appointment_purpose }}</td>
                        @endif
                        @if($appointment_filter['Message'])
                            <td>{{ $value->appointment_message }}</td>
                        @endif
                        @if($appointment_filter['Status'])
                            <td>{{ $value->status_details }}</td>
                        @endif
                        @if($appointment_filter['Action'])
                            <td>
                                @if($value->status_details == 'Pending')
                                <button class="btn btn-warning" wire:click="reschedule_appointment({{$value->appointment_id}})">
                                    Reschedule 
                                </button>
                                <button class="btn btn-danger" wire:click="cancel_appointment({{$value->appointment_id}})">
                                    Cancel
                                </button >
                                @endif
                                @if($value->status_details == 'Accepted')
                                <button class="btn btn-warning" wire:click="reschedule_appointment({{$value->appointment_id}})">
                                    Reschedule 
                                </button>
                                @endif
                            </td>
                        @endif
                        </tr>
                    @empty
                        <td class="text-center font-weight-bold" colspan="42">
                            NO RECORDS FOUND
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
           
        <div class="modal fade" id="addApppointmentModal" tabindex="-1" role="dialog" aria-labelledby="addApppointmentModal" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addApppointmentModal">Schedule Appointment</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Reschedule appointment form goes here -->
                      
                        <form wire:submit.prevent="add_apointment()">
                            <div class="form-group">
                                <label for="appointment-date">Preferred Appointment Date:</label>
                                <input type="date" class="form-control" wire:model.defer="appointment.appointment_preferred_date" required>
                            </div>
                            <div class="form-group">
                                <label for="appointment-purpose">Purpose:</label>
                                <input type="text" class="form-control" wire:model.defer="appointment.appointment_purpose" required >
                            </div>
                            <div class="form-group">
                                <label for="appointment-message">Message (optional):</label>
                                <input type="text" class="form-control" wire:model.defer="appointment.appointment_message">
                            </div>
                            <button type="submit" class="btn btn-primary">Schedule Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="CancelApppointmentModal" tabindex="-1" role="dialog" aria-labelledby="CancelApppointmentModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CancelApppointmentModal">Cancel Appointment</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Reschedule appointment form goes here -->
                    @if($appointment['appointment_id'])
                    <form wire:submit.prevent="confirm_cancel_appointment({{$appointment['appointment_id']}})">
                    <div class="modal-body">
                        <p> Are you sure you want to cancel the appointment that dates:({{$appointment['appointment_preferred_date']}})? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger"> Cancel</button>
                    </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <!-- Reschedule Modal 1 -->
        <div class="modal fade" id="rescheduleApppointmentModal" tabindex="-1" role="dialog" aria-labelledby="rescheduleApppointmentModal" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rescheduleApppointmentModal">Reschedule Appointment</h5>
                        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    @if($appointment['appointment_id'])
                    <form wire:submit.prevent="save_reschedule_appointment({{$appointment['appointment_id']}})">
                        <div class="form-group">
                            <label for="appointment-date">Preferred Appointment Date:</label>
                            <input type="date" class="form-control" wire:model.defer="appointment.appointment_preferred_date" required>
                        </div>
                        <div class="form-group">
                            <label for="appointment-purpose">Purpose:</label>
                            <input type="text" class="form-control" wire:model.defer="appointment.appointment_purpose" required >
                        </div>
                        <div class="form-group">
                            <label for="appointment-message">Message (optional):</label>
                            <input type="text" class="form-control" wire:model.defer="appointment.appointment_message">
                        </div>
                        <button type="submit" class="btn btn-warning">Re-Schedule</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>