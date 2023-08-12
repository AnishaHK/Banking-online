<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "update mail SET cust_status='Deleted' WHERE mail_request_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Mail record deleted successfully...');</script>";		
		if($_GET[msgtype] == "Sent" && $_GET[usertype] == "Customer")
		{
			echo "<script>window.location='viewcustsentmail.php';</script>";
		}
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
    <th scope="col" style="width:55%">&nbsp;Subject</th>
    <th scope="col" style="width:10%">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
<?php 
	 $sql ="SELECT * FROM mail  WHERE message_type='CustomerAdmin' AND sender_id='$_SESSION[customer_id]' AND cust_status!='Deleted' ORDER BY date_time desc";
	 $qsql = mysqli_query($con,$sql);
	 while($rs = mysqli_fetch_array($qsql))
	 {
		 $sqlcustomer ="SELECT * FROM employee WHERE emp_name='$rs[receiver_id]'";
		 $qsqlcustomer = mysqli_query($con,$sqlcustomer);
		 $rscustomer = mysqli_fetch_array($qsqlcustomer);
	  echo "<tr>
				<td>&nbsp;" . date('d-m-Y h:i A', strtotime($rs[date_time])) . "</td>
				<td>&nbsp;<a href='viewmailcontent.php?viewid=$rs[mail_request_id]&usertype=Customer&msgtype=Sent'>$rs[subject]</a></td>";
?>		
<?php
		echo "<td>&nbsp; ";
		?>
        <a href='viewcustsentmail.php?delid=<?php echo $rs[mail_request_id]; ?>&viewid=<?php echo $rs[mail_request_id]; ?>&usertype=Customer&msgtype=<?php echo $_GET[msgtype]; ?>' onclick='return confirmtodelete()'>Delete</a>
        <?php
        echo "</td></tr>";
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