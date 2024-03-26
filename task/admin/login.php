<?php
session_start();
include('connect.php'); 

if (isset($_SESSION['logged_in'])){
    header("Location: dashboard.php");
    exit; 
}

$error = array();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($_POST["email"])){
        $error['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['email'] = "Invalid email format";
    }
    
    if (empty($password)){
        $error['password'] = "Password is required";
    } elseif(strlen($password) < 6){
        $error['password'] = "Password must be at least 6 characters";
    }

    if (empty($error)) {
        $email = stripcslashes($email);  
        $password = stripcslashes($password); 
        
        $email = mysqli_real_escape_string($conn, $email);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $pass_md = md5($password);

        // Check role
        $sql_admin = "SELECT * FROM adminlogin WHERE email = '$email' AND `password` = '$pass_md'";  
        $result_admin = mysqli_query($conn, $sql_admin);  
        $count_admin = mysqli_num_rows($result_admin);  

        $sql_editor = "SELECT * FROM usertable WHERE email = '$email' AND `password` = '$pass_md' AND role = 'editor'";  
        $result_editor = mysqli_query($conn, $sql_editor);  
        $count_editor = mysqli_num_rows($result_editor);  

        if ($count_admin == 1) {  
			// Admin login
			$row = mysqli_fetch_array($result_admin, MYSQLI_ASSOC);  
		
			$_SESSION['email'] = $row['email'];
			$_SESSION['logged_in'] = true;
			$_SESSION['role'] = $row['role'];
			header("Location: dashboard.php");
		} elseif ($count_editor == 1) {
			// Editor login
			$row = mysqli_fetch_array($result_editor, MYSQLI_ASSOC);  
		
			if ($row['status'] == 1) { // Check if status is 1 (allowed)
				$_SESSION['email'] = $row['email'];
				$_SESSION['logged_in'] = true;
				$_SESSION['role'] = $row['role'];
				header("Location: dashboard.php");
			} else {
				$_SESSION['error'] = "<div class='alert alert-danger'>Login failed. Your account is disabled.</div>";  
			}
		} else {  
			$_SESSION['error'] = "<div class='alert alert-danger'>Login failed. Invalid email or password.</div>";  
		}
		
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-login-in.html" />

	<title>login In | AdminKit Demo</title>

	<link href="<?php echo $admin_url ?>assests/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


	<style>
		.error{
			color:red;
		}
	</style>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome to Admin Login!</h1>
							<p class="lead">
								login in to your account to continue
							</p>
						</div>

						<?php
                // Check if error message is set in session and display it
                if(isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    // Unset the error session variable to clear it after displaying
                    unset($_SESSION['error']);
                }
                ?>
						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email or usermane" />
                                            <span class="error"><?php if(isset($error['email'])) echo $error['email']; ?></span>
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<span class="error"><?php if(isset($error['password'])) echo $error['password']; ?></span>
										</div>
										<div>
									
										</div>
										<div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary" name="submit">login in</button>
                                        </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>