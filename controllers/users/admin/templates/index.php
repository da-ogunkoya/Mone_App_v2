<?php include('includes/header.php'); ?>
<!----New Layout Starts here---col-md-9------------------------------------------------------------------>		
			<div class="col-md-9">
<!--Agent--------->
<?php if( (getUser()['level']=='1')||(getUser()['level']=='2')|| (getUser()['level']=='3') || (getUser()['level']=='4') ): ?>
				<div class="row">
					<div class="col-md-12">
						<div class="user_section">
					<br/>
							<span class="img_header"><img src="<?php echo BASE_URI; ?>/admin/templates/images/customer.png"></span><h4 class="text-center">AGENT</h4><br>
							<div class="row">
									<div class="col-md-6">
									
										<h5 class="total"><strong>Total</strong>:<?php echo $agent->countA; ?></h5>
										<h5 class="active"><strong>Active</strong>:<?php echo $agent->countActiveAgent; ?></h5>
										<h5 class="suspended"><strong>Suspended</strong>:<?php echo $agent->countSuspendAgent; ?></h5>
									</div>
									
									
									<div class="col-md-6">
										<h5 class="total"><strong>Pending Transaction</strong>:<?php  echo $agent->agentTransPending;?> / &#8358;<?php  echo number_format($agent->totalTrans,2);?> </h5>
										
										<h5 class="suspended"><strong>Suspended Transaction</strong>: <?php  echo $agent->countTranSuspend;?>/ &#8358;<?php  echo number_format($agent->transSuspend,2);?></h5>
										
										
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-7 col-md-offset-3">
										<div class="well">
												<ol>
												<strong>Recent</strong>:
													<?php foreach($recentAgent as $result): ?>
													<li><i class="fa fa-shopping-cart" aria-hidden="true"></i> 
													<strong><?php  echo $result->agent_name; ?></strong> Placed £<strong><?php  echo number_format($result->total,2); ?></strong>/ On  <strong><?php  echo $result->date; ?></strong>
													</li>
													<?php endforeach; ?>
									
												</ol>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
	<?php endif; ?>
<!--Customer--------->
	<?php if( (getUser()['level']=='2')|| (getUser()['level']=='3') || (getUser()['level']=='4') ): ?>
				<div class="row">
					<div class="col-md-12">
						<div class="user_section">
							<span class="img_header"><img src="<?php echo BASE_URI; ?>/admin/templates/images/agent.png"></span><h4 class="text-center">CUSTOMER</h4><br>
							<div class="row">
									<div class="col-md-6">
										<h5 class="total"><strong>Total</strong>:<?php echo $customer->countC ?></h5>
										<h5 class="active"><strong>Active</strong>:<?php echo $customer->countActiveCustomer ?></h5>
										<h5 class="suspended"><strong>Suspended</strong>:<?php echo $customer->countSuspendCustomer ?></h5>
									</div>
									
									
									<div class="col-md-6">
										<h5 class="total"><strong>Pending Transaction</strong>:<?php echo $customer->customerTransPending; ?> / &#8358;<?php echo number_format($customer->totalTrans,2); ?> </h5>
										
										<h5 class="suspended"><strong>Suspended Transaction</strong>:<?php echo $customer->countCustTranSuspend; ?>  / &#8358;<?php echo number_format($customer->custTransSuspend,2); ?></h5>																				
									</div>
								</div>
							<div class="row">
								<div class="col-md-7 col-md-offset-3">
								<div class="well">
									<strong>Recent</strong>:
									<ol>
											<?php foreach($recentCust as $resultC): ?>
										<li><i class="fa fa-shopping-cart" aria-hidden="true"></i> 
											<strong><?php  echo $resultC->sender_name; ?></strong> Placed £<strong><?php  echo number_format($resultC->total,2); ?></strong>/ On <strong><?php   echo $resultC->date; ?></strong>
										</li>
										<?php endforeach; ?>
										</ol>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>	
		<?php endif; ?>
<!--Manager--------->
<?php if(  (getUser()['level']=='3') || (getUser()['level']=='4') ): ?>
				<div class="row">
					<div class="col-md-12">
						<div class="user_section">
							<span class="img_header"><img src="<?php echo BASE_URI; ?>/admin/templates/images/debt.png"></span><h4 class="text-center">MANAGER</h4><br>
							<div class="row">
									<div class="col-md-6">
										<h5 class="total"><strong>Active</strong>:200</h5>
										<h5 class="active"><strong>Active</strong>:200</h5>
										<h5 class="suspended"><strong>Suspended</strong>:200</h5>
									</div>
									
									
									<div class="col-md-6">
										<h5 class="total"><strong>Pending Transaction</strong>:200 / &#8358;5000.00</h5>
										
										<h5 class="suspended"><strong>Suspended Transaction</strong>:3 / &#8358;2000.00</h5>
									</div>
								</div>
							</div>
						</div>
					</div>					
					
			<?php endif; ?>	
				</div>
				
	<?php include('includes/footer.php'); ?>