<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

@include('student-components.student-navigation')
@include('student-components.student-navtabs')
<!-- content-->
<section class="profile-section">
    <div class="container">
        <h2 class="profile-heading">Applicant Information</h2>
        <div class="Applicant-container">
            <div class="Applicant-info">
                <div class="profile-box">
                    <div class="profile-image-container">
                        <input type="file" id="profileImageInput" style="display: none;">
                        <label for="profileImageInput" class="profile-image-label">
                            <div class="profile-image">
                                <i class="fas fa-user fa-5x"></i>
                            </div>
                        </label>
                    </div>
                    <h3 class="mt-3">Applicant username</h3>
                    <p class="text-muted">Status: Registered</p>
                    <button id="modifyButtonProfile" class="btn btn-primary" data-toggle="modal" data-target="#modifyModal">Modify</button>
                </div>
            </div>
<!-- Modify Section Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalLabel">Account Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tab navigation for different settings -->
                <ul class="nav nav-tabs" id="accountSettingsTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="modify-tab" data-toggle="tab" href="#modify" role="tab" aria-controls="modify" aria-selected="true">Modify Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="changePassword-tab" data-toggle="tab" href="#changePassword" role="tab" aria-controls="changePassword" aria-selected="false">Change Password</a>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="accountSettingsTabContent">
                    <!-- Modify Info Tab -->
                    <div class="tab-pane fade show active" id="modify" role="tabpanel" aria-labelledby="modify-tab">
                        <!-- Form to modify username and profile image -->
                        <form>
                        <div class="form-group">
                            <label class="fas" for="newProfileImage">Change profile picture:</label>
                            <input type="file" class="form-control" id="newProfileImage">
                        </div>
                        <div class="form-group">
                            <label class="fas" for="newProfileImage">Formal Photo(2x2):</label>
                            <input type="file" class="form-control" id="newProfileImage">
                        </div>
                        <!-- Add more fields to modify user details as needed -->
                    </form>
                    </div>

                    <!-- Change Password Tab -->
                    <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
                        <!-- Form to change password -->
                        <form>
                            <div class="form-group">
                                <label for="currentPassword">Current Password:</label>
                                <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password:</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password:</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Confirm new password">
                            </div>
                            <!-- ... -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Applicant details -->
    <div class="applicant-details">
        <div class="details-box">
            <h4>Applicant Details</h4>
            <ul class="list-group" id="applicantDetailsList">
                <li class="list-group-item"><strong>Full Name:</strong> John Doe</li>
                <li class="list-group-item"><strong>Gender:</strong> Male</li>
                <li class="list-group-item"><strong>Age:</strong> 18</li>
                <li class="list-group-item"><strong>Home Address:</strong> 123 Main St, City</li>
                <li class="list-group-item"><strong>Phone number:</strong> 09956207083</li>
                <li class="list-group-item"><strong>Email:</strong> john.doe@example.com</li>
                <li class="list-group-item"><strong>Birthdate:</strong> January 15, 2000</li>
                <li class="list-group-item"><strong>Account Created:</strong> January 1, 2023</li>
            </ul>
            <button id="modifyButtonDetails" class="btn btn-primary" data-toggle="modal" data-target="#modifyModalDetails">Modify</button>
        </div>
    </div>
</div>

<!-- Modify Applicant Details Modal -->
<div class="modal fade" id="modifyModalDetails" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabelDetails" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalLabelDetails">Modify Applicant Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                        <legend>Applicant Information</legend>
                        <!-- Full Name -->
                        <div class="form-group row">
                            <label for="newFullName" class="col-sm-3 col-form-label">Full Name*:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="newFullName" placeholder="Enter new full name" required>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="form-group row">
                            <label for="newGender" class="col-sm-3 col-form-label">Gender*:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="newGender" placeholder="Enter new gender" required>
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="form-group row">
                            <label for="newAge" class="col-sm-3 col-form-label">Age*:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="newAge" placeholder="Enter new age" required>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group row">
                            <label for="newPhoneNumber" class="col-sm-3 col-form-label">Phone Number:</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="newPhoneNumber" placeholder="Enter phone number" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);">
                            </div>
                        </div>

                        <!-- Home Address -->
                        <div class="form-group row">
                            <label for="newHomeAddress" class="col-sm-3 col-form-label">Home Address:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="newHomeAddress" placeholder="Enter new home address">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            <label for="newEmail" class="col-sm-3 col-form-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="newEmail" placeholder="Enter new email">
                            </div>
                        </div>

                        <!-- Birthdate -->
                        <div class="form-group row">
                            <label for="newBirthdate" class="col-sm-3 col-form-label">Birthdate*:</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="newBirthdate" placeholder="Enter new birthdate" required>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>



<!-- Family Background -->
<div class="family-background">
    <h4>Family Background</h4>
    <ul class="list-group" id="familyBackgroundList">
        <li class="list-group-item"><strong>Father's Name:</strong> John Doe Sr.</li>
        <li class="list-group-item"><strong>Mother's Name:</strong> Jane Doe</li>
        <li class="list-group-item"><strong>Number of Siblings:</strong> 2</li>
        <li class="list-group-item"><strong>Family Address:</strong> 456 Oak St, City</li>
    </ul>
    <button id="modifyButtonFamilyBackground" class="btn btn-primary" data-toggle="modal" data-target="#modifyModalFamilyBackground">Modify</button>
</div>
<!-- Modify Family Background Modal -->
<div class="modal fade" id="modifyModalFamilyBackground" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabelFamilyBackground" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalLabelFamilyBackground">Modify Family Background</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                        <legend>Family Information</legend>
                        <!-- Father's Name -->
                        <div class="form-group row">
                            <label for="newFatherName" class="col-sm-3 col-form-label">Father's Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="newFatherName" placeholder="Enter father's name">
                            </div>
                        </div>

                        <!-- Mother's Name -->
                        <div class="form-group row">
                            <label for="newMotherName" class="col-sm-3 col-form-label">Mother's Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="newMotherName" placeholder="Enter mother's name">
                            </div>
                        </div>

                        <!-- Number of Siblings -->
                        <div class="form-group row">
                            <label for="newNumberOfSiblings" class="col-sm-3 col-form-label">Number of Siblings:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="newNumberOfSiblings" placeholder="Enter the number of siblings">
                            </div>
                        </div>

                        <!-- Family Address -->
                        <div class="form-group row">
                            <label for="newFamilyAddress" class="col-sm-3 col-form-label">Family Address:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="newFamilyAddress" placeholder="Enter family address">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

            <!-- Educational Background Section -->
            <div class="educational-background">
                <h4>Educational Background</h4>
                <ul class="list-group" id="educationalBackgroundList">
                    <!-- Existing educational background details go here -->
                    <li class="list-group-item">
                        <strong>Senior High School:</strong> Sample High School
                    </li>
                    <li class="list-group-item">
                        <strong>Strand:</strong> STEM
                    </li>
                    <li class="list-group-item">
                        <strong>Awards (if any):</strong> Dean's List, Science Fair Champion
                    </li>
                </ul>
                <button id="modifyButtonEducationalBackground" class="btn btn-primary" data-toggle="modal" data-target="#modifyModalEducationalBackground">Modify</button>
            </div>

            <!-- Modify Educational Background Modal -->
            <div class="modal fade" id="modifyModalEducationalBackground" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabelEducationalBackground" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabelEducationalBackground">Modify Educational Background</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <fieldset>
                                    <legend>Educational Background Information</legend>
                                    <!-- High School -->
                                    <div class="form-group row">
                                        <label for="newHighSchool" class="col-sm-3 col-form-label">Senior High School*:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="newHighSchool" placeholder="Enter high school name" required>
                                        </div>
                                    </div>

                                    <!-- Strand -->
                                    <div class="form-group row">
                                        <label for="newStrand" class="col-sm-3 col-form-label">Strand*:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="newStrand" placeholder="Enter  strand" required>
                                        </div>
                                    </div>

                                    <!-- Awards (if any) -->
                                    <div class="form-group row">
                                        <label for="newAwards" class="col-sm-3 col-form-label">Awards (if any):</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="newAwards" placeholder="Enter  awards received">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requirements Section -->
            <div class="requirements">
                <h4>Requirements Upload</h4>
                <ul class="list-group" id="requirementsList">
                    <!-- Existing requirements go here -->
                    <li class="list-group-item">
                        <strong>Requirement Name:</strong> High School Transcript
                    </li>
                    <li class="list-group-item">
                        <strong>Requirement Name:</strong> Birth Certificate
                    </li>
                    <li class="list-group-item">
                        <strong>Requirement Name:</strong> Photo ID
                    </li>
                </ul>
                <button id="modifyButtonRequirements" class="btn btn-primary" data-toggle="modal" data-target="#modifyModalRequirements">Add Requirement</button>
            </div>

            <!-- Modify Requirements Modal -->
            <div class="modal fade" id="modifyModalRequirements" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabelRequirements" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabelRequirements">Modify Requirements</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <fieldset>
                                    <legend>Edit Requirements</legend>
                                    <!-- Requirement Name -->
                                    <div class="form-group row">
                                        <label for="newRequirementName" class="col-sm-3 col-form-label">Requirement Name*:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="newRequirementName" placeholder="Enter new requirement name" required>
                                        </div>
                                    </div>
                                    <!-- Add more fields for requirement details as needed -->
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>

          
<!-- content-->
</section>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script></script>

</body>
</html>
