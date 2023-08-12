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

          <h1>Individual Loan Payment  Details</h1>
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
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM loan_payment WHERE payment_id!= '0'";
 if(isset($_GET['loan_acc_no']))
 {
	 $sql = $sql . " AND loan_acc_no='$_GET[loan_acc_no]'";
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
    <td>$_SESSION[currency]&nbsp;$rs[loan_amt]</td>
    <td>&nbsp;$rs[interest]%</td>
    <td>$_SESSION[currency]&nbsp;$rs[total_amt]</td>
	<td>$_SESSION[currency]&nbsp;$rs[paid]</td>
	<td>&nbsp;$rs[payment_type]</td>
	<td>$_SESSION[currency]&nbsp;$rs[balance]</td>
	<td>&nbsp;$rs[paid_date]</td>
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
include("datatables.php");
include("footer.php");
?>