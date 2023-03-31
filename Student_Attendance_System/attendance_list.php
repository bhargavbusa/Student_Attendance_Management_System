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
                    <h1 class="h3 mb-4 text-gray-800">Attendance</h1>

                     <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Attendance Tables</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Stident Name</th>
                                            <th>Roll No.</th>    
                                            <th>Class</th>
                                            <th>Attendance Status</th>
                                            <th>Attendance Date</th>    
                                            <th>Teacher Name</th>
                                            <th>Language</th>    
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Stident Name</th>
                                            <th>Roll No.</th>    
                                            <th>Class</th>
                                            <th>Attendance Status</th>
                                            <th>Attendance Date</th>    
                                            <th>Teacher Name</th>    
                                            <th>Language</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <th>raju</th>
                                            <th>28</th>    
                                            <th>5BCA-A</th>
                                            <th><span class="badge badge-success rounded-pill d-inline">Present</span></th>
                                            <th>2023-10-28</th>    
                                            <th>ramu</th>
                                            <th>java</th>    
                                        </tr>
                                        <tr>
                                            <th>meet</th>
                                            <th>89</th>    
                                            <th>5BCA-A</th>
                                            <th><span class="badge badge-danger rounded-pill d-inline">Absent</span></th>
                                            <th>2023-10-28</th>    
                                            <th>ramu</th>
                                            <th>python</th>    
                                        </tr>
                                    </tbody>
                                </table>
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