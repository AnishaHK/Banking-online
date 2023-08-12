<?php
include("header.php");
include("sidebar.php");
if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{
			$sql = "update registered_payee set customer_id='$_POST[customer]',payee_name='$_POST[payeename]',bank_acc_no='$_POST[bankacno]', acc_type='$_POST[accounttype]',bank_name='$_POST[bankname]',ifsc_code='$_POST[ifsccode]' where registered_payee_id='$_GET[editid]' ";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Registered payee record updated successfully..');</script>";
		}
		}
		else
		{
			$sql = "insert into registered_payee(customer_id,registered_payee_type,payee_name,bank_acc_no,acc_type,bank_name,ifsc_code,status) VALUES('$_SESSION[customer_id]','$_POST[trtype]','$_POST[payeename]','$_POST[bankacno]','$_POST[accounttype]','$_POST[bankname]','$_POST[ifsccode]','Active') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Registered payee record inserted successfully..');</script>";
				echo "<script>window.location='viewcustregisteredpayee.php';</script>";
			}
		}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM registered_payee where registered_payee_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
else
{
	$sqlifsc = "SELECT max(ifsc_code) FROM registered_payee";
	$qsqlifsc = mysqli_query($con,$sqlifsc);
	$rsifsc = mysqli_fetch_array($qsqlifsc);	
}

$ifscnumber = preg_replace('/[^0-9]/', '', $rsifsc[0]);
$letters = preg_replace('/[^a-zA-Z]/', '', $rsifsc[0]);
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <h1>Add  Registered Payee</h1>
          <p class="margin-bottom-15">Enter  registered payee details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmregisteredpayee" method="post" action="" onsubmit="return javascriptvalidation()">
                <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
<?php
$sql ="SELECT * FROM accounts INNER JOIN customer ON accounts.customer_id=customer.customer_id WHERE accounts.customer_id='$_SESSION[customer_id]' AND accounts.acc_type_id!= '0' AND accounts.acc_status='Active'";
$qsql = mysqli_query($con,$sql);
 if(mysqli_num_rows($qsql) == 0)
 {
	 echo "0";
 }
 else
 {
     while($rs = mysqli_fetch_array($qsql))
     {
            $sqlaccounts ="SELECT * FROM accounts INNER JOIN account_master ON accounts.acc_type_id = account_master.acc_type_id WHERE acc_no='$_SESSION[customer_id]'";
            $qsqlaccounts = mysqli_query($con,$sqlaccounts);
            $rsaccounts = mysqli_fetch_array($qsqlaccounts);
            $sqlbranch ="SELECT * FROM branch WHERE ifsc_code='$rs[ifsc_code]'";
            $qsqlbranch = mysqli_query($con,$sqlbranch);
            $rsbranch = mysqli_fetch_array($qsqlbranch);
    ?>
    <input type="hidden" class="form-control" name="payeename" placeholder="Payee Name" value="<?php echo $rs['first_name'] . " ".$rs['last_name']; ?>"> 
    <input type="hidden" class="form-control" name="bankacno" placeholder="Account Number" value="<?php echo $rsaccounts['acc_no']; ?>">
    <input type="hidden" class="form-control" name="accounttype" placeholder="Account type" value="<?php echo $rsaccounts['acc_type']; ?>">
    <input type="hidden" class="form-control" name="bankname" placeholder="Bank Name" value="eBanking">
     <input type="hidden" class="form-control" name="ifsccode" placeholder="IFSC code"  value="<?php echo $rs['ifsc_code']; ?>">
    <?php  
      }
    ?>  
<?php
 }
 ?>
            
                <div class="row">
                    <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Fund Transfer type</label>
                    <select name="trtype" id="trtype" class="form-control" onChange="showcustomer(0,trtype.value) " >
                        <option value="">Select Fund transfer type</option>
                        <?php
                        $arr = array("Intra Bank","Other bank");
                        foreach($arr as $val)
                        {
                            echo "<option value='$val'>$val</option>";
                        }			
                        ?>
                    </select>        
                    </div>
                    <div class="col-md-6 margin-bottom-15"><br /><br />
                 
                    </div>
                </div>             
                
                <div id="divregpayee"><img src='images/LoadingSmall.gif' width='172' height='172' /></div>
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
		     /*
		document.getElementById("jspayeename").innerHTML ="";
		document.getElementById("jsbankacno").innerHTML ="";
		*/
		var validateform=0;
		 
		if(document.frmregisteredpayee.trtype.value=="Intra Bank")
			{
				/*
				if(document.frmregisteredpayee.bankacno.value=="")
				{
					document.getElementById("jsbankacno").innerHTML ="<font color='red'><strong>Account number should not be empty</strong></font>";
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
			

			if(document.frmregisteredpayee.trtype.value=="Other bank")
			{
				/*
				document.getElementById("jspayeename").innerHTML ="";
				document.getElementById("jsbankacno").innerHTML ="";
				document.getElementById("jsaccounttype").innerHTML ="";
				document.getElementById("jsbankname").innerHTML ="";
				document.getElementById("jsifsccode").innerHTML ="";

				if(!document.frmregisteredpayee.payeename.value.match(alphaspaceExp))
				{
					document.getElementById("jspayeename").innerHTML ="<font color='red'><strong>Only alphabets and digits are allowed.</strong></font>";
					validateform=1;
				}     
				if(document.frmregisteredpayee.payeename.value=="")
				{
					document.getElementById("jspayeename").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
					validateform=1;
				}   				
				if(!document.frmregisteredpayee.bankacno.value.match(numericExpression))
				{
					document.getElementById("jsbankacno").innerHTML ="<font color='red'><strong>Bank Account number is not valid.</strong></font>";
					validateform=1;
				}
				if(document.frmregisteredpayee.bankacno.value=="")
				{
					document.getElementById("jsbankacno").innerHTML ="<font color='red'><strong>Bank Account number should not be empty.</strong></font>";
					validateform=1;
				}
				if(document.frmregisteredpayee.accounttype.value=="")
				{
					document.getElementById("jsaccounttype").innerHTML ="<font color='red'><strong>Bank Account type should not be empty.</strong></font>";
					validateform=1;
				}
				if(document.frmregisteredpayee.bankname.value=="")
				{
					document.getElementById("jsbankname").innerHTML ="<font color='red'><strong>Bank name should not be empty.</strong></font>";
					validateform=1;
				}
				if(document.frmregisteredpayee.ifsccode.value=="")
				{
					document.getElementById("jsifsccode").innerHTML ="<font color='red'><strong>IFSC code should not be empty.</strong></font>";
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
	}
</script>	
<script>
function showcustomer(customeracid,trtype) 
{
        document.getElementById("divregpayee").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";
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
					document.getElementById("divregpayee").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";
				}
				else
				{
    	            document.getElementById("divregpayee").innerHTML = this.responseText;
				}
            }
        };
        xmlhttp.open("GET","ajaxregisteredpayee.php?customeracid="+customeracid+"&trtype="+trtype,true);
        xmlhttp.send();
}
</script>
<script type="application/javascript">
function loadbankaccount(customeracid)
{
        document.getElementById("divbankac").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";


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
				document.getElementById("divbankac").innerHTML = "<img src='images/LoadingSmall.gif' width='172' height='172' />";
				}
				else
				{
    	            document.getElementById("divbankac").innerHTML = this.responseText;
				}
            }
        };
        xmlhttp.open("GET","ajaxbankaccount.php?customeracid="+customeracid,true);
        xmlhttp.send();
}
</script>
<?php
include("footer.php");
?>