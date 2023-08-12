<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit'])) 
	{
		if(isset($_GET['editid']))
		{
			$sql = "UPDATE transaction SET payee_id='$_POST[payeeid]',receiver_id='$_POST[receiverid]',amount='$_POST[amount]',comission='$_POST[commission]',particulars='$_POST[particulars]',transaction_type='$_POST[transtype]',trans_date_time='$_POST[transdatetime]',approve_date_time='$_POST[approvaldatetime]',payment_status='$_POST[paymentstatus]' where trans_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Transaction record UPDATED successfully..');</script>";
			}
		}
		else
		{
			$sql = "insert into transaction(payee_id,receiver_id,amount,comission,particulars,transaction_type,trans_date_time,approve_date_time,payment_status) VALUES('$_POST[payeeid]','$_POST[receiverid]','$_POST[amount]','$_POST[commission]','$_POST[particulars]','$_POST[transtype]','$_POST[transdatetime]','$_POST[approvaldatetime]','$_POST[paymentstatus]') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Transaction record inserted successfully..');</script>";
			}
			
		}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM transaction where trans_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Deposit Money</h1>
          <p class="margin-bottom-15">Enter transaction details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmtransaction" method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Payee </label>
                    <select class="form-control margin-bottom-15" name="payeeid">
                                    
                   <option value="">Select</option>
                <?php
                $sqlid= "SELECT * FROM customer";
                $qsqlid =mysqli_query($con,$sqlid);
                while($rsid = mysqli_fetch_array($qsqlid))
                {
                    if($rsid[customer_id] == $rsedit[payee_id])
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
                  <span id="jspayeeid" ></span>
                  </div>
                  </div>
                  
                   <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Receiver </label>
                    <select class="form-control margin-bottom-15" name="receiverid">
                     <option value="">Select</option>
                    <?php
                    $sqlid= "SELECT * FROM customer";
                    $qsqlid =mysqli_query($con,$sqlid);
                    while($rsid = mysqli_fetch_array($qsqlid))
                    {
                        if($rsid[customer_id] == $rsedit[receiver_id])
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
                  <span id="jsreceiverid" ></span>
                  </div>
                  </div>
                                   
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account </label>
                  <select class="form-control margin-bottom-15" name="account">
                  <option value="">Select</option>
                <?php
                $sqlaccno= "SELECT * FROM accounts";
                $qsqlaccno =mysqli_query($con,$sqlaccno);
                while($rsaccno = mysqli_fetch_array($qsqlaccno))
                {
                    if($rsid[acc_no] == $rsedit[acc_no])
                    {
                        echo "<option value='$rsaccno[acc_no]' selected>$rsaccno[acc_no]</option>";
                    }
                    else
                    {
                        echo "<option value='$rsaccno[acc_no]'>$rsaccno[acc_no]</option>";
                    }
                    
                }
                ?>
                  </select> 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccount" ></span>
                  </div>
                  </div>
                  
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Amount</label>
                    <input type="text" class="form-control" name="amount" placeholder=" Amount" value="<?php echo $rsedit['amount']; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsamount" ></span>
                  </div>
                  </div>
                
                   <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Commission</label>
                    <input type="text" class="form-control" name="commission" placeholder=" Commission" value="<?php echo $rsedit[comission]; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jscommission" ></span>
                  </div>
                  </div>
                
                <div class="row">
                <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Particulars</label>
                   <textarea  class="form-control" name="particulars" placeholder="Particulars"><?php echo $rsedit['particulars']; ?></textarea>
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsparticulars" ></span>
                  </div>
                  </div>
                    
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Transaction Type </label>
                    <select class="form-control margin-bottom-15" name="transtype">
                    <option value="">Select Transaction Type</option>
                    <?php
					$arr = array("Credit","Debit");
					foreach($arr as $val)
					{
						if($val == $rsedit[transaction_type])
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
                  <span id="jstranstype" ></span>
                  </div>
                  </div>
               
                <div class="row">
                          <div class="col-md-6 margin-bottom-15">
                                <label for="firstName" class="control-label">Transaction Date Time</label>
                                 <input type="date" class="form-control" name="transdatetime" placeholder="Trnsaction Date Time " value="<?php echo $rsedit[trans_date_time]; ?>"> 
                          </div>
                         <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jstransdatetime" ></span>
                  </div>
                  </div>
                  
               <div class="row">
                          <div class="col-md-6 margin-bottom-15">
                                <label for="firstName" class="control-label">Approval Date Time</label>
                                 <input type="date" class="form-control" name="approvaldatetime" placeholder="Approval Date Time " value="<?php echo $rsedit[approve_date_time]; ?>"> 
                          </div>
                         <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsapprovaldatetime" ></span>
                  </div>
                  </div>
                                 
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Payment Status</label>
                    <select class="form-control" name="paymentstatus" placeholder=" Payment Status">  
                    <option value="">Select Payment status</option>
                    <?php
					$arr = array("Active","Inactive");
					foreach($arr as $val)
					{
						if($val == $rsedit[payment_status])
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
                  <span id="jspaymentstatus" ></span>
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
		
		document.getElementById("jspayeeid").innerHTML ="";
		document.getElementById("jsreceiverid").innerHTML ="";
		document.getElementById("jsamount").innerHTML ="";
		document.getElementById("jscommission").innerHTML ="";
		document.getElementById("jsparticulars").innerHTML ="";
		document.getElementById("jstranstype").innerHTML ="";
		document.getElementById("jstransdatetime").innerHTML ="";
		document.getElementById("jsapprovaldatetime").innerHTML ="";
		document.getElementById("jspaymentstatus").innerHTML ="";
		
		var validateform=0;      
			if(document.frmtransaction.payeeid.value=="")
			{
				document.getElementById("jspayeeid").innerHTML ="<font color='red'><strong>Payee ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmtransaction.receiverid.value=="")
			{
				document.getElementById("jsreceiverid").innerHTML ="<font color='red'><strong>Receiver ID should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmtransaction.account.value=="")
			{
				document.getElementById("jsaccount").innerHTML ="<font color='red'><strong>Account should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmtransaction.amount.value.match(numericExpression))
			{
				document.getElementById("jsamount").innerHTML ="<font color='red'><strong>Amount is not valid. Kindly input numbers.</strong></font>";
				validateform=1;
			}				
			if(document.frmtransaction.amount.value=="")
			{
				document.getElementById("jsamount").innerHTML ="<font color='red'><strong>Amount should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmtransaction.commission.value.match(numericExpression))
			{
				document.getElementById("jscommission").innerHTML ="<font color='red'><strong>Commission is not valid. Kindly input numbers.</strong></font>";
				validateform=1;
			}			
			if(document.frmtransaction.commission.value=="")
			{
				document.getElementById("jscommission").innerHTML ="<font color='red'><strong>Commission should not be empty...</strong></font>";
				validateform=1;
			}	
			if(!document.frmtransaction.particulars.value.match(alphaspaceExp))
			{
				document.getElementById("jsparticulars").innerHTML ="<font color='red'><strong>Particulars is not valid. Kindly input alphabets.</strong></font>";
				validateform=1;
			}					
			if(document.frmtransaction.particulars.value=="")
			{
				document.getElementById("jsparticulars").innerHTML ="<font color='red'><strong>Particulars should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmtransaction.transtype.value=="")
			{
				document.getElementById("jstranstype").innerHTML ="<font color='red'><strong>Transaction type should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmtransaction.transdatetime.value=="")
			{
				document.getElementById("jstransdatetime").innerHTML ="<font color='red'><strong>Transaction date and time should not be empty...</strong></font>";
				validateform=1;
			}
			if(document.frmtransaction.approvaldatetime.value=="")
			{
				document.getElementById("jsapprovaldatetime").innerHTML ="<font color='red'><strong>Approval date and time should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmtransaction.paymentstatus.value=="")
			{
				document.getElementById("jspaymentstatus").innerHTML ="<font color='red'><strong>Payment status should not be empty..</strong></font>";
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