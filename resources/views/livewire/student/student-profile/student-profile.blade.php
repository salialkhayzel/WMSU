<div>
    <!-- content-->
    <section class="profile-section">
    <div class="container">
    <div class="Applicant-container">
        <!-- Profile Section -->
        <div class="Applicant-info">
            <div class="profile-box">
                <h4>
                    Profile
                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#profileCollapse" aria-expanded="true" aria-controls="profileCollapse">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </h4>
                <div id="profileCollapse" class="collapse show">
                    <label for="profileImageInput" class="profile-image-label">
                        <a target="blank" href="@if($user_details['user_profile_picture'] == 'default.png') @else {{asset('storage/images/original/'.$user_details['user_profile_picture'])}} @endif">
                            <div class="profile-image">
                                @if($user_details['user_profile_picture'] == 'default.png')
                                <i class="fas fa-user fa-5x"></i>
                                @else
                                <img style="border-radius: 50%;" width="150" height="150" src="{{asset('storage/images/resize/'.$user_details['user_profile_picture'])}}" alt="">
                                @endif
                            </div>
                        </a>
                    </label>
                    <h3 class="mt-3">{{$user_details['user_name']}}</h3>
                    <button id="modifyButtonProfile" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modifyModalPhoto">Change Profile</button>
                    <br>
                    <button id="modifyButtonpassword" class="btn btn-danger" data-toggle="modal" data-target="#modifyModalpassword">Change Password</button>
                </div>
                <div class="modal fade" id="modifyModalPhoto" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabelDetails" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifyModalLabelDetails">Change Profile photo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="update_profile_and_id()">
                                    <!-- Full Name -->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label mb-5">Profile photo<span style="color:red;"></span> :</label>
                                        <div class="col-sm-8">
                                            <input type="file" accept="image/png, image/jpeg" wire:model="photo" class="form-control" id="newFullName" placeholder="Current Password"></input>
                                        </div>
                                    </div>
                                    <div>
                                        @if(isset($profile_photo_error))
                                            <span class="error" style="color:red;">{{ $profile_photo_error }}</span>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modify Password Modal -->
                <div class="modal fade" id="modifyModalpassword" tabindex="-1" role="dialog" aria-labelledby="modifyModalpassword" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifyModalLabelDetails">Change password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <!-- Full Name -->
                                    <form wire:submit.prevent="change_password()">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Current Password<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="password"  wire:model="current_password"  class="form-control" placeholder="Current Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">New Password<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="password"  wire:model="new_password" wire:keyup.debounce.500ms="new_password()" class="form-control" placeholder="New Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Confirm Password<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="password"  wire:model="confirm_password" wire:keyup.debounce.500ms="confirm_password"class="form-control" placeholder="Confirm Password" required>
                                            </div>
                                        </div>
                                        <div>
                                        @if(isset($password_error)) <span class="error" style="color:red;">{{ $password_error }}</span> @endif
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

        <!-- Profile Details Section -->
        <div class="applicant-details">
            <div class="details-box">
                <h4>Profile Details
                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#detailsCollapse" aria-expanded="true" aria-controls="detailsCollapse">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </h4>
                <div id="detailsCollapse" class="collapse show">
                    <ul class="list-group" id="applicantDetailsList">
                        <li class="list-group-item"><strong>First name: </strong>{{$user_details['user_firstname']}}</li>
                        <li class="list-group-item"><strong>Middle name: </strong> {{$user_details['user_middlename']}}</li>
                        <li class="list-group-item"><strong>Last name: </strong> {{$user_details['user_lastname']}}</li>
                        <li class="list-group-item"><strong>Suffix: </strong> {{$user_details['user_suffix']}}</li>
                        <li class="list-group-item"><strong>Citizenship: </strong> {{$user_details['user_citizenship']}}</li>
                        <li class="list-group-item"><strong>Gender: </strong> {{$user_details['user_gender_details']}}</li>
                        <li class="list-group-item"><strong>Age: </strong> {{floor((time() - strtotime($user_details['user_birthdate'])) / 31556926);}}</li>
                        <li class="list-group-item"><strong>Home Address: </strong> {{$user_details['user_address']}}</li>
                        <li class="list-group-item"><strong>Phone number: </strong> {{$user_details['user_phone']}}</li>
                        <li class="list-group-item"><strong>Email: </strong> {{$user_details['user_email']}} @if($user_details['user_email_verified']==1)<a href="../change-email">change</a>@else<a href="../change-email">verify</a>@endif</li>
                        <li class="list-group-item"><strong>Birthdate: </strong> {{date_format(date_create($user_details['user_birthdate']), "F d, Y ")}}</li>
                        <li class="list-group-item"><strong>Account Created: </strong> {{date_format(date_create( $user_details['date_created']), "F d, Y ")}}</li>
                    </ul>
                    <br>
                    <button id="modifyButtonDetails" class="btn btn-primary " data-toggle="modal" data-target="#modifyModalDetails">Modify</button>
                </div>

                <div class="modal fade" id="modifyModalDetails" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabelDetails" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifyModalLabelDetails">Modify Profile Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <!-- Full Name -->
                                    <form wire:submit.prevent="save_profile_info()">
                                        <div class="form-group row">
                                            <label  class="col-sm-4 col-form-label">First name<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  wire:model="user_details.user_firstname" class="form-control" placeholder="Enter firstname" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Middle name<span style="color:red;"></span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  wire:model="user_details.user_middlename" class="form-control" placeholder="Enter middlename" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Last name<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  wire:model="user_details.user_lastname" class="form-control" placeholder="Enter lastname" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
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

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Gender<span style="color:red;"></span>:</label>
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
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Citizenship<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" wire:model="user_details.user_citizenship" required class="form-control" placeholder="Enter citizenship">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Address Street:</label>
                                            <div class="col-sm-8">
                                                <input type="text" wire:model="user_details.user_addr_street" class="form-control" placeholder="Enter street">
                                            </div>
                                            
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Barangay<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8"  data-bs-toggle="dropdown" wire:ignore.self>
                                                <input class="form-control" required  wire:keyup="update_location()" wire:click="update_location()" wire:model="user_details.user_addr_brgy" placeholder="Type to search...">
                                            </div>
                                            <div class="dropdown-menu dropdown col-sm-7 mx-2" wire:ignore.self>
                                                @foreach($brgy_data as $key =>$value)
                                                <li class="list-group-item"   wire:key="brgy-{{$value->id}}" wire:click="update_brgy('{{$value->brgyDesc}}')"> <a href="#" data-bs-toggle="dropdown">{{$value->brgyDesc}}</a></li>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Municipality<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8"  data-bs-toggle="dropdown" wire:ignore.self>
                                                <input class="form-control" required  wire:keyup="update_location()" wire:click="update_location()" wire:model="user_details.user_addr_city_mun" placeholder="Type to search...">
                                            </div>
                                            <div class="dropdown-menu dropdown col-sm-7 mx-2" wire:ignore.self>
                                                @foreach($mun_city_data as $key =>$value)
                                                <li class="list-group-item"   wire:key="muncity-{{$value->id}}" wire:click="update_muncity('{{$value->citymunDesc}}')"> <a href="#" data-bs-toggle="dropdown">{{$value->citymunDesc}}</a></li>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Province<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8"  data-bs-toggle="dropdown" wire:ignore.self>
                                                <input class="form-control" required  wire:keyup.="update_location()" wire:click="update_location()" wire:model="user_details.user_addr_province" placeholder="Type to search...">
                                            </div>
                                            <div class="dropdown-menu dropdown col-sm-7 mx-2" wire:ignore.self>
                                                @foreach($province_data as $key =>$value)
                                                <li class="list-group-item"   wire:key="province-{{$value->id}}" wire:click="update_province('{{$value->provDesc}}')"> <a href="#" data-bs-toggle="dropdown">{{$value->provDesc}}</a></li>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">ZIP Code<span style="color:red;">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" wire:model="user_details.user_addr_zip_code" required class="form-control" placeholder="Enter ZIP code">
                                            </div>
                                        </div>
    
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Phone number<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                            <input type="text"  required wire:model="user_details.user_phone" class="form-control" placeholder="Enter phone number"  oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11);">
                                            </div>
                                        </div>
                                        <div class="form-group row">
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
    </div>

        <!-- Family Background Section -->
        <div class="details-box mt-3 d-none">
            <div class="family-background">
                <h4>Family Background
                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#familyBackgroundCollapse" aria-expanded="true" aria-controls="familyBackgroundCollapse">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </h4>
                <div id="familyBackgroundCollapse" class="collapse show">
                    <div class="row justify-content-center">
                        <div class="details-box col-lg-6 mb-4">
                            <h5>Father's Information</h5>
                            <ul class="list-group" id="familyBackgroundList">
                                <li class="list-group-item"><strong>Father's first name: </strong> {{$f_firstname}}</li>
                                <li class="list-group-item"><strong>Father's middle name: </strong> {{$f_middlename}} </li>
                                <li class="list-group-item"><strong>Father's last name: </strong> {{$f_lastname}}</li>
                                <li class="list-group-item"><strong>Father's suffix name: </strong> {{$f_suffix}}</li>
                            </ul>
                        </div>
                        <div class="details-box col-lg-6 mb-4">
                            <h5>Mother's Information</h5>
                            <ul class="list-group" id="familyBackgroundList">
                                <li class="list-group-item"><strong>Mother's first name: </strong> {{$m_firstname}}</li>
                                <li class="list-group-item"><strong>Mother's middle name: </strong> {{$m_middlename}}</li>
                                <li class="list-group-item"><strong>Mother's last name: </strong> {{$m_lastname}}</li>
                                <li class="list-group-item"><strong>Mother's suffix: </strong> {{$m_suffix}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="details-box col-lg-12 mb-4">
                            <h5>Guardian's Information</h5>
                            <ul class="list-group" id="familyBackgroundList">
                                <li class="list-group-item"><strong>Guardian's first name: </strong> {{$g_firstname}}</li>
                                <li class="list-group-item"><strong>Guardian's middle name: </strong> {{$g_middlename}} </li>
                                <li class="list-group-item"><strong>Guardian's last name: </strong> {{$g_lastname}}</li>
                                <li class="list-group-item"><strong>Guardian's suffix name: </strong> {{$g_suffix}}</li>
                                <li class="list-group-item"><strong>Guardian's Relationship: </strong> {{$g_relationship}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="details-box col-lg-12 mb-4">
                            <h5>Siblings</h5>
                            <ul class="list-group" id="familyBackgroundList">
                                <li class="list-group-item"><strong>Number of Siblings: </strong> {{$number_of_siblings}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="details-box col-lg-12 mb-4">
                            <h5>Family Home Address</h5>
                            <ul class="list-group" id="familyBackgroundList">
                                <li class="list-group-item"><strong>Family Home Address:</strong> {{$fb_address}}</li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <button id="modifyButtonFamilyBackground" class="btn btn-primary" data-toggle="modal" data-target="#modifyModalFamilyBackground">Modify</button>
                </div>

                <div class="modal fade bd-example-modal-lg" id="modifyModalFamilyBackground" tabindex="-1" role="dialog" aria-labelledby="modifyModalFamilyBackground" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifyModalLabelDetails">Family Background Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <!-- Full Name -->
                                    <form wire:submit.prevent="save_family_background()">
                                        <div class="row">
                                            <div class="details-box col-lg-6 mb-4">
                                                <h5>Father's Information</h5>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">First name<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="f_firstname" class="form-control" placeholder="Enter firstname" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Middle name<span style="color:red;"></span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="f_middlename" class="form-control" placeholder="Enter middlename" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Last name<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="f_lastname" class="form-control" placeholder="Enter Lastname" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Suffix<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <select wire:model="suffix" class="form-control">
                                                            <option value="">Select suffix</option>
                                                            <option value="Jr.">Jr.</option>
                                                            <option value="Sr.">Sr.</option>
                                                            <option value="II">II</option>
                                                            <option value="III">III</option>
                                                            <!-- Add more suffix options as needed -->
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        
                                            <div class="details-box col-lg-6 mb-4">
                                                <h5>Mother's Information</h5>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">First name<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="m_firstname" class="form-control" placeholder="Enter firstname" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Middle name<span style="color:red;"></span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="m_middlename" class="form-control" placeholder="Enter middlename" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Last name<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="m_lastname" class="form-control" placeholder="Enter Lastname" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Suffix<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <select wire:model="suffix" class="form-control">
                                                            <option value="">Select suffix</option>
                                                            <option value="Jr.">Jr.</option>
                                                            <option value="Sr.">Sr.</option>
                                                            <option value="II">II</option>
                                                            <option value="III">III</option>
                                                            <!-- Add more suffix options as needed -->
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="details-box col-lg-12 mb-4">
                                                <h5>Guardian's Information (if applicable)</h5>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">First name<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="g_firstname" class="form-control" placeholder="Enter firstname" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Middle name<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="g_middlename" class="form-control" placeholder="Enter middlename" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Last name<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="g_lastname" class="form-control" placeholder="Enter Lastname" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Suffix<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <select wire:model="suffix" class="form-control">
                                                            <option value="">Select suffix</option>
                                                            <option value="Jr.">Jr.</option>
                                                            <option value="Sr.">Sr.</option>
                                                            <option value="II">II</option>
                                                            <option value="III">III</option>
                                                            <!-- Add more suffix options as needed -->
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Relation<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  wire:model="g_relationship" class="form-control" placeholder="Enter Relationship" >
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="details-box col-lg-12 mb-4">
                                                <h5>Siblings</h5>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">No. of siblings<span style="color:red;"></span> :</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" min="0" wire:model="number_of_siblings" class="form-control" placeholder="Number of siblings" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="details-box col-lg-12 mb-4">
                                                <h5>Home Address</h5>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Street:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" wire:model="fb_street" class="form-control" placeholder="Enter street">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Barangay:</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>Open this select menu</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Barangay:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" wire:model="fb_barangay" class="form-control" placeholder="Enter barangay">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">City<span style="color:red;">*</span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" wire:model="fb_city" class="form-control" placeholder="Enter city" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Province:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" wire:model="fb_province" class="form-control" placeholder="Enter province">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">ZIP Code:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" wire:model="fb_zip_code" class="form-control" placeholder="Enter ZIP code">
                                                    </div>
                                                </div>

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
    </div>
</div>

            <br>
            <!-- Educational Background -->
            <!-- <div class="details-box">
                <div class="family-background">
                    <h4>Educational Background</h4>
                    <div class="row justify-content-center">
                        <div class="details-box col-lg-12 mb-4">
                            <h5>SHS's Details</h5>
                            <ul class="list-group" id="SeniorHighSchoolList">
                                <li class="list-group-item"><strong>Senior High School Name: </strong> {{$ueb_shs_school_name}}</li>
                                <li class="list-group-item"><strong>Senior High School Address: </strong> {{$ueb_shs_address}} </li>
                            </ul>
                        </div>
                    </div>
                       
                    <br>
                    <button id="modifyButtonEducationalDetails" class="btn btn-primary" data-toggle="modal" data-target="#modifyModalEducationalDetails">Modify</button>
                    </div> 
                </div>
            </div>
            <br> -->
        
            <!-- Modify Applicant Details Modal -->
            
                    <!-- Modify Profile and ID Modal -->
           
            <!-- Modify Family Background Modal -->
            
             <!-- Modify Educational Details Modal -->
            <div class="modal fade bd-example-modal-lg" id="modifyModalEducationalDetails" tabindex="-1" role="dialog" aria-labelledby="modifyModalEducationalDetails" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabelDetails">Educational Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <fieldset>

                                <!-- Full Name -->
                                <form wire:submit.prevent="save_educational_details()">
                                    <div class="row">
                                        <div class="details-box col-lg-12 mb-4">
                                            <h5>SHS Information</h5>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Senior High School Name<span style="color:red;"></span> :</label>
                                                <div class="col-sm-9">
                                                    <input type="text"  wire:model="ueb_shs_school_name" class="form-control" placeholder="Enter Name" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Senior High School Address<span style="color:red;"></span>:</label>
                                                <div class="col-sm-9">
                                                    <input type="text"  wire:model="ueb_shs_address" class="form-control" placeholder="Enter Address" >
                                                </div>
                                            </div>     
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

    <!-- content-->
    </section>
    <!-- not nice - ace dev - https://github.com/Drusha01 -->
</div>
