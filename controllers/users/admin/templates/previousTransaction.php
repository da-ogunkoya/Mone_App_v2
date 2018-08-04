<?php include ('includes/header.php')?>
<div class="col-md-9">
<!---pagination header -->
			<?php include("includes/paging_header.php");?>
			
<!--Search Start here---->
			<div class="well well-default">
				<form name="form1" method="post" action="">
					<div class="row">
						<div class="col-md-10">
											<div class="row">
									<div class="col-md-10 ">
										<div class="form-group input-group">
											<span class="input-group-addon">Search BY</span>
											<input class="form-control" type="text" name="entry" placeholder="Transfer code / Phone No / First Name, Last Name">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">	
										<strong>
												<label class="radio-inline">
													<input type="radio" name="option" value="pending" checked><strong>Pending</strong>
												</label>
												
												<label class="radio-inline">
													<input type="radio" name="option" value="PAID" ><strong>Paid</strong>
												</label>
												
												<label class="radio-inline">
													<input type="radio" name="option" value="today" ><strong>Today</strong>
												</label>
												
												<label class="radio-inline">
													<input type="radio" name="option" value="transferCode" ><strong>Transfer Code</strong>
												</label>				
												
												<label class="radio-inline">
													<input type="radio" name="option" value="cFirstLastName" ><strong>Sender Name</strong>
												</label>				
												
												<label class="radio-inline">
													<input type="radio" name="option" value="phoneNo" ><strong>Phone No</strong>
												</label>
												<label class="radio-inline">
													<input type="radio" name="option" value="date" ><strong>Date</strong>
												</label>
											</strong>
									</div>
								</div>
								<br/>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i> Date</span>
												<input class="form-control" type="text"  id="date1"  name="date1"  placeholder="FROM">
										</div>
									</div>
									
												<div class="col-md-6">
										<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i> Date</span>
												<input class="form-control" type="text"  id="date2"  name="date2" placeholder="TO">
										</div>
									</div>

									
								</div>
						</div>
						<div class="col-md-2"><br/><br/>
							<input id="button" type="submit" name="submit" value="submit" class="btn btn-primary btn-lg">
						</div>
					</div>
				
			</div>
<!--Search ends here---->

<!--Table Result---->
		<div class="row">
			
<!---member type navaigation -->	
				<?php 
						if(!isset($_GET['Id'])){
						include ('includes/navAC.php'); 
						}
				?>
				
				
					<h3>Transactions</h3>
			
				
					<table id="sort-table" class="table table-striped table-bordered tablesorter">
						<thead>
						<tr>
							<div id="centerit">
<!---Amendment -->											
										<td colspan="13"><button name="Pay" id="Pay" class="btn btn-info " ><i class="fa fa-money" aria-hidden="true"></i> PAY / DELETE / SUSPEND</button><strong> &nbsp; &nbsp; &nbsp; Please Check</strong></td>

							</div>
						</tr>
							<tr>
								<th><strong>No</strong></th>
								<th><strong>Pay / Del</strong></th>
								<th><strong>Date</strong></th>
								<th><strong>Tcode</strong></th>
								<th><strong>Sender</th>
								<th><strong>Receiver</strong></th>
								<th><strong>Amt</strong></th>
								<th><strong>Local</strong></th>
								<th><strong>Total</strong></th>
								<th><strong>Status</strong></th>
								<th><strong>Receipt</strong></th>
								<th><strong>Edit</strong></th>
								<th><strong>Note</strong></th>
								
							</tr>
						</thead>
						<tbody>
							<?php $x=0; 
						 $tamt_send=0;$tamt_local=0;$tcom_a=0;$tcom_d=0; $tTotal=0;
						 foreach($dataResult as $result): ?>
						<tr>
							<td><?php  echo $x=$x+1;?></td>
							<td ><input type="checkbox" name="check_list" id="check_list" value="<?php echo $result->id; ?>"> </td>
							<td><?php  echo $result->date;?></td>
							<td><?php  echo firstCap($result->receiptno);?></td>
							<td><?php  echo firstCap($result->sender_name);?></td>
							<td><?php  echo firstCap($result->r_name);?></td>
							<td><?php  echo number_format($result->amt_send, 2);?></td>
							<td><?php  echo number_format($result->amt_local, 2);?></td>							
							<td><?php  echo number_format($result->total,2);?></td>
							<td><?php  echo $result->status;?></td>
<!--Receipt---->
							
							<td><a href="../receipt.php?transId=<?php echo urlFormat($result->id); ?> & tableType=<?php echo urlFormat($table); ?>" class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i>Print</a></td>								
<!--ReEditceipt---->							
							<td> <a href="editTrans.php?transId=<?php echo urlFormat($result->id); ?>& tableType=<?php echo urlFormat($table); ?>" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a></td>
<!--Note---->
							<td><a href="note.php?transId=<?php echo urlFormat($result->id); ?> & tableType=<?php echo urlFormat($table); ?>" class="btn btn-<?php echo $val=$result->note==NULL?'default':'success';?>"><i class="fa fa-bell" aria-hidden="true"></i>Note</a></td>
<!--Delete---->							
							
						
							<?php
										$tamt_send=$tamt_send + $result->amt_send;
										$tamt_local=$tamt_local+ $result->amt_local;										
										$tTotal=$tTotal + $result->total;										
							?>		
							
						  </tr>
						  <?php endforeach; ?>
						</tbody>
							<tr>
<!--hidden table type---->
										<input name="table" id="table" value="<?php if(isset($tableGet)){echo $tableGet; } ?>"  type="hidden">
<!-----duplicate------------------------<td><div id="dup"></div > </td>--->
										<td colspan="6"><strong>Total</td>
											<td><strong>&pound;<?php echo number_format($tamt_send,2); ?></strong></td>
											<td><strong>&#8358;<?php echo number_format($tamt_local,2); ?></strong></td>											
											<td><strong>&pound;<?php echo number_format($tTotal,2); ?></strong></td>
										</strong>
							</tr>
							
					</table>
					<input name="send" id="send" class="btn btn-success" onchange='checkAll(this)' type="checkbox"> &nbsp;&nbsp;&nbsp;
<!---pagination footer -->
				<?php include("includes/paging_footer.php");?>
		</form>		
			
		</div>
</div>



<script>
var td=$('#check_list').val();
$(document).ready(function() {
      	
	$('#Pay').click(function() {
			
			var favorite = [];
	
				$.each($("input[name='check_list']:checked"), function(){            
					 favorite.push($(this).val());
				});
//stored tabe type(hidden input)
			var table=$('#table').val();
			var inputURL = favorite.join(",");
			var url = 'payStatus.php?TransId=';
	
//check if item is selected
	if(inputURL !==""){
			   window.location.href = url + inputURL + '& table=' + table;
			   return false;
		}
	
});
    });


$("button").clone().insertAfter("#dup:last");

</script>

<?php include ('includes/footer.php') ?>