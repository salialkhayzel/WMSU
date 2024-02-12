<div>
    <!-- Main Content -->
    <x-loading-indicator/>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Program</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Program</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link show @if($active == 'Colleges') show active @endif " wire:key="Colleges" wire:click="active_page('Colleges')" href="#college-tab">Colleges</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($active == 'Departments') show active @endif " wire:key="Departments" wire:click="active_page('Departments')"href="#departments-tab">Departments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($active == 'Campuses') show active @endif " wire:key="Campuses" wire:click="active_page('Campuses')"href="#Campuses-tab">Campuses</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <div class="tab-pane fade fade @if($active == 'Colleges') show active @endif ">
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" wire:click="add_college()" >Add College</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#College-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 

                    <div class="modal fade" id="College-filter" tabindex="-1" role="dialog" aria-labelledby="College-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="College-filterLabel">Sort&nbsp;Columns for FAQ</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($college_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="College-filter-{{$loop->iteration}}"
                                            wire:model.defer="college_filter.{{$item}}">
                                        <label class="form-check-label" for="College-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="filterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <table class="application-table">
                    <thead>
                        <tr>
                            @foreach ($college_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($college_data  as $item => $value)
                            <tr>
                                @if($college_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($college_filter['Logo'])
                                    <td>
                                        <img src="{{asset('storage/content/programs/colleges/'.$value->college_logo)}}" alt="" style="height: 200px; ">
                                    </td>
                                @endif
                                @if($college_filter['Campus'])
                                    <td>
                                        <div>
                                            {{$value->campus_name}}
                                        </div>
                                    </td>
                                @endif
                                @if($college_filter['Header'])
                                    <td>
                                        <div>
                                            {{$value->college_header}}
                                        </div>
                                    </td>
                                @endif
                                @if($college_filter['Content'])
                                    <td class="align-middle">
                                        <p>{{$value->college_content}}</p>
                                    </td>
                                @endif
                                @if($college_filter['Order'])
                                    <td class="align-middle"> 
                                        <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_up_college({{$value->college_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_down_college({{$value->college_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        </div>
                                    </td>
                                @endif
                                @if($college_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==0)
                                        <button class="btn btn-primary" wire:click="view_college({{$value->college_id}})" >View</button>
                                        @endif
                                        @if($access_role['U']==1)
                                        <button class="btn btn-success" wire:click="edit_college({{$value->college_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==1)
                                        <button class="btn btn-danger" wire:click="delete_college({{$value->college_id}})">Delete</button>
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
                <div class="modal fade" id="addCollegeModal" tabindex="-1" role="dialog" aria-labelledby="addCollegeModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCollegeModalLabel">Add College</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_college()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <select wire:model.defer="college.college_campus_id" class="form-select" aria-label="Default select example">
                                            <option value="0">Select Campus</option>
                                            @foreach ($campus_data  as $item => $value)
                                                <option value="{{$value->campus_id}}">{{$value->campus_abr.' '.$value->campus_name.' '.$value->campus_location}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Logo</label>
                                        <input  type="file" accept="image/jpg" accept="image/jpg" class="form-control" wire:model.defer="college.college_logo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="college.college_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Contents:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="college.college_content" required></textarea>
                                    </div>
                                  
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="EditCollegeModal" tabindex="-1" role="dialog" aria-labelledby="EditCollegeModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditCollegeModalLabel">Edit College</h5>
                            </div>
                            <hr>
                            @if($college['college_id'])
                                <form wire:submit.prevent="save_edit_college({{$college['college_id']}})">
                                    <div class="modal-body">
                                        <select wire:model.defer="college.college_campus_id" class="form-select" aria-label="Default select example">
                                            <option value="0">Select Campus</option>
                                            @foreach ($campus_data  as $item => $value)
                                                <option value="{{$value->campus_id}}">{{$value->campus_abr.' '.$value->campus_name.' '.$value->campus_location}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Logo</label>
                                            <input  type="file" accept="image/jpg" class="form-control" wire:model.defer="college.college_logo" >
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Header:</label>
                                            <input  type="text" class="form-control" wire:model.defer="college.college_header" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Contents:</label>
                                            <textarea  type="text" class="form-control" wire:model.defer="college.college_content" required></textarea>
                                        </div>
                                    
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button type="submit" class="btn btn-success">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="DeleteCollegeModal" tabindex="-1" role="dialog" aria-labelledby="DeleteCollegeModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteCollegeModalLabel">Edit College</h5>
                            </div>
                            <hr>
                            @if($college['college_id'])
                                <form wire:submit.prevent="save_delete_college({{$college['college_id']}})">
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this college?</p>
                                        <p><h6>Note:</h6>departments will also get deleted along with it!</p>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="tab-pane fade @if($active == 'Departments') show active @endif ">
                <div class="d-flex mt-2">
                    <label class="filter-label align-self-center " for="exam-filter">Select College:</label>
                    <select class="filter-select " id="exam-filter" wire:model="college_id" wire:change="college_filter()">
                        @foreach ($college_data as $item => $value)
                            <option value="{{$value->college_id}}" >{{$value->college_header}}</option>
                                                    
                        @endforeach
                        
                        <!-- Add more options as needed -->
                    </select>
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
                                    @foreach($department_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                            wire:model.defer="department_filter.{{$item}}">
                                        <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="filterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-10">
                
                        <button class="btn btn-success mx-1" wire:click="add_department()" >Add Department to {{$department_college_name}} </button>
                    </div>
                </div>

                <table class="application-table">
                    <thead>
                        <tr>
                            @foreach ($department_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($department_data  as $item => $value)
                            <tr>
                                @if($department_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($department_filter['Logo'])
                                    <td>
                                        <img src="{{asset('storage/content/programs/departments/'.$value->department_logo)}}" alt="" style="height: 200px; ">
                                    </td>
                                @endif
                                @if($department_filter['College'])
                                    <td>
                                        {{$department_college_name}}
                                    </td>
                                @endif
                                @if($department_filter['Header'])
                                    <td>
                                        {{$value->department_name}}
                                    </td>
                                @endif
                                @if($department_filter['Content'])
                                    <td class="align-middle">
                                        <p>{{$value->department_details}}</p>
                                    </td>
                                @endif
                                @if($department_filter['Order'])
                                    <td class="align-middle"> 
                                        <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_up_department({{$value->department_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_down_department({{$value->department_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        </div>
                                    </td>
                                @endif
                                @if($department_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==0)
                                        <button class="btn btn-primary" wire:click="view_department({{$value->department_id}})" >View</button>
                                        @endif
                                        @if($access_role['U']==1)
                                        <button class="btn btn-success" wire:click="edit_department({{$value->department_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==1)
                                        <button class="btn btn-danger" wire:click="delete_department({{$value->department_id}})">Delete</button>
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



                <div class="modal fade" id="AddDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="AddDepartmentModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddDepartmentModalLabel">Add Department to {{$department_college_name}}</h5>
                            </div>
                            <hr>
                            @if($college_id)
                                <form wire:submit.prevent="save_add_department({{$college_id}})">
                                    <div class="modal-body">
                                    <div class="form-group">
                                            <label for="addRoomCapacity">College:</label>
                                            <input  type="text" class="form-control" value="{{$department_college_name}}" required disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department Logo</label>
                                            <input  type="file" accept="image/jpg" class="form-control" wire:model.defer="department.department_logo" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department Name:</label>
                                            <input  type="text" class="form-control" wire:model.defer="department.department_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department abreviation:</label>
                                            <input  type="text" class="form-control" wire:model.defer="department.department_abr" >
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department Details:</label>
                                            <textarea  type="text" class="form-control" wire:model.defer="department.department_details" required></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button type="submit" class="btn btn-success">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="EditDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="EditDepartmentModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditDepartmentModalLabel">Edit Department of {{$department_college_name}}</h5>
                            </div>
                            <hr>
                            @if($department['department_id'])
                                <form wire:submit.prevent="save_edit_department({{$department['department_id']}})">
                                    <div class="modal-body">
                                    <div class="form-group">
                                            <label for="addRoomCapacity">College:</label>
                                            <input  type="text" class="form-control" value="{{$department_college_name}}" required disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department Logo</label>
                                            <input  type="file" accept="image/jpg" class="form-control" wire:model.defer="department.department_logo" >
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department Name:</label>
                                            <input  type="text" class="form-control" wire:model.defer="department.department_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department abreviation:</label>
                                            <input  type="text" class="form-control" wire:model.defer="department.department_abr" >
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Department Details:</label>
                                            <textarea  type="text" class="form-control" wire:model.defer="department.department_details" required></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button type="submit" class="btn btn-success">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="DeleteDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="DeleteDepartmentModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteDepartmentModalLabel">Edit College</h5>
                            </div>
                            <hr>
                            @if($department['department_id'])
                                <form wire:submit.prevent="save_delete_department({{$department['department_id']}})">
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this department?</p>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade @if($active == 'Campuses') show active @endif ">
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn" type="button" data-bs-toggle="modal" data-bs-target="#campus-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            <input class="form-control" type="text" id="search" placeholder="Search "  wire:change="search_applicant()"/> 
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="campus-filter" tabindex="-1" role="dialog" aria-labelledby="campus-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($campus_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                            wire:model.defer="campus_filter.{{$item}}">
                                        <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="filterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-10">
                        <button class="btn btn-success mx-1" wire:click="add_campus()" >Add Campus </button>
                    </div>
                </div>

                <table class="application-table">
                    <thead>
                        <tr>
                            @foreach ($campus_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($campus_data  as $item => $value)
                            <tr>
                                @if($campus_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                               
                                @if($campus_filter['Campus Name'])
                                    <td>
                                        {{$value->campus_name}}
                                    </td>
                                @endif
                                @if($campus_filter['Campus Location'])
                                    <td>
                                        {{$value->campus_location}}
                                    </td>
                                @endif
                                @if($campus_filter['Campus Abr'])
                                    <td>
                                        {{$value->campus_abr}}
                                    </td>
                                @endif
                                @if($campus_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==0)
                                        <button class="btn btn-primary" wire:click="view_campus({{$value->campus_id}})" >View</button>
                                        @endif
                                        @if($access_role['U']==1)
                                        <button class="btn btn-success" wire:click="edit_campus({{$value->campus_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==1)
                                        <button class="btn btn-danger" wire:click="delete_campus({{$value->campus_id}})">Delete</button>
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

                <div class="modal fade" id="AddCampusModal" tabindex="-1" role="dialog" aria-labelledby="AddCampusModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddCampusModalLabel">Add Campus</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_campus()">
                                <div class="modal-body">
                                <div class="form-group">
                                        <label for="addRoomCapacity">Campus Name:</label>
                                        <input  type="text" class="form-control" wire:model.defer="campus.campus_name" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Campus Location</label>
                                        <input  type="text" class="form-control" wire:model.defer="campus.campus_location" >
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Campus ABR:</label>
                                        <input  type="text" class="form-control" wire:model.defer="campus.campus_abr" >
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="EditCampusModal" tabindex="-1" role="dialog" aria-labelledby="EditCampusModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditCampusModalLabel">Edit Campus</h5>
                            </div>
                            <hr>
                            @if(isset($campus['campus_id']))
                                <form wire:submit.prevent="save_edit_campus({{$campus['campus_id']}})">
                                    <div class="modal-body">
                                    <div class="form-group">
                                            <label for="addRoomCapacity">Campus Name:</label>
                                            <input  type="text" class="form-control" wire:model.defer="campus.campus_name" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Campus Location</label>
                                            <input  type="text" class="form-control" wire:model.defer="campus.campus_location" >
                                        </div>
                                        <div class="form-group">
                                            <label for="addRoomCapacity">Campus ABR:</label>
                                            <input  type="text" class="form-control" wire:model.defer="campus.campus_abr" >
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button type="submit" class="btn btn-success">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="DeleteCampusModal" tabindex="-1" role="dialog" aria-labelledby="EditCampusModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditCampusModalLabel">Delete Campus</h5>
                            </div>
                            <hr>
                            @if(isset($campus['campus_id']))
                                <form wire:submit.prevent="save_delete_campus({{$campus['campus_id']}})">
                                    <div class="modal-body">
                                    <div class="form-group">
                                        Are you sure you want to delete the campus ?
                                        <br>

                                        Note that colleges under that campus might also get deleted along with it...
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>


            </div>

        <!-- Add Announcement Modal -->
       

    
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>
