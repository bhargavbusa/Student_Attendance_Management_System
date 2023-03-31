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
//edit student
if(isset($_POST['edit_student']))
  {

$grade_name=$_POST['grade_name'];
$student_name=$_POST['student_name'];

$statement = $dbh->prepare("UPDATE tbl_student SET student_name=?,student_roll_number=?,student_dob=?,student_grade_id=? WHERE student_id=?");
$statement->execute(array($_POST['student_name'],$_POST['student_roll_number'],$_POST['student_dob'],$_POST['student_grade_id'],$_REQUEST['id']));
if($statement)
{
$msg=" update Student successfully";
//sleep for 5 seconds
echo "<script>setTimeout(()=> { window.location='show_student.php'} ,5000);</script>";
}
else 
{
$error=" Something went wrong. Please try again";
}
  }
?>


<?php
$statement0 = $dbh -> prepare("SELECT *
FROM tbl_student
JOIN tbl_grade
ON tbl_grade.grade_id = tbl_student.student_grade_id where student_id=? ;");
$statement0->execute(array($_REQUEST['id']));
$result0 = $statement0->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result0 as $row0) {
    $student_id=$row0['student_id'];
    $student_name=$row0['student_name'];
    $student_dob=$row0['student_dob'];
    $student_roll_number=$row0['student_roll_number'];
    
    $grade_name=$row0['grade_name'];
    $grade_id=$row0['grade_id'];

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
                    <h1 class="h3 mb-4 text-gray-800">Edit Student</h1>

                    <div class="row">

                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Student Form</h6>
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
                                        <label for="inputText" class="col-sm-2 col-form-label">Student Name </label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Student Name" value="<?php echo $student_name; ?>" name="student_name" >
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Roll No.</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Roll No." value="<?php echo $student_roll_number; ?>" name="student_roll_number" >
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Date Of Birth</label>
                                        <div class="col-sm-8">
                                        <input type="date" class="form-control" placeholder="Date Of Birth" value="<?php echo $student_dob; ?>" name="student_dob" >
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Selcet Class</label>
                                        <div class="col-sm-8 ">
                                        <select name="student_grade_id" id="grade_id" class="form-control" >
                                               <option value="<?php echo $grade_id; ?>"><?php echo $grade_name; ?></option>
                                               <?php
                                                    $statement1 = $dbh->prepare("SELECT * FROM tbl_grade ORDER BY grade_name ASC");
                                                    $statement1->execute();
                                                    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);	
                                                    foreach ($result1 as $row1) {
                                                        ?>
                                                        <option value="<?php echo $row1['grade_id']; ?>"><?php echo $row1['grade_name']; ?></option>
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
                                        <input type="submit" value="Edit Student" name="edit_student" class="btn btn-primary" >
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