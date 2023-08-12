<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM customer WHERE customer_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Customer record deleted successfully...');</script>";
	}
}
?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Customer</h1>
          <p>View Customer records.</p>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;IFSC Code</th>
    <th scope="col">&nbsp;Name</th>
    <th scope="col">&nbsp;Login ID</th>
    <th scope="col">&nbsp;A/C Open Date</th>
    <th scope="col">&nbsp;Last Login</th>
    <th scope="col">&nbsp;A/C Status</th>
     <?php
if($rsemployee['emp_type'] != "Admin")
{
?>
    <th scope="col">&nbsp;Action</th>
  <th scope="col">&nbsp;View</th>
   <?php
}
?>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM customer WHERE acc_status!='' ";
	if($rsemployee['emp_type'] == "Employee")
 	{
	 	$sql = $sql . " AND ifsc_code='$rsemployee[ifsc_code]'";
 	}
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
 		$sqlbranch ="SELECT * FROM branch WHERE ifsc_code='$rs[ifsc_code]'";
 		$qsqlbranch = mysqli_query($con,$sqlbranch);
		$rsbranch = mysqli_fetch_array($qsqlbranch);
  echo "<tr>
    <td>&nbsp;$rs[ifsc_code] ($rsbranch[branch_name])</td>
    <td>&nbsp;$rs[first_name]&nbsp;$rs[last_name]</td>
    <td>&nbsp;$rs[login_id]</td>
	<td>&nbsp;". date("d-M-Y",strtotime($rs['acc_open_date'])) . "</td>
	<td>";
	if($rs['last_login'] != "0000-00-00 00:00:00")
	{
	echo date("d-M-Y",strtotime($rs['last_login']));
	echo "<br>";
	echo date("h:i A",strtotime($rs['last_login']));
	}
	echo "</td>
	<td>&nbsp;$rs[acc_status]</td>";
	if($rsemployee['emp_type'] != "Admin")
{
      echo "<td><center><a href='customer.php?editid=$rs[customer_id]'>Edit</a> | <a href='viewcustomer.php?delid=$rs[customer_id]' onclick='return confirmtodelete()'>Delete</a></td>
	 <td><a href='viewcustomerac.php?customeracid=$rs[customer_id]'>View</a></center></td>";
}
  echo "</tr>";
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