<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM transaction WHERE trans_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Transaction record deleted successfully...');</script>";
	}
}
?> 
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View FD Accounts</h1>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table   id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Customer</th>
    <th scope="col">&nbsp;Account No.</th>
    <th scope="col">&nbsp;Account date</th>
    <th scope="col">&nbsp;Maturity date</th>
    <th scope="col">&nbsp;Deposit type</th>
    <th scope="col">&nbsp;Investment amount</th>
    <th scope="col">&nbsp;Profit</th>
    <th scope="col">&nbsp;Total Receivable Amount</th>
    <th scope="col">&nbsp;Status</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $acprimary = "(Primary)";
	$sql ="SELECT * FROM accounts INNER JOIN customer ON customer.customer_id=accounts.customer_id WHERE accounts.fd_id!='0' ";
	if(isset($_SESSION['customer_id']))
	{
		$sql = $sql . " AND accounts.customer_id='$_SESSION[customer_id]'";
	}
	if($rsemployee['emp_type'] == "Employee")
	{
		$sql = $sql . " AND customer.ifsc_code='$rsemployee[ifsc_code]'";
	}
	$sql = $sql. " order by accounts.acc_no";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 	$sqlfixed_deposit = "SELECT * FROM fixed_deposit where fd_id='$rs[fd_id]'";
		$qsqlfixed_deposit = mysqli_query($con,$sqlfixed_deposit);
		$rsfixed_deposit = mysqli_fetch_array($qsqlfixed_deposit);
		$profit = $rs['acc_balance'] * $rs['interest']/100;
		$totrec = $rs['acc_balance'] + $profit;
		$sqlcustomer= "SELECT * FROM customer where customer_id='$rs[customer_id]'";
		$qsqlcustomer = mysqli_query($con,$sqlcustomer);
		$rscustomer = mysqli_fetch_array($qsqlcustomer);
  echo "<tr>
 <td>&nbsp;$rscustomer[first_name] $rscustomer[last_name]</td>
    <td>&nbsp;$rs[acc_no] $acprimary</td>
    <td>&nbsp;"  . date("d-M-Y",strtotime($rs['acc_date'])) . "</td>
    <td>&nbsp;";
	 	$year = "$rsfixed_deposit[terms] years";
		$acdate =$rs['acc_date'];
	   $mdate=date('d-M-Y', strtotime($year, strtotime($acdate)) );
	 echo "$mdate</td>
    <td>&nbsp;$rs[deposit_type] ($rsfixed_deposit[prefix]) </td>
    <td>&nbsp;$_SESSION[currency] $rs[acc_balance]</td>
    <td>&nbsp;$_SESSION[currency] $profit ($rs[interest]%)</td>
    <td>&nbsp;$_SESSION[currency] $totrec </td>
    <td>&nbsp;$rs[acc_status]</td>
  </tr>";
  /*$acprimary = "";*/
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