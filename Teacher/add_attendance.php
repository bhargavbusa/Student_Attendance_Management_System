<?php
session_start();
error_reporting(0);
include('include/config1.php');
if(strlen($_SESSION['teacher_emailid'])==0)
	{	
header('location:login.php');
}
else{
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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    <h1 class="h3 mb-4 text-gray-800">Add Attendance</h1>

                     <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Attendance</h6>
                            <h6>
                            <?php if($error){?><div class="errorWrap" style="color:red"><strong>ERROR </strong> : <?php echo htmlentities($error); ?> </div><?php } 
		else if($msg){?><div class="succWrap" style="color:green"><?php echo $msg; ?> </div><?php }?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <form method="post" enctype="multipart/form-data">  

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Roll No.</th>    
                                            <th>Student Name</th>
                                            <th>Present</th>
                                            <th>Absent</th>    
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Roll No.</th>    
                                            <th>Student Name</th>
                                            <th>Present</th>
                                            <th>Absent</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php


$statement = $dbh->prepare("SELECT * FROM tbl_student 
                            where student_grade_id='".$_REQUEST['tgrade_id']."'");

$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
foreach ($result as $row) {
    
    $student_id=$row['student_id'];
    $student_name=$row['student_name'];
    $student_roll_numbe=$row['student_roll_number'];
    $student_dob=$row['student_dob'];

    

    $class = $_REQUEST['tgrade_id'];
    $teachet_id = $_SESSION['teacher_id'];
    $tdate = $_REQUEST['tdate'];

?>
                                        <tr>
                                            <th><?php echo $student_roll_numbe; ?></th>    
                                            <th><?php echo $student_name; ?></th>
                                                <input type="hidden" name="student_id[]" value="<?php echo $student_id; ?>" />
                                            <th>
                                                <input type="radio" name="attendance_status<?php echo $student_id; ?>" value="Present" checked/>
                                                <label for="inputText">Present</label>
                                            </th>
                                            <th>
                                                <input type="radio" name="attendance_status<?php echo $student_id; ?>"  value="Absent"/>
                                                <label for="inputText">Absent</label>
                                            </th>   
                                        </tr>
<?php } ?>
                                    </tbody>
                                </table>
                                <div class="form-group row">
                                    <div class="col-sm-5"></div>
                                    <label for="input" class="col-form-label"></label>
                                    <div class="col-sm-7">
                                    <input type="submit" value="Add Attendance" name="add_attendance" class="btn btn-primary" >
                                    </div>
                                </div>
                                </form>
                                <?php

if(isset($_POST["add_attendance"]))
{
	
		$student_id = $_POST["student_id"];
		$statement1="";
		
			for($count = 0; $count < count($student_id); $count++)
			{
				$data = array(
					':student_id'			=>	$student_id[$count],
					':grade_id'	    		=>	$_REQUEST['tgrade_id'],
					':attendance_status'	=>	$_POST["attendance_status".$student_id[$count].""],
					':attendance_date'		=>	$_REQUEST['tdate'],
					':teacher_id'			=>	$_SESSION["teacher_id"]
				);

				$query = "
				INSERT INTO tbl_attendance 
				(student_id,grade_id, attendance_status, attendance_date, teacher_id) 
				VALUES (:student_id, :grade_id, :attendance_status, :attendance_date, :teacher_id)
				";
				$statement1 = $dbh->prepare($query);
				$statement1->execute($data);
                
                
			}
            if($statement1)
                {
                    echo "<script>alert('Add Attendance successfully')</script>";
                }
                else 
                {
                    echo "<script>alert('Something went wrong. Please try again')</script>";
                }
}

?>

                            </div>
                        </div>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>


</body>

</html>
<?php } ?>