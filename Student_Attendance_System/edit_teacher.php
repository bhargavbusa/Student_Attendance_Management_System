<?php
session_start();
error_reporting(0);
include('include/config1.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:login.php');
}
else{
    


//edit teacher
if(isset($_POST['add_teacher']))
  {

    $teacher_name=$_POST['teacher_name'];
    $teacher_address=$_POST['teacher_address'];
    $teacher_emailid=$_POST['teacher_emailid'];
    $teacher_password=md5($_POST['teacher_password']);
    $teacher_qualification=$_POST['teacher_qualification'];
    $teacher_doj=$_POST['teacher_doj'];
    $teacher_language=$_POST['teacher_language'];
    $p=$_FILES["teacher_image"]["name"];
    
    if($_POST['teacher_password']!="")
    {
        if($p!="")
        {   //delete Teacher Photo
            // Getting other photo ID to unlink from folder
            $statement1 = $dbh->prepare("SELECT * FROM tbl_teacher WHERE teacher_id=?");
            $statement1->execute(array($_REQUEST['id']));
            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
            foreach ($result1 as $row1) {
                $photo1 = $row1['teacher_image'];
                unlink('images/'.$photo1);
            }

            // upload Teacher photo
            move_uploaded_file($_FILES["teacher_image"]["tmp_name"],"images/".$p);
            $statement = $dbh->prepare("UPDATE tbl_teacher SET teacher_name=?,teacher_address=?,teacher_emailid=?,teacher_password=?,teacher_qualification=?,teacher_doj=?,teacher_language=?,teacher_image=? WHERE teacher_id=?");
            $statement->execute(array($teacher_name,$teacher_address,$teacher_emailid,$teacher_password,$teacher_qualification,$teacher_doj,$teacher_language,$p,$_REQUEST['id']));

        }
        else{

            $statement = $dbh->prepare("UPDATE tbl_teacher SET teacher_name=?,teacher_address=?,teacher_emailid=?,teacher_password=?,teacher_qualification=?,teacher_doj=?,teacher_language=? WHERE teacher_id=?");
            $statement->execute(array($teacher_name,$teacher_address,$teacher_emailid,$teacher_password,$teacher_qualification,$teacher_doj,$teacher_language,$_REQUEST['id']));

        }
    }
    else{

        if($p!="")
        {   //delete Teacher Photo
            // Getting other photo ID to unlink from folder
            $statement1 = $dbh->prepare("SELECT * FROM tbl_teacher WHERE teacher_id=?");
            $statement1->execute(array($_REQUEST['id']));
            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
            foreach ($result1 as $row1) {
                $photo1 = $row1['teacher_image'];
                unlink('images/'.$photo1);
            }

            // upload Teacher photo
            move_uploaded_file($_FILES["teacher_image"]["tmp_name"],"images/".$p);
            $statement = $dbh->prepare("UPDATE tbl_teacher SET teacher_name=?,teacher_address=?,teacher_emailid=?,teacher_qualification=?,teacher_doj=?,teacher_language=?,teacher_image=? WHERE teacher_id=?");
            $statement->execute(array($teacher_name,$teacher_address,$teacher_emailid,$teacher_qualification,$teacher_doj,$teacher_language,$p,$_REQUEST['id']));

        }
        else{

            $statement = $dbh->prepare("UPDATE tbl_teacher SET teacher_name=?,teacher_address=?,teacher_emailid=?,teacher_qualification=?,teacher_doj=?,teacher_language=? WHERE teacher_id=?");
            $statement->execute(array($teacher_name,$teacher_address,$teacher_emailid,$teacher_qualification,$teacher_doj,$teacher_language,$_REQUEST['id']));

        }
    }





if($statement)
{
$msg=" update Teacher successfully";
//sleep for 5 seconds
echo "<script>setTimeout(()=> { window.location='show_teacher.php'} ,5000);</script>";
}
else 
{
$error=" Something went wrong. Please try again";
}
  }
?>

<?php
// Getting fatch teacher
$statement = $dbh->prepare("SELECT * FROM tbl_teacher WHERE teacher_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$teacher_name = $row['teacher_name'];
	$teacher_address = $row['teacher_address'];
	$teacher_emailid = $row['teacher_emailid'];
	$teacher_password = $row['teacher_password'];
	$teacher_qualification = $row['teacher_qualification'];
	$teacher_doj = $row['teacher_doj'];
	$teacher_image = $row['teacher_image'];
	$teacher_language = $row['teacher_language'];	
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Teacher</h1>

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
                                        <label for="inputText" class="col-sm-2 col-form-label">Teacher Name</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Teacher Name" value="<?php echo $teacher_name; ?>" name="teacher_name" >
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Address" value="<?php echo $teacher_address; ?>" name="teacher_address" >
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Email Address</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Email Address" value="<?php echo $teacher_emailid; ?>" name="teacher_emailid">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="teacher_password">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Qualification</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Qualification" value="<?php echo $teacher_qualification; ?>" name="teacher_qualification">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Date of Joining</label>
                                        <div class="col-sm-8">
                                        <input type="date" class="form-control" placeholder="Date of Joining" value="<?php echo $teacher_doj; ?>" name="teacher_doj">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Language</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Language" value="<?php echo $teacher_language; ?>" name="teacher_language">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" value="<?php echo $teacher_image; ?>" name="teacher_image" accept="image/png, image/jpeg">
                                            <label class="custom-file-label" for="customFile">Choose Image</label>
                                        </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-8" style="width:82px;">
                                        <img src="images/<?php echo $teacher_image; ?>" alt="<?php echo $teacher_image; ?>" style="width:80px;">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <label for="input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-8">
                                        <input type="submit" value="Add Teacher" name="add_teacher" class="btn btn-primary" >
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