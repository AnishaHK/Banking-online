<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
			$sql = "UPDATE employee SET ifsc_code='$_POST[ifsccode]', emp_name='$_POST[employeename]', login_id='$_POST[loginid]', email_id='$_POST[emailid]', contact_no='$_POST[contactno]', emp_type='$_POST[employeetype]' WHERE emp_id='$_SESSION[emp_id]' ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Employee Profile updated successfully..');</script>";
			}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_SESSION['emp_id']))
{
	$sqledit = "SELECT * FROM employee where emp_id='$_SESSION[emp_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Admin Profile</h1>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmadminprofile" method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />       
                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Admin Name</label>
                    <input type="text" class="form-control" name="employeename" placeholder="Admin Name" value="<?php echo $rsedit['emp_name']; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsemployeename" ></span>
                  </div>
                </div>  
                                                      
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Login ID</label>
                    <input type="text" class="form-control" name="loginid" placeholder="Login ID" value="<?php echo $rsedit['login_id']; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloginid" ></span>
                  </div>
                </div>  
                
 
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Email ID</label>
                    <input type="email" class="form-control" name="emailid" placeholder="Email ID" value="<?php echo $rsedit['email_id']; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsemailid" ></span>
                  </div>
                </div>   
               
               <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Contact No</label>
                    <input type="number" class="form-control" name="contactno" placeholder="Contact No" value="<?php echo $rsedit['contact_no']; ?>"> 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscontactno" ></span>
                  </div>
                </div> 
                
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Employee Type</label>
                   <input type="text" class="form-control" name="employeetype" placeholder="Employee Type" value="Admin" readonly style="background-color:#FC6"> 
                   <!--<select class="form-control" name="employeetype" >
                    <?php
					$arr = array("Admin","Employee");
					foreach($arr as $val)
					{
						if($val == $rsedit['emp_type'])
						{
						echo "<option value='$val' selected>$val</option>";
						}
					}
					?>
                 </select> -->
                  </div>
                  <div class="col-md-6 margin-bottom-10"><br /><br />
                  <span id="jsemployeetype" ></span>
                  </div>
                </div>
                                
                         
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
	include("footer.php");
	?>
	<script type="application/javascript">
	function javascriptvalidation()
	{
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		           
		document.getElementById("jsemployeename").innerHTML ="";
		document.getElementById("jsloginid").innerHTML ="";
		document.getElementById("jsemailid").innerHTML ="";
		document.getElementById("jscontactno").innerHTML ="";
		document.getElementById("jsemployeetype").innerHTML ="";
		
		
		var validateform=0;     
			if(!document.frmadminprofile.employeename.value.match(alphaspaceExp))
			{
				document.getElementById("jsemployeename").innerHTML ="<font color='red'><strong>Admin name is not valid. Kindly input alphabets.</strong></font>";
				validateform=1;
			}				 
			if(document.frmadminprofile.employeename.value=="")
			{
				document.getElementById("jsemployeename").innerHTML ="<font color='red'><strong>Payee ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmadminprofile.loginid.value.match(alphanumbericExp))
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>Login ID is not valid. Kindly input numbers and alphabets.</strong></font>";
				validateform=1;
			}			
			if(document.frmadminprofile.loginid.value=="")
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>Login ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmadminprofile.emailid.value=="")
			{
				document.getElementById("jsemailid").innerHTML ="<font color='red'><strong>Email Id should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmadminprofile.contactno.value.match(numericExpression))
			{
				document.getElementById("jscontactno").innerHTML ="<font color='red'><strong>Contact number should not be empty.</strong></font>";
				validateform=1;
			}			
			if(document.frmadminprofile.contactno.value=="")
			{
				document.getElementById("jscontactno").innerHTML ="<font color='red'><strong>Contact number is not valid. Kindly input numbers.</strong></font>";
				validateform=1;
			}				
			if(document.frmadminprofile.employeetype.value=="")
			{
				document.getElementById("jsemployeetype").innerHTML ="<font color='red'><strong>Employee type should not be empty..</strong></font>";
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