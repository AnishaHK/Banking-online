<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{
$sql = "update accounts set customer_id='$_GET[customeracid]', acc_status='$_POST[accountstatus]', primary_acc='$_POST[primaryaccount]', acc_type='$_POST[accounttype]',acc_balance='$_POST[accountbalance]',unclear_bal='$_POST[unclearbalance]',interest='$_POST[interest]' where acc_no ='$_GET[editid]'";
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
			$sql = "insert into accounts(acc_no,customer_id,acc_status,primary_acc,acc_date,acc_type_id,acc_balance,unclear_bal,interest) VALUES('$_POST[accno]','$_GET[customeracid]','$_POST[accountstatus]','$_POST[primaryaccount]','$dt','$_POST[accounttype]','$_POST[accountbalance]','$_POST[unclearbalance]','$_POST[interest]') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Account record inserted successfully..');</script>";
			}
			//#################################################################################//
				//Transaction types - Cheque, Fund Transfer, Deposit, Withdrawal
				//Add clear balance
				$sql = "insert into transaction( to_acc_no, amount, comission, particulars, transaction_type, trans_date_time, approve_date_time, payment_status) VALUES('$_POST[accno]','$_POST[accountbalance]','0','Account opening balance', 'Credit','$dttim','$dttim','Approved') ";
				$qsql = mysqli_query($con,$sql);
				echo mysqli_error($con);
				//Add unclear balance
				if($_POST['unclearbalance'] != 0)
				{
					$sql = "insert into transaction( to_acc_no, amount, comission, particulars, transaction_type, trans_date_time, payment_status) VALUES('$_POST[accno]','$_POST[unclearbalance]','0','Account opening balance', 'Cheque','$dttim','Pending') ";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_error($con);
				}
			//#################################################################################//
			echo "<script>window.location='viewcustomerac.php?customeracid=$_GET[customeracid]';</script>";						
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
	if($accno==0)
	{
		$accno = 117501000811000;
	}
	else
	{
		$accno = $accno;
	}
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <h1> Add New Account</h1>
          <p class="margin-bottom-15">Enter  account details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form"  name="frmaccounts" method="post" action="" onsubmit="return javascriptvalidation()">
                <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />     
                              
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Number</label>
      <input type="text" class="form-control" name="accno" placeholder="Account Number" value="<?php echo $accno; ?>" readonly style="background-color:#9CC">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
             </div>
             </div>
                                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label"> Primary Account</label>
                   <select  class="form-control" name="primaryaccount" placeholder=" Primary account" > 
                            <?php
                            $sqlid= "SELECT * FROM accounts WHERE customer_id='$_GET[customeracid]' AND acc_type_id!='0' ORDER BY acc_no limit 0,1";
                            $qsqlid =mysqli_query($con,$sqlid);
							if(mysqli_num_rows($qsqlid) ==0)
							{
								echo "<option value='$accno'>$accno</option>";
							}
							else
							{
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
                </div>  
                </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Type</label>
         			<select  class="form-control" name="accounttype" placeholder="Account type" onchange="selectpercentage(this.value)" >                  
                   		<option value="">Select</option>
                            <?php
                            $sqlid= "SELECT * FROM account_master WHERE status='Active'";
                            $qsqlid =mysqli_query($con,$sqlid);
                            while($rsid = mysqli_fetch_array($qsqlid))
                            {
                                if($rsid['acc_type_id'] == $rsedit['acc_type'])
                                {
                                    echo "<option value='$rsid[acc_type_id]' selected >$rsid[acc_type]</option>";
                                }
                                else
                                {
                                    echo "<option value='$rsid[acc_type_id]' >$rsid[acc_type]</option>";
                                }
                            }
                            ?>          
                   </select>
                  </div> 
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccounttype" ></span>
                  </div>
                  </div>      
                  
                  
                   <script type="application/javascript">
					   function selectpercentage(acc_type_id)
					   {
									if (window.XMLHttpRequest) {
										// code for IE7+, Firefox, Chrome, Opera, Safari
										xmlhttp = new XMLHttpRequest();
									} else {
										// code for IE6, IE5
										xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
									}
									xmlhttp.onreadystatechange = function() {
										if (this.readyState == 4 && this.status == 200) {
											document.getElementById("interest").value = this.responseText;
										}
									};
									xmlhttp.open("GET","ajaxinterest.php?acc_type_id="+acc_type_id,true);
									xmlhttp.send();
					   }
				   </script>
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Interest (in percentage)</label>
                    <input type="text" readonly class="form-control" name="interest" id="interest" placeholder="Kindly select Account type.." value="<?php echo $rsedit['interest']; ?>"> 
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsinterest" ></span>
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
		var numericfloatExpression = /^[0-9.]+$/; //Variable to validate only numbers
		
		document.getElementById("jsaccountstatus").innerHTML ="";
		document.getElementById("jsaccounttype").innerHTML ="";
		document.getElementById("jsaccountbalance").innerHTML ="";
		document.getElementById("jsunclearbalance").innerHTML ="";
		var validateform=0;
			if(document.frmaccounts.accounttype.value=="")
			{
				document.getElementById("jsaccounttype").innerHTML ="<font color='red'><strong>Account type should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccounts.accountbalance.value.match(numericfloatExpression))
			{   
				document.getElementById("jsaccountbalance").innerHTML ="<font color='red'><strong>Only floating values are allowed.</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.accountbalance.value=="" )
			{   
				document.getElementById("jsaccountbalance").innerHTML ="<font color='red'><strong>Account balance should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmaccounts.unclearbalance.value.match(numericfloatExpression))
			{
				document.getElementById("jsunclearbalance").innerHTML ="<font color='red'><strong>Only floating values are allowed.</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.unclearbalance.value=="")
			{
				document.getElementById("jsunclearbalance").innerHTML ="<font color='red'><strong>Unclear balance should not be empty..</strong></font>";
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