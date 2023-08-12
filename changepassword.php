<?php
include("header.php");
?>
    <div class="template-page-wrapper">
      <form class="form-horizontal templatemo-signin-form" name="frmchangepassword" role="form" action="index.php" method="post" onsubmit="return javascriptvalidation()">
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">Old Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="oldpassword" placeholder="Old Password" name="oldpassword">
            </div>
             <div class="col-md-6 margin-bottom-15"><br />
                  <span id="jsoldpassword" ></span>
          </div>              
        </div>
   
           <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">New Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="newpassword" placeholder="New Password" name="newpassword">
            </div>
             <div class="col-md-6 margin-bottom-15"><br />
                  <span id="jsnewpassword" ></span>
          </div>              
        </div>
        
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">Confirm Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword">
            </div>
             <div class="col-md-6 margin-bottom-15"><br />
                  <span id="jsconfirmpassword" ></span>
          </div>              
        </div>
        
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Submit" class="btn btn-default">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
	<script type="application/javascript">
	function javascriptvalidation()
	{
		document.getElementById("jsoldpassword").innerHTML ="";
		document.getElementById("jsnewpassword").innerHTML ="";
		document.getElementById("jsconfirmpassword").innerHTML ="";
		document.getElementById("jsconfirmpassword").innerHTML ="";
		
		var validateform=0;     
			if(document.frmchangepassword.oldpassword.value=="")
			{
				document.getElementById("jsoldpassword").innerHTML ="<font color='red'><strong>Old-Password should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmchangepassword.newpassword.value.length < 8)
			{
				document.getElementById("jsnewpassword").innerHTML ="<font color='red'><strong>New-Password should be more than 8 charaters..</strong></font>";
				validateform=1;
			}
			if(document.frmchangepassword.newpassword.value=="")
			{
				document.getElementById("jsnewpassword").innerHTML ="<font color='red'><strong>New-Password should not be empty...</strong></font>";
				validateform=1;
			}			
			if(document.frmchangepassword.confirmpassword.value=="")
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>Confirm Password should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmchangepassword.newpassword.value != document.frmchangepassword.confirmpassword.value)
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>New-Password and Confirm Password not matching..</strong></font>";
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