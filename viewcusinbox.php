<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "UPDATE mail SET cust_status='Deleted' WHERE mail_request_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Mail deleted successfully...');</script>";
		echo "<script>window.location='viewcusinbox.php';</script>";
	}
}
?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>Inbox</h1>
          <p>View all recieved mail's:</p>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th width="15%" scope="col">&nbsp;Date Time</th> 
    <th width="58%" scope="col">&nbsp;Subject</th>
    <th width="27%" scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM mail  WHERE receiver_id='$_SESSION[customer_id]' AND message_type='AdminCustomer' AND cust_status!='Deleted' ORDER BY date_time desc";
 $qsql = mysqli_query($con,$sql);
 echo mysqli_error($con);
 while($rs = mysqli_fetch_array($qsql))
 {
	 $sqlcustomer ="SELECT * FROM customer WHERE customer_id='$rs[receiver_id]'";
	 $qsqlcustomer = mysqli_query($con,$sqlcustomer);
	 $rscustomer = mysqli_fetch_array($qsqlcustomer);
  echo "<tr>
    <td>&nbsp;" . date('d-m-Y h:i A', strtotime($rs['date_time'])) . "</td> 
    <td>&nbsp;<a href='viewmailcontent.php?viewid=$rs[mail_request_id]&msgtype=Inbox'>$rs[subject]</a></td>
    <td>&nbsp; ";
	?>
	<a href='viewcusinbox.php?delid=<?php echo $rs['mail_request_id']; ?>&viewid=<?php echo $rs['mail_request_id']; ?>&usertype=Customer&msgtype=Inbox' onclick='return confirmtodelete()'>Delete</a></td>
  <?php
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