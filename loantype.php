<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
				if(isset($_GET['editid']))
{
		$sql = " update loan_type set loan_type='$_POST[loantype]',prefix='$_POST[prefix]',min_amount='$_POST[minimumamount]',max_amount='$_POST[maximumamount]',interest='$_POST[interest]',terms='$_POST[terms]',status='$_POST[status]' where loan_type_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Loan Type record updated successfully..');</script>";
			}
}
else
{
	
			$sql = "insert into loan_type(loan_type,prefix,min_amount,max_amount,interest,terms,status) VALUES('$_POST[loantype]','$_POST[prefix]','$_POST[minimumamount]','$_POST[maximumamount]','$_POST[interest]','$_POST[terms]','$_POST[status]') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Loan Type record inserted successfully..');</script>";
			}
}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM loan_type where loan_type_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Loan Type</h1>
          <p class="margin-bottom-15">Enter loan type details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmloantype" method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Loan Type</label>
                   <input type="text" class="form-control" name="loantype" placeholder="Loan Type" value="<?php echo $rsedit[loan_type]; ?>">
                 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloantype" ></span>
                  </div>
                  </div>
                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Prefix</label>
                      <input type="text" class="form-control" name="prefix" placeholder="Prefix" value="<?php echo $rsedit[prefix]; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsprefix" ></span>
                  </div>
                  </div>
                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Minimum amount</label>
                    <input type="text" class="form-control" name="minimumamount" placeholder="Minimum amount" value="<?php echo $rsedit[min_amount]; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsminimumamount" ></span>
                  </div>
                  </div>
                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Maximum amount</label>
                    <input type="text" class="form-control" name="maximumamount" placeholder="Maximum amount" value="<?php echo $rsedit[max_amount]; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsmaximumamount" ></span>
                  </div>
                  </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Loan Interest (In Percentage %)</label>
                    <input type="text" class="form-control" name="interest" placeholder="Interest" value="<?php echo $rsedit['interest']; ?>" min="0" max="50">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsinterest" ></span>
                  </div>
                  </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Terms (No. of Year)</label>
                    <input type="text" class="form-control" name="terms" placeholder="Terms" value="<?php echo $rsedit[terms]; ?>">  
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsterms" ></span>
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
						if($val == $rsedit[status])
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
		var alphaExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		var numericfloatExpression = /^[+-]?\d+(\.\d+)?$/; //Variable to validate only numbers
		    
		document.getElementById("jsloantype").innerHTML ="";
		document.getElementById("jsprefix").innerHTML ="";
		document.getElementById("jsminimumamount").innerHTML ="";
		document.getElementById("jsmaximumamount").innerHTML ="";
		document.getElementById("jsinterest").innerHTML ="";
		document.getElementById("jsterms").innerHTML ="";
		document.getElementById("jsstatus").innerHTML ="";
				
		var validateform=0;      
			if(!document.frmloantype.loantype.value.match(alphaspaceExp))
			{
				document.getElementById("jsloantype").innerHTML ="<font color='red'><strong>Loan type is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}      
			if(document.frmloantype.loantype.value=="")
			{
				document.getElementById("jsloantype").innerHTML ="<font color='red'><strong>Loan type should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmloantype.prefix.value.match(alphaExp))
			{
				document.getElementById("jsprefix").innerHTML ="<font color='red'><strong>Prefix is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}      
			if(document.frmloantype.prefix.value=="")
			{
				document.getElementById("jsprefix").innerHTML ="<font color='red'><strong>Prefix should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmloantype.minimumamount.value.match(numericfloatExpression))
			{
				document.getElementById("jsminimumamount").innerHTML ="<font color='red'><strong>Minimum amount is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}      
			if(document.frmloantype.minimumamount.value=="")
			{
				document.getElementById("jsminimumamount").innerHTML ="<font color='red'><strong>Minimum amount should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmloantype.maximumamount.value.match(numericfloatExpression))
			{
				document.getElementById("jsmaximumamount").innerHTML ="<font color='red'><strong>Maximum amount is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}      
			if(document.frmloantype.maximumamount.value=="")
			{
				document.getElementById("jsmaximumamount").innerHTML ="<font color='red'><strong>Maximum amount should not be empty</strong></font>";
				validateform=1;
			}			
			if(!document.frmloantype.interest.value.match(numericfloatExpression))
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}      
			if(document.frmloantype.interest.value=="")
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmloantype.terms.value.match(numericExpression))
			{
				document.getElementById("jsterms").innerHTML ="<font color='red'><strong>Terms is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}      
			if(document.frmloantype.terms.value=="")
			{
				document.getElementById("jsterms").innerHTML ="<font color='red'><strong>Terms should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmloantype.status.value=="")
			{
				document.getElementById("jsstatus").innerHTML ="<font color='red'><strong>Status should not be empty...</strong></font>";
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