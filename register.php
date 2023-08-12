<?php
include("header.php");
if(isset($_SESSION['customer_id']))
{
	echo "<script>window.location='customerpanel.php';</script>";
}
//if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
		$idproof = rand(111111,999999).$_FILES['idproof']['name'];
		$addressproof= rand(111111,999999). $_FILES['addressproof']['name'];
		move_uploaded_file($_FILES['idproof']['tmp_name'],"documents/".$idproof);
		move_uploaded_file($_FILES['addressproof']['tmp_name'],"documents/".$addressproof);	
		$acpwd = md5($_POST['accountpassword']);
		$trpwd = md5($_POST['transactionpassword']);
		$sql = "insert into customer(ifsc_code,first_name,last_name,login_id,acc_password,trans_password,email_id,acc_status,address,city,state,acc_open_date,mob_no,country,idproof,addressproof) VALUES('$_POST[ifsccode]','$_POST[firstname]','$_POST[lastname]','$_POST[loginid]','$acpwd','$trpwd','$_POST[emailid]','Pending','$_POST[address]','$_POST[city]','$_POST[state]','$dttim','$_POST[mob_no]','$_POST[country]','$idproof','$addressproof') ";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('You have registered successfully.. Bank executive will verify your account within 2 working days..');</script>";
			echo "<script>window.location='index.php';</script>";
		}
	}
}
$_SESSION['randomno'] = rand();
?>
<center><h1>Customer Registration Panel</h1></center>    
<div class="template-page-wrapper">
      <form class="form-horizontal templatemo-signin-form" name="frmregister" role="form" action="" method="post"  onsubmit="return javascriptvalidation()" enctype="multipart/form-data">
         <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
        
        <div class="form-group">
          <div class="col-md-12">
			<label for="firstName" class="control-label">Branch name</label>
                    <select class="form-control" name="ifsccode">
                    	<option value="">Select</option>
						<?php
                        $sqlbranch= "SELECT * FROM branch";
                        $qsqlbranch =mysqli_query($con,$sqlbranch);
                        while($rsbranch = mysqli_fetch_array($qsqlbranch))
                        {
                            echo "<option value='$rsbranch[ifsc_code]'>$rsbranch[branch_name] : $rsbranch[branch_address], $rsbranch[state], $rsbranch[country] </option>";
                        }
                        ?>
                  </select>
                  <span id="jsifsccode" ></span>   
          </div> 
          </div> 
          

          <div class="form-group">
          <div class="col-md-6">
                    <label for="firstName" class="control-label">First Name</label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name"> 
                    <span id="jsfirstname" ></span>   
          </div>
          <div class="col-md-6">
                    <label for="firstName" class="control-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name">  
          			<span id="jslastname" ></span>     
          </div>
          </div>
        
        
          <div class="form-group">
          <div class="col-md-12">
                    <label for="firstName" class="control-label">Login ID</label>
                    <input type="text" class="form-control" name="loginid" placeholder="Login ID"> 
          			<span id="jsloginid" ></span>     
          </div>
          </div>
      
          <div class="form-group">
          <div class="col-md-6">
                    <label for="firstName" class="control-label">Account Login Password</label>
                    <input type="password" class="form-control" name="accountpassword" placeholder="Account Login Password"> 
          			<span id="jsaccountpassword" ></span>  
          </div>
          <div class="col-md-6">
                    <label for="firstName" class="control-label"> Confirm Login Password</label>
                    <input type="password" class="form-control" name="confirmloginpassword" placeholder="Confirm Login Password">  
          			<span id="jsconfirmloginpassword" ></span>  
          </div> 
          </div>
        
        
          <div class="form-group">
          <div class="col-md-6">
                  <label for="firstName" class="control-label"> Transaction Password</label>
                  <input type="password" class="form-control" name="transactionpassword" placeholder=" Transaction Password"> 
         		<span id="jstransactionpassword" ></span> 
          </div> 
                    <div class="col-md-6">
           <label for="firstName" class="control-label"> Confirm Transaction Password</label>
           <input type="password" class="form-control" name="confirmtransactionpassword" placeholder="Confirm Transaction Password">
          <span id="jsconfirmtransactionpassword" ></span> 
          </div>
        </div>
        
          
        <div class="form-group">
          <div class="col-md-12">
					<label for="firstName" class="control-label">Mobile Number</label>
            		<input type="text" class="form-control" name="mob_no" placeholder="Mobile number" >
          			<span id="jsmob_no" ></span>          
          </div>   
         </div> 
        
          <div class="form-group">
          <div class="col-md-12">
                    <label for="firstName" class="control-label">Email ID</label>
                    <input type="email" class="form-control" name="emailid" placeholder="Email ID">  
          			<span id="jsemailid" ></span>          
          </div>  
          </div>

        
           <div class="form-group">
          <div class="col-md-12">
                    <label for="firstName" class="control-label">Address</label>
                    <textarea  class="form-control" name="address"></textarea>  
          			<span id="jsaddress" ></span>          
          </div> 
          </div>        
        
        
          <div class="form-group">
          <div class="col-md-12">
                     <label for="firstName" class="control-label"> City</label>
                    <input type="text" class="form-control" name="city" placeholder="  City">  
          			<span id="jscity" ></span>         
          </div>     
          </div>
       
          <div class="form-group">
          <div class="col-md-6">
                              <label for="firstName" class="control-label"> State</label>
                    <select name='state' class="form-control" >
                    <option value="">Select state</option>
					<?php
					$arr =  array("Karnataka","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Andra Pradesh","Kerala","Madya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Orissa","Punjab","Rajasthan","Sikkim","Tamil Nadu","Tripura","Uttaranchal","Uttar Pradesh","West Bengal");
					foreach($arr as $val)
					{
						echo "<option value='$val'>$val</option>";
					}
					?>
                    </select>
          			<span id="jsstate" ></span>        
          </div>  
          <div class="col-md-6">
                     <label for="firstName" class="control-label"> Country</label>
                    <input type="text" class="form-control" name="country" placeholder="  Country" value="India" readonly style="background-color:#FFC">  
          			<span id="jscity" ></span>         
          </div>  
          </div>
          
          
          <div class="form-group">
          <div class="col-md-6">
                     <label for="firstName" class="control-label"> Photo</label>
                    <input type="file" class="form-control" name="idproof" readonly style="background-color:#FFC">  
          			<span id="jsidproof" ></span>         
          </div>    
          <div class="col-md-6">
                     <label for="firstName" class="control-label"> Any Proof</label>
                    <input type="file" class="form-control" name="addressproof"   readonly style="background-color:#FFC">  
          			<span id="jsaddressproof" ></span>         
          </div>    
          </div>
          
          
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Click Here to Register" class="btn btn-default" name="submit">
            </div>
          </div>
        </div>
       </form>
    </div>
    <br />
<center>

  <a href="index.php"><strong>Click Here to Login</strong></a>
</center>
<br />

<script type="application/javascript">
	function javascriptvalidation()
	{	
	
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		
		document.getElementById("jsifsccode").innerHTML ="";
		document.getElementById("jsfirstname").innerHTML ="";
		document.getElementById("jslastname").innerHTML ="";
		document.getElementById("jsloginid").innerHTML ="";
		document.getElementById("jsaccountpassword").innerHTML ="";
		document.getElementById("jsconfirmloginpassword").innerHTML ="";
		document.getElementById("jsconfirmloginpassword").innerHTML ="";
		document.getElementById("jstransactionpassword").innerHTML ="";
		document.getElementById("jsconfirmtransactionpassword").innerHTML ="";
		document.getElementById("jsconfirmtransactionpassword").innerHTML ="";
		document.getElementById("jsmob_no").innerHTML ="";
		document.getElementById("jsemailid").innerHTML ="";
		document.getElementById("jsaddress").innerHTML ="";
		document.getElementById("jscity").innerHTML ="";
		document.getElementById("jsstate").innerHTML ="";
		document.getElementById("jsidproof").innerHTML ="";
		document.getElementById("jsaddressproof").innerHTML ="";
		
		var validateform=0;     
		if(document.frmregister.ifsccode.value=="")
			{
				document.getElementById("jsifsccode").innerHTML ="<font color='red'><strong>This field should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmregister.firstname.value.match(alphaExp))
			{
				document.getElementById("jsfirstname").innerHTML ="<font color='red'><strong>This field is not valid. Kindly enter only alphabets..</strong></font>";
				validateform=1;
			}
			if(document.frmregister.firstname.value=="")
			{
				document.getElementById("jsfirstname").innerHTML ="<font color='red'><strong>This field should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmregister.lastname.value.match(alphaExp))
			{
				document.getElementById("jslastname").innerHTML ="<font color='red'><strong>This field is not valid. Kindly enter only alphabets..</strong></font>";
				validateform=1;
			}
			if(document.frmregister.lastname.value=="")
			{
				document.getElementById("jslastname").innerHTML ="<font color='red'><strong>This field should not be empty..</strong></font>";
				validateform=1;
			}
			
			if(!document.frmregister.loginid.value.match(alphanumbericExp))
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>This field is not valid. Kindly input numbers or alphabets...</strong></font>";
				validateform=1;
			}		
			if(document.frmregister.loginid.value=="")
			{
				document.getElementById("jsloginid").innerHTML ="<font color='red'><strong>This field should not be empty...</strong></font>";
				validateform=1;
			}		
			
			if(!document.frmregister.accountpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsaccountpassword").innerHTML ="<font color='red'><strong>This field is not valid. Kindly input numbers or alphabets..</strong></font>";
				validateform=1;
			}			 	 
			if(document.frmregister.accountpassword.value.length < 8)
			{
				document.getElementById("jsaccountpassword").innerHTML ="<font color='red'><strong>Account Login Password should be more than 8 characters...</strong></font>";
				validateform=1;
			}
			if(document.frmregister.accountpassword.value=="")
			{
				document.getElementById("jsaccountpassword").innerHTML ="<font color='red'><strong>This field should not be empty...</strong></font>";
				validateform=1;
			} 
		
			if(!document.frmregister.confirmloginpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsconfirmloginpassword").innerHTML ="<font color='red'><strong>Confirm login password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			
			if(document.frmregister.accountpassword.value != document.frmregister.confirmloginpassword.value )
			{
				document.getElementById("jsconfirmloginpassword").innerHTML ="<font color='red'><strong>Confirm Login Password not matching...</strong></font>";
				validateform=1;
			}
				if(document.frmregister.confirmloginpassword.value =="")
			{
				document.getElementById("jsconfirmloginpassword").innerHTML ="<font color='red'><strong>Confirm login Password should not be empty..</strong></font>";
				validateform=1;
			}
			
			if(!document.frmregister.transactionpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jstransactionpassword").innerHTML ="<font color='red'><strong>Transaction password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}			 
			if(document.frmregister.transactionpassword.value.length < 8)
			{
				document.getElementById("jstransactionpassword").innerHTML ="<font color='red'><strong>Transaction Password should be more than 8 characters...</strong></font>";
				validateform=1;
			}
			if(document.frmregister.transactionpassword.value=="")
			{
				document.getElementById("jstransactionpassword").innerHTML ="<font color='red'><strong>Transaction Password should not be empty..</strong></font>";
				validateform=1;
			}
			
			
			if(!document.frmregister.confirmtransactionpassword.value.match(alphanumbericExp))
			{
				document.getElementById("jsconfirmtransactionpassword").innerHTML ="<font color='red'><strong>Confirm transaction password is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}	
			if(document.frmregister.confirmtransactionpassword.value=="")
			{
				document.getElementById("jsconfirmtransactionpassword").innerHTML ="<font color='red'><strong>Confirm Transaction Password should not be empty...</strong></font>";
				validateform=1;
			}	
			if(document.frmregister.transactionpassword.value!= document.frmregister.confirmtransactionpassword.value )
			{
				document.getElementById("jsconfirmtransactionpassword").innerHTML ="<font color='red'><strong>Confirm Transaction Password not matching...</strong></font>";
				validateform=1;
			}
			if(!document.frmregister.mob_no.value.match(numericExpression))
			{
				document.getElementById("jsmob_no").innerHTML ="<font color='red'><strong>Mobile number is not valid. Kindly input numbers.</strong></font>";
				validateform=1;
			}				
			if(document.frmregister.mob_no.value=="")
			{
				document.getElementById("jsmob_no").innerHTML ="<font color='red'><strong>Mobile number should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmregister.emailid.value=="")
			{
				document.getElementById("jsemailid").innerHTML ="<font color='red'><strong>Email ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmregister.address.value=="")
			{
				document.getElementById("jsaddress").innerHTML ="<font color='red'><strong>Address should not be empty...</strong></font>";
				validateform=1;
			}
			if(!document.frmregister.city.value.match(alphaspaceExp))
			{
				document.getElementById("jscity").innerHTML ="<font color='red'><strong>City is not valid. Kindly input numbers or alphabets.</strong></font>";
				validateform=1;
			}				
			if(document.frmregister.city.value=="")
			{
				document.getElementById("jscity").innerHTML ="<font color='red'><strong>City should not be empty..</strong></font>";
				validateform=1;
			}
		
			if(document.frmregister.state.value=="")
			{
				document.getElementById("jsstate").innerHTML ="<font color='red'><strong>State should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmregister.idproof.value=="")
			{
				document.getElementById("jsidproof").innerHTML ="<font color='red'><strong>File must be chosen.</strong></font>";
				validateform=1;
			}
		
			if(document.frmregister.addressproof.value=="")
			{
				document.getElementById("jsaddressproof").innerHTML ="<font color='red'><strong>File must be chosen.</strong></font>";
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