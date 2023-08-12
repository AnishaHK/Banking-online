<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM employee WHERE emp_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Employee record deleted successfully...');</script>";
	}
}
?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Employee</h1>
          <p>View Employee records.</p>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Employee Type</th>
    <th scope="col">&nbsp;IFSC Code(Branch)</th>
    <th scope="col">&nbsp;Employee Name</th>
    <th scope="col">&nbsp;Login ID</th>
    <th scope="col">&nbsp;Email ID</th>
    <th scope="col">&nbsp;Contact Number</th>
    <th scope="col">&nbsp;Created Date</th>
    <th scope="col">&nbsp;Last Login</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM employee";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
 		$sqlbranch ="SELECT * FROM branch WHERE ifsc_code='$rs[ifsc_code]'";
 		$qsqlbranch = mysqli_query($con,$sqlbranch);
		$rsbranch = mysqli_fetch_array($qsqlbranch);
  echo "<tr>
	<td>&nbsp;$rs[emp_type]</td>
    <td>&nbsp;$rs[ifsc_code] ($rsbranch[branch_name])</td>
    <td>&nbsp;$rs[emp_name]</td>
    <td>&nbsp;$rs[login_id]</td>
    <td>&nbsp;$rs[email_id]</td>
	<td>&nbsp;$rs[contact_no]</td>
	<td>&nbsp;"  . date("d-M-Y",strtotime($rs['create_date'])) . "</td>
	<td>&nbsp;"  . date("d-M-Y h:i A",strtotime($rs['last_login'])) . "</td>
	 <td>&nbsp;<a href='employee.php?editid=$rs[emp_id]' class='btn btn-info'>Edit</a> | <a href='viewemployee.php?delid=$rs[emp_id]' onclick='return confirmtodelete()' class='btn btn-danger'>Delete</a></td>
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