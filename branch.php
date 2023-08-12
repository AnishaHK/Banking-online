<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{
			$sql = "update branch set ifsc_code='$_POST[ifsccode]',branch_name='$_POST[branchname]' ,branch_address='$_POST[address]' ,state='$_POST[state]' ,country='$_POST[country]' where ifsc_code='$_GET[editid]'  ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Branch record updated successfully..');</script>";
			}
		}
		else
		{
			$sql = "insert into branch(ifsc_code,branch_name ,branch_address ,state ,country ,dob) VALUES('$_POST[ifsccode]','$_POST[branchname]','$_POST[address]','$_POST[state]','$_POST[country]','$_POST[dob]') ";

				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<script>alert('Branch record inserted successfully..');</script>";
				}
		}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM branch where ifsc_code='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
else
{
	$sqlifsc = "SELECT max(ifsc_code) FROM branch";
	$qsqlifsc = mysqli_query($con,$sqlifsc);
	$rsifsc = mysqli_fetch_array($qsqlifsc);	
}
$ifscnumber = preg_replace('/[^0-9]/', '', $rsifsc[0]);
$letters = preg_replace('/[^a-zA-Z]/', '', $rsifsc[0]);
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Branch</h1>
          <p class="margin-bottom-15">Enter Branch details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmbranch"method="post" action="" onsubmit="return javascriptvalidation()">
              <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">IFSC code</label>
                   <input type="text" class="form-control" name="ifsccode" placeholder="IFSC code" value="<?php 
				   if(isset($rsedit['ifsc_code']))
				   {
				   	echo $rsedit['ifsc_code'];
				   }
				   else
				   {
					   echo "EB". sprintf('%06d', $ifscnumber+1);
				   }
				   ?>" readonly>
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsifsccode" ></span>
                  </div>
                  </div>
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Branch Name</label>
                    <input type="text" class="form-control" name="branchname" placeholder="Branch Name" value="<?php echo $rsedit['branch_name']; ?>">  
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbranchname" ></span>
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Address</label>
                    <textarea class="form-control" name="address" placeholder="address" ><?php echo $rsedit['branch_address']; ?></textarea>  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaddress" ></span>
                  </div>
                  </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">State</label>
                     <select name='state' class="form-control" >
                    <option value="">Select state</option>
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
                    <label for="firstName" class="control-label">Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Country" >  
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscountry" ></span>
                  </div>
                  </div>
				  <div class="row">
				  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">dob</label>
                    <input type="date" class="form-control" name="dob" placeholder="Country" >  
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscountry" ></span>
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
		
		document.getElementById("jsifsccode").innerHTML ="";
		document.getElementById("jsbranchname").innerHTML ="";
		document.getElementById("jsaddress").innerHTML ="";
		document.getElementById("jsstate").innerHTML ="";
		document.getElementById("jscountry").innerHTML ="";
				
		var validateform=0;      
			if(document.frmbranch.ifsccode.value=="")
			{
				document.getElementById("jsifsccode").innerHTML ="<font color='red'><strong>IFSC code should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmbranch.branchname.value.match(alphaspaceExp))
			{
				document.getElementById("jsbranchname").innerHTML ="<font color='red'><strong>Branch name is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmbranch.branchname.value=="")
			{
				document.getElementById("jsbranchname").innerHTML ="<font color='red'><strong>Branch name should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmbranch.address.value=="")
			{
				document.getElementById("jsaddress").innerHTML ="<font color='red'><strong>Address should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmbranch.state.value.match(alphaspaceExp))
			{
				document.getElementById("jsstate").innerHTML ="<font color='red'><strong>State is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmbranch.state.value=="")
			{
				document.getElementById("jsstate").innerHTML ="<font color='red'><strong>State should not be empty...</strong></font>";
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