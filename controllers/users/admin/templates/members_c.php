<?php include 'includes/header.php'; ?>
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
								 url: "../quickSearch.php",
								 data: { adminSearchCust: request.term },
								 dataType: "json",
								 success: response,
								 error: function () {
									 response([]);
								 }
							 });
						 },
						 
					select: function( event, ui ) {
						var add="members.php?custUser=";		
					window.location.href = add+ui.item.value;
					}
    });
				
			});
		</script>

<div class="col-md-9">

	<div class=" panel panel-default">
		<div class="panel-heading">
			<h3>Members View</h3>
		</div>
		
		<div class="panel-body">
			<table id="sort-table" class="table table-striped table-bordered tablesorter">
			<thead>
					<tr>									
						<td colspan="3">
							<button name="send" id="send" class="btn btn-success " ><i class="fa fa-money" aria-hidden="true"></i> SMS / EMAIL</button>		
							<strong> &nbsp; &nbsp; &nbsp; Please Check</strong>	
						</td >
							<td colspan="3">
							<div class="ui-widget">
								<input type="text" id="search" class="form-control" placeholder="Enter Search" >
								</div>
							</td>
					</tr>
				
					<tr>
								<th>No </th>
								<th>Name <i class=""></i></th>
								<th colspan="4">General Quick View</th>
									
					</tr>
				</thead>
				
				
					<tbody>
										<?php $avater="noavatar.jpg";$x=0; foreach($dataResult as $result): ?>
							<tr>
										<td>
											<input type="checkbox" id="check_list" name="check_list" value="<?php echo $result->id; ?>">
											<img src="<?php echo BASE_URI; ?>img/agent/photo/<?php  echo $result->myPhoto_name!==NULL?$result->myPhoto_name:$avater;?>" width="25" height="25" alt="..." class="img-thumbnail">
											<?php echo $x=$x+1; ?>
										</td>
										
										<td> <?php echo ucfirst($result->fname). " " . ucfirst($result->mname)." ".ucfirst($result->lname);   ?></td>
<!----View Profile---->										
										<td>
												<a href="memberPage.php?id=<?php echo $result->id; ?> &type=<?php echo $type; ?>"><i class="fa fa-user" aria-hidden="true"> </i>View Profile </a> 																							
										</td>
<!----Customers---->											
										<td>
												<a href="memberCustomer.php?Id=<?php echo $result->id; ?> & type=<?php echo $type; ?>"><i class="fa fa-users" aria-hidden="true"> </i> Customers:<?php echo  $result->countId; ?> </a>																																	
										</td>
<!----Peniding Transaction---->											
										<td>
											<a href="previousTransaction.php?opType=Pending && Id=<?php echo $result->id; ?> & type=<?php echo $type; ?>"><i class="fa fa-money" aria-hidden="true"> </i> Pending:<?php echo  $result->transPending; ?> /  &#8358;<?php echo number_format($result->localPending,2); ?> </a>
																																			
										</td>
										
<!----Move To Agent---->						<td>
												<a href="moveCustomer.php?id=<?php echo $result->id; ?> "><i class="fa fa-truck" aria-hidden="true"> Move to Agent</i> </a>									
										</td>
										<input name="table" id="table" value="<?php if(isset($type)){echo $type; } ?>"  type="hidden">
									</tr>
									
										<?php endforeach; ?>
					
										
			</table>
			<input name="send" id="send" class="btn btn-success" onchange='checkAll(this)' type="checkbox"> &nbsp;&nbsp;&nbsp;
			
		</div>
	</div>
</div>
<script>
var td=$('#check_list').val();
$(document).ready(function() {
      	
	$('#send').click(function() {
			
			var favorite = [];
	
				$.each($("input[name='check_list']:checked"), function(){            
					 favorite.push($(this).val());
				});
//stored tabe type(hidden input)
			var table=$('#table').val();
			var inputURL = favorite.join(",");
			var url = 'message.php?Id=';
	
//check if item is selected
	if(inputURL !==""){
			   window.location.href = url + inputURL + '& table=' + table;
			   return false;
		}
	
});
    });


$("button").clone().insertAfter("#dup:last");

</script>

<?php include 'includes/footer.php'; ?>