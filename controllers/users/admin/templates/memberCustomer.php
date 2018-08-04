<?php include "includes/header.php";?>

  	<style>
  .ui-autocomplete {
			max-height: 200px;
			overflow-y: auto;
			overflow-x: hidden;
		  }
		  
 * html .ui-autocomplete {
			height: 100px;
		  }
 </style>
  
	 		<script>
			$(function(){
				
				 $( "#search" ).autocomplete({	
				 	max:10,
					
					//source:sr,
					//position: { of:"menu",  my : "right top", at: "right bottom" },
						 source: function (request, response) {
							 $.ajax({
								 url: "../quickSearch.php?",
								 data: { adminAgentCust: request.term },
								 dataType: "json",
								 success: response,
								 error: function () {
									 response([]);
								 }
							 });
						 }, 
						 
					select: function( event, ui ) {
						var add="memberCustomer.php?agentCust=";		
					window.location.href = add+ui.item.value;
					}
    });
				
			});
		</script>

<div class="col-md-9">
	<!---pagination header -->
			<?php include("includes/paging_header.php");?>
	<div class="panel panel-default">
		<div class="panel-heading">
		<div class="row">
				<div class="col-md-7">
					<h3>Customer List For </h3>
				</div>
				<div class="col-md-5">
					<div class="ui-widget">
						<input type="text" id="search" class="form-control" placeholder="Enter Search" style="margin-top:12px" >
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<table id="sort-table" class="table table-striped table-bordered tablesorter">
			
				<thead>
					<tr>
						<strong>
							<th><strong>id</strong></strong></th>
							<th><strong>Customer></strong></th>
							<th><strong>Phones</strong></th>
							<th><strong>Registed</strong></th>
							<th><strong>Address</strong></th>
							<th><strong>Delete</strong></th>
							<th><strong>Modify</strong></th></strong>
						</strong>
					</tr>					
				</thead>
				<tbody>
				 <?php $x=0;
								 foreach($dataResult as $result): ?>
								 
									<tr>
										<td><?php  echo $x=$x+1;?></td>
										<td><?php  echo ucfirst($result->fname). " " .ucfirst($result->lname);?></td>
										<td><?php   echo ucfirst($result->pnumber). " / " .ucfirst($result->mnumber);?></td>
										<td><?php   echo ucfirst($result->date_reg);?></td>
										<td><?php   echo ucfirst($result->address);?></td>
										<td><a class="btn btn-danger" href="delete.php?id=<?php echo $result->id; ?>&type=ac"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></td>
										<td><a class="btn btn-success"href="acModify.php?id=<?php echo $result->id; ?>&type=ac"><i class="fa fa-pencil" aria-hidden="true"></i>Modify</a></td>
									 </tr> 
									 
								<?php endforeach; ?>		
				</tbody>
			
			</table>
		</div>
	</div>
		<!---pagination header -->
			<?php include("includes/paging_footer.php");?>

</div>

<?php include "includes/footer.php";?>