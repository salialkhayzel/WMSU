<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin announcement - WMSU TEC</title>
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
    <!--  Main CSS File -->
    <link href="{{ asset('css/Admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <!--   js File -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
</head>

<body class="admin-dashboard">

    <!-- ======= Header ======= -->
    @include('admin-components.admin-header');
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin-components.admin-sidebar');
    <!-- End Sidebar -->



    <!-- ======= Main Content ======= -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Announcement</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Announcement</li>
                </ol>
            </nav>
        </div><!-- End Right side columns -->

        <!-- Insert Section -->
        <section class="admin-content">            
                <!-- Filter Bar -->
            <div class="announcement-filter">
                <label for="status-filter">Search:</label><input type="text" id="announcement-search" placeholder="Search...">
                <label for="status-filter">Status:</label>
                <select id="status-filter">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="disabled">Disabled</option>
                </select>
                <div class="add-announcement-button">
                    <button id="openModalButton">Add Announcement</button>
                </div>
                </div>

                <div class="announcement-table">
                <table>
                    <thead>
                        <tr>
                            <th>Announcement Title</th>
                            <th>Type (Text/Image)</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status (Active/Disabled)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- You can add announcement rows here -->
                        <tr>
                            <td>Announcement 1</td>
                            <td>Text</td>
                            <td>2023-09-18</td>
                            <td>2023-09-25</td>
                            <td>Active</td>
                            <td>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Announcement 2</td>
                            <td>Image</td>
                            <td>2023-09-20</td>
                            <td>2023-09-27</td>
                            <td>Disabled</td>
                            <td>
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </section>
        <!-- Add Announcement Modal -->
        <div id="addAnnouncementModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Add Announcement</h2>
                <form id="announcementForm">
                    <label for="announcementTitle">Title of the announcement:</label>
                    <input type="text" id="announcementTitle" name="announcementTitle" required><br><br>

                    <label for="announcementType">Type of announcement (Text/Image):</label>
                    <select id="announcementType" name="announcementType" required>
                        <option value="text">Text</option>
                        <option value="image">Image</option>
                    </select><br><br>

                    <label for="announcementContent">Enter content of announcement:</label>
                    <textarea id="announcementContent" name="announcementContent" required></textarea><br><br>

                    <label for="announcementImage">Upload Image (if applicable):</label>
                    <input type="file" id="announcementImage" name="announcementImage"><br><br>

                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" name="startDate" required><br><br>

                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" name="endDate" required><br><br>

                    <label for="announcementStatus">Set Status (Active/Disabled):</label>
                    <select id="announcementStatus" name="announcementStatus" required>
                        <option value="active">Active</option>
                        <option value="disabled">Disabled</option>
                    </select><br><br>

                    <button type="submit">Add Announcement</button>
                </form>
            </div>
        </div>

        <!-- Your JavaScript code for the modal and form handling here -->
        <script>
            // Get the modal element
            var modal = document.getElementById('addAnnouncementModal');

            // Get the button that opens the modal
            var addButton = document.querySelector('.add-announcement-button button');

            // Get the <span> element that closes the modal
            var closeModal = document.getElementById('closeModal');

            // When the user clicks the "Add Announcement" button, open the modal
            addButton.onclick = function () {
                modal.style.display = 'block';
            }

            // When the user clicks the <span> (x) or outside the modal, close it
            closeModal.onclick = function () {
                modal.style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }

            // Add event listener for form submission
            var announcementForm = document.getElementById('announcementForm');

            announcementForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Get form data and do something with it (e.g., send it to the server via AJAX)
                var formData = new FormData(announcementForm);

                // Replace this with your own logic to handle form data
                // Example: Send data to the server using fetch API
                fetch('/your-server-endpoint', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response from the server here
                        // You can close the modal or display a success message, etc.
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        </script>
        <!-- End Inserted Section -->

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>
