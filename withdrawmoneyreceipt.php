<?php
include("header.php");
include("sidebar.php");

$_SESSION['randomno'] = rand();

	$sqltransaction = "SELECT * FROM transaction where trans_id='$_GET[receiptid]'";
	$qsqltransaction= mysqli_query($con,$sqltransaction);
	$rstransaction = mysqli_fetch_array($qsqltransaction);
	
	$sqlcustac ="SELECT * FROM accounts INNER JOIN customer ON accounts.customer_id=customer.customer_id WHERE accounts.acc_no='$rstransaction[to_acc_no]' AND accounts.acc_type_id!= '0' AND accounts.acc_status='Active'";
 	$qsqlcustac = mysqli_query($con,$sqlcustac);
	$rscustac = mysqli_fetch_array($qsqlcustac);
	
	 $sqlbranch ="SELECT * FROM branch WHERE ifsc_code='$rscustac[ifsc_code]'";
 	$qsqlbranch = mysqli_query($con,$sqlbranch);
	$rsbranch = mysqli_fetch_array($qsqlbranch);

?>
     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
<div id="divprint">
         <center><h1>Withdrawal Receipt</h1></center>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmtransaction" method="post" action="" onsubmit="return javascriptvalidation()">
                 <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />

                  
<table  id="example1" class="table table-striped table-bordered" cellspacing="0" width="75%">
<thead> 
  <tr>
    <th scope="col">&nbsp;Name</th>
    <th scope="col">&nbsp;<?php echo $rscustac['first_name'] . " ". $rscustac['last_name']; ?></th>
  </tr>
  
  <tr>
    <th scope="col">&nbsp;Branch</th>
    <td scope="col">&nbsp;<?php echo $rsbranch['branch_name']; ?></td> 
  </tr>
  
  <tr>
    <th scope="col">&nbsp;IFSC Code</th>
    <td scope="col">&nbsp;<?php echo $rsbranch['ifsc_code']; ?></td> 
  </tr>
    
  <tr>
    <th scope="col">&nbsp;Account Number</th>
    <td scope="col">&nbsp;<?php echo  $rstransaction['to_acc_no']; ?></td> 
  </tr>
   <tr>
    <th scope="col">&nbsp;Date</th>
    <td scope="col">&nbsp;<?php echo  $rstransaction[trans_date_time]; ?></td> 
  </tr> 
  <tr>
    <th scope="col">&nbsp;Amount Withdrawn</th>
    <td scope="col">&nbsp;Rs. <?php echo  $rstransaction['amount']; ?></td> 
  </tr>
  
  <tr>
    <th scope="col">&nbsp;Account Balance</th>
    <td scope="col">&nbsp;Rs. <?php echo  $rscustac['acc_balance']; ?></td> 
  </tr>
 
  </thead>
</table>
</div>

<center><input type="button" name="print" value="Print"  class="btn btn-primary"  onClick="PrintElem('divprint')" ></center>
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
        xmlhttp.open("GET","ajaxcreditdebit.php?customeracid="+customeracid,true);
        xmlhttp.send();
}


function PrintElem(elem)
    {
      var mywindow = window.open('', 'PRINT', 'height=400,width=600');


        mywindow.document.write('<html><head><title>' + document.title  + '</title>');

        mywindow.document.write('</head><body >');
      mywindow.document.write('<center><h1>' + document.title  + '</h1></center>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;

        }
</script>
<?php
	include("footer.php");
	?>