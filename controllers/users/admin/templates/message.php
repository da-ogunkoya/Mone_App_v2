<?php include('includes/header.php');?>
<div class="col-md-9">
	<div class="panel panel-default">
		<div class=" panel-headingt">
			<h3>Send SMS / Email</h3>
		</div>
		<div class=" panel-body">
			<form name="form1" action ="" method="post">
<!--option--->
			<div class="row">
				<div class="col-md-5 col-md-offset-3">
					<label class="radio-inline">	
						<input type="radio" name="choice" value="email" checked  >
						EMAIL
					<label>	
					<label class="radio-inline">	
						<input type="radio" name="choice" value="sms"  >
						SMS
					<label>	
					
				</div>
	<br/><br/>
<!--Title--->
			<div class="row">
				<div class="col-md-9 col-md-offset-1">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Title</strong></span>
							<input type="text" name="title" value="" class="form-control" >
						</div>
					</div>
				</div>
	<br/>
<!--Sender--->
		<div class="row">
				<div class="col-md-9 col-md-offset-1">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Sender</strong></span>
							<input type="text" name="sender" value="<?php foreach($result as $result){echo ($result).";";}?>" class="form-control" >
						</div>
					</div>
				</div>
<br/>
<!--Message body--->
				<div class="row">
				<div class="col-md-10 col-md-offset-1">
						<div class="input-group input-group-md">
							<span class="input-group input-group-addon"><strong>Message</strong></span>
							<textarea name="message" rows="7"  col="8" class="form-control" ></textarea>
						</div>
					</div>
				</div>
	<br/>


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
