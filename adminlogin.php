<?php
include("header.php");
if(isset($_SESSION['emp_id']))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_POST['submit']))
{
	$admpwd = md5($_POST['password']);
 	$sql = "SELECT * FROM employee where login_id='$_POST[loginid]' AND password='$admpwd'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION['emp_id'] = $rs['emp_id'];
		$_SESSION['emp_type'] = $rs['emp_type'];
		echo "<script>window.location='dashboard.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid Login credentials entered..');</script>";
	}
}
?>
<body background="ebimages/42190839-e-banking-e-banking-laptop-with-bank-3d-icon-Stock-Photo-online (1).jpg" style="background-repeat:inherit">
    <div class="template-page-wrapper"><br /><br /><br /><br />
    <center><h1><strong>Staff Login Panel</strong></h1></center>
      <form class="form-horizontal templatemo-signin-form" role="form" action="" method="post">
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label"><b><strong>Login Id</strong></b></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" placeholder="Login Id" name="loginid">
            </div>
          </div>              
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label"><strong>Password</strong></label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Sign in" class="btn btn-default" name="submit" id="submit">
            </div>
          </div>
        </div>
      </form>
    </div>
   
  </div>
</body>
</html>