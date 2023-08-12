<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM mail WHERE mail_request_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Account master record deleted successfully...');</script>";
	}
}
?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>Sent Mail</h1>
          <p>View all sent records.</p>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col" style="width:15%">&nbsp;Sent on</th> 
    <th scope="col" style="width:20%">&nbsp;Customer<br>(Name and login ID)</th>
    <th scope="col" style="width:55%">&nbsp;Subject</th>
    <th scope="col" style="width:10%">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM mail  WHERE sender_id='$_SESSION[emp_id]'  AND message_type='AdminCustomer' ORDER BY date_time desc";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 $sqlcustomer ="SELECT * FROM customer WHERE customer_id='$rs[receiver_id]'";
	 $qsqlcustomer = mysqli_query($con,$sqlcustomer);
	 $rscustomer = mysqli_fetch_array($qsqlcustomer);
  echo "<tr>
    <td>&nbsp;$rs[date_time]</td>
    <td>&nbsp;$rscustomer[first_name] $rscustomer[last_name] |  $rscustomer[login_id]</td>
    <td>&nbsp;$rs[subject]</td>
    <td>&nbsp; <a href='viewsentmail.php?delid=$rs[mail_request_id]' onclick='return confirmtodelete()'>Delete</a></td>
  </tr>";
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