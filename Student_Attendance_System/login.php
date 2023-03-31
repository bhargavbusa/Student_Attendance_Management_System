<?php
session_start();
include('include/config1.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT admin_user_name,admin_password FROM tbl_admin WHERE admin_user_name=:email and admin_password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Username and Password');</script>";

}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5">

            <h3 class="mb-5">Admin</h3>
            <form method="post">
                <div class="form-outline mb-4">
                    <label class="form-label" for="typeEmailX-2">Email</label>
                    <input type="text" id="typeEmailX-2" class="form-control form-control-lg" name="username" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="typePasswordX-2">Password</label>
                    <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" />
                </div>

                <button class="btn btn-primary btn-lg btn-block" name="login" type="submit">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>