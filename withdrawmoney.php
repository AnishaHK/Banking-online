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
			$sql = "insert into transaction(to_acc_no,amount,comission,particulars,transaction_type,trans_date_time,approve_date_time,payment_status) VALUES('$_POST[account]','$_POST[amount]','$_POST[commission]','$_POST[particulars]','Debit','$dttim','$dttim','Active') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Withdrawal Successful...');</script>";
			}
			
			$insid= mysqli_insert_id($con);
			
			$sql = "UPDATE accounts SET acc_balance= acc_balance -  $_POST[amount]  WHERE acc_no='$_POST[account]'";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			echo "<script>window.location='withdrawmoneyreceipt.php?receiptid=" . $insid ."';</script>";
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
         <h1>Withdraw Money</h1>
          <p class="margin-bottom-15">Enter transaction details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmtransaction" method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Enter Account number </label>                  
                    <input type="text" class="form-control" name="account" placeholder=" Account Number" value="<?php echo $rsedit['amount']; ?>" onKeyUp="showcustomer(this.value)">  
                    
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jspayeeid" ></span>
                  </div>
                </div>
                  
                  <div id="divcustrecloadid" ></div>

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
		
		/*document.getElementById("jspayeeid").innerHTML ="";
		document.getElementById("jsreceiverid").innerHTML ="";
		document.getElementById("jscommission").innerHTML ="";
		document.getElementById("jstranstype").innerHTML ="";
		document.getElementById("jstransdatetime").innerHTML ="";
		document.getElementById("jsapprovaldatetime").innerHTML ="";
		document.getElementById("jspaymentstatus").innerHTML ="";*/
		
		document.getElementById("jsamount").innerHTML ="";
		document.getElementById("jsparticulars").innerHTML ="";
		
		var validateform=0;      
			/*if(document.frmtransaction.payeeid.value=="")
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
			}*/
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
			/*if(!document.frmtransaction.commission.value.match(numericExpression))
			{
				document.getElementById("jscommission").innerHTML ="<font color='red'><strong>Commission is not valid. Kindly input numbers.</strong></font>";
				validateform=1;
			}			
			if(document.frmtransaction.commission.value=="")
			{
				document.getElementById("jscommission").innerHTML ="<font color='red'><strong>Commission should not be empty...</strong></font>";
				validateform=1;
			}*/	
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
			/*if(document.frmtransaction.transtype.value=="")
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
			}*/			
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
<script>
function showcustomer(customeracid) 
{
        document.getElementById("divcustrecloadid").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";


        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				if(this.responseText == 0)
				{
					document.getElementById("divcustrecloadid").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";
				}
				else
				{
    	            document.getElementById("divcustrecloadid").innerHTML = this.responseText;
				}
            }
        };
        xmlhttp.open("GET","ajaxcreditdebit.php?customeracid="+customeracid+"&transttype=debit",true);
        xmlhttp.send();
}
</script>
<?php
	include("footer.php");
	?>