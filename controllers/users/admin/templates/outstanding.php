<?php include 'includes/header.php'; ?>

<div class="col-md-9">

	<div class=" panel panel-default">
		<div class="panel-heading">
			<h3>Outstanding Payment</h3>
		</div>
<!--navigation--->
		<?php include 'includes/navAC.php'; ?>
		<div class="panel-body">
			<table id="sort-table" class="table table-striped table-bordered tablesorter">
			<thead>
				
					<tr>
								<th><strong>No</strong> </th>
								<th><strong>Name</strong> <i class=""></i></th>
								<th><strong>Outstanding</strong></th>
								<th colspan="3"><strong>Part Payment</strong></th>
									
					</tr>
				</thead>
				
				
					<tbody>
										<?php $avater="noavatar.jpg";$x=0; foreach($dataResult as $result): ?>
							<tr>
										<td>
											
											<img src="<?php echo BASE_URI; ?>img/agent/photo/<?php  echo $result->myPhoto_name!==NULL?$result->myPhoto_name:$avater;?>" width="25" height="25" alt="..." class="img-thumbnail">
											<?php echo $x=$x+1; ?>
										</td>
										
										<td> <?php echo ucfirst($result->fname). " " . ucfirst($result->mname)." ".ucfirst($result->lname);   ?></td>
<!----Total Outstanding---->										
										<td>
												<a href="memberPage.php?id=<?php echo $result->id; ?> &type=<?php echo $Ttype; ?>"><i class="fa fa-battery-full" aria-hidden="true"> </i> <?php echo number_format($result->outstanding,2); ?> </a> 																							
										</td>
<!----Part Pay---->											
										<td>
												<a href="partPaid.php?Id=<?php echo $result->id; ?> & type=<?php echo $Ttype; ?>"><i class="fa fa-battery-quarter" aria-hidden="true"> </i> <?php echo $part=$result->sta==""?'None':'£'.number_format($result->sta,2); ?> </a>																																	
										</td>
<!----clear---->											
										<td>
											<a href="clearTrans.php?opType=Pending && Id=<?php echo $result->id; ?> & type=<?php echo $Ttype; ?>"><i class="fa fa-money" aria-hidden="true"> </i> Clear <?php echo $result->noOutstand; ?> </a>
																																			
										</td>

										<input name="table" id="table" value="<?php if(isset($type)){echo $type; } ?>"  type="hidden">
									</tr>
									
										<?php endforeach; ?>
					
										
			</table>
			
			
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
			var url = 'clearTransConfirm.php?Id=';
	
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