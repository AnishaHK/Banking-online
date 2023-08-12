<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit'])) 
	{
		if($_POST['regpayregistered_payee_type'] == "Intra Bank")
		{
			$sql = "insert into transaction( registered_payee_id, from_acc_no, to_acc_no, amount, comission, particulars, transaction_type, trans_date_time, approve_date_time, payment_status) VALUES ('$_POST[regpayeeid]','$_POST[account]','$_POST[regpaybank_acc_no]','$_POST[amount]','0','$_POST[particulars]','Credit','$dttim','$dttim','Active') ";
			$qsql = mysqli_query($con,$sql);
			
			$sql = "UPDATE accounts SET acc_balance= acc_balance +  $_POST[amount]  WHERE acc_no='$_POST[regpaybank_acc_no]'";
			$qsql = mysqli_query($con,$sql);
			
		}
		$amt = ($_POST['amount'] + 5);
			$sql = "insert into transaction( registered_payee_id,  to_acc_no, amount, comission, particulars, transaction_type, trans_date_time, approve_date_time, payment_status) VALUES ('$_POST[regpayeeid]','$_POST[account]','$amt','5','$_POST[particulars]','Debit','$dttim','$dttim','Active') ";
			$qsql = mysqli_query($con,$sql);
			$insid = mysqli_insert_id($con);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Fund Transferred successfully..');</script>";
			}
			$sql = "UPDATE accounts SET acc_balance= acc_balance -  $amt  WHERE acc_no='$_POST[account]'";
			$qsql = mysqli_query($con,$sql);
			echo "<script>window.location='depositmoneyreceipt.php?receiptid=" . $insid ."&regpayid=" . $_POST['regpayeeid'] . "';</script>";
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
         <h1>Fund Transfer</h1>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmtransaction" method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Select Account number </label>                  
<div id="divac" >                    
<select name="account" id="account"  class="form-control" onChange="showcustomer(this.value)" >
<option value="">Select Account</option>
<?php
$sqlacc ="SELECT * FROM accounts WHERE acc_status='Active' AND acc_type_id!='0' AND customer_id='$_SESSION[customer_id]'";
$qsqlacc = mysqli_query($con,$sqlacc);
while($rsacc = mysqli_fetch_array($qsqlacc))
{
	echo "<option value='$rsacc[acc_no]'>$rsacc[acc_no]</option>";	
}
?>
</select>
</div>
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
 
 
 <!-- Transaction Password Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Verify your Transaction</h4>
      </div>
      <div class="modal-body" id="divverifyform">
        <p>Kindly enter the OTP which you received by mail..
        <input type="text" name="otp" id="otp" class="form-control" autocomplete="off" placeholder="Enter OTP here" > 
        </p>
        <p>Enter Transaction Password..
        <input type="password" name="trpass" id="trpass" class="form-control" autocomplete="off" placeholder="Enter Transaction Password here" > 
        </p>
      </div>
      <div class="modal-footer" id="divverify">
        <button type="button" class="btn btn-default" onClick="otpverification()">Verify</button>
      </div>
    </div>

  </div>
</div>
<script type="application/javascript">
	function otpverification()
	{
		document.getElementById("divverify").innerHTML = "<img src='images/loadingverif.gif' height='50px;'>";
			if (window.XMLHttpRequest) 
			{
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} 
			else 
			{
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() 
			{
					if (this.readyState == 4 && this.status == 200)
					{
						//document.getElementById("txtHint").innerHTML = this.responseText;
						//alert(this.responseText);
						if(this.responseText == 1)
						{		
							document.getElementById("divac").style.pointerEvents = "none";
							document.getElementById("idregpaye").style.pointerEvents = "none";										
							document.getElementById("amount").readOnly = true;
							document.getElementById("particulars").readOnly = true;		
							document.getElementById("divverifyform").innerHTML = "<strong>You have verified successfully..</strong>";
							document.getElementById("divverify").innerHTML =  '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
							document.getElementById("divbtnfundtransfer").innerHTML = '<button type="submit" class="btn btn-primary" name="submit">Click Here to Transfer Fund</button>';
						}
						else
						{
							document.getElementById("divverify").innerHTML = this.responseText;
						}
					}
			}; 		
			var otp = document.getElementById("otp").value;
			var trpass = document.getElementById("trpass").value;
			//alert(otp);
			//alert(trpass);	
			xmlhttp.open("GET","verifytransaction.php?otp="+otp+"&trpass="+trpass,true);
			xmlhttp.send();
	}
	
	function verifytransaction()
	{
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			//alert(document.getElementById("trpass"));
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//document.getElementById("txtHint").innerHTML = this.responseText;
					//alert(this.responseText);
				}
			};
			xmlhttp.open("GET","verifytransaction.php",true);
			xmlhttp.send();
	}
	function javascriptvalidation()
	{
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		/*
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
			*/
	}
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
        xmlhttp.open("GET","ajaxfundtransfer.php?customeracid="+customeracid,true);
        xmlhttp.send();
}
function showregpayee(registered_payee_id) 
{
        document.getElementById("divpayeedet").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";


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
					document.getElementById("divpayeedet").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";
				}
				else
				{
    	            document.getElementById("divpayeedet").innerHTML = this.responseText;
				}
            }
        };
        xmlhttp.open("GET","ajaxregpayeedetails.php?registered_payee_id="+registered_payee_id,true);
        xmlhttp.send();
}
</script>
<?php
include("footer.php");
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
   function verifytransaction(){
    var amount = $('#amount').val();
    var withdrawalamt = $('#withdrawalamt').val();
	
    var regpayeeid = $('#regpayeeid').val();
	var widamt = parseFloat(withdrawalamt);
	
	if(regpayeeid == ""){
      $('#jsaccount').html('<font color=red><strong>Kindly select registered payee detail<strong></font>');
       $('#amount').val('');
    }
	else if(amount<100){
      $('#jsamount').html('<font color=red><strong>Amount can not be less than 100..<strong></font>');
       $('#amount').val('');
    }    
	else if(amount>widamt){
      $('#jsamount').html('<font color=red><strong>Entered amount is greater than Withdraw amount<strong></font>');
       $('#amount').val('');
    }  
	else{
      $('#jsamount').html('');
	  
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			//alert(document.getElementById("trpass"));
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//document.getElementById("txtHint").innerHTML = this.responseText;
					//alert(this.responseText);
				}
			};
			xmlhttp.open("GET","verifytransaction.php",true);
			xmlhttp.send();
			 
      jQuery.noConflict(); 
      $('#myModal').modal('show');  
    }

   }
 </script>