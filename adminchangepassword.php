<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	$oldpassword= md5($_POST[oldpassword]);
	$newpass= md5($_POST[newpassword]);
	$sql = "UPDATE employee SET password='$newpass' WHERE login_id='$_POST[loginid]' AND password='$oldpassword'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Employee password updated successfully...');</script>";
	}	
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Change Password</h1>
          <p class="margin-bottom-15">Kindly enter old password and new password to change password..</p>
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal templatemo-signin-form" name="frmadminchangepassword" role="form" action="" method="post"onsubmit="return javascriptvalidation()">
        <div class="form-group" >
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label" >Login Id:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" placeholder="Login Id" name="loginid">
            </div>
          <div class="col-md-6 margin-bottom-15"><br />
                  <span id="jsloginid" ></span>
                  </div>
                </div>
        
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label">Old Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="oldpassword" placeholder="Old-Password" name="oldpassword">
            </div>
          <div class="col-md-6 margin-bottom-15"><br />
                  <span id="jsoldpassword" ></span>
                  </div>
                </div>
        
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label">New Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="newpassword" placeholder="New-Password" name="newpassword">
            </div>
           <div class="col-md-6 margin-bottom-15"><br />
                  <span id="jsnewpassword" ></span>
                  </div>
                </div>
        
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label">Confirm Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm-Password" name="confirmpassword">
            </div>
          <div class="col-md-6 margin-bottom-15"><br />
                  <span id="jsconfirmpassword" ></span>
                  </div>
                </div>
        
                  <div class="form-group">
                  <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" value="Change Password" class="btn btn-default" name="submit">
                    </div>
                  </div>
                </div>
      		</form>
          </div>
        </div>
      </div>
    </div>
    </div>
   </div>
   </div>
    
	<script type="application/javascript">
	function javascriptvalidation()
	{
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		
		document.getElementById("jsloginid").innerHTML ="";
		document.getElementById("jsoldpassword").innerHTML ="";
		document.getElementById("jsnewpassword").innerHTML ="";
		document.getElementById("jsconfirmpassword").innerHTML ="";
		document.getElementById("jsconfirmpassword").innerHTML ="";
		
		var validateform=0;      
			
			if(!document.frmadminchangepassword.loginid.value.match(alphanumbericExp))
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>Only alphabets and digits are allowed</strong></font>";
				validateform=1;
			}
			if(document.frmadminchangepassword.loginid.value=="")
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>This field should not be empty..</strong></font>";
				validateform=1;
			}
			
			if(!document.frmadminchangepassword.oldpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsoldpassword").innerHTML ="<font color='red'><strong>Only alphabets and digits are allowed</strong></font>";
				validateform=1;
			}
			if(document.frmadminchangepassword.oldpassword.value=="")
			{
				document.getElementById("jsoldpassword").innerHTML ="<font color='red'><strong>This field should not be empty..</strong></font>";
				validateform=1;
			}
			
			if(document.frmadminchangepassword.newpassword.value.length < 8)
			{
				document.getElementById("jsnewpassword").innerHTML ="<font color='red'><strong>This field should contain more than 8 charaters..</strong></font>";
				validateform=1;
			}
					
			if(!document.frmadminchangepassword.newpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsnewpassword").innerHTML ="<font color='red'><strong>Only alphabets and digits are allowed</strong></font>";
				validateform=1;
			}			
			
			if(!document.frmadminchangepassword.confirmpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>Only alphabets and digits are allowed</strong></font>";
				validateform=1;
			}
			if(document.frmadminchangepassword.newpassword.value=="")
			{
				document.getElementById("jsnewpassword").innerHTML ="<font color='red'><strong>This field should not be empty...</strong></font>";
				validateform=1;
			}
			if(document.frmadminchangepassword.newpassword.value != document.frmadminchangepassword.confirmpassword.value)
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>New-Password and Confirm Password not matching..</strong></font>";
				validateform=1;
			}
			if(document.frmadminchangepassword.confirmpassword.value=="")
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>This field  should not be empty..</strong></font>";
				validateform=1;
			}
			
			if(validateform==0)
			{
			return true;
			}
			else
			{
				return false;
			}
			
	}
</script>	
<?php
	include("footer.php");
	?>