<?php
session_start();
error_reporting(0);
include('include/config1.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:login.php');
}
else{
?>
<?php

if(isset($_POST['add_class_teacher']))
{

    $teacher_id=$_POST['teacher_id'];
    $grade_id=$_POST['grade_id'];

    $sql="INSERT INTO tbl_teachet_class(teacher_id,grade_id) VALUES(:teacher_id,:grade_id)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':teacher_id',$teacher_id,PDO::PARAM_STR);
    $query->bindParam(':grade_id',$grade_id,PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    $msg=" Add Teacher Class successfully";
    }
    else 
    {
    $error=" Something went wrong. Please try again";
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

    <title> Admin </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("include/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("include/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add Teacher</h1>

                    <div class="row">

                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Teacher Form</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-10 col-form-label" style="color:green">
<?php if($error){?><div class="errorWrap" style="color:red"><strong>ERROR </strong> : <?php echo htmlentities($error); ?> </div><?php } 
		else if($msg){?><div class="succWrap" style="color:green"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                        </label>
                                        <div class="col-sm-1"></div>
                                    </div>
                                <form method="post" enctype="multipart/form-data">  
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Teacher Email</label>
                                        <div class="col-sm-8 ">
                                        <select name="teacher_id" id="teacher_id" class="form-control" >
                                            <option value="">Select Email id</option>
                                            <?php
                                                $statement = $dbh->prepare("SELECT * FROM tbl_teacher ORDER BY teacher_emailid ASC");
                                                $statement->execute();
                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);	
                                                foreach ($result as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['teacher_emailid']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Teacher Class</label>
                                        <div class="col-sm-8 ">
                                           <select name="grade_id" id="grade_id" class="form-control" >
                                               <option value="">Select Class</option>
                                               <?php
                                                    $statement = $dbh->prepare("SELECT * FROM tbl_grade ORDER BY grade_name ASC");
                                                    $statement->execute();
                                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);	
                                                    foreach ($result as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['grade_id']; ?>"><?php echo $row['grade_name']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                               
                                           </select>
                                           </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-8">
                                        <input type="submit" value="Add Class Teacher" name="add_class_teacher" class="btn btn-primary" >
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-1"></div>



                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include("include/footer.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <!-- Logout Modal-->

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php } ?>