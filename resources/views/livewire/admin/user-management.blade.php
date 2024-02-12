<div>
    <x-loading-indicator/>
     <!-- ======= Main Content ======= -->
     <main id="main" class="main">
        <div class="pagetitle">
            <h1>User Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">User Management</li>
                </ol>
            </nav>
            </div><!-- End Right side columns -->
            <!-- Insert Section -->
            <section class="admin-content">
                <button onclick="addUser()" class="user-button">Add New User</button>

                <!-- User List -->
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td>Admin</td>
                            <td>
                                <button onclick="editUser(1)">Edit</button>
                                <button onclick="deleteUser(1)">Delete</button>
                                <button onclick="resetPassword(1)">Reset Password</button>
                            </td>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td>Hanz</td>
                            <td>hanz@gmail.com</td>
                            <td>Admin</td>
                            <td>
                                <button onclick="editUser(1)">Edit</button>
                                <button onclick="deleteUser(1)">Delete</button>
                                <button onclick="resetPassword(1)">Reset Password</button>
                            </td>
                        </tr>
                        <!-- Add more user rows here -->
                    </tbody>
                </table>

                <!-- Add User Form (Hidden by default) -->
                <div id="add-user-form" style="display: none;" class="user-form">
                    <h3>Add User</h3>
                    <form>
                    <label for="id">ID Number:</label>
                            <input type="text" id="id" name="id" required>

                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>

                            <label for="role">Role:</label>
                            <select id="role" name="role">
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                                <!-- Add more role options here -->
                            </select>
                        <button type="submit">Save</button>
                        <button type="button" onclick="cancelAddUser()">Cancel</button>
                    </form>
                </div>

                <!-- Edit User Form (Hidden by default) -->
                <div id="edit-user-form" style="display: none;" class="user-form">
                    <h3>Edit User</h3>
                    <form>
                    <input type="hidden" id="edit-user-id" name="edit-user-id"> <!-- Hidden field to store user ID -->
                        <label for="edit-name">Name:</label>
                        <input type="text" id="edit-name" name="edit-name" required>
                        <label for="edit-email">Email:</label>
                        <input type="email" id="edit-email" name="edit-email" required>
                        <label for="edit-role">Role:</label>
                        <select id="edit-role" name="edit-role">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                        <!-- Add more role options here -->
                        </select>
                        <button type="submit">Save Changes</button>
                        <button type="button" onclick="cancelEditUser()">Cancel</button>
                    </form>
                </div>
            </section>
        </div>


        <script>
            // Function to show the add user form
            function addUser() {
                document.getElementById("add-user-form").style.display = "block";
            }

            // Function to hide the add user form
            function cancelAddUser() {
                document.getElementById("add-user-form").style.display = "none";
            }

            // Function to show the edit user form for a specific user
            function editUser(userId) {
                document.getElementById("edit-user-form").style.display = "block";
                // Populate the edit form with user data based on the userId
            }

            // Function to hide the edit user form
            function cancelEditUser() {
                document.getElementById("edit-user-form").style.display = "none";
            }

            // Function to delete a user based on the userId
            function deleteUser(userId) {
                // Implement user deletion logic here
            }

            // Function to reset the password of a user based on the userId
            function resetPassword(userId) {
                // Implement password reset logic here
            }
        </script>

        <!-- End Inserted Section -->

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>
