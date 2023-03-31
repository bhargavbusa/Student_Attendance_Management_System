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
// Checking id is not fetch then logout
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $dbh->prepare("SELECT * FROM tbl_teacher WHERE teacher_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

// Getting other photo ID to unlink from folder
$statement = $dbh->prepare("SELECT * FROM tbl_teacher WHERE teacher_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$photo = $row['teacher_image'];
	unlink('images/'.$photo);
}

// Delete from teacher class
$statement = $dbh->prepare("DELETE FROM tbl_teachet_class WHERE teacher_id=?");
$statement->execute(array($_REQUEST['id']));

// Delete from teacher
$statement = $dbh->prepare("DELETE FROM tbl_teacher WHERE teacher_id=?");
$statement->execute(array($_REQUEST['id']));

header('location: show_teacher.php');

?>

<?php } ?>