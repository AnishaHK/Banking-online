<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{  
	if(isset($_POST['submit']))
	{
		$apwd = md5($_POST[accountpassword]);
		$tpwd = md5($_POST[transactionpassword]);
		
			if(isset($_GET['editid']))
			{
				$sql = "update customer set ifsc_code='$_POST[ifsccode]',first_name='$_POST[firstname]',last_name='$_POST[lastname]', login_id='$_POST[loginid]', acc_password='$apwd', trans_password='$tpwd',email_id='$_POST[emailid]', acc_status='$_POST[accountstatus]', address='$_POST[address]', city='$_POST[city]', state='$_POST[state]', country='$_POST[country]',mob_no='$_POST[mob_no]' where customer_id=$_GET[editid]";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<script>alert('Customer record updated successfully..');</script>";
				}
			}
			else
			{
				$sql = "insert into customer(ifsc_code,first_name,last_name,login_id,acc_password,trans_password,email_id,acc_status,address,city,state,country,acc_open_date,mob_no) VALUES('$_POST[ifsccode]','$_POST[firstname]','$_POST[lastname]','$_POST[loginid]','$apwd','$tpwd','$_POST[emailid]','$_POST[accountstatus]','$_POST[address]','$_POST[city]','$_POST[state]','$_POST[country]','$dttim','$_POST[mob_no]')";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<script>alert('Customer record inserted successfully..');</script>";
					$insid = mysqli_insert_id($con);
					echo "<script>window.location='viewcustomerac.php?customeracid=$insid';</script>";
				}				
			}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM customer where customer_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Customer</h1>
          <p class="margin-bottom-15">Enter customer details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmcustomer"  method="post" action=""  onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Branch name</label>
                    <select class="form-control margin-bottom-15" name="ifsccode">
                    <?php
					if($rsemployee['emp_type'] == "Employee")
					{
                        $sqlbranch= "SELECT * FROM branch WHERE ifsc_code='$rsemployee[ifsc_code]'";
                        $qsqlbranch =mysqli_query($con,$sqlbranch);
                        while($rsbranch = mysqli_fetch_array($qsqlbranch))
                        {	
                            echo "<option value='$rsbranch[ifsc_code]' >$rsbranch[branch_name] ($rsbranch[ifsc_code]) : $rsbranch[branch_address], $rsbranch[state], $rsbranch[country] </option>";
                        }   
					}
					else
					{
					?>
                        <option value="">Select</option>
                        <?php
                        $sqlbranch= "SELECT * FROM branch";
                        $qsqlbranch =mysqli_query($con,$sqlbranch);
                        while($rsbranch = mysqli_fetch_array($qsqlbranch))
                        {	
                            if($rsbranch['ifsc_code'] == $rsedit['ifsc_code'])
                            {
                            echo "<option value='$rsbranch[ifsc_code]' selected>$rsbranch[branch_name] : $rsbranch[branch_address], $rsbranch[state], $rsbranch[country] </option>";
                            }
                            else
                            {
                            echo "<option value='$rsbranch[ifsc_code]' >$rsbranch[branch_name] : $rsbranch[branch_address], $rsbranch[state], $rsbranch[country] </option>";
                            }
                        }
                        ?>
                    <?php
					}
					?>
                  </select> 
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsifsccode" ></span>
                  </div>
                  </div>
                                   
                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">First Name</label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $rsedit[first_name]; ?>">                    
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsfirstname" ></span>
                  </div>
                  </div>
                
                   <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $rsedit['last_name']; ?>">                     
                  </div>
                    <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jslastname" ></span>
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
                    <label for="firstName" class="control-label">Account Login Password</label>
                    <input type="password" class="form-control" name="accountpassword" placeholder="Account Login Password" value="<?php echo $rsedit[acc_password]; ?>">                     
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccountpassword" ></span>
                  </div>
                  </div>
                
                 <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> Confirm Login Password</label>
                    <input type="password" class="form-control" name="confirmloginpassword" placeholder="Confirm Login Password" value="<?php echo $rsedit[acc_password]; ?>">                     
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsconfirmloginpassword" ></span>
                  </div>
                  </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> Transaction Password</label>
                    <input type="password" class="form-control" name="transactionpassword" placeholder=" Transaction Password" value="<?php echo $rsedit[trans_password]; ?>">                     
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jstransactionpassword" ></span>
                  </div>
                  </div>
                
                 <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> Confirm Transaction Password</label>
                    <input type="password" class="form-control" name="confirmtransactionpassword" placeholder="Confirm Transaction Password" value="<?php echo $rsedit[trans_password]; ?>">                     
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsconfirmtransactionpassword" ></span>
                  </div>
                  </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Mobile Number</label>
                    <input type="text" class="form-control" name="mob_no" placeholder="Mobile number" value="<?php echo $rsedit['mob_no']; ?>">                     
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsmoblno" ></span>
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
                    <label for="firstName" class="control-label">Address</label>
                    <textarea  class="form-control" name="address" placeholder="Address"><?php echo $rsedit[address]; ?></textarea>
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaddress" ></span>
                  </div>
                  </div>
                   
                
                 <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> City</label>
                    <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $rsedit[city]; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscity" ></span>
                  </div>
                  </div>

                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> State</label>
        <select class="form-control margin-bottom-15" name="State">
                                <option value="">Select status</option>
                                <?php
                                $arr = array("Karnataka","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Andra Pradesh","Kerala","Madya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Orissa","Punjab","Rajasthan","Sikkim","Tamil Nadu","Tripura","Uttaranchal","Uttar Pradesh","West Bengal");
                                foreach($arr as $val)
                                {
                                    if($val == $rsedit['state'])
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
                  <span id="jsstate" ></span>
                  </div>
                  </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> Country</label>
                    <input type="text" class="form-control" name="country" placeholder="  Country" value="India" readonly style="background-color:#FFC">
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscountry" ></span>
                  </div>
                  </div>             
                                          
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Status</label>
                 	<select class="form-control margin-bottom-15" name="accountstatus">
                     	<option value="">Select status</option>
						<?php
                        $arr = array("Active","Pending");
                        foreach($arr as $val)
                        {
                            if($val == $rsedit['acc_status'])
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
                  <span id="jsaccountstatus" ></span>
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
		
		var editid = '<?php echo $_GET[editid]; ?>';

		document.getElementById("jsifsccode").innerHTML ="";
		document.getElementById("jsfirstname").innerHTML ="";
		document.getElementById("jslastname").innerHTML ="";
		document.getElementById("jsloginid").innerHTML ="";				
	
		if(editid=="")
		{
		document.getElementById("jsaccountpassword").innerHTML ="";
		document.getElementById("jsconfirmloginpassword").innerHTML ="";
		document.getElementById("jsconfirmloginpassword").innerHTML ="";
		document.getElementById("jstransactionpassword").innerHTML ="";
		document.getElementById("jsconfirmtransactionpassword").innerHTML ="";
		document.getElementById("jsconfirmtransactionpassword").innerHTML ="";
		}	
		document.getElementById("jsmoblno").innerHTML ="";	
		document.getElementById("jsemailid").innerHTML ="";
		document.getElementById("jsaddress").innerHTML ="";
		document.getElementById("jscity").innerHTML ="";
		document.getElementById("jsstate").innerHTML ="";
		document.getElementById("jscountry").innerHTML ="";
		document.getElementById("jsaccountstatus").innerHTML ="";

		var validateform=0;      
		
			if(document.frmcustomer.ifsccode.value=="")
			{
				document.getElementById("jsifsccode").innerHTML ="<font color='red'><strong>IFSC code should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.firstname.value.match(alphaExp))
			{
				document.getElementById("jsfirstname").innerHTML ="<font color='red'><strong>First name is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.firstname.value=="")
			{
				document.getElementById("jsfirstname").innerHTML ="<font color='red'><strong>First name should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.lastname.value.match(alphaExp))
			{
				document.getElementById("jslastname").innerHTML ="<font color='red'><strong>Last name is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.lastname.value=="")
			{
				document.getElementById("jslastname").innerHTML ="<font color='red'><strong>Last name should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.loginid.value.match(alphanumbericExp))
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>Login ID is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			if(document.frmcustomer.loginid.value=="")
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>Login ID should not be empty...</strong></font>";
				validateform=1;
			}
			
		if(editid=="")
		{
			if(!document.frmcustomer.accountpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsaccountpassword").innerHTML ="<font color='red'><strong>Account password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			if(document.frmcustomer.accountpassword.value.length < 8)
			{
				document.getElementById("jsaccountpassword").innerHTML ="<font color='red'><strong>Account Password should be more than 8 charaters...</strong></font>";
				validateform=1;
			}						
			if(document.frmcustomer.accountpassword.value=="")
			{
				document.getElementById("jsaccountpassword").innerHTML ="<font color='red'><strong>Account password should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.confirmloginpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsconfirmloginpassword").innerHTML ="<font color='red'><strong>Confirm Login password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			
			if(document.frmcustomer.confirmloginpassword.value=="")
			{
				document.getElementById("jsconfirmloginpassword").innerHTML ="<font color='red'><strong>Confirm Login Password should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.accountpassword.value != document.frmcustomer.confirmloginpassword.value )
			{
				document.getElementById("jsconfirmloginpassword").innerHTML ="<font color='red'><strong>Account Password and Confirm account password not matching..</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.transactionpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jstransactionpassword").innerHTML ="<font color='red'><strong>Transaction password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			if(document.frmcustomer.transactionpassword.value.length < 8)
			{
				document.getElementById("jstransactionpassword").innerHTML ="<font color='red'><strong>Transaction Password should be more than 8 characters...</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.transactionpassword.value=="")
			{
				document.getElementById("jstransactionpassword").innerHTML ="<font color='red'><strong>Transaction Password should not be empty...</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.confirmtransactionpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsconfirmtransactionpassword").innerHTML ="<font color='red'><strong>Confirm transaction password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			if(document.frmcustomer.confirmtransactionpassword.value=="")
			{
				document.getElementById("jsconfirmtransactionpassword").innerHTML ="<font color='red'><strong>Confirm transaction password should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.transactionpassword.value != document.frmcustomer.confirmtransactionpassword.value )
			{
				document.getElementById("jsconfirmtransactionpassword").innerHTML ="<font color='red'><strong>Transaction password and confirm transaction password not matching...</strong></font>";
				validateform=1;
			}
		}
			if(!document.frmcustomer.mob_no.value.match(numericExpression))
			{
				document.getElementById("jsmoblno").innerHTML ="<font color='red'><strong>Only digits are allowed.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.mob_no.value=="")
			{
				document.getElementById("jsmoblno").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.emailid.value=="")
			{
				document.getElementById("jsemailid").innerHTML ="<font color='red'><strong>Email ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.address.value=="")
			{
				document.getElementById("jsaddress").innerHTML ="<font color='red'><strong>Address should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.city.value.match(alphaspaceExp))
			{
				document.getElementById("jscity").innerHTML ="<font color='red'><strong>City is not valid. Kindly input alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.city.value=="")
			{
				document.getElementById("jscity").innerHTML ="<font color='red'><strong>City should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.State.value.match(alphaspaceExp))
			{
				document.getElementById("jsstate").innerHTML ="<font color='red'><strong>State is not valid. Kindly input alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.State.value=="")
			{
				document.getElementById("jsstate").innerHTML ="<font color='red'><strong>State should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.accountstatus.value=="")
			{
				document.getElementById("jsaccountstatus").innerHTML ="<font color='red'><strong>Account status should not be empty..</strong></font>";
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
