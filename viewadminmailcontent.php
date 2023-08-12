<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "UPDATE mail SET adminst='Deleted' WHERE mail_request_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	/*
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Mail record deleted successfully...');</script>";
		
		if($_GET[msgtype] == "Sent")
		{
			echo "<script>window.location='viewsentmail.php?customeracid=" . $receiver . "';</script>";
		}
		if($_GET[msgtype] == "Sent")
		{
			echo "<script>window.location='viewsentmail.php?customeracid=" . $receiver . "';</script>";
		}
	}
	*/
}
 $sql ="SELECT * FROM mail  WHERE message_type='AdminCustomer' and mail_request_id='$_GET[viewid]' ORDER BY date_time desc";
 $qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);

		 $sqlcustomer ="SELECT * FROM customer WHERE customer_id='$rs[receiver_id]'";
		 $qsqlcustomer = mysqli_query($con,$sqlcustomer);
		 $rscustomer = mysqli_fetch_array($qsqlcustomer);
?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>Sent Mail</h1>
          <p>View all sent records.</p>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
        <table width="610" cellspacing="0"  class="table table-striped table-bordered" >
        <thead>
          <tr>
            <th width="18%" style="width:15%" scope="col">&nbsp;Sent on</th> 
            <td width="82%">&nbsp;<?php echo $rs[date_time]; ?></td>
           </tr>
           <tr>
            <th scope="col">&nbsp;Customer Name</th>
            <td>&nbsp;<?php echo $rscustomer[first_name] . " ".$rscustomer[last_name] ; ?></td>
        </tr>
           <tr>
            <th scope="col">&nbsp; login ID</th>
            <td>&nbsp;<?php echo $rscustomer[login_id]; ?></td>
        </tr>
           <tr>
            <th scope="col">&nbsp;Subject</th>
            <td>&nbsp;<?php echo $rs[subject]; ?></td>
            </tr>
        </tr>
           <tr>
            <th scope="col" style="vertical-align:top;">&nbsp;Message</th>
            <td><?php echo $rs[message]; ?></td>
            </tr>
          </tr>
<?php
if($_GET[msgtype] == "Sent")
{
?>  
   <tr>
    <th colspan="2" scope="col">&nbsp;Reply to this mail<br>
&nbsp;
      <script src="richtexteditor/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'textarea' });</script>
      <textarea class="form-control" name="message" placeholder="Message" rows="5"><?php echo $rsedit[message]; ?></textarea>    
<ul class="nav nav-pills">
              <li class="active"><a href='viewsentmail.php?delid=<?php echo $rs[mail_request_id]; ?>' onclick='return confirmtodelete()'>Send Reply</a></li>
              </ul>
      </th>
    </tr>
  </tr>
<?php
}
?>  
  </thead>
  <tbody>
</tbody>
</table>
			<ul class="nav nav-pills">
              <li class="active"><a href='viewmailcontent.php?delid=<?php echo $rs[0]; ?>' onclick='return confirmtodelete()'>Delete this mail</a></li>
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