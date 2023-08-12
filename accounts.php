<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{
$sql = "update accounts set acc_no='$_POST[accountno]', customer_id='$_POST[customer]', acc_status='$_POST[accountstatus]', primary_acc='$_POST[primaryaccount]', acc_date='$_POST[accountdate]',acc_type='$_POST[accounttype]',acc_balance='$_POST[accountbalance]',unclear_bal='$_POST[unclearbalance]',interest='$_POST[interest]' where acc_no ='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Account record updated successfully..');</script>";
			}
		}
		else
		{
			$sql = "insert into accounts(acc_no,customer_id,acc_status,primary_acc,acc_date,acc_type,acc_balance,unclear_bal,interest) VALUES('$_POST[accountno]','$_POST[customer]','$_POST[accountstatus]','$_POST[primaryaccount]','$_POST[accountdate]','$_POST[accounttype]','$_POST[accountbalance]','$_POST[unclearbalance]','$_POST[interest]') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Account record inserted successfully..');</script>";
			}
		}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM accounts where acc_no='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
else
{
	$sqlacc_no = "SELECT max(acc_no)+1 FROM accounts";
	$qsqlacc_no = mysqli_query($con,$sqlacc_no);
	$rsacc_no = mysqli_fetch_array($qsqlacc_no);
	$accno = $rsacc_no[0] ;
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <h1> Account</h1>
          <p class="margin-bottom-15">Enter  account details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form"  name="frmaccounts" method="post" action="" onsubmit="return javascriptvalidation()">
                <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account No</label>
                    <input type="text"  class="form-control margin-bottom-15" name="accountno" placeholder="Account No" value="<?php echo $accno;  ?>"readonly="readonly">                  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccountno" ></span>
                </div>
                </div>
                
                 <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> Primary Account</label>
                   <select  class="form-control" name="primaryaccount" placeholder=" Primary account" > 
                            <?php
                            $sqlid= "SELECT * FROM accounts WHERE customer_id='$_GET[customeracid]' AND acc_type_id!='0'";
                            $qsqlid =mysqli_query($con,$sqlid);
							if(mysqli_num_rows($qsqlid) ==0)
							{
								echo "<option value='$accno'>$accno</option>";
							}
							else
							{
								echo "<option value=''>Select</option>";
								while($rsid = mysqli_fetch_array($qsqlid))
								{
									if($rsid[acc_no] == $rsedit[acc_no])
									{
										echo "<option value='$rsid[acc_no]' selected>$rsid[acc_no]</option>";
									}
									else
									{
										echo "<option value='$rsid[acc_no]'>$rsid[acc_no]</option>";
									}
								}
							}
                            ?>          
                   </select>
                  </div> 
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsprimaryaccount" ></span>
                </div>  
                </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Customer  </label>
                    <select class="form-control margin-bottom-15" name="customer" >   
                       <option value="">Select</option>
                            <?php
                            $sqlid= "SELECT * FROM customer";
                            $qsqlid =mysqli_query($con,$sqlid);
                            while($rsid = mysqli_fetch_array($qsqlid))
                            {
                                if($rsid[customer_id] == $rsedit[customer_id])
                                {
                                    echo "<option value='$rsid[customer_id]' selected>$rsid[first_name]</option>";
                                }
                                else
                                {
                                    echo "<option value='$rsid[customer_id]'>$rsid[first_name]</option>";
                                }
                            }
                            ?>           
                    </select> 
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscustomer" ></span>
                </div> 
                </div>    
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Creation Date</label>
       <input type="date" class="form-control" name="accountdate" placeholder="Account Date" value="<?php echo $rsedit['acc_date']; ?>">  
                  </div> 
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccountdate" ></span>
             </div>
             </div>
             
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Type</label>
         <input type="text" class="form-control" name="accounttype" placeholder="Account Type" value="<?php echo $rsedit['acc_type']; ?>">  
                  </div> 
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccounttype" ></span>
                  </div>
                  </div>              
                  
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Balance</label>
      <input type="text" class="form-control" name="accountbalance" placeholder="Account Balance" value="<?php echo $rsedit['acc_balance']; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccountbalance" ></span>
             </div>
             </div>
             
             <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Unclear Balance</label>
                    <input type="text" class="form-control" name="unclearbalance" placeholder="Unclear Balance" value="<?php echo $rsedit['unclear_bal']; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsunclearbalance" ></span>
               </div>
               </div>
               
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Interest</label>
                    <input type="number" class="form-control" name="interest" placeholder="Interest" value="<?php echo $rsedit['interest']; ?>" min="0" max="50">  
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsinterest" ></span>
                </div>
                </div>            
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">  Account Status</label>
                   <select  class="form-control" name="accountstatus" placeholder=" Account Status"  value="<?php echo $rsedit['acc_status']; ?>">   
                   <option value="">Select Account status</option>
                    <?php
					$arr = array("Active","Inactive");
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
		
		document.getElementById("jsaccountno").innerHTML ="";
		document.getElementById("jscustomer").innerHTML ="";
		document.getElementById("jsaccountstatus").innerHTML ="";
		document.getElementById("jsprimaryaccount").innerHTML ="";
		document.getElementById("jsaccountdate").innerHTML ="";
		document.getElementById("jsaccounttype").innerHTML ="";
		document.getElementById("jsaccountbalance").innerHTML ="";
		document.getElementById("jsunclearbalance").innerHTML ="";
		document.getElementById("jsinterest").innerHTML ="";
		
		var validateform=0;      
			
			if(document.frmaccounts.customer.value=="")
			{
				document.getElementById("jscustomer").innerHTML ="<font color='red'><strong>Customer should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.primaryaccount.value=="")
			{
				document.getElementById("jsprimaryaccount").innerHTML ="<font color='red'><strong>Primary account should not be empty...</strong></font>";
				validateform=1;
			}			
			if(document.frmaccounts.accountdate.value=="")
			{
				document.getElementById("jsaccountdate").innerHTML ="<font color='red'><strong>Account date should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.accounttype.value=="")
			{
				document.getElementById("jsaccounttype").innerHTML ="<font color='red'><strong>Account type should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccounts.accountbalance.value.match(numericExpression))
			{
				document.getElementById("jsaccountbalance").innerHTML ="<font color='red'><strong>Account balance is not matching. Kindly enter the numbers.</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.accountbalance.value=="" )
			{   
				document.getElementById("jsaccountbalance").innerHTML ="<font color='red'><strong>  Account balance should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccounts.unclearbalance.value.match(numericExpression))
			{
				document.getElementById("jsunclearbalance").innerHTML ="<font color='red'><strong>Unclear balance is not matching. Kindly enter the numbers.</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.unclearbalance.value=="")
			{
				document.getElementById("jsunclearbalance").innerHTML ="<font color='red'><strong>Unclear balance should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccounts.interest.value.match(numericExpression))
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest is not matching. Kindly enter the numbers.</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.interest.value=="")
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong> Interest should not be empty..</strong></font>";
				validateform=1;
			}		
			if(document.frmaccounts.accountstatus.value=="")
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