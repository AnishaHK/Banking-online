<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "update mail SET emp_status='Deleted' WHERE mail_request_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Mail record deleted successfully...');</script>";		
		if($_GET['msgtype'] == "Sent" && $_GET[usertype] == "Customer")
		{
			echo "<script>window.location='viewinbox.php';</script>";
		}
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
    <th scope="col">&nbsp;Date Time</th> 
    <th scope="col">&nbsp;Received from</th>
    <th scope="col">&nbsp;Subject</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM mail INNER JOIN customer ON mail.sender_id = customer.customer_id WHERE mail.message_type='CustomerAdmin' AND mail.emp_status!='Deleted' ";
if(isset($_SESSION['emp_id']))
{
	if($_SESSION['emp_type'] == "Employee")
	{
 	$sql = $sql . " AND customer.ifsc_code='$rsemployee[ifsc_code]'";
	}
}
if(isset($_GET['customeracid']))
{
	$sql = $sql . " AND customer.customer_id='$_GET[customeracid]'";
}
 $sql = $sql . " ORDER BY mail.date_time desc";
 //echo $sql;
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 $sqlcustomer ="SELECT * FROM customer WHERE customer_id='$rs[sender_id]'";
	 $qsqlcustomer = mysqli_query($con,$sqlcustomer);
	 $rscustomer = mysqli_fetch_array($qsqlcustomer);
  echo "<tr>
    <td>&nbsp;" . date("d-M-Y h:i A",strtotime($rs['date_time'])) . "</td>
    <td>&nbsp;$rscustomer[first_name] $rscustomer[last_name] |  $rscustomer[login_id]</td>
    <td>&nbsp;<a href='viewmailcontent.php?viewid=$rs[mail_request_id]&usertype=Employee&msgtype=Inbox'>$rs[subject]</a></td>
    <td>&nbsp; ";
	?>
	<a href='viewinbox.php?delid=<?php echo $rs[mail_request_id]; ?>&viewid=<?php echo $rs['mail_request_id']; ?>&usertype=Employee&msgtype=Inbox' onclick='return confirmtodelete()'>Delete</a>
	<?php
    echo "</td></tr>";
  }
?>  
</tbody>
</table>
            </div
            ></div>
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