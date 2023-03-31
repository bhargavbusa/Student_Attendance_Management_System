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
                    <h1 class="h3 mb-4 text-gray-800">Show Attendance</h1>

                     <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Show Attendance</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Roll No.</th>    
                                            <th>Student Name</th>
                                            <th>Status</th>
                                            <th>Date</th>    
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Roll No.</th>    
                                            <th>Student Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php
    $class = $_REQUEST['tgrade_id'];
    $teachet_id = $_SESSION['teacher_id'];
    $tdate = $_REQUEST['tdate'];


if($class == "00all")
{
    $statement = $dbh->prepare("SELECT * FROM tbl_attendance where teacher_id='".$_SESSION['teacher_id']."' ");
}
else
{
    $statement = $dbh->prepare("SELECT * FROM tbl_attendance where grade_id='".$_REQUEST['tgrade_id']."' AND teacher_id='".$_SESSION['teacher_id']."' AND attendance_date='".$_REQUEST['tdate']."' ");
}
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
foreach ($result as $row) {
    
    $student_id=$row['student_id'];
   
    if($class == "00all")
    {
        $statement1 = $dbh->prepare("SELECT * FROM tbl_student where student_id='".$row['student_id']."' ");
    //echo "working";
    }
    else
    {
        $statement1 = $dbh->prepare("SELECT * FROM tbl_student where student_id='".$row['student_id']."' AND student_grade_id='".$_REQUEST['tgrade_id']."' ");
    }
    

    $statement1->execute();
    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);	
    foreach ($result1 as $row1) {

    


    



?>
                                        <tr>
                                            <th><?php echo $student_id; ?></th>    
                                            <th><?php echo $row1['student_name']; ?></th>
                                            <th><?php echo $row['attendance_status']; ?></th>
                                            <th><?php echo $row['attendance_date']; ?></th>   
                                        </tr>
<?php } } ?>
                                    </tbody>
                                </table>
                                <div class="form-group row">
                                    <div class="col-sm-5"></div>
                                    <label for="input" class="col-form-label"></label>
                                    <div class="col-sm-7">
                                    
                                    </div>
                                </div>
                            
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