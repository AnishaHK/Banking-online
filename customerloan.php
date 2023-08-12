<?php
include("header.php");
include("sidebar.php");
//if($_SESSION['randomno'] == $_POST['randomno'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{
							
			$sql = "update loan set loan_acc_no='$_POST[loanaccno]',customer_id='$_SESSION[customer_id]',loan_type_id='$_POST[loantype]',loan_amt='$_POST[loanamount]',interest='$_POST[interest]',create_date='$_POST[datetime]' where loan_acc_no='$_GET[editid]' ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Loan  account updated successfully..');</script>";
			}

		}
		else
		{				
			$sql = "insert into loan(loan_acc_no,customer_id,loan_type_id,loan_amt,interest,create_date,status) VALUES('$_POST[loanaccno]','$_SESSION[customer_id]','$_POST[loantype]','$_POST[amtloanamount]','$_POST[interest]','$dttim','Pending') ";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Loan  account created successfully..');</script>";
				echo "<script>window.location='viewcustloanpending.php';</script>";	
			}
		}
	}
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM loan where loan_acc_no='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
else
{
	$sqlacc_no = "SELECT max(loan_acc_no)+1 FROM loan";
	$qsqlacc_no = mysqli_query($con,$sqlacc_no);
	$rsacc_no = mysqli_fetch_array($qsqlacc_no);
	$accno = $rsacc_no[0] ;
	if($accno==0)
	{
		$accno = 217501000811000;
	}
	else
	{
		$accno = $accno;
	}
}
?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Loan Account</h1>
          <p class="margin-bottom-15">Enter loan account details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmloan"  method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Loan Account Number</label>
                    <input type="text" class="form-control" name="loanaccno" placeholder="Loan Account Number"  value="<?php echo $accno; ?>" readonly="readonly" style="background-color:#9C9">  
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloanaccno" ></span>
                  </div>
                  </div>
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Loan Type</label>
                   <select class="form-control" name="loantype" onchange="loadloanrec(this.value)" >
                 <option value="">Select</option>
                    <?php
                    $sqlid= "SELECT * FROM loan_type WHERE status='Active'";
                    $qsqlid =mysqli_query($con,$sqlid);
                    while($rsid = mysqli_fetch_array($qsqlid))
                    {
                        if($rsid[loan_type_id] == $rsedit[loan_type_id])
                        {
                            echo "<option value='$rsid[loan_type_id]' selected>$rsid[loan_type] ($rsid[prefix])</option>";
                        }
                        else
                        {
                            echo "<option value='$rsid[loan_type_id]'>$rsid[loan_type] ($rsid[prefix])</option>";
                        }
                    }
                    ?>        
                 </select>
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloantype" ></span>
                  </div>
                  </div>
                
                  <div id="divloan"><img src="images/LoadingSmall.gif" width="172" height="172" /></div>
                

            </form>
          </div>
        </div>
      </div>
    </div>

    
	<script type="application/javascript">
	function javascriptvalidation()
	{
		document.getElementById("jsloanaccno").innerHTML ="";
		document.getElementById("jscustomer").innerHTML ="";
		document.getElementById("jsloantype").innerHTML ="";
		document.getElementById("jsloanamount").innerHTML ="";
		document.getElementById("jsinterest").innerHTML ="";
		document.getElementById("jsdatetime").innerHTML ="";
				
		var validateform=0;      
			if(document.frmloan.loanaccno.value=="")
			{
				document.getElementById("jsloanaccno").innerHTML ="<font color='red'><strong>Loan account number should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmloan.customer.value=="")
			{
				document.getElementById("jscustomer").innerHTML ="<font color='red'><strong>Customer should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmloan.loantype.value=="")
			{
				document.getElementById("jsloantype").innerHTML ="<font color='red'><strong>Loan type should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmloan.loanamount.value=="")
			{
				document.getElementById("jsloanamount").innerHTML ="<font color='red'><strong>Loan amount should be more than 8 charaters...</strong></font>";
				validateform=1;
			}			
			if(document.frmloan.interest.value=="")
			{
				document.getElementById("jsinterest").innerHTML ="<font color='red'><strong>Interest should not be empty..</strong></font>";
				validateform=1;
			}
			if(document.frmloan.datetime.value=="")
			{
				document.getElementById("jsdatetime").innerHTML ="<font color='red'><strong>Date and time should not be empty..</strong></font>";
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
	function loadloanrec(loanid)
	{
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
                document.getElementById("divloan").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxloan.php?loanid="+loanid,true);
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