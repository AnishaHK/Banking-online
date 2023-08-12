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
			$sql = "insert into accounts(acc_no,customer_id,acc_status,acc_date,fd_id,acc_balance,unclear_bal,interest) VALUES('$_POST[accno]','$_GET[customeracid]','Active','$dt','$_POST[accounttype]','$_POST[amtloanamount]','$_POST[unclearbalance]','$_POST[interest]') ";
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
      <input type="text" class="form-control" name="accno" placeholder="Account Number" value="<?php echo $accno; ?>" readonly style="background-color:#FCC">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccountbalance" ></span>
             </div>
             </div>
                                
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Fixed deposit account Type</label>
         			<select  class="form-control" name="accounttype" placeholder="Account type" onchange="selectfixeddeposit(this.value)" >                  
                   		<option value="">Select</option>
                            <?php
                            $sqlid= "SELECT * FROM fixed_deposit WHERE status='Active'";
                            $qsqlid =mysqli_query($con,$sqlid);
                            while($rsid = mysqli_fetch_array($qsqlid))
                            {
                                if($rsid['fd_id'] == $rsedit['fd_id'])
                                {
                                    echo "<option value='$rsid[fd_id]' selected >$rsid[deposit_type] ($rsid[prefix])</option>";
                                }
                                else
                                {
                                    echo "<option value='$rsid[fd_id]' >$rsid[deposit_type] ($rsid[prefix])</option>";
                                }
                            }
                            ?>          
                   </select>
                  </div> 
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsaccounttype" ></span>
                  </div>
                  </div>      
                  
                  <div id="divfd"><img src="images/LoadingSmall.gif" width="172" height="172" /></div>
                  
                  
                  
           
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
		
		document.getElementById("jsamtloanamount").innerHTML ="";
		/*document.getElementById("jscustomer").innerHTML ="";
		document.getElementById("jsaccountstatus").innerHTML ="";
		document.getElementById("jsprimaryaccount").innerHTML ="";
		document.getElementById("jsaccountdate").innerHTML ="";
		document.getElementById("jsaccounttype").innerHTML ="";
		document.getElementById("jsaccountbalance").innerHTML ="";
		document.getElementById("jsunclearbalance").innerHTML ="";
		document.getElementById("jsinterest").innerHTML ="";*/
		
		var validateform=0; 
		if(!document.frmaccounts.amtloanamount.value.match(numericfloatExpression))
			{
				document.getElementById("jsamtloanamount").innerHTML ="<font color='red'><strong>Investment amount should be floating point number.</strong></font>";
				validateform=1;
			}     
			if(document.frmaccounts.amtloanamount.value=="")
			{
				document.getElementById("jsamtloanamount").innerHTML ="<font color='red'><strong>Investment amount should not be empty..</strong></font>";
				validateform=1;
			}
			
			if(document.frmaccounts.accounttype.value=="")
			{
				document.getElementById("jsaccounttype").innerHTML ="<font color='red'><strong>Account type should be selected.</strong></font>";
				validateform=1;
			}
			/*if(document.frmaccounts.customer.value=="")
			{
				document.getElementById("jscustomer").innerHTML ="<font color='red'><strong>Customer should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.accountstatus.value=="")
			{
				document.getElementById("jsaccountstatus").innerHTML ="<font color='red'><strong>Account status should not be empty..</strong></font>";
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
			if(document.frmaccounts.accountbalance.value=="" )
			{   
				document.getElementById("jsaccountbalance").innerHTML ="<font color='red'><strong>  Account balance should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.unclearbalance.value=="")
			{
				document.getElementById("jsunclearbalance").innerHTML ="<font color='red'><strong>Unclear balance should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmaccounts.interest.value=="")
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong> Interest should not be empty..</strong></font>";
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
<script type="application/javascript">
	   function selectfixeddeposit(fd_id)
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
							document.getElementById("divfd").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","ajaxfd.php?fd_id="+fd_id,true);
					xmlhttp.send();
				
	   }
	function calculategrandtotal()
	{
		//alert(document.getElementById("amtloanamount").value);
		document.getElementById("tinterestamt").value = parseFloat(document.getElementById("amtloanamount").value) * parseFloat(document.getElementById("interest").value) /100;
		// )/100;
		document.getElementById("tgrandtotal").value = parseFloat(document.getElementById("amtloanamount").value) * parseFloat(document.getElementById("interest").value) /100 + parseFloat(document.getElementById("amtloanamount").value);

	}
</script>
<?php
	include("footer.php");
	?>
	