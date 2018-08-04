
<?php include('includes/header.php'); ?>
			
				
					 
			

 <div class="col-md-9">
	<div class="panel-border">
	<br/>
		 <div class="panel panel-default">
			
			
				<div class="panel-heading">
						<h4>Edit Profile</h4>
				</div>
			<form name=form1  enctype="multipart/form-data" method="POST" action="#">
				<div class="panel-body">
					<div class="container">
						<?php foreach($result as $result):?>
						<div class="row">
							<div class="col-md-4">
								<div class="input-group input-group-sm">
									<span class="input-group-addon">First Name</span>
									<input class="form-control" type="text" name="fName"  value="<?php  echo ucfirst($result->fname);?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group form-group-sm">
									<span class="input-group-addon">Last  Name</span>
									<input class="form-control" type="text" name="lName"  value="<?php  echo ucfirst($result->lname);?>">
								</div>
							</div>
						</div>
						<br/>
							<div class="row">
								<div class="col-md-5 col-md-offset-1">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Address</span>
										<input class="form-control" type="text" name="address"  value="<?php  echo ucfirst($result->address);?>">
									</div>
								</div>

						</div>
							<br/>
							<div class="row">
								<div class="col-md-4">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Street</span>
										<input class="form-control" type="text" name="street"  value="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Town</span>
										<input class="form-control" type="text" name="town"  value="<?php  echo ucfirst($result->town);?>">
									</div>
								</div>
						</div>
						<br/>
							<div class="row">
								<div class="col-md-4">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Country</span>
										<input class="form-control" type="text" name="country"  value="<?php  echo ucfirst($result->country);?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group form-group-sm">
										<span class="input-group-addon" >PostCode</span>
										<input class="form-control" type="text" name="postcode"  value="<?php  echo ucfirst($result->postcode);?>">
									</div>
								</div>
						</div>
						<br/>
							<div class="row">
								<div class="col-md-4">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Contact No</span>
										<input class="form-control" type="text" name="contact"  value="<?php  echo ucfirst($result->pnumber);?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Mobile No</span>
										<input class="form-control" type="text" name="mobile"  value="<?php  echo ucfirst($result->mnumber);?>">
									</div>
								</div>
						</div>
						<br/>
						<div class="row">
								<div class="col-md-5 col-md-offset-1">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Email</span>
										<input class="form-control" type="text" name="email"  value="<?php  echo ucfirst($result->email);?>">
									</div>
								</div>

						</div>
						<br/>
						<?php endforeach; ?>
						
							<div class="row">
								<div class="col-md-5 col-md-offset-1">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">My Photo</span>
										<input  type="file" class="btn btn-default" name="myPhoto">
									</div>
								</div>
								
								<div class="col-md-2 col-md-offset-1">
									<img src="<?php echo BASE_URI; ?>img/<?php  echo $type;?>/photo/<?php  echo $result->myPhoto_name;?>" width="50" height="50" alt="..." class="img-thumbnail">
								</div>

						</div>
						<br/>
						<div class="row">
								<div class="col-md-5 col-md-offset-1">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Upload ID</span>
										<input  type="file" class="btn btn-default" name="imageId">
									</div>
								</div>
								<div class="col-md-2 col-md-offset-1">
									<img src="<?php echo BASE_URI; ?>img/<?php  echo $type;?>/id/<?php  echo $result->proofid_name;?>" width="50" height="50" alt="..." class="img-thumbnail">
								</div>

						</div>
						<br/>
						<div class="row">
								<div class="col-md-5 col-md-offset-1">
									<div class="input-group form-group-sm">
										<span class="input-group-addon">Proof Of Address</span>
										<input  type="file" class="btn btn-default" name="imageAdd">
									</div>
								</div>
								
								<div class="col-md-2 col-md-offset-1">
									<img src="<?php echo BASE_URI; ?>img/<?php  echo $type;?>/address/<?php  echo $result->proofad_name;?>" width="50" height="50" alt="..." class="img-thumbnail">
								</div>

						</div>
						<br/>
						<div class="row">
								<div class="col-md-3 col-md-offset-4">
									<div class="form-group form-group-sm">
										
										<input class="btn btn-primary" type="submit" name="submit">
									</div>
								</div>
			</form>
						</div>
				</div>
			</div>
			</div>
		  
	</div>	  
 </div>