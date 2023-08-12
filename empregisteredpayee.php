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
				$sql = "insert into registered_payee(customer_id,registered_payee_type,payee_name,bank_acc_no,acc_type,bank_name,ifsc_code,status) VALUES('$_POST[customerid]','$_POST[trtype]','$_POST[payeename]','$_POST[bankacno]','$_POST[accounttype]','$_POST[bankname]','$_POST[ifsccode]','Active') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Registered payee record inserted successfully..');</script>";
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

                <div class="row">
                    <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Enter Account Number</label>
                    <input type="text" class="form-control" name="acno" placeholder="Enter Account number">  
                </div>
                    <div class="col-md-6 margin-bottom-15"><br /><br />
                    <span id="jsamount" ></span>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Fund Transfer type</label>
                    <select name="trtype" class="form-control" onChange="showcustomer(acno.value,trtype.value) " >
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
                    <span id="jsamount" ></span>
                    </div>
                </div>             
                
                <div id="divregpayee"></div>
                
                
                
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
		     
		document.getElementById("jscustomer").innerHTML ="";
		document.getElementById("jspayeename").innerHTML ="";
		document.getElementById("jsbankacno").innerHTML ="";
		document.getElementById("jsaccounttype").innerHTML ="";
		document.getElementById("jsbankname").innerHTML ="";
		document.getElementById("jsifsccode").innerHTML ="";
				
		var validateform=0;      
			if(document.frmregisteredpayee.customer.value=="")
			{
				document.getElementById("jscustomer").innerHTML ="<font color='red'><strong>Customer should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmregisteredpayee.payeename.value.match(alphaExp))
			{
				document.getElementById("jspayeename").innerHTML ="<font color='red'><strong>Payee name is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}
			if(document.frmregisteredpayee.payeename.value=="")
			{
				document.getElementById("jspayeename").innerHTML ="<font color='red'><strong>Payee name should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmregisteredpayee.bankacno.value.match(alphanumbericExp))
			{
				document.getElementById("jsbankacno").innerHTML ="<font color='red'><strong>Bank account number is not valid. Kindly enter number.</strong></font>";
				validateform=1;
			}
			if(document.frmregisteredpayee.bankacno.value=="")
			{
				document.getElementById("jsbankacno").innerHTML ="<font color='red'><strong>Bank account number should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmregisteredpayee.accounttype.value=="")
			{
				document.getElementById("jsaccounttype").innerHTML ="<font color='red'><strong>Account type should not be empty...</strong></font>";
				validateform=1;
			}		
			if(!document.frmregisteredpayee.bankname.value.match(alphaspaceExp))
			{
				document.getElementById("jsbankname").innerHTML ="<font color='red'><strong>Bank name is not valid. Kindly enter alphabets.</strong></font>";
				validateform=1;
			}	
			if(document.frmregisteredpayee.bankname.value=="")
			{
				document.getElementById("jsbankname").innerHTML ="<font color='red'><strong>Bank name should not be empty..</strong></font>";
				validateform=1;
			}
			if(!document.frmregisteredpayee.ifsccode.value.match(alphanumbericExp))
			{
				document.getElementById("jsifsccode").innerHTML ="<font color='red'><strong>IFSC code is not valid. Kindly enter alphabets or numbers.</strong></font>";
				validateform=1;
			}	
			if(document.frmregisteredpayee.ifsccode.value=="")
			{
				document.getElementById("jsifsccode").innerHTML ="<font color='red'><strong>IFSC code should not be empty..</strong></font>";
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