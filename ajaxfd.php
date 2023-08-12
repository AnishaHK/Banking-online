<?php
error_reporting(0);
include("dbconnection.php");
$sqlid= "SELECT * FROM fixed_deposit WHERE fd_id='$_GET[fd_id]'";
$qsqlid =mysqli_query($con,$sqlid);
$rsid = mysqli_fetch_array($qsqlid);
?>		

                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Interest (in percentage)</label>
                    <input type="text" readonly class="form-control" name="interest" id="interest" placeholder="Kindly select Account type.." value="<?php echo $rsid['interest']; ?>"> 
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                 
                </div>
                </div>       
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Minimum amount</label>
                    <input type="text" readonly class="form-control" name="minamt" id="minamt" placeholder="Kindly select Account type.." value="<?php echo $rsid['min_amt']; ?>"> 
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
               
                </div>
                </div>   
                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Maximum Amount</label>
                    <input type="text" readonly class="form-control" name="maxamt" id="maxamt" placeholder="Kindly select Account type.." value="<?php echo $rsid['max_amt']; ?>"> 
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
             
                </div>
                </div>   
                                
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Maximum Amount</label>
                    <input type="text" readonly class="form-control" name="maxamt" id="maxamt" placeholder="Kindly select Account type.." value="<?php echo $rsid['interest']; ?>"> 
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
            
                </div>
                </div>   
                  
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Term (in year)</label>
      <input type="text" class="form-control" name="term" placeholder="Account Balance" value="<?php echo $rsid['terms']; ?>" readonly>  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
             
             </div>
             </div>
             
             
             
                                   <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Investment amount</label>
                    <input type="text" class="form-control" name="amtloanamount" id="amtloanamount" placeholder="Investment amount" value="<?php echo $rsedit['loan_amt']; ?>" onkeyup="calculategrandtotal()">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsamtloanamount" ></span>
                  </div>
                  </div>
                               
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Total Profit</label>
                    <input type="text" class="form-control" name="tinterestamt" id="tinterestamt" placeholder="Interest amount calculates automatically" readonly >  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloanamount" ></span>
                  </div>
                  </div>
                  
                                                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Amount receivable</label>
                    <input type="text" class="form-control" name="tgrandtotal" id="tgrandtotal" placeholder="Total receivable calculates automatically" readonly >  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloanamount" ></span>
                  </div>
                  </div>
                  
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Maturity date</label>
      <input type="text" class="form-control" name="term" placeholder="Account Balance" value="<?php 
	 $year = $rsid['terms'] ." years";
	  echo $futureDate=date('Y-m-d', strtotime($year));
	  ?>" readonly>  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
             
             </div>
             </div>
                
   				<div class="row templatemo-form-buttons">
                	<div class="col-md-12">
                  		<button type="submit" class="btn btn-primary" name="submit">Submit</button>  
                	</div>
              	</div>                