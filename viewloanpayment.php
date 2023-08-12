<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM loan_payment WHERE payment_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Account master record deleted successfully...');</script>";
	}
}

?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Loan Payment</h1>
        <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Customer</th>
    <th scope="col">&nbsp;Loan Number</th>
    <th scope="col">&nbsp;Loan Amount</th>
    <th scope="col">&nbsp;Interest</th>
    <th scope="col">&nbsp;Total Amount</th>
    <th scope="col">&nbsp;Paid</th>
    <th scope="col">&nbsp;Payment Type</th>
    <th scope="col">&nbsp;Balance</th>
    <th scope="col">&nbsp;Paid Date</th>
    <th scope="col">&nbsp;Receipt</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM loan_payment where payment_id!='0' ";
 if(isset($_SESSION['customer_id']))
 {
	 $sql = $sql . " and customer_id='$_SESSION[customer_id]'";
 }
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
		$sqlcustomer= "SELECT * FROM customer where customer_id='$rs[customer_id]'";
		$qsqlcustomer = mysqli_query($con,$sqlcustomer);
		$rscustomer = mysqli_fetch_array($qsqlcustomer);
  echo "<tr>
    <td>&nbsp;$rscustomer[first_name] $rscustomer[last_name]</td>
    <td>&nbsp;$rs[loan_acc_no]</td>
    <td>$_SESSION[currency] $rs[loan_amt]</td>
    <td>&nbsp;$rs[interest]%</td>
    <td>$_SESSION[currency] $rs[total_amt]</td>
	<td>$_SESSION[currency] $rs[paid]</td>
	<td>&nbsp;$rs[payment_type]</td>
	<td>$_SESSION[currency] $rs[balance]</td>
	<td>&nbsp;" . date("d-M-Y",strtotime($rs['paid_date'])) . "</td>
	<td>&nbsp;<A class='btn btn-info' href='loanpaymentreceipt.php?receiptid=$rs[0]'>Print</a></td>
  </tr>";
  }
?>  
</tbody>
</table>
            </div>
          </div>
        </div>
      </div>
<script type="application/javascript">
function confirmtodelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
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