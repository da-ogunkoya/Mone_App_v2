<?php include("includes/header.php");?>

<div class="col-md-9">
		<!---pagination header -->
			<?php include("includes/paging_header.php");?>
				
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>RECENT ACTIVITIES</h2>			 
		</div>
		<div class="panel-body">
<!---member type navaigation -->	
			
			
			<table id="sort-table" class="table table-striped table-bordered tablesorter">
				<thead>
					 <tr>
								<th>No </th>
								<th>Date-Time <i class=""></i></th>
								<th>Name  </th>
								<th>Activities</th>	
								<th>Ref</th>
								<th>User</th>									
						</tr>
				</thead>
				
				<tbody>
					 <?php $x=0;
								 foreach($dataResult as $result): ?>
								 
									<tr>
										<td><?php  echo $x=$x+1;?></td>
										<td><?php  echo ($result->datetime);?></td>
										<td><?php echo strtoupper($result->name);?></td>
										<td><?php echo strtoupper($result->type);?></td>
										<td><?php echo strtoupper($result->nametype);?></td>
										<td><?php $type= ($result->level);
											switch($type){
												case 0:
												$type="agent";
												break;
												case 1:
												$type="admin";
												break;
												case 2:
												$type="admin";
												break;
												case 3:
												$type="Manager";
												break;
												case 4:
												$type="admin";
												break;
											}
											echo strtoupper($type);
										?></td>
										
									 </tr> 
									 
								<?php endforeach; ?>						
				</tbody>
			</table>
				<!---pagination footer -->
				<?php include("includes/paging_footer.php");?>
		</div>
	</div>
	<?php include('includes/footer.php'); ?>
</div>