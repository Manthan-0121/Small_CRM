<?php
include("./includes/config.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $txt_email = mysqli_real_escape_string($conn,$_POST['txt_email']);
    $txt_pwd = mysqli_real_escape_string($conn,$_POST['txt_pwd']);
    $selsql = "SELECT * FROM tbl_user WHERE email = '$txt_email'";
    $res = mysqli_query($conn,$selsql);
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        if($row["password"] == md5($txt_pwd)){
            $_SESSION["u_id"] = $row['id'];
            header("Location:".BASE_URL."index.php");
            exit();
        }else{
            $pwdmsg = "Password is incorrect";
        }
    }else{
        $emailmsg = "Email is not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Small CRM</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/app.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/bundles/bootstrap-social/bootstrap-social.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo BASE_URL ?>assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="#" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" name="txt_email" class="form-control <?php if(isset($emailmsg) != null){ echo 'is-invalid';}?>" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                                <?php if(isset($emailmsg) != null){ echo $emailmsg;}else {echo "Please fill in your email";}?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" name="txt_pwd" class="form-control <?php if(isset($pwdmsg) != null){ echo 'is-invalid';}?>" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                        <?php if(isset($pwdmsg) != null){ echo $pwdmsg;}else {echo "please fill in your password";}?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="<?php echo BASE_URL ?>assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="<?php echo BASE_URL ?>assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="<?php echo BASE_URL ?>assets/js/custom.js"></script>
</body>



</html>