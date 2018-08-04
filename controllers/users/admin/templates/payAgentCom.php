<?php include('includes/header.php');?>
<div class="col-md-9">
	<div class="panel panel-default">
		<div class=" panel-headingt">
			<h3>Commission Payment</h3>
		</div>
		<div class=" panel-body">
			<form name="form1" action ="" method="post">
<!--No of transaction--->
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Agent</strong></span>
							<input type="text" name="no" value="<?php echo strtoupper($agent->fname." ". $agent->lname);?>" class="form-control" >
						</div>
					</div>
				</div>
	<br/>
<!--items--->
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Items</strong></span>
							<textarea name="no" rows="4"  class="form-control" ><?php foreach($receipt as $receipt){ echo $receipt->receiptno.", ";}?></textarea>
						</div>
					</div>
				</div>
<br/>
<!--Total--->
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Total</strong></span>
							<input type="text" name="no" value="<?php foreach($total as $total){echo number_format($total->payCom,2);}?>" class="form-control" >
						</div>
					</div>
				</div>
	<br/>
<!--Administrative Confirmation--->
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3>Administrative Confirmation</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-6 col-md-offset-3">
								<div class="input-group input-group-md">
											<span class="input-group input-group-addon">
											Password
											</span>
											<input name="password" 	 class="form-control" type="password"	 >
										</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 col-md-offset-5">
					<input type="submit" name="submit" class="btn btn-primary btn-lg">
				</div>
			</div>
			</form>
		</div>
	</div>
</div>


<?php include('includes/footer.php');?>
