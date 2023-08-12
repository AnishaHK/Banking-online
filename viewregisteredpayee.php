<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM registered_payee WHERE registered_payee_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Account master record deleted successfully...');</script>";
	}
}
if(isset($_GET['st']))
{
	$sql = "update registered_payee set  status='$_GET[st]' where registered_payee_id ='$_GET[registered_payee_id]'";
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
?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Registered Payee</h1>
          <p>View Registered Payee records.</p>

  
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Customer</th>
    <th scope="col">&nbsp;Login ID</th>
    <th scope="col">&nbsp;Payee Name</th>
    <th scope="col">&nbsp;Bank Account Number</th>
    <th scope="col">&nbsp;Account type</th>
    <th scope="col">&nbsp;Bank Name</th>
     <th scope="col">&nbsp;IFSC Code</th>
     <th scope="col">&nbsp;Status</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM registered_payee INNER JOIN customer ON customer.customer_id=registered_payee.customer_id WHERE registered_payee.registered_payee_id!='0'";
 	if($rsemployee['emp_type'] == "Employee")
 	{
	 	$sql = $sql . " AND customer.ifsc_code='$rsemployee[ifsc_code]'";
 	}
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
		
		$sqlcustomer= "SELECT * FROM customer where customer_id='$rs[customer_id]'";
		$qsqlcustomer = mysqli_query($con,$sqlcustomer);
		$rscustomer = mysqli_fetch_array($qsqlcustomer);
  echo "<tr>
    <td>&nbsp;$rscustomer[first_name] $rscustomer[last_name]</td>
    <td>&nbsp;$rscustomer[login_id]</td>
    <td>&nbsp;$rs[payee_name]</td>
    <td>&nbsp;$rs[bank_acc_no]</td>
    <td>&nbsp;$rs[acc_type]</td>
    <td>&nbsp;$rs[bank_name]</td>
	<td>&nbsp;$rs[ifsc_code]</td>
	<td>&nbsp;$rs[status]</td>
	<td>&nbsp;";
	echo "<a href='viewregisteredpayee.php?registered_payee_id=$rs[registered_payee_id]&st=Active'>Activate</a> ";
	echo "| ";
	echo "<a href='viewregisteredpayee.php?registered_payee_id=$rs[registered_payee_id]&st=Inactive' >Deactivate</a></td>";
  	echo "</tr>";
  }
?>  
</tbody>
</table>
            </div>
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