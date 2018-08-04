<?php include('includes/header.php');?>
<div class="col-md-9">
	<div class="panel panel-default">
		<div class=" panel-headingt">
			<h3>Modify Status</h3>
		</div>
		<div class=" panel-body">
			<form name="form1" action ="" method="post">
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2" class="center">
					<strong style="color:#0000ff;">Modify to Activate, Suspend or Turn Staff into Manager(Admin Level 2)</strong>
				</div><br><br>
			</div>
<!--agent--->
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Agent </strong></span>
							
							<input type="text" name="no" value="<?php echo strtoupper($agent->fname." ". $agent->lname);?>" class="form-control" >
						</div>
					</div>
				</div>
	<br/>

<!--Agent %commission--->
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Select <strong style="color:red;">*</strong></strong></span>
							<select name="choice" class="form-control" >
								<option selected>ACTIVE</option>
								<option>SUSPENDED</option>
								<option>LIMIT</option>
<!---only for full package and agent-customer--->
							<?php if(binfo()['size']==3 || binfo()['size']==4): ?>
								<option>Admin Level 2</option>
							<?php endif; ?>
							</select>
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
