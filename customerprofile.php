<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{  
	if(isset($_POST['submit']))
	{
			$sql = "update customer set email_id='$_POST[emailid]',address='$_POST[address]', city='$_POST[city]', state='$_POST[state]', mob_no='$_POST[mob_no]' where customer_id='$_SESSION[customer_id]'";
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
}
if(isset($_SESSION['customer_id']))
{
	$sqledit = "SELECT * FROM customer where customer_id='$_SESSION[customer_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION['randomno'] = rand();
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
                        $sqlbranch= "SELECT * FROM branch WHERE ifsc_code='" . $rsedit['ifsc_code'] . "'";
                        $qsqlbranch =mysqli_query($con,$sqlbranch);
                        while($rsbranch = mysqli_fetch_array($qsqlbranch))
                        {	
                            echo "<option value='$rsbranch[ifsc_code]' >$rsbranch[branch_name] ($rsbranch[ifsc_code]) : $rsbranch[branch_address], $rsbranch[state], $rsbranch[country] </option>";
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
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" readonly value="<?php echo $rsedit[first_name]; ?>">                    
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                 
                  </div>
                  </div>
                
                   <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" readonly value="<?php echo $rsedit['last_name']; ?>">                     
                  </div>
                    <div class="col-md-6 margin-bottom-15"><br /><br />
               
                  </div>
                  </div>
               
                    
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Login ID</label>
                    <input type="text" class="form-control" name="loginid" readonly placeholder="Login ID" value="<?php echo $rsedit['login_id']; ?>">                     
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                
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
                    <textarea  class="form-control" name="address" ><?php echo $rsedit[address]; ?></textarea>
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
        <select class="form-control margin-bottom-15" name="state">
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
										echo "<option value='$val' >$val</option>";
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
                    <input type="text" class="form-control" name="country" placeholder="Country" value="India" readonly style="background-color:#FFC">                       
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                 
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
		var editid = '<?php echo $_GET[editid]; ?>'
		
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers		
		
		document.getElementById("jsmoblno").innerHTML ="";
		document.getElementById("jsemailid").innerHTML ="";
		document.getElementById("jsaddress").innerHTML ="";
		document.getElementById("jscity").innerHTML ="";
		document.getElementById("jsstate").innerHTML ="";
		
		
		
		var validateform=0; 
		     
		
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
				document.getElementById("jsemailid").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
				validateform=1;
			}
			
			if(document.frmcustomer.address.value=="")
			{
				document.getElementById("jsaddress").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
				validateform=1;
			}
			if(!document.frmcustomer.city.value.match(alphaspaceExp))
			{
				document.getElementById("jscity").innerHTML ="<font color='red'><strong>Only alphabets are allowed.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.city.value=="")
			{
				document.getElementById("jscity").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
				validateform=1;
			}
			if(document.frmcustomer.state.value=="")
			{
				document.getElementById("jsstate").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
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