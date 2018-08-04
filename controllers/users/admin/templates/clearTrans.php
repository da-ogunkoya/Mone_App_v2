<?php include ('includes/header.php')?>
<div class="col-md-9">
<!---pagination header -->
			<?php include("includes/paging_header.php");?>
			
<!--Search Start here---->
			<div class="well well-default">
				<form name="form1" method="post" action="">
					<div class="row">
						<div class="col-md-10">																			
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
										<td colspan="13"><button name="Pay" id="Pay" class="btn btn-info " ><i class="fa fa-money" aria-hidden="true"></i> CLEAR</button><strong> &nbsp; &nbsp; &nbsp; Please Check</strong></td>

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
								<th><strong>Clear</strong></th>
								
								
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
<!--Clear---->
							
							<td><a href="clearTransConfirm.php?Id=<?php echo urlFormat($Id); ?> & transId=<?php echo urlFormat($result->id); ?> & type=<?php echo urlFormat($type); ?>" class="btn btn-info"><i class="fa fa-money" aria-hidden="true"></i>Clear</a></td>								

						
						
							<?php
										$tamt_send=$tamt_send + $result->amt_send;
										$tamt_local=$tamt_local+ $result->amt_local;										
										$tTotal=$tTotal + $result->total;										
							?>		
							
						  </tr>
						  <?php endforeach; ?>
						</tbody>
							<tr>
<!--table / type---->
										<input name="type" id="type" value="<?php if(isset($type)){echo $type; } ?>"  type="hidden">
										<input name="Id" id="Id" value="<?php if(isset($Id)){echo $Id; } ?>"  type="hidden">
										
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
			var Id=$('#Id').val();
			var type=$('#type').val();
			var inputURL = favorite.join(",");
			var url = 'clearTransConfirm.php?transId=';
	
//check if item is selected
	if(inputURL !==""){
			   window.location.href = url + inputURL + '& type=' + type + '& Id=' + Id;
			   return false;
		}
	
});
    });


$("button").clone().insertAfter("#dup:last");

</script>

<?php include ('includes/footer.php') ?>