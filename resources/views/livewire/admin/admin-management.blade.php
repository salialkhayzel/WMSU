<div>
    <x-loading-indicator/>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Admin management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Admin management</li>
                </ol>
            </nav>
        </div><!-- End Right side columns -->
        <!-- Insert Section -->
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link @if($active == 'admin_management') show active @endif " wire:key="admin_management"  wire:click="active_page('admin_management')" data-bs-toggle="tab" href="#admin-management-tab">Admin Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($active == 'user_management') show active @endif " wire:key="user_management"  wire:click="active_page('user_management')" data-bs-toggle="tab" href="#user-management-tab">User Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($active == 'role_management') show active @endif " wire:key="role_management"  wire:click="active_page('role_management')" data-bs-toggle="tab" href="#role-management-tab">Role Management</a>
            </li>
        </ul>
         <!-- Tab Content -->
        <div class="tab-content">
        <!-- Admin Management tab -->
        <div class="tab-pane fade @if($active == 'admin_management') show active @endif " id="admin-management-tab">
            <div class="container-fluid">
                <!-- Add Admin Button (Opens Add Modal) -->
                <div class="d-flex my-3">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#admin-data-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            <input class="form-control" type="text" id="search" placeholder="Search "  wire:change="search_applicant()"/> 
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                

                    <div class="modal fade" id="admin-data-filter" tabindex="-1" role="dialog" aria-labelledby="admin-data-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns for Admin Management</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($admin_data_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="assigned-filtering-{{$loop->iteration}}"
                                            wire:model.defer="admin_data_filter.{{$item}}">
                                        <label class="form-check-label" for="assigned-filtering-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block" data-bs-dismiss="modal"  id='btn_close1'>Close</button>
                                    <button wire:click="admin_data_filterView()"  data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success   mx-1"  wire:click="add_admin_modal()" >Add Admin</button>
                    </div>
                </div>
                
    
                <!-- Admin Table -->
                <div class="application-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            @foreach ($admin_data_filter as $item => $value)
                                @if($loop->last && $value )
                                    <th class="text-center">
                                        Action
                                    </th>
                                @elseif($value)
                                    <th>{{$item}}</th>
                                @endif
                            @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your table rows dynamically using server-side data or JavaScript -->
                            @forelse ($admin_data as $item => $value)
                            </tr>
                                @if($admin_data_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($admin_data_filter['Username'])
                                    <td>{{ $value->user_name }}</td>
                                @endif
                                @if($admin_data_filter['Full name'])
                                    <td>{{ $value->user_lastname.', '.$value->user_firstname.' '.$value->user_middlename }}</td>
                                @endif
                                @if($admin_data_filter['Email'])
                                    <td>{{ $value->user_email }}</td>
                                @endif
                                @if($admin_data_filter['CP#'])
                                    <td>{{ $value->user_phone }}</td>
                                @endif
                                @if($admin_data_filter['Verified'])
                                    <td class="text-center"> @if($value->user_email_verified) <i class="bi bi-check"></i> @else <i class="bi bi-x"></i> @endif </td>
                                @endif
                                @if($admin_data_filter['Status'])
                                    <td class='text-center'>
                                        {{ $value->user_status_details }}
                                    </td>
                                @endif
                                @if($admin_data_filter['Action'])
                                    <td class="text-center">
                                    @if($access_role['R']==1)
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewRoomModal" wire:click="view_admin({{$value->user_id }})">View</button>
                                    @endif
                                    @if($access_role['U']==1)
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditRoomModal" wire:click="edit_admin({{$value->user_id }})">Edit</button>
                                    @endif
                                    @if($access_role['D']==1)
                                        @if($value->user_status_details == 'deleted') 
                                            <button class="btn btn-warning" wire:click="activate_admin({{ $value->user_id }})">Activate</button>
                                        @else
                                        <button class="btn btn-danger" wire:click="delete_admin({{ $value->user_id }})">Delete</button>
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
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <!-- End Admin Table -->
            </div>
        </div>
        
        <div class="modal fade show" id="DeleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="DeleteAdminModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteAdminModalLabel">Delete User</h5>
                        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form wire:submit.prevent="delete_admin_now({{$delete_admin_user_id}})">
                        <div class="modal-body">
                            <p>Are you sure you want to delete this user?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Admin Modal -->
        <div class="modal fade show" id="adminAddModal" tabindex="-1" role="dialog" aria-labelledby="ViewAdminModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminAdminModalLabel">Add Admin</h5>
                        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form wire:submit.prevent="add_admin()">
                        <div class="modal-body">
                            <!-- Add Admin form -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="AddAdminFirstName">Username</label>
                                        <input type="text" class="form-control" wire:model.defer="admin_username" placeholder="Enter Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="AddAdminEmail">Email</label>
                                        <input type="email" class="form-control" wire:model.defer="admin_email" placeholder="Enter Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="AddAdminFirstName">First Name</label>
                                        <input type="text" class="form-control" wire:model.defer="admin_firstname" placeholder="Enter First Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="AddAdminMiddleName">Middle Name</label>
                                        <input type="text" class="form-control" wire:model.defer="admin_middlename" placeholder="Enter Middle Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="AddAdminLastName">Last Name</label>
                                        <input type="text" class="form-control" wire:model.defer="admin_lastname" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="AddAdminEmail">Birthdate</label>
                                        <input type="date" class="form-control" wire:model.defer="admin_birthdate" placeholder="Enter birthdate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="AddAdminEmail">Password</label>
                                        <input type="password" class="form-control" wire:model.defer="admin_password" placeholder="Enter password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="AddAdminEmail">Confirm Password</label>
                                        <input type="password" class="form-control" wire:model.defer="admin_confirm_password" placeholder="Confirm password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="AddAdminRole">Role</label>
                                        <select class="form-control" id="AddAdminRole" wire:model.defer="admin_role_name_id" required wire:change="update_admin_role()" required>
                                            <option value="">Select Role</option>
                                            @forelse ($roles_data as $item => $value)
                                            <option value="{{$value->admin_role_name_id}}">{{$value->admin_role_name_name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Test Center:</label>
                                        @foreach ($admin_testing_centers as $key =>$value)
                                            @if($loop->last)
                                                <div class=" d-flex">
                                                    <div class="col-8 ">
                                                        <select wire:key="testing-center-{{$key}}" required wire:change="check_admin_testing_centers({{$key}})" wire:model.defer="admin_testing_centers.{{$key}}.testing_center_id" class="form-select">
                                                            <option value="">Select Test Center</option>
                                                            @foreach ($test_center_data as $item => $value)
                                                                <option value="{{$value->id}}">{{$value->test_center_code.' - '.$value->test_center_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        @if($key !=0)
                                                        <button type="button" class="btn btn-danger" wire:click="delete_testing_center({{$key}})">Delete</button>
                                                        @endif
                                                        <button type="button" class="btn btn-success" wire:click="add_testing_center()">Add</button>
                                                    </div>
                                                </div>
                                            @else
                                            <div class=" d-flex">
                                                    <div class="col-8 ">
                                                        <select wire:key="testing-center-{{$key}}" required wire:change="check_admin_testing_centers({{$key}})" wire:model.defer="admin_testing_centers.{{$key}}.testing_center_id" class="form-select">
                                                            <option value="">Select Test Center</option>
                                                            @foreach ($test_center_data as $item => $value)
                                                                <option value="{{$value->id}}">{{$value->test_center_code.' - '.$value->test_center_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="button" class="btn btn-danger" wire:click="delete_testing_center({{$key}})">Delete</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>  
                            </div>
                            <br>
                            @if($sign_up_button)<div style="color:red;">{{$sign_up_button}}</div> @endif
                            <br>
                            <table class="application-table">
                                <tr>
                                    <th class="text-align center">Module</th>
                                    <th class="text-align center">Create</th>
                                    <th class="text-align center">Read</th>
                                    <th class="text-align center">Update</th>
                                    <th class="text-align center">Delete</th>
                                </tr>
                                @forelse ($modules as $item => $value)
                                <tr wire:key="{{$value->module_id}}">
                                    <td>{{$value->module_nav_name}}</td>
                                    <td class="text-center"><input type="checkbox" wire:model.defer="admin_access_role.{{$loop->index}}.C"></td>
                                    <td class="text-center"><input type="checkbox" wire:model.defer="admin_access_role.{{$loop->index}}.R"></td>
                                    <td class="text-center"><input type="checkbox" wire:model.defer="admin_access_role.{{$loop->index}}.U"></td>
                                    <td class="text-center"><input type="checkbox" wire:model.defer="admin_access_role.{{$loop->index}}.D"></td>
                                </tr>
                                @empty
                                <td class="text-center font-weight-bold" colspan="42">
                                    NO RECORDS
                                </td>
                                @endforelse
                            </table>
                            <!-- End Add Admin -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- View Admin Modal -->
        <div class="modal fade show" id="ViewAdminModal" tabindex="-1" role="dialog" aria-labelledby="ViewAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ViewAdminModalLabel">View Admin Details</h5>
                        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form>
                        <div class="modal-body">
                            <!-- View Admin Form -->
                            <div class="form-group">
                                <label for="editRoleName">Full Name</label>
                                <input type="text" disabled class="form-control" placeholder="Role name" wire:model.defer="admin_fullname" required>
                            </div>
                            <br>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="background-color:#990000; color:white;">Module</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Create</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Read</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Update</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($modules as $item => $value)
                                            <tr wire:key="{{$value->module_id}}">
                                                <td>{{$value->module_nav_name}}</td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.C"></td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.R"></td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.U"></td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.D"></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center font-weight-bold" colspan="5">NO RECORDS</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- End View Admin Form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

       <!-- Edit Admin Modal -->
<div class="modal fade show" id="EditAdminModal" tabindex="-1" role="dialog" aria-labelledby="EditAdminModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditAdminModalLabel">Edit Admin Details</h5>
                <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>
            </div>
            <form wire:submit.prevent="save_edit_admin({{$view_admin_user_id}})">
                <div class="modal-body">
                    <!-- User role Form -->
                    <div class="form-group">
                        <label for="editRoleName">Full Name</label>
                        <input type="text" disabled class="form-control" placeholder="Role name" wire:model.defer="admin_fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="addRoomCapacity">Test Center:</label>
                        @foreach ($admin_testing_centers as $key =>$value)
                            @if($loop->last)
                                <div class=" d-flex">
                                    <div class="col-8 ">
                                        <select wire:key="testing-center-{{$key}}" required wire:change="check_admin_testing_centers({{$key}})" wire:model.defer="admin_testing_centers.{{$key}}.testing_center_id" class="form-select">
                                            <option value="">Select Test Center</option>
                                            @foreach ($test_center_data as $item => $value)
                                                <option value="{{$value->id}}">{{$value->test_center_code.' - '.$value->test_center_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        @if($key !=0)
                                        <button type="button" class="btn btn-danger" wire:click="delete_testing_center({{$key}})">Delete</button>
                                        @endif
                                        <button type="button" class="btn btn-success" wire:click="add_testing_center()">Add</button>
                                    </div>
                                </div>
                            @else
                            <div class=" d-flex">
                                    <div class="col-8 ">
                                        <select wire:key="testing-center-{{$key}}" required wire:change="check_admin_testing_centers({{$key}})" wire:model.defer="admin_testing_centers.{{$key}}.testing_center_id" class="form-select">
                                            <option value="">Select Test Center</option>
                                            @foreach ($test_center_data as $item => $value)
                                                <option value="{{$value->id}}">{{$value->test_center_code.' - '.$value->test_center_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-danger" wire:click="delete_testing_center({{$key}})">Delete</button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background-color:#990000; color:white;">Module</th>
                                    <th class="text-center" style="background-color:#990000; color:white;">Create</th>
                                    <th class="text-center" style="background-color:#990000; color:white;">Read</th>
                                    <th class="text-center" style="background-color:#990000; color:white;">Update</th>
                                    <th class="text-center" style="background-color:#990000; color:white;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($modules as $item => $value)
                                    <tr wire:key="{{$value->module_id}}">
                                        <td>{{$value->module_nav_name}}</td>
                                        <td class="text-center"><input type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.C"></td>
                                        <td class="text-center"><input type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.R"></td>
                                        <td class="text-center"><input type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.U"></td>
                                        <td class="text-center"><input type="checkbox" wire:model.defer="view_admin_roles.{{$loop->index}}.D"></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center font-weight-bold" colspan="5">NO RECORDS</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- End Edit role Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

        
        <!-- Edit Admin Modal -->
        <!-- <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
                        <div type="button" class="close"  data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <div class="modal-body"> -->
                        <!-- Admin Edit Form -->
                        <!-- <form>
                            <div class="form-group">
                                <label for="editAdminFirstName">First Name</label>
                                <input type="text" class="form-control" id="editAdminFirstName" placeholder="Edit First name">
                            </div>
                            <div class="form-group">
                                <label for="editAdminMiddleName">Middle Name</label>
                                <input type="text" class="form-control" id="editAdminMiddleName" placeholder="Edit Middle Name">
                            </div>
                            <div class="form-group">
                                <label for="editAdminLastName">Last Name</label>
                                <input type="text" class="form-control" id="editAdminLastName" placeholder="Edit Last Name">
                            </div>
                            <div class="form-group">
                                <label for="editAdminEmail">Email</label>
                                <input type="email" class="form-control" id="editAdminEmail" placeholder="Enter new Email">
                            </div>
                            <div class="form-group">
                                <label for="editAdminRole">Role</label>
                                <select class="form-control" id="editAdminRole">
                                    <option value="admin">Administrator</option>
                                    <option value="moderator">Moderator</option>
                                </select>
                            </div>
                        </form> -->
                        <!-- End Admin Edit Form -->
                    <!-- </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End Edit Admin Modal -->

        
        <!-- User Management tab -->
        <div class="tab-pane @if($active == 'user_management') show active @endif " id="user-management-tab">
            <div class="container-fluid">  
                <!-- Add user Button (Opens Add user Modal) -->
                <div class="d-flex my-3">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#user-data-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            <input class="form-control" type="text" id="search" placeholder="Search "  wire:change="search_applicant()"/> 
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                

                    <div class="modal fade" id="user-data-filter" tabindex="-1" role="dialog" aria-labelledby="user-data-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns for User Management</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($user_data_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="assigned-filtering-{{$loop->iteration}}"
                                            wire:model.defer="user_data_filter.{{$item}}">
                                        <label class="form-check-label" for="assigned-filtering-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block" data-bs-dismiss="modal"  id='btn_close1'>Close</button>
                                    <button wire:click="user_data_filterView()"  data-bs-dismiss="modal" 
                                        class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        
                    </div>
                </div>         
                <!-- User Table -->
                <div class="application-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            @foreach ($user_data_filter as $item => $value)
                                @if($loop->last && $value )
                                    <th class="text-center">
                                        Action
                                    </th>
                                @elseif($value)
                                    <th>{{$item}}</th>
                                @endif
                            @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <!--  table -->
                            @forelse ($user_data as $item => $value)
                                <tr>
                                @if($user_data_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($user_data_filter['Username'])
                                    <td>{{ $value->user_name }}</td>
                                @endif
                                @if($user_data_filter['Full name'])
                                    <td>{{ $value->user_lastname.', '.$value->user_firstname.' '.$value->user_middlename }}</td>
                                @endif
                                @if($user_data_filter['Email'])
                                    <td>{{ $value->user_email }}</td>
                                @endif
                                @if($user_data_filter['CP#'])
                                    <td>{{ $value->user_phone }}</td>
                                @endif
                                @if($user_data_filter['Verified'])
                                    <td class="text-center"> @if($value->user_email_verified) <i class="bi bi-check"></i> @else <i class="bi bi-x"></i> @endif </td>
                                @endif
                                @if($user_data_filter['Status'])
                                    <td class='text-center'>
                                        {{ $value->user_status_details }}
                                    </td>
                                @endif
                                @if($user_data_filter['Action'])
                                    <td class="text-center">
                                        @if($value->user_status_details == 'deleted') 
                                            <button class="btn btn-warning" wire:click="activate_admin({{ $value->user_id }})">Activate</button>
                                        @else
                                        <button class="btn btn-danger" wire:click="delete_admin({{ $value->user_id }})">Delete</button>
                                        @endif
                                    </td>
                                @endif
                                </tr>
                            @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                NO RECORDS 
                            </td>
                            @endforelse
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <!-- End User Table -->
            </div>
        </div>
        <!-- Add User Modal -->
      
        <!-- End Edit User Modal -->
        <!-- Role Management tab -->
        <div class="tab-pane @if($active == 'role_management') show active @endif " id="role-management-tab">
            <div class="container-fluid">
            <!--
            <p>This section enables you to manage user roles and permissions.</p>
            <p>You can define different roles, assign permissions to each role, and allocate roles to users.</p> -->
            <div class="d-flex my-3">
                    
                    
                
            

                <div class="modal fade" id="assigned-room-filter" tabindex="-1" role="dialog" aria-labelledby="unassigned-room-filterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns for Assigned Room</h5>
                            </div>
                            <hr>
                            <div class="modal-body">
                                @foreach($admin_data_filter as $item => $value)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="assigned-filtering-{{$loop->iteration}}"
                                        wire:model.defer="admin_data_filter.{{$item}}">
                                    <label class="form-check-label" for="assigned-filtering-{{$loop->iteration}}">
                                        {{$item}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-secondary btn-block" data-bs-dismiss="modal"  id='btn_close1'>Close</button>
                                <button wire:click="admin_data_filterView()"  data-bs-dismiss="modal" 
                                    class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success   mx-1"  wire:click="new_role()" >Add Role</button>
                </div>
            </div>
                
                <!-- Role Table -->
                <div class="table-responsive">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th style="background-color:#990000; color:white;">#</th>
                                <th style="background-color:#990000; color:white;">Role Name</th>
                                <th style="background-color:#990000; color:white;">Description</th>
                                <th class="text-center" style="background-color:#990000; color:white;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your table rows dynamically using server-side data or JavaScript -->
                            @forelse ($roles_data as $item => $value)
                            <tr >
                                @if($roles_data_filter['#'] )
                                <td >{{$loop->index+1}}</td>
                                @endif
                                @if($roles_data_filter['Role Name'] )
                                <td >{{$value->admin_role_name_name}}</td>
                                @endif
                                @if($roles_data_filter['Description'] )
                                <td >{{$value->admin_role_name_details}}</td>
                                @endif
                                @if($roles_data_filter['Action'] )
                                <td class="text-center">
                                    @if($access_role['R']==1)
                                    <button class="btn btn-primary"  wire:click="view_role({{$value->admin_role_name_id }})">View</button>
                                    @endif
                                    @if($access_role['U']==1)
                                    <button class="btn btn-success"  wire:click="edit_role({{$value->admin_role_name_id }})">Edit</button>
                                    @endif
                                    @if($access_role['D']==1)
                                    <button class="btn btn-danger" wire:click="delete_role({{ $value->admin_role_name_id }})">Delete</button>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                NO RECORDS 
                            </td>
                            @endforelse
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <!-- End Role Table -->
            </div>
        </div>

        <!-- Add Role Modal -->
        <div class="modal fade show" id="AddRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Add Role</h5>
                        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form wire:submit.prevent="add_new_role()">
                        <div class="modal-body">
                            <!-- User role Form -->
                            <div class="form-group">
                                <label for="editRoleName">Role Name</label>
                                <input type="text" class="form-control" placeholder="Role name" wire:model.defer="access_role_name" required>
                            </div>
                            <div class="form-group">
                                <label for="editDescription">Description</label>
                                <input type="text" class="form-control" placeholder="Edit Description" wire:model.defer="access_role_description">
                            </div>
                            <br>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="background-color:#990000; color:white;">Module</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Create</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Read</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Update</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($modules as $item => $value)
                                            <tr wire:key="{{$value->module_id}}">
                                                <td>{{$value->module_nav_name}}</td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="access_roles.{{$loop->index}}.C"></td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="access_roles.{{$loop->index}}.R"></td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="access_roles.{{$loop->index}}.U"></td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="access_roles.{{$loop->index}}.D"></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center font-weight-bold" colspan="5">NO RECORDS</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Add Role Form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- View Role Modal -->
        <div class="modal fade show" id="ViewRoleModal" tabindex="-1" role="dialog" aria-labelledby="ViewRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ViewRoleModalLabel">View Role</h5>
                        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form>
                        <div class="modal-body">
                            <!-- View Role Form -->
                            <div class="form-group">
                                <label for="editRoleName">Role Name</label>
                                <input type="text" disabled class="form-control" placeholder="Role name" wire:model.defer="role_name_details.0.admin_role_name_name" required>
                            </div>
                            <div class="form-group">
                                <label for="editDescription">Description</label>
                                <input type="text" disabled class="form-control" placeholder="Edit Description" wire:model.defer="role_name_details.0.admin_role_name_details">
                            </div>
                            <br>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="background-color:#990000; color:white;">Module</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Create</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Read</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Update</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($modules as $item => $value)
                                            <tr wire:key="{{$value->module_id}}">
                                                <td>{{$value->module_nav_name}}</td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_access_role.{{$loop->index}}.C"></td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_access_role.{{$loop->index}}.R"></td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_access_role.{{$loop->index}}.U"></td>
                                                <td class="text-center"><input disabled type="checkbox" wire:model.defer="view_access_role.{{$loop->index}}.D"></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center font-weight-bold" colspan="5">NO RECORDS</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- End View Role Form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <!-- Edit Role Modal -->
        <div class="modal fade show" id="EditRoleModal" tabindex="-1" role="dialog" aria-labelledby="EditRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditRoleModalLabel">Edit Role</h5>
                        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form wire:submit.prevent="edit_selected_role()">
                        <div class="modal-body">
                            <!-- Edit Role Form -->
                            <div class="form-group">
                                <label for="editRoleName">Role Name</label>
                                <input type="text" class="form-control" placeholder="Role name" wire:model.defer="role_name_details.0.admin_role_name_name" required>
                            </div>
                            <div class="form-group">
                                <label for="editDescription">Description</label>
                                <input type="text" class="form-control" placeholder="Edit Description" wire:model.defer="role_name_details.0.admin_role_name_details">
                            </div>
                            <br>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="background-color:#990000; color:white;">Module</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Create</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Read</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Update</th>
                                            <th class="text-center" style="background-color:#990000; color:white;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($modules as $item => $value)
                                            <tr wire:key="{{$value->module_id}}">
                                                <td>{{$value->module_nav_name}}</td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="edit_access_role.{{$loop->index}}.C"></td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="edit_access_role.{{$loop->index}}.R"></td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="edit_access_role.{{$loop->index}}.U"></td>
                                                <td class="text-center"><input type="checkbox" wire:model.defer="edit_access_role.{{$loop->index}}.D"></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center font-weight-bold" colspan="5">NO RECORDS</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Edit Role Form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Role Modal -->
        <!-- <div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleModalLabel">Delete Role</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="delete_role()">
                        <div class="modal-body">
                            <p>Are you sure you want to delete this role?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->

        <!-- End Edit User Modal -->
        <!-- End Inserted Section -->
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>
