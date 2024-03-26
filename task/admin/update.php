<?php
include('connect.php');
require_once('header.php');

$_SESSION['update_success_message'] = "Record updated successfully";

// Check if ID is provided in the URL
if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = "User ID not provided";
    redirectToViewUser();
}

$id = $_GET['id'];

// Fetch user details from the database based on ID
$sql = "SELECT * FROM usertable WHERE id = $id";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check if form is submitted for updating user details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve updated details from the form
        $username = $_POST["username"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        $status = $_POST["status"];
        $password = $_POST["password"]; // Add password field

        // Update user details in the database
        $update_sql = "UPDATE usertable SET user_name='$username', email='$email', role='$role', status='$status'";
        
        // If password field is not empty, update password
        if (!empty($password)) {
            $update_sql .= ", password='" . md5($password) . "'";
        }

        $update_sql .= " WHERE id = $id";

        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['update_success_message'] = "User details updated successfully";
            redirectToViewUser();
        } else {
            $_SESSION['error_message'] = "Error updating user details: " . $conn->error;
        }
    }
} else {
    $_SESSION['error_message'] = "User not found";
    redirectToViewUser();
}

$conn->close();

function redirectToViewUser() {
    echo "<script>window.location.href = 'viewuser.php';</script>";
    exit();
}
?>


<div class="container">
    <div class="card p-4">
        <h2 class="mb-4 text-center">Update User Details</h2>
        <?php if(isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        <form method="post">
            <div class="col-md-6 offset-3">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['user_name']; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                </div>
                
                <div class="form-group">
                    <label>Role:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="admin" name="role" value="admin" <?php if ($row['role'] == 'admin') echo 'checked'; ?>>
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="editor" name="role" value="editor" <?php if ($row['role'] == 'editor') echo 'checked'; ?>>
                        <label class="form-check-label" for="editor">Editor</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="disabled" name="status" value="0" <?php if ($row['status'] == '0') echo 'checked'; ?>>
                        <label class="form-check-label" for="disabled">Disabled</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="enabled" name="status" value="1" <?php if ($row['status'] == '1') echo 'checked'; ?>>
                        <label class="form-check-label" for="enabled">Enabled</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

<?php include('footer.php') ?>
