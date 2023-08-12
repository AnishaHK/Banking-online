<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{ 
		if(isset($_GET['editid']))
		{
			$sql = " update account_master set acc_type='$_POST[acctype]',prefix='$_POST[prefix]',min_balance='$_POST[minimumbalance]',interest='$_POST[interest]',status='$_POST[status]' where acc_type_id=$_GET[editid]";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Account Type record updated successfully..');</script>";
			}
		}
		else
		{
			$sql = "insert into account_master(acc_type,prefix,min_balance,interest,status) VALUES('$_POST[acctype]','$_POST[prefix]','$_POST[minimumbalance]','$_POST[interest]','$_POST[status]') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Account Type record inserted successfully..');</script>";
			}
		}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM account_master where acc_type_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Account types</h1>
          <p class="margin-bottom-15">Enter Account type details..</p>
          <div class="row">
            <div class="col-md-12">
 <form role="form" id="templatemo-preferences-form" name="frmaccountmaster"  method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Type</label>
                   <input type="text" class="form-control" name="acctype" placeholder="Account Type" value="<?php echo $rsedit['acc_type']; ?>"> 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsacctype" ></span>
                  </div>
                </div>

                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Prefix</label>
                      <input type="text" class="form-control" name="prefix" placeholder="Prefix" value="<?php echo $rsedit['prefix']; ?>">    
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsprefix" ></span>
                  </div>
                </div>          
                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Minimum Balance</label>
                    <input type="text" class="form-control" name="minimumbalance" placeholder="Minimum Balance" value="<?php echo $rsedit['min_balance']; ?>">    
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsminimumbalance" ></span>
                  </div>
                </div>   
                
                  
              <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Interest (in percentage)</label>
         			<input type="number" class="form-control" name="interest" placeholder="Interest" value="<?php echo $rsedit['interest']; ?>" min="0" max="50">    
                  </div>
				  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsinterest" ></span>
                  </div>
                </div>  
                
                 <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Status</label>
                    <select class="form-control margin-bottom-15" name="status">
                     <option value="">Select status</option>
                    <?php
					$arr = array("Active","Inactive");
					foreach($arr as $val)
					{
						if($val == $rsedit['status'])
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
                  <span id="jsstatus" ></span>
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
		var alphaspacenumbericExp = /^[a-zA-Z0-9\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		var numericfloatExpression = /^[0-9.]+$/; //Variable to validate only numbers
		    	
		document.getElementById("jsacctype").innerHTML ="";
		document.getElementById("jsprefix").innerHTML ="";
		document.getElementById("jsminimumbalance").innerHTML ="";
		document.getElementById("jsinterest").innerHTML ="";
		document.getElementById("jsstatus").innerHTML ="";
				
		var validateform=0;      
			if(!document.frmaccountmaster.acctype.value.match(alphaspacenumbericExp))
			{
				document.getElementById("jsacctype").innerHTML ="<font color='red'><strong>Account type is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}    
			if(document.frmaccountmaster.acctype.value=="")
			{
				document.getElementById("jsacctype").innerHTML ="<font color='red'><strong>Account type should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccountmaster.prefix.value.match(alphanumbericExp))
			{
				document.getElementById("jsprefix").innerHTML ="<font color='red'><strong>Prefix is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}    
			if(document.frmaccountmaster.prefix.value=="")
			{
				document.getElementById("jsprefix").innerHTML ="<font color='red'><strong>Prefix should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccountmaster.minimumbalance.value.match(numericfloatExpression))
			{
				document.getElementById("jsminimumbalance").innerHTML ="<font color='red'><strong>Minimum balance is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}
			if(document.frmaccountmaster.minimumbalance.value=="")
			{
				document.getElementById("jsminimumbalance").innerHTML ="<font color='red'><strong>Minimum balance should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccountmaster.interest.value.match(numericfloatExpression))
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest is not matching. Kindly enter the numbers.</strong></font>";
				validateform=1;
			}
			if(document.frmaccountmaster.interest.value=="")
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest should not be empty...</strong></font>";
				validateform=1;
			}			
			if(document.frmaccountmaster.status.value=="")
			{
				document.getElementById("jsstatus").innerHTML ="<font color='red'><strong>Status should not be empty..</strong></font>";
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