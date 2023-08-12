<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM loan_type WHERE loan_type_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Account master record deleted successfully...');</script>";
	}
}

?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Loan Type</h1>
          <p>View Loan Type records.</p>

          <div class="row margin-bottom-30">
            <div class="col-md-12">
              <ul class="nav nav-pills">
                <li class="active"><a href="loantype.php">Add Account Types</a></li>
              </ul>          
            </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Loan Type</th>
    <th scope="col">&nbsp;Prefix</th>
    <th scope="col">&nbsp;Minimum Amount</th>
    <th scope="col">&nbsp;Maximum Amount</th>
    <th scope="col">&nbsp;Interest</th>
    <th scope="col">&nbsp;Terms (Year)</th>
    <th scope="col">&nbsp;Status</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM loan_type";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
  echo "<tr>
    <td>&nbsp;$rs[loan_type]</td>
    <td>&nbsp;$rs[prefix]</td>
    <td>&nbsp;₹ $rs[min_amount]</td>
    <td>&nbsp;₹ $rs[max_amount]</td>
    <td>&nbsp;$rs[interest]%</td>
	<td>&nbsp;$rs[terms]</td>
	<td>&nbsp;$rs[status]</td>
    <td>&nbsp;<a href='loantype.php?editid=$rs[loan_type_id]'>Edit</a> | <a href='viewloantype.php?delid=$rs[loan_type_id]' onclick='return confirmtodelete()'>Delete</a></td>
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