<?php
error_reporting(0);
	include("dbconnection.php");
	$sqledit = "SELECT interest FROM account_master where acc_type_id='$_GET[acc_type_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	echo $rsedit[0];
?>