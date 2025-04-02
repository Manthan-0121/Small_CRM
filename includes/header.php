<?php
include("./includes/auth.php");


$selsql = "SELECT * FROM tbl_user WHERE id = '" . mysqli_real_escape_string($conn, $_SESSION["u_id"]) . "'";
$result = mysqli_query($conn, $selsql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Small CRM</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/components.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bundles/summernote/summernote-bs4.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo BASE_URL; ?>assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="<?php echo BASE_URL; ?>assets/img/user.png"
                                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></div>
                            <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo BASE_URL; ?>/logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- include sidebar here -->
            <?php include("./includes/sidebar.php"); ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body"></div>