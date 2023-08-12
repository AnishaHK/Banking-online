<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM fixed_deposit WHERE fd_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Record deleted successfully...');</script>";
	}
}
?> 
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Fixed Deposit accounts</h1>
          <p>View Fixed Deposite records.</p>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Deposite Type</th>
    <th scope="col">&nbsp;Prefix</th>
    <th scope="col">&nbsp;Minimum Amount</th>
    <th scope="col">&nbsp;Maximum Amount</th>
    <th scope="col">&nbsp;Interest</th>
    <th scope="col">&nbsp;Terms</th>
     <th scope="col">&nbsp;Status</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM fixed_deposit";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
  echo "<tr>
    <td>&nbsp;$rs[deposit_type]</td>
    <td>&nbsp;$rs[prefix]</td>
    <td>&nbsp;$_SESSION[currency] $rs[min_amt]</td>
    <td>&nbsp;$_SESSION[currency] $rs[max_amt]</td>
    <td>&nbsp;$rs[interest]%</td>
	<td>&nbsp;$rs[terms] yr</td>
	<td>&nbsp;$rs[status]</td>
   <td>&nbsp;<a href='fixeddeposit.php?editid=$rs[fd_id]'>Edit</a> | <a href='viewfixeddeposit.php?delid=$rs[fd_id]' onclick='return confirmtodelete()'>Delete</a></td>
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