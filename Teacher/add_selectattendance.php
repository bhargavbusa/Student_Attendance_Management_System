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

<?php
//edit class
if(isset($_POST['add_attendance']))
{
    $grade_id=$_POST['grade_id'];
    $tdate=$_POST['select_date'];
    echo "<script>window.location='add_attendance.php?tgrade_id=$grade_id&tdate=$tdate'</script>";
}
?>




<?php
$statement = $dbh->prepare("SELECT * FROM tbl_teacher where teacher_id='".$_SESSION['teacher_id']."'");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
foreach ($result as $row) {

    $teacher_emailid=$row['teacher_emailid'];
    $teacher_name=$row['teacher_name'];
    $teacher_language=$row['teacher_language'];

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
                    <h1 class="h3 mb-4 text-gray-800">Add Attendance</h1>

                    <div class="row">

                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Attendance Form</h6>
                                </div>
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">  
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Teacher Email</label>
                                        <div class="col-sm-8 ">
                                            <label for="inputText"><?php echo $teacher_emailid; ?></label>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Teacher Name</label>
                                        <div class="col-sm-8 ">
                                            <label for="inputText"><?php echo $teacher_name; ?></label>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Teacher language</label>
                                        <div class="col-sm-8 ">
                                            <label for="inputText"><?php echo $teacher_language; ?></label>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Teacher Class</label>
                                        <div class="col-sm-8 ">
                                           <select name="grade_id" id="grade_id" class="form-control" required>
                                               <option value="">Select Class</option>
                                               <?php
                                                    $statement1 = $dbh->prepare("SELECT * FROM tbl_teachet_class where teacher_id='".$_SESSION['teacher_id']."'");
                                                    $statement1->execute();
                                                    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);	
                                                    foreach ($result1 as $row1) {

                                                        $grade_id=$row1['grade_id'];
                                                        $statement11 = $dbh->prepare("SELECT * FROM tbl_grade where grade_id=$grade_id"."");
                                                        $statement11->execute();
                                                        $result11 = $statement11->fetchAll(PDO::FETCH_ASSOC);	
                                                        foreach ($result11 as $row11) {
                                                ?>
                                                        <option value="<?php echo $row11['grade_id']; ?>"><?php echo $row11['grade_name']; ?></option>
                                                <?php
                                                    } }
                                                ?>
                                               
                                           </select>
                                           </div>
                                        <div class="col-sm-1"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-8">
                                        <input type="date" id="date" class="form-control" placeholder="dd-mm-yyyy" name="select_date"  required>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-8">
                                        <input type="submit" value="Add Attendance" name="add_attendance" class="btn btn-primary" >
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

    
<script>
    const dateInput = document.getElementById('date');

// Using the visitor's timezone
dateInput.value = formatDate();

console.log(formatDate());

function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}

function formatDate(date = new Date()) {
  return [
    date.getFullYear(),
    padTo2Digits(date.getMonth() + 1),
    padTo2Digits(date.getDate()),
  ].join('-');
}

//  Using UTC (universal coordinated time)
// dateInput.value = new Date().toISOString().split('T')[0];

// console.log(new Date().toISOString().split('T')[0]);

</script>
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