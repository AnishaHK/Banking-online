<?php
include("header.php");
include("sidebar.php");
//if($_SESSION['randomno'] == $_POST['randomno'])
{
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
			$message = mysqli_real_escape_string($con, $_POST['message']);
			$sql = "insert into mail(sender_id,receiver_id,subject,message,message_type,date_time) VALUES('$sender','$receiver','$_POST[subject]','$message','$message_type','$dttim') ";
			$qsql = mysqli_query($con,$sql);
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
}
$_SESSION['randomno'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM mail where mail_request_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

     <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
         <h1>Mail</h1>
          <p class="margin-bottom-15">Enter Mail details..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form" name="frmmail" method="post" action="" onsubmit="return javascriptvalidation()">
              <input  type="hidden" name="randomno" value="<?php echo $_SESSION['randomno']; ?>"  />
               <div class="row">
                  <div class="col-md-12 margin-bottom-15">
                     <label for="firstName" class="control-label">Customer name and Login ID : </label>
                                     <?php
					 if(isset($_GET['customeracid']))
					 { 
					?>
                    <select class="form-control margin-bottom-15" name="customer">
					<?php
						echo $sqlid= "SELECT * FROM customer WHERE customer_id='$_GET[customeracid]'";
						$qsqlid =mysqli_query($con,$sqlid);
						while($rsid = mysqli_fetch_array($qsqlid))
						{
								echo "<option value='$rsid[customer_id]' selected>$rsid[first_name] $rsid[last_name] ($rsid[login_id])</option>";
						}
                    ?>           
                   </select> 
                   <?php
					 }
					 else
					 {
					?> 
                   <select class="form-control margin-bottom-15" name="customer">
                     <option value="">Select</option>
					<?php
						$sqlid= "SELECT * FROM customer";
						$qsqlid =mysqli_query($con,$sqlid);
						while($rsid = mysqli_fetch_array($qsqlid))
						{
							if($rsid['customer_id'] == $rsedit['customer_id'])
							{
								echo "<option value='$rsid[customer_id]' selected>$rsid[first_name] $rsid[last_name] ($rsid[login_id])</option>";
							}
							else
							{
								echo "<option value='$rsid[customer_id]'>$rsid[first_name] $rsid[last_name] ($rsid[login_id])</option>";
							}
						}
                    ?>           
                   </select> 
                   <?php
					 }
				 ?>
 <span id="jscustomer" ></span>
                  </div>
                  </div>
                                  
                <div class="row">
                          <div class="col-md-12 margin-bottom-15">
                                <label for="firstName" class="control-label">Subject</label>
                                <input type="text" class="form-control" name="subject" placeholder="Subject" value="<?php 
								if(isset($_GET['editid']))
								{
								echo $rsedit['subject']; 
								}
								?>">  
                                 <span id="jssubject" ></span>
                          </div>
                  </div>
                
                           
                <div class="row">
                  <div class="col-md-12 margin-bottom-15">
                    <label for="firstName" class="control-label">Message</label>
                    <script src="richtexteditor/tinymce.min.js"></script>
              <script>tinymce.init({ selector:'textarea' });</script>
                    <textarea class="form-control" name="message" id="messages" placeholder="Message" rows="15"><?php
if(isset($_GET['editid']))
{
					echo $rsedit['message'];
}
					?></textarea>
                    <span id="jsmessage" ></span>
                  </div>
                  </div>

              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Send Mail"  class="btn btn-primary" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    
	<script type="application/javascript">
	function javascriptvalidation()
	{
		document.getElementById("jscustomer").innerHTML ="";
		document.getElementById("jssubject").innerHTML ="";
		document.getElementById("jsmessage").innerHTML ="";		
		var validateform=0;      
			
			if(document.frmmail.customer.value=="")
			{
				document.getElementById("jscustomer").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
				validateform=1;
			}
			if(document.frmmail.subject.value=="")
			{
				document.getElementById("jssubject").innerHTML ="<font color='red'><strong>This field can not be empty.</strong></font>";
				validateform=1;
			}
	if(tinyMCE.get('messages').getContent() =="")
	 {
		 document.getElementById("jsmessage").innerHTML ="<font color='red'><strong>Message should not be empty.</strong></font>";
		 validatecondtion=1;
	 }		
			if(validateform==0)
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
	include("footer.php");
	?>