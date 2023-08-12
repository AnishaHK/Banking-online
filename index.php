<?php
include("header.php");
if(isset($_SESSION['customer_id']))
{
	echo "<script>window.location='customerpanel.php';</script>";
}
if(isset($_SESSION['emp_id']))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_POST['submit']))
{
	$loginpwd = md5($_POST['password']);
	$sql = "SELECT * FROM customer where login_id='$_POST[loginid]' AND acc_password='$loginpwd' AND acc_status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
			$rs = mysqli_fetch_array($qsql);	
			$_SESSION['customer_id'] = $rs['customer_id'];
			//Update customer last login
			$_SESSION['last_login'] == $rs['last_login'];			
			$sql = "UPDATE customer SET last_login='$dttim' where login_id='" . $_POST['loginid'] . "'";
			$qsql = mysqli_query($con,$sql);		
			echo "<script>window.location='customerpanel.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid Login credentials entered..');</script>";
	}
}
?>
<body background="ebimages/logo.png" style="background-size:cover">

    <center><h1><b>Customer Login Panel</b></h1></center>
    
<div class="template-page-wrapper"  style="height:450px; ">
      <form class="form-horizontal templatemo-signin-form" role="form" action="" method="post">
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">Login ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="loginid" name="loginid" placeholder="Login ID">
            </div>
          </div>              
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Sign in" class="btn btn-default" name="submit">
            </div>
          </div>
        </div>
        
      </form>
      	<br>
      	<br>
<center><hr style="border-top: 1px solid #631818;">
  <center><h1><b>Open Bank Account Through Online...</b></h1></center>
  <a href="register.php" class="btn btn-default"><strong>Click Here to Register</strong></a>
</center>
      
    </div>  
</div>
</body>
<?php
include("footer.php");
?>