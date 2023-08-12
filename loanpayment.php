<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{	
		if(isset($_GET['editid']))
			{
						$sql = "update  loan_payment set customer_id='$_POST[customer]', loan_no='$_POST[loanaccountno]',loan_amt='$_POST[loanamt]',interest='$_POST[interest]',total_amt='$_POST[totalamount]',paid='$_POST[paidamount]',payment_type='$_POST[paymenttype]',balance='$_POST[balance]',paid_date='$_POST[paiddate]' where payment_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<script>alert('Loan payment record updated successfully..');</script>";
				}
			}
			else
			{
					

			$sql = "insert into loan_payment(customer_id, loan_acc_no, loan_amt, interest, total_amt, paid, payment_type, balance, paid_date) VALUES('$_POST[custid]','$_POST[loanaccountno]','$_POST[loan_amt]','$_POST[interest]','$_POST[totamt]','$_POST[paidamt]','$_POST[paymenttype]','$_POST[balanceamt]','$dt') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			
			$insid= mysqli_insert_id($con);
			
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Loan payment record inserted successfully..');</script>";
				$insid = mysqli_insert_id($con);
				echo "<script>window.location='loanpaymentreceipt.php?receiptid=" . $insid ."';</script>";	
			}
			}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM loan_payment where payment_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
else
{
	$sqlloan_payment = "SELECT max(acc_no)+1 FROM accounts";
	$qsqlloan_payment = mysqli_query($con,$sqlloan_payment);
	$rsloan_payment = mysqli_fetch_array($qsqlloan_payment);
	$loan_payment = $rsloan_payment[0] ;
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <h1>Loan Payment</h1>
          <p class="margin-bottom-15">Enter loan payment details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmloanpayment" method="post" action="" onsubmit="return javascriptvalidation()">
                <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />

                
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Loan Account No</label>
              <input type="text" class="form-control" name="loanaccountno" placeholder="Loan Account Number" onkeyup="loadloanacc(this.value)"  >  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloanaccountno" ></span>
                  </div>
                  </div>
                  
                  <div id="divloandetail"></div>
                
   
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
		
		/*document.getElementById("jscustomer").innerHTML ="";
		document.getElementById("jsloanaccountno").innerHTML ="";
		document.getElementById("jsloanamt").innerHTML ="";
		document.getElementById("jsinterest").innerHTML ="";
		document.getElementById("jstotalamount").innerHTML ="";
		document.getElementById("jsbalance").innerHTML ="";
		document.getElementById("jspaiddate").innerHTML ="";*/
		document.getElementById("jspaidamt").innerHTML ="";
		document.getElementById("jspaymenttype").innerHTML ="";
		
		
		var validateform=0;
		if(!document.frmloanpayment.paidamt.value.match(numericExpression))
			{
				document.getElementById("jspaidamt").innerHTML ="<font color='red'><strong>Paid amount is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}	
			if(document.frmloanpayment.paidamt.value=="")
			{
				document.getElementById("jspaidamt").innerHTML ="<font color='red'><strong>Paid amount should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmloanpayment.paymenttype.value=="")
			{
				document.getElementById("jspaymenttype").innerHTML ="<font color='red'><strong>Payment type should not be empty...</strong></font>";
				validateform=1;
			}   
		   /*if(document.frmloanpayment.customer.value=="")
			{
				document.getElementById("jscustomer").innerHTML ="<font color='red'><strong>Customer should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmloanpayment.loanamt.value.match(numericExpression))
			{
				document.getElementById("jsloanamt").innerHTML ="<font color='red'><strong>Loan amount is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}
			if(document.frmloanpayment.loanamt.value=="")
			{
				document.getElementById("jsloanamt").innerHTML ="<font color='red'><strong>Loan amount should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmloanpayment.interest.value.match(numericExpression))
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}		
			if(document.frmloanpayment.interest.value=="")
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest should not be empty...</strong></font>";
				validateform=1;
			}
			if(!document.frmloanpayment.totalamount.value.match(numericExpression))
			{
				document.getElementById("jstotalamount").innerHTML ="<font color='red'><strong>Total amount is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}					
			if(document.frmloanpayment.totalamount.value=="")
			{
				document.getElementById("jstotalamount").innerHTML ="<font color='red'><strong>Total amount should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmloanpayment.balance.value.match(numericExpression))
			{
				document.getElementById("jsbalance").innerHTML ="<font color='red'><strong>Balance is not valid. Kindly enter numbers.</strong></font>";
				validateform=1;
			}	
			if(document.frmloanpayment.balance.value=="")
			{
				document.getElementById("jsbalance").innerHTML ="<font color='red'><strong>Balance should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmloanpayment.paiddate.value=="")
			{
				document.getElementById("jspaiddate").innerHTML ="<font color='red'><strong>Paid date should not be empty..</strong></font>";
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
function calculatebal(totamt,paidamt)
{
	document.getElementById("balanceamt").value = totamt - paidamt;
}
function loadloanacc(loanaccid)
{
        document.getElementById("divloandetail").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";


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
					document.getElementById("divloandetail").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";
				}
				else
				{
    	            document.getElementById("divloandetail").innerHTML = this.responseText;
				}
            }
        };
        xmlhttp.open("GET","ajaxloanaccount.php?loanaccid="+loanaccid,true);
        xmlhttp.send();
}
</script>
 <?php
	include("footer.php");
	?>