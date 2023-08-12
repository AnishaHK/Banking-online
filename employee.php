<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
		$admpwd=md5($_POST['password']);
		if(isset($_GET['editid']))
		{
				$sql = "update employee set ifsc_code='$_POST[ifsccode]', emp_name='$_POST[employeename]', login_id='$_POST[loginid]', password='$admpwd', email_id='$_POST[emailid]', contact_no='$_POST[contactno]', emp_type='$_POST[employeetype]', create_date='$dttim', last_login='$dttim' where emp_id=$_GET[editid] ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Employee record updated successfully..');</script>";
			}

		}
		else
		{
			$sql = "insert into employee(ifsc_code,emp_name,login_id,password,email_id,contact_no,emp_type,create_date,last_login) VALUES('$_POST[ifsccode]','$_POST[employeename]','$_POST[loginid]','$admpwd','$_POST[emailid]','$_POST[contactno]','$_POST[employeetype]','$dttim','$dttim') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Employee record inserted successfully..');</script>";
			}
		}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM employee where emp_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Employee</h1>
          <p class="margin-bottom-15">Enter employee details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmemployee"  method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Branch</label>
                    <select class="form-control margin-bottom-15" name="ifsccode">
                    <option value="">Select</option>
                    <?php
                    $sqlbranch= "SELECT * FROM branch";
                    $qsqlbranch =mysqli_query($con,$sqlbranch);
                    while($rsbranch = mysqli_fetch_array($qsqlbranch))
                    {
                       if($rsbranch['ifsc_code'] == $rsedit['ifsc_code'])
                        {
                            echo "<option value='$rsbranch[ifsc_code]' selected>$rsbranch[branch_name]($rsbranch[ifsc_code]): $rsbranch[branch_address], $rsbranch[state], $rsbranch[country] </option>";
                        }
                        else
                        {
                            echo "<option value='$rsbranch[ifsc_code]' >$rsbranch[branch_name]($rsbranch[ifsc_code]): $rsbranch[branch_address], $rsbranch[state], $rsbranch[country] </option>";
                        }
                    }
                    ?>
                  </select>                 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbranch" ></span>
                  </div>
                  </div>
                  
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Employee Name</label>
<input type="text" class="form-control" name="employeename" placeholder="Employee Name" value="<?php echo $rsedit['emp_name']; ?>">  
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
                    <label for="firstName" class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $rsedit['password']; ?>">  
                  </div>
              <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jspassword" ></span>
                  </div>
                </div> 
                
    
                  
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $rsedit['password']; ?>">  
                  </div>
                  
                 
              <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsconfirmpassword" ></span>
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
                    <input type="text" class="form-control" name="contactno" placeholder="Contact No" value="<?php echo $rsedit['contact_no']; ?>"> 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscontactno" ></span>
                  </div>
                </div> 
                
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Employee Type</label>
                   <select class="form-control" name="employeetype" >
                  <option value="">Select</option>
                    <?php
					$arr = array("Admin","Employee");
					foreach($arr as $val)
					{
						if($val == $rsedit['emp_type'])
						{
						echo "<option value='$val' selected>$val</option>";
						}
						else
						{
						echo "<option value='$val'>$val</option>";
						}
					}
					?>
                 </select>
                  </div>
                 
                  <div class="col-md-6 margin-bottom-15"><br /><br />
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

   
<script type="application/javascript">
	function javascriptvalidation()
	{
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		
		document.getElementById("jsbranch").innerHTML ="";
		document.getElementById("jsemployeename").innerHTML ="";
		document.getElementById("jsloginid").innerHTML ="";
		document.getElementById("jspassword").innerHTML ="";
		document.getElementById("jsconfirmpassword").innerHTML ="";
		document.getElementById("jsconfirmpassword").innerHTML ="";
		document.getElementById("jsemailid").innerHTML ="";
		document.getElementById("jscontactno").innerHTML ="";
		document.getElementById("jsemployeetype").innerHTML ="";
		
		var validateform=0;      
			if(document.frmemployee.ifsccode.value=="")
			{
				document.getElementById("jsbranch").innerHTML ="<font color='red'><strong>Branch name should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmemployee.employeename.value.match(alphaspaceExp))
			{
				document.getElementById("jsemployeename").innerHTML ="<font color='red'><strong>Employee name is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmemployee.employeename.value=="")
			{
				document.getElementById("jsemployeename").innerHTML ="<font color='red'><strong>Employee name should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmemployee.loginid.value.match(alphanumbericExp))
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>Login ID is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			if(document.frmemployee.loginid.value=="")
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>Login ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmemployee.password.value.match(alphanumbericExp))
			{
				document.getElementById("jspassword").innerHTML ="<font color='red'><strong>Password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			if(document.frmemployee.password.value.length < 8)
			{
				document.getElementById("jspassword").innerHTML ="<font color='red'><strong>Password should be more than 8 charaters...</strong></font>";
				validateform=1;
			}			
			if(document.frmemployee.password.value=="")
			{
				document.getElementById("jspassword").innerHTML ="<font color='red'><strong>Password should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmemployee.confirmpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>Confirm password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			} 
			if(document.frmemployee.confirmpassword.value=="")
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>Confirm Password should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmemployee.password.value != document.frmemployee.confirmpassword.value )
			{
				document.getElementById("jsconfirmpassword").innerHTML ="<font color='red'><strong>Password and Confirm password not matching..</strong></font>";
				validateform=1;
			}
			if(document.frmemployee.emailid.value=="")
			{
				document.getElementById("jsemailid").innerHTML ="<font color='red'><strong>Email ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmemployee.contactno.value.match(numericExpression))
			{
				document.getElementById("jscontactno").innerHTML ="<font color='red'><strong>Contact number is not valid. Kindly input numbers.</strong></font>";
				validateform=1;
			}
			if(document.frmemployee.contactno.value=="")
			{
				document.getElementById("jscontactno").innerHTML ="<font color='red'><strong>Contact number should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmemployee.employeetype.value=="")
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
 <?php
	include("footer.php");
	?>