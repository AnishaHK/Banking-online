<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['emp_id']))
	{
	$sender =$_SESSION['emp_id'];
	$receiver = $_POST['customer'];
	$message_type = "AdminCustomer";
	}
	if(isset($_SESSION['customer_id']))
	{
	$sender =$_SESSION['customer_id'];
	$receiver = 1;
	$message_type = "CustomerAdmin";
	}
		$prevmessagesubject = mysqli_real_escape_string($con, $_POST['prevmessagesubject']);
		$prevmessagecontent = mysqli_real_escape_string($con, $_POST['prevmessagecontent']);
		$message = mysqli_real_escape_string($con, $_POST['message']);
		$sql = "insert into mail(sender_id,receiver_id,subject,message,message_type,date_time) VALUES('$receiver','$_POST[sender_id]','Reply to $prevmessagesubject','$message <hr>Subject : $prevmessagesubject <br>$prevmessagecontent','$message_type','$dttim') ";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Mail sent successfully..');</script>";
			echo "<script>window.location='viewsentmail.php';</script>";
		}

}
if(isset($_GET['delid']))
{
	if(isset($_SESSION['customer_id']))
	{
	$sql = "update mail SET cust_status='Deleted' WHERE mail_request_id='$_GET[delid]'";
	}
	if(isset($_SESSION['emp_id']))
	{
	$sql = "update mail SET emp_status='Deleted' WHERE mail_request_id='$_GET[delid]'";
	}
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Mail record deleted successfully...');</script>";		
		if($_GET['msgtype'] == "Sent" && $_GET['usertype'] == "Customer")
		{
			echo "<script>window.location='viewcustsentmail.php';</script>";
		}
		if($_GET['msgtype'] == "Inbox" && $_GET['usertype'] == "Employee")
		{
			echo "<script>window.location='viewinbox.php';</script>";
		}
	}
}
if(isset($_SESSION['customer_id']))
{
	$sql ="SELECT * FROM mail  WHERE mail_request_id='$_GET[viewid]' ORDER BY date_time desc";
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	$sqlcustomer ="SELECT * FROM customer WHERE customer_id='$rs[sender_id]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
}
if(isset($_SESSION['emp_id']))
{
	$sql ="SELECT * FROM mail  WHERE mail_request_id='$_GET[viewid]' ORDER BY date_time desc";
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	$sqlcustomer ="SELECT * FROM customer WHERE customer_id='$rs[receiver_id]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
}
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>Received Mail</h1>
            <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">

<form method="post" action="">
        <table width="610" cellspacing="0"  class="table table-striped table-bordered" >
        <thead>
          <tr>
            <th width="18%" style="width:15%" scope="col">&nbsp;Sent on</th> 
            <td width="82%">&nbsp;<?php echo date("d-M-Y h:i A",strtotime($rs['date_time'])) ; ?></td>
           </tr>
          <!-- <tr>
            <th scope="col">&nbsp;Customer Name</th>
            <td>&nbsp;<?php echo $rscustomer['first_name'] . " ".$rscustomer['last_name'] ; ?></td>
        </tr>
           <tr>
            <th scope="col">&nbsp;Login ID</th>
            <td>&nbsp;<?php echo $rscustomer['login_id']; ?></td>
        </tr>-->
           <tr>
            <th scope="col">&nbsp;Subject</th>
            <td>&nbsp;<?php echo $rs['subject']; ?></td>
            </tr>
        </tr>
           <tr>
            <th scope="col" style="vertical-align:top;height:350px;">&nbsp;Message</th>
            <td><?php echo $rs['message']; ?></td>
            </tr>
          </tr>
<?php
if($_GET['msgtype'] == "Inbox")
{
?>  
   <tr>
    <th colspan="2" scope="col">&nbsp;Reply to this mail<br>
&nbsp;
      <script src="richtexteditor/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'textarea' });</script>
      
      <input type="hidden" name="sender_id" value="<?php echo $rs['sender_id']; ?>" >
      <input type="hidden" name="prevmessagesubject" value="<?php echo $rs['subject']; ?>" >
      <input type="hidden" name="prevmessagecontent" value="<?php echo $rs['message']; ?>" >
      
      <textarea class="form-control" name="message" placeholder="Message" rows="5"><?php 
	  if(isset($rsedit['message']))
	  {
	  echo $rsedit['message']; 
	  }
	  ?></textarea>    
<ul class="nav nav-pills">
                  <input type="submit" name="submit" value="Send Reply"  class="btn btn-primary" />
              </ul>
      </th>
    </tr>
<?php
}
?>  
  </thead>
  <tbody>
</tbody>
</table>
</form>
			<ul class="nav nav-pills">
      <li class="active"><a href='viewmailcontent.php?delid=<?php echo $rs['mail_request_id']; ?>&viewid=<?php echo $_GET['viewid']; ?>&usertype=<?php echo $_GET['usertype']; ?>&msgtype=<?php echo $_GET['msgtype']; ?>' onclick='return confirmtodelete()'>Delete this mail</a></li>
              </ul><br>

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