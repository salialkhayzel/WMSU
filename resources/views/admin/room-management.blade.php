<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin room management - WMSU TEC</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/boxicons/2.0.7/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('css/ADMIN.css') }}" rel="stylesheet">
    <!-- JS Files -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/addexam.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</head>

<body class="admin-dashboard">

    <!-- ======= Header ======= -->
    @include('admin-components.admin-header');
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin-components.admin-sidebar');
    <!-- End Sidebar -->

    <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Room Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Room Management</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link show active" data-toggle="tab" href="#room-assignment-tab">Unassigned Room</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#room-assignment1-tab">Assigned Room</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#room-management-tab">Room Management</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">

        <!-- Unnassigned Tab -->
        <div class="tab-pane show active" id="room-assignment-tab">
            <!-- Room Assignment Form -->
            <!-- List of Room Assignments -->
            <div class="room-assignments">
                <div class="examfilter-container">
                    <label class="filter-label" for="exam-filter">Filter by Type of Exam:</label>
                    <select class="filter-select" id="exam-filter">
                        <option value="">All</option>
                        <option value="College Entrance Exam">Cet</option>
                        <option value="Nursing aptitude test">Nat</option>
                        <option value="Engineering Aptitude test">Eat</option>
                        <!-- Add more options as needed -->
                    </select>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn" style="background-color: #990000; color: white;" data-toggle="modal" data-target="#assignModal">Assign</button>
                    </div>
                </div>
                <!-- Displays a table of room assignment and list of applicants -->
                <table class="application-table">
                    <thead>
                        <tr>
                            <th>
                                &#10003;   <!-- check icon -->
                            </th> 
                            <th>#</th>  
                            <th>Applicant Name</th>
                            <th>Exam Type</th>
                            <th>School Year</th>
                            <th>Date Applied</th>
                            <th>Room Venue</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td> 
                            <td>1</td>
                            <td>Accepted Applicant 1</td>
                            <td>CET</td>
                            <td>2023-2024</td>
                            <td>2023-09-10</td>
                
                            <td>Not assigned</td>
                            <td>
                                <button class="btn btn-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td> 
                            <td>2</td>
                            <td>Accepted Applicant 2</td>
                            <td>NAT</td>
                            <td>2023-2024</td>
                            <td>2023-09-11</td>
                
                            <td>Not assigned</td>
                            <td>
                                <button class="btn btn-primary">View</button>
                            </td>
                        </tr>
                        <!-- Add more accepted applicant rows here -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Unnassigned Tab -->

        <!-- Assign Modal -->
        <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignModalLabel">Assign Venue and Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="venueSelect">Select Venue:</label>
                            <select class="form-control" id="venueSelect">
                                <option value="">Select Venue</option>
                                <option value="WMSU MAIN">WMSU MAIN</option>
                                <option value="WMSU ESU">WMSU ESU</option>
                            </select>
                        </div>

                        <!-- Room selection dropdown (hidden by default) -->
                        <div class="form-group" id="roomSelectGroup" style="display: none;">
                            <label for="roomSelect">Select Room:</label>
                            <select class="form-control" id="roomSelect">
                                <option value="">Select Room</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="assignButton">Assign</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Assigned Tab -->
        <div class="tab-pane show " id="room-assignment1-tab">
            <!-- Room Assignment Form -->
            <!-- List of Room Assignments -->
            <div class="room-assignments">
            <div class="examfilter-container">
                <label class="filter-label" for="exam-filter">Filter by Type of Exam:</label>
                <select class="filter-select" id="exam-filter">
                    <option value="">All</option>
                    <option value="College Entrance Exam">Cet</option>
                    <option value="Nursing aptitude test">Nat</option>
                    <option value="Engineering Aptitude test">Eat</option>
                    <!-- Add more options as needed -->
                </select>
                <!-- Re-assign Button -->
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" id="reassignModalButton" style="background-color: #990000; border-color: #990000;">Re-assign</button>
                </div>
            </div>
                <!-- Displays a table of room assignment and list of applicants -->
                <table class="application-table">
                    <thead>
                        <tr>
                            <th>
                                &#10003;   <!-- check icon -->
                            </th>
                            <th>#</th>  
                            <th>Applicant Name</th>
                            <th>Exam Type</th>
                            <th>School Year</th>
                            <th>Date Applied</th>
                            <th>Room Venue</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td> 
                            <td>1</td>
                            <td>Accepted Applicant 1</td>
                            <td>CET</td>
                            <td>2023-2024</td>
                            <td>2023-09-10</td>
                            <td>WMSU MAIN-CLA 12</td>
                            <td>
                                <button class="btn btn-primary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td> 
                            <td>2</td>
                            <td>Accepted Applicant 2</td>
                            <td>NAT</td>
                            <td>2023-2024</td>
                            <td>2023-09-11</td>
                            <td>WMSU MAIN-LAW 121</td>
                            <td>
                                <button class="btn btn-primary">View</button>
                            </td>
                        </tr>
                        <!-- Add more accepted applicant rows here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Re-assign Modal -->
        <div class="modal fade" id="reassignModal" tabindex="-1" role="dialog" aria-labelledby="reassignModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reassignModalLabel">Re-assign Venue and Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Re-assignment form fields -->
                        <form id="reassignForm">
                            <div class="form-group">
                                <label for="reassignVenue">Select Venue:</label>
                                <select class="form-control" id="reassignVenue" name="reassignVenue">
                                    <option value="">Select Venue</option>
                                    <option value="WMSU MAIN">WMSU MAIN</option>
                                    <option value="WMSU ESU">WMSU ESU</option>
                                    <!-- Add more venue options as needed -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reassignRoom">Select Room:</label>
                                <select class="form-control" id="reassignRoom" name="reassignRoom">
                                    <option value="">Select Room</option>
                                    <!-- Room options will be dynamically populated based on the selected venue -->
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="reassignConfirmButton">Re-assign</button>
                    </div>
                </div>
            </div>
        </div>





        <!-- View Names Modal (Add the modal content as needed) -->
        <div class="modal fade" id="viewNamesModal" tabindex="-1" role="dialog" aria-labelledby="viewNamesModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewNamesModalLabel">Assigned Applicants</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Display the list of assigned applicant names here -->
                        <ul>
                            <li>John Doe</li>
                            <li>Jane Smith</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Room Management Tab -->
        <div class="tab-pane show " id="room-management-tab">
            <!-- Room Management Table -->
            <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Button to trigger the Add Room modal -->
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn" style="background-color: #990000; color: white;" data-toggle="modal" data-target="#addRoomModal">Add Room</button>
            </div>


            <table class="application-table">
                <thead>
                    <tr>
                        <th>
                            &#10003;   <!-- check icon -->
                        </th>
                        <th>#</th> 
                        <th>Venue</th>
                        <th>Room</th>
                        <th>School Year</th>
                        <th>Capacity</th>
                        <th>Slot</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td> 
                        <td>1</td>
                        <td>WMSU MAIN</td>
                        <td>CLA 102</td>
                        <td>2023-2024</td>
                        <td>12</td>
                        <td>8</td>
                        <td>First Floor</td>
                        <td>
                            <button type="button" class="accept-button btn btn-primary btn-sm" data-toggle="modal" data-target="#editRoomModal">Edit</button>
                            <button type="button" class="decline-button btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteRoomModal">Delete</button>
                            <!-- View button to display the list of names -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewNamesModal">View</button>
                            <!-- Download button to download the list of names -->
                        </td>

                    </tr>
                    <tr>
                        <td><input type="checkbox"></td> 
                        <td>1</td>
                        <td>WMSU-ESU</td>
                        <td>AGRI-102</td>
                        <td>2023-2024</td>
                        <td>25</td>
                        <td>23</td>
                        <td>Lecture room 1st floor</td>
                        <td>
                            <button type="button" class="accept-button btn btn-primary btn-sm" data-toggle="modal" data-target="#editRoomModal">Edit</button>
                            <button type="button" class="decline-button btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteRoomModal">Delete</button>
                            <!-- View button to display the list of names -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewNamesModal">View</button>
                            <!-- Download button to download the list of names -->
                        </td>

                    </tr>
                    <tr>
                        <td><input type="checkbox"></td> 
                        <td>1</td>
                        <td>WMSU-MAIN</td>
                        <td>LAW-102</td>
                        <td>2023-2024</td>
                        <td>31</td>
                        <td>12</td>
                        <td>Large lecture room</td>
                        <td>
                            <button type="button" class="accept-button btn btn-primary btn-sm" data-toggle="modal" data-target="#editRoomModal">Edit</button>
                            <button type="button" class="decline-button btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteRoomModal">Delete</button>
                            <!-- View button to display the list of names -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewNamesModal">View</button>
                            <!-- Download button to download the list of names -->
                        </td>
                    </tr>
                    <!-- Add more room entries as needed -->
                </tbody>
            </table>
        </div>

        <!-- Add Room Modal -->
        <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="addRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a new room -->
                        <form id="addRoomForm">
                        <div class="form-group">
                            <label for="addSchoolYear">School Year:</label>
                            <select class="form-control" id="addSchoolYear" name="addSchoolYear" required>
                                <option value="">Select School Year</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2024-2025">2024-2025</option>
                                <option value="2025-2026">2025-2026</option>
                                <!-- Add more options for additional years as needed -->
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="addCollegeName">College Name:</label>
                                <input type="text" class="form-control" id="addCollegeName" name="addCollegeName" required>
                            </div>
                            <div class="form-group">
                                <label for="addRoomName">Venue:</label>
                                <input type="text" class="form-control" id="addRoomName" name="addRoomName" required>
                            </div>
                            <div class="form-group">
                                <label for="addRoomName">Room name #:</label>
                                <input type="text" class="form-control" id="addRoomName" name="addRoomName" required>
                            </div>
                            <div class="form-group">
                                <label for="addRoomCapacity">Capacity:</label>
                                <input type="number" class="form-control" id="addRoomCapacity" name="addRoomCapacity" required>
                            </div>
                            <div class="form-group">
                                <label for="addRoomCapacity">Slot:</label>
                                <input type="number" class="form-control" id="addRoomCapacity" name="addRoomCapacity" required>
                            </div>
                            <div class="form-group">
                                <label for="addRoomDescription">Room Description:</label>
                                <textarea class="form-control" id="addRoomDescription" name="addRoomDescription" rows="4" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveAddRoom">Add Room</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Room Modal -->
        <div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="editRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoomModalLabel">Edit Room Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing room details -->
                        <form id="editRoomForm">
                        <div class="form-group">
                                <label for="editSchoolYear">School Year:</label>
                                <input type="number" class="form-control" id="editSchoolYear" name="editSchoolYear" required>
                            </div>
                            <div class="form-group">
                                <label for="editCollegeName">College Name:</label>
                                <input type="text" class="form-control" id="editCollegeName" name="editCollegeName" required>
                            </div>
                            <div class="form-group">
                                <label for="editCollegeName">Venue:</label>
                                <input type="text" class="form-control" id="editCollegeName" name="editCollegeName" required>
                            </div>
                            <div class="form-group">
                                <label for="editRoomName">Room Name #:</label>
                                <input type="text" class="form-control" id="editRoomName" name="editRoomName" required>
                            </div>
                            <div class="form-group">
                                <label for="editRoomCapacity">Capacity:</label>
                                <input type="number" class="form-control" id="editRoomCapacity" name="editRoomCapacity" required>
                            </div>
                            <div class="form-group">
                                <label for="editRoomCapacity">Slot:</label>
                                <input type="number" class="form-control" id="editRoomCapacity" name="editRoomCapacity" required>
                            </div>
                            <div class="form-group">
                                <label for="editRoomDescription">Room Description:</label>
                                <textarea class="form-control" id="editRoomDescription" name="editRoomDescription" rows="4" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveEditRoom">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const venueSelect = document.getElementById("venueSelect");
        const roomSelectGroup = document.getElementById("roomSelectGroup");
        const roomSelect = document.getElementById("roomSelect");

        // Define room options based on venues
        const rooms = {
            "WMSU MAIN": ["CLA 12", "CLA 01", "LAW 121"],
            "WMSU ESU": ["ESU Room 1", "ESU Room 2", "ESU Room 3"],
        };

        venueSelect.addEventListener("change", function () {
            const selectedVenue = venueSelect.value;
            if (selectedVenue in rooms) {
                // Populate the room dropdown based on the selected venue
                roomSelectGroup.style.display = "block";
                roomSelect.innerHTML = '<option value="">Select Room</option>';
                rooms[selectedVenue].forEach(function (room) {
                    const option = document.createElement("option");
                    option.value = room;
                    option.textContent = room;
                    roomSelect.appendChild(option);
                });
            } else {
                // Hide the room dropdown if no venue is selected
                roomSelectGroup.style.display = "none";
            }
        });

        // Handle the "Assign" button click
        const assignButton = document.getElementById("assignButton");
        assignButton.addEventListener("click", function () {
            const selectedVenue = venueSelect.value;
            const selectedRoom = roomSelect.value;
            // Perform assignment logic here based on the selected venue and room
            // You can send this information to the server or perform any other necessary actions.
            console.log("Selected Venue: " + selectedVenue);
            console.log("Selected Room: " + selectedRoom);
            // Close the modal
            $('#assignModal').modal('hide');
        });
    });
</script>

<script>
    // JavaScript to trigger the re-assign modal when the "Re-assign" button is clicked
    document.addEventListener("DOMContentLoaded", function () {
        const reassignModalButton = document.getElementById("reassignModalButton");
        const reassignModal = document.getElementById("reassignModal");

        reassignModalButton.addEventListener("click", function () {
            // Manually open the re-assign modal
            $(reassignModal).modal("show");
        });

        // Handle the "Re-assign" button click inside the re-assign modal
        const reassignConfirmButton = document.getElementById("reassignConfirmButton");
        reassignConfirmButton.addEventListener("click", function () {
            // Perform re-assignment logic here
            // You can send this information to the server or perform any other necessary actions.
            // Close the re-assign modal
            $('#reassignModal').modal('hide');
        });
    });
</script>


</body>
</html>
