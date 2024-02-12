<div>
    <x-loading-indicator/>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Right side columns -->
        <!-- Insert Section -->
        <!-- content-->
        <section class="profile-section">
            <div class="container">
                <h2 class="profile-heading">Profile Information</h2>
                <div class="Applicant-container">
                    <div class="Applicant-info">
                        <div class="profile-box">
                            <div class="profile-image-container">
                                <input type="file" id="profileImageInput" style="display: none;">
                                <label for="profileImageInput" class="profile-image-label">
                                    <a target="blank"href="@if($user_details['user_profile_picture']== 'default.png')  @else {{asset('storage/images/original/'.$user_details['user_profile_picture'])}}@endif">
                                        <div class="profile-image">
                                        <img width="160px" width="height"style="border-radius:50%;" src="@if($user_details['user_profile_picture']== 'default.png'){{asset('images/contents/profile_picture/thumbnail/default.png')}} @else {{asset('storage/images/thumbnail/'.$user_details['user_profile_picture'])}} @endif" alt="">
                                            
                                        </div>
                                    </a>
                                </label>
                            </div>
                            <h3 class="mt-3">{{$user_details['user_name']}}</h3>
                            <!-- <p class="text-muted">Status: Registered</p> -->
                            <button id="modifyButtonProfile" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifyModal">Modify</button>
                        </div>
                    </div>
                    
            <!-- Modify Section Modal -->
            <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabel">Account Settings</h5>
                            <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <!-- Tab navigation for different settings -->
                            <ul class="nav nav-tabs" id="accountSettingsTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if($modal_active == 'photo') active @endif" href="#modify" role="tab" aria-controls="modify" aria-selected="true" wire:click="modal_active('photo')">Modify Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if($modal_active == 'password') active @endif" href="#changePassword" role="tab" aria-controls="changePassword" aria-selected="false" wire:click="modal_active('password')">Change Password</a>
                                </li>
                            </ul>


                            <!-- Tab content -->
                            <div class="tab-content" id="accountSettingsTabContent">
                                <!-- Modify Info Tab -->
                                <div class="tab-pane fade @if($modal_active == 'photo')  show active @endif"  id="modify" role="tabpanel" aria-labelledby="modify" >
                                    <!-- Form to modify username and profile image -->
                                    <form wire:submit.prevent="save_photo()">
                                        <div class="form-group mt-4">
                                            <label class="fas" for="newProfileImage ">Change profile picture:</label>
                                            <input type="file" class="form-control" wire:model.defer="photo" required  accept="image/png, image/jpeg" id="photo-{{$photo_id}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                        <!-- Add more fields to modify user details as needed -->
                                    </form>
                                </div>

                                <!-- Change Password Tab -->
                                <div class="tab-pane fade @if($modal_active == 'password') show active @endif" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
                                    <!-- Form to change password -->
                                    <form wire:submit.prevent="change_password()">
                                        <div class="form-group row mt-2">
                                            <label for="newFullName" class="col-sm-4 col-form-label">Current Password<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                                <input type="password"  wire:model.defer="current_password"  class="form-control" placeholder="Current Password" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="newFullName" class="col-sm-4 col-form-label">New Password<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                                <input type="password"  wire:model.defer="new_password"  class="form-control" placeholder="New Password" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="newFullName" class="col-sm-4 col-form-label">Confirm Password<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                                <input type="password"  wire:model.defer="confirm_password" class="form-control" placeholder="Confirm Password" required>
                                            </div>
                                        </div>
                                        <div>
                                        @if(isset($password_error)) <span class="error" style="color:red;">{{ $password_error }}</span> @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Applicant details -->
            <div class="applicant-details">
                <div class="details-box">
                    <h4>Profile Details</h4>
                    <ul class="list-group" id="applicantDetailsList">
                    <li class="list-group-item"><strong>First name: </strong>{{$user_details['user_firstname']}}</li>
                        <li class="list-group-item"><strong>Middle name: </strong> {{$user_details['user_middlename']}}</li>
                        <li class="list-group-item"><strong>Last name: </strong> {{$user_details['user_lastname']}}</li>
                        <li class="list-group-item"><strong>Suffix: </strong> {{$user_details['user_suffix']}}</li>
                        <li class="list-group-item"><strong>Gender: </strong> {{$user_details['user_gender_details']}}</li>
                        <li class="list-group-item"><strong>Age: </strong> {{floor((time() - strtotime($user_details['user_birthdate'])) / 31556926);}}</li>
                        <li class="list-group-item"><strong>Home Address: </strong> {{$user_details['user_address']}}</li>
                        <li class="list-group-item"><strong>Phone number: </strong> {{$user_details['user_phone']}}</li>
                        <li class="list-group-item"><strong>Email: </strong> {{$user_details['user_email']}} @if($user_details['user_email_verified']==1)<a href="../change-email">change</a>@else<a href="../change-email">verify</a>@endif</li>
                        <li class="list-group-item"><strong>Birthdate: </strong> {{date_format(date_create($user_details['user_birthdate']),"F d, Y ")}}</li>
                        <li class="list-group-item"><strong>Account Created: </strong> {{date_format(date_create( $user_details['date_created']),"F d, Y ")}}</li>
                    </ul>
                    <button id="modifyButtonDetails" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifyModalDetails">Modify</button>
                </div>

                <div class="modal fade" id="modifyModalDetails" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabelDetails" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifyModalLabelDetails">Modify Profile Details</h5>
                                <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </div>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <!-- Full Name -->
                                    <form wire:submit.prevent="save_profile_info()">
                                        <div class="form-group row mb-2">
                                            <label  class="col-sm-4 col-form-label">First name<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  wire:model="user_details.user_firstname" class="form-control" placeholder="Enter firstname" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Middle name<span style="color:red;"></span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  wire:model="user_details.user_middlename" class="form-control" placeholder="Enter middlename" >
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Last name<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  wire:model="user_details.user_lastname" class="form-control" placeholder="Enter lastname" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Suffix<span style="color:red;"></span> :</label>
                                            <div class="col-sm-8">
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
                                                    <!-- Add more suffix options as needed -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Gender<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8">
                                                <select wire:model="user_details.user_gender_details" class="form-control">
                                                    @if(isset($user_details['user_gender_details']) && strlen($user_details['user_gender_details']>0))
                                                        <option value="$user_details['user_gender_details']">
                                                    @else
                                                        <option value="">Select gender</option>
                                                    @endif
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Address Street:</label>
                                            <div class="col-sm-8">
                                                <input type="text" wire:model="user_details.user_addr_street" class="form-control" placeholder="Enter street">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Barangay:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" required list="brgy" wire:change="update_data()" wire:model="user_details.user_addr_brgy" placeholder="Type to search...">
                                                <datalist id="brgy" >
                                                    @if(isset($user_details['user_addr_brgy']))
                                                        <option value="$user_details['user_addr_brgy']">
                                                    @endif
                                                    @foreach($brgy_data as $key =>$value)
                                                    <option value="{{$value->brgyDesc}}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">City / Municipality<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" required list="muncity" wire:change="update_data()" wire:model="user_details.user_addr_city_mun" placeholder="Type to search...">
                                                <datalist id="muncity">
                                                    @if(isset($user_details['user_addr_brgy']))
                                                        <option value="{{$user_details['user_addr_city_mun']}}">
                                                    @endif
                                                    @if($mun_city_data)
                                                        @foreach($mun_city_data as $key =>$value)
                                                        <option value="{{$value->citymunDesc}}" >
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Province<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" required list="province" wire:change="update_data()" wire:model="user_details.user_addr_province" placeholder="Type to search...">
                                                <datalist id="province" >
                                                    @if(isset($user_details['user_addr_brgy']))
                                                        <option value="$user_details['user_addr_city_mun']">
                                                    @endif
                                                    @if($province_data)
                                                        @foreach($province_data as $key =>$value)
                                                        <option value="{{$value->provDesc}}" >
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">ZIP Code:</label>
                                            <div class="col-sm-8">
                                                <input type="text" wire:model="user_details.user_addr_zip_code" required class="form-control" placeholder="Enter ZIP code">
                                            </div>
                                        </div>
    
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Phone number<span style="color:red;"></span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  required wire:model="user_details.user_phone" class="form-control" placeholder="Enter phone number"  oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11);">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-sm-4 col-form-label">Birthdate<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="date"  wire:model="user_details.user_birthdate" class="form-control" placeholder="Enter birthdate" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- End Inserted Section -->

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- not nice - ace dev - https://github.com/Drusha01 -->
</div>
