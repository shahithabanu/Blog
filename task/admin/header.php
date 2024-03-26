<?php session_start();
if (!isset($_SESSION['logged_in'])){
    header("Location: login.php");
    exit; 
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
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>

	<link href="<?php echo $admin_url ?>assests/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">



<style>
	.error{
		color:red;
	}
</style>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?php echo $admin_url ?>dashboard.php">
					<span class="align-middle">Admin</span>
				</a>


				<ul class="sidebar-nav">

				<?php if (isset($_SESSION['logged_in'])) { ?>
					<li class="sidebar-header">
						Pages
					</li>
					<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="<?php echo $admin_url ?>dashboard.php">
							<i class="align-middle" data-feather="sliders"></i> <span
								class="align-middle">Dashboard</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo $admin_url ?>adduser.php">
							<i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Add
								user</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo $admin_url ?>viewuser.php">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">View
								user</span>
						</a>
					</li>
					<?php } ?>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo $admin_url ?>editor/addarticle.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Add Airtcle</span>
						</a>
					</li>
					

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo $admin_url ?>editor/viewarticle.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">view Airticle</span>
						</a>
					</li>
	

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo $admin_url ?>userfeedback.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">User Feedback</span>
						</a>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo $admin_url ?>logout.php">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Logout</span>
						</a>
					</li>
					<?php } ?>
				</ul>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
								data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
								data-bs-toggle="dropdown">
								<img src="<?php echo $admin_url ?>assests/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
									alt="Charles Hall" /> <span class="text-dark">Admin</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Logout</a>
							</div>
						</li>
						
					</ul>
				</div>
			</nav>

			<main class="content">