<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Schedule Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Schedule Management</li>
                </ol>
            </nav>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule" type="button" role="tab" aria-controls="schedule" aria-selected="true">Registration Management</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="test-schedule-tab" data-bs-toggle="tab" data-bs-target="#test-schedule" type="button" role="tab" aria-controls="test-schedule" aria-selected="false">Test Schedule</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                <!-- Schedule Management content -->
                <section id="schedule-section">
                    <table class="application-table mt-2">
                        <thead>
                            <tr>
                                @foreach ($exam_filters as $item => $value)
                                    @if($value)
                                        <th >{{$item}}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exam_schedules  as $item => $value)
                                <tr>
                                    @if($exam_filters['#'])
                                        <td>{{ $loop->index+1 }}</td>
                                    @endif
                                    @if($exam_filters['Exam name'])
                                        <td class="align-left">    
                                            {{$value->es_exam_details}}
                                        </td>
                                    @endif
                                    @if($exam_filters['Exam Abr'])
                                        <td class="align-left">
                                            {{$value->es_exam_abr}}
                                        </td>
                                    @endif
                                    @if($exam_filters['start-end'])
                                        <td>
                                        {{$value->es_date_start.' - '.$value->es_date_end}}
                                        </td>
                                    @endif
                                    
                                    @if($exam_filters['Status'])
                                        <td class="align-left">
                                            @if($value->es_isactive) Active @else Inactive @endif
                                        </td>
                                    @endif
                                
                                    @if($exam_filters['Action'])
                                        <td class="align-middle"> 
                                            @if($access_role['R']==0 && 0)
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewCarouselModal" >View</button>
                                            @endif
                                            @if($access_role['U']==1)
                                            <button class="btn btn-success" wire:click="edit_exam_schedule({{$value->es_id}})" >Edit</button>
                                            @endif
                                            @if($access_role['D']==0)
                                            <button class="btn btn-danger" wire:click="delete_faq({{$value->es_id}})">Delete</button>
                                            @endif
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
                </section>
            </div>


            <div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editScheduleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editScheduleModalLabel">Edit Schedule</h5>
                            <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                        </div>
                        @if($exam_schedule['es_id'])
                            <form wire:submit.prevent="save_edit_exam_schedule({{$exam_schedule['es_id']}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="scheduleDate">Exam Details:</label>
                                        <input type="text" class="form-control" wire:model.defer="exam_schedule.es_exam_details" requird>
                                    </div>
                                    <div class="form-group">
                                        <label for="scheduleDate">Exam Abr:</label>
                                        <input type="text" class="form-control" wire:model.defer="exam_schedule.es_exam_abr" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="scheduleDate">Date Start:</label>
                                        <input type="date" class="form-control" wire:model.defer="exam_schedule.es_date_start" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="scheduleDate">Date End:</label>
                                        <input type="date" class="form-control" wire:model.defer="exam_schedule.es_date_end" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Active?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" wire:model="exam_schedule.es_isactive" value="1" required>
                                            <label class="form-check-label" for="Active">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" wire:model="exam_schedule.es_isactive" value="0" required>
                                            <label class="form-check-label" for="Active">Disabled</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" >Save</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="test-schedule" role="tabpanel" aria-labelledby="test-schedule-tab">
                <!-- Content for CET Test Schedule tab -->
                <div>
                    <!-- Add Schedule Button -->
                    <button class="btn btn-primary mt-2">Add Schedule</button>

                    <!-- CET Test Schedule Table -->
                    <div class="mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Test Date</th>
                                    <th scope="col">Test Center</th>
                                    <th scope="col">School Year</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- CET test schedule details -->
                                <tr>
                                    <td>November 5, 2023</td>
                                    <td>WMSU Main Campus, Z.C.</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <!-- Edit/Delete buttons or actions -->
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>November 12, 2023</td>
                                    <td>WMSU Main Campus, Z.C.</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <!-- Edit/Delete buttons or actions -->
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <!-- Add more CET test schedules dynamically here -->
                            </tbody>
                        </table>
                    </div>
                    <!-- ... -->
                    <!-- Additional features or details related to managing CET test schedules and rooms -->
                    <!-- ... -->
                </div>
            </div>



        </div>
    </main>
</div>