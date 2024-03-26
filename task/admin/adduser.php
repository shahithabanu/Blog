<?php 
include('connect.php');
include('header.php');

$errors = array();
$inserted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate Username
    if (empty($username)){
        $errors['username'] = "Username is required";
    }

    // Validate Email
    if (empty($email)){
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    } else {
        // Check if email already exists in the database
        $sql_check_email = "SELECT * FROM usertable WHERE email='$email'";
        $result_check_email = $conn->query($sql_check_email);
        if ($result_check_email->num_rows > 0) {
            $errors['email'] = "Email already exists";
        }
    }

    // Validate Password
    if (empty($password)){
        $errors['password'] = "Password is required";
    } elseif(strlen($password) < 6){
        $errors['password'] = "Password must be at least 6 characters";
    }

    // Validate role
    if(isset($_POST['role'])){
        $role = $_POST["role"];
    if ($role !== 'admin' && $role !== 'editor') {
        $errors['role'] = "Please select a valid role option";
    }
} else{
        $errors['role']="please select your role";
    }

    if(isset($_POST['status'])){
        $status = $_POST["status"];
    if ($status !== '0' && $status !== '1') {
        $errors['status'] = "Please select a valid status option";
    }
} else{
        $errors['status']="please select your status";
    }


    // If there are no validation errors, insert data into the database
    if (empty($errors)) {
        $pass_md = md5($password);
        $sql = "INSERT INTO usertable (user_name, email, password, role,status) VALUES ('$username', '$email', '$pass_md', '$role','$status')";

        if ($conn->query($sql) === TRUE) {
            $inserted = true; 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body">
                
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                        <?php if ($inserted): ?>
                    <div class="alert alert-success text-center" role="alert">
                        Data inserted successfully!
                    </div>
                    <?php endif; ?>
                            <h2 class="text-center text-black">Add User</h2>
                            <div id="addEmployeeForm">
                                <form id="employeeForm" class="row g-3 p-3" method="POST">
                                    <div class="col-md-12">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" value="<?php echo isset($username)?$username: ''; ?>">
                                        <span class="error">
                                            <?php if(isset($errors['username'])) echo $errors['username']; ?>
                                        </span>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Enter your email" value="<?php echo isset($email) ? $email : ''; ?>">
                                        <span class="error">
                                            <?php if(isset($errors['email'])) echo $errors['email']; ?>
                                        </span>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputEmail4" class="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" value="<?php echo isset($password)?$password: ''; ?>">
                                        <span class="error">
                                            <?php if(isset($errors['password'])) echo $errors['password']; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Role</label><br>
                                        <input type="radio" id="admin_role" name="role" value="admin" <?php if(isset($_POST['role']) && $_POST['role'] == 'admin') echo 'checked'; ?>>
                                        <label for="admin_role">Admin</label><br>
                                        <input type="radio" id="editor_role" name="role" value="editor" <?php if(isset($_POST['role']) && $_POST['role'] == 'editor') echo 'checked'; ?>>
                                        <label for="editor_role">Editor</label><br>
                                        <span class="error">
                                            <?php if(isset($errors['role'])) echo $errors['role']; ?>
                                        </span>
                                    </div>


                                    <div class="col-md-12">
                                        <label>Status</label><br>
                                        <input type="radio" id="status1" name="status" value="1" checked> <!-- Default value set to '1' -->
                                        <label for="status1">Enabled</label><br>
                                        <input type="radio" id="status0" name="status" value="0">
                                        <label for="status0">Disabled</label><br>
                                        <span class="error">
                                        <?php if(isset($errors['status'])) echo $errors['status']; ?>
                                        </span>
                                    </div>

                            
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-dark">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Your custom JavaScript -->
<script src="path/to/your/custom/js/script.js"></script>
</body>
</html>
