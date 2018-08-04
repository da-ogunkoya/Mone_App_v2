			<ol class="breadcrumb">
					<div class="linkhead">
						<div class="row">
							<div class="col-md-10 col-md-offset-2">
							<?php 
							$filem =url();
								$file2 = substr($filem, ($pos = strpos($filem, '?')) !== false ? $pos + 0 : 0);
								$file=str_replace($file2, '', $filem);
								$file = basename($file);
								$underline=isset($_GET['type'])?'underline':"";
								$type=isset($_GET['type'])?$_GET['type']:"";
							?>
<!--for customer,agent-customer,full-package------>
							 <?php if((binfo()['size']=='1')|| (binfo()['size']=='3') || (binfo()['size']=='4') ): ?>
								<li><a href="<?php echo $file; ?>?type=c" class="btn btn-primary <?php if($type=="c"){echo $underline;} ?> ">For <span class="shadow">Customers</span></a></li>
							<?php endif; ?>

							<!--for agent,agent-customer,full-package------>							
							 <?php if((binfo()['size']=='2')|| (binfo()['size']=='3') || (binfo()['size']=='4') ): ?>
								<li><a href="<?php echo $file; ?>?type=a" class="btn btn-primary <?php if($type=="a" || !isset($_GET['type'])){echo "underline";} ?>"> For <span class="shadow">Agents</span></a></li>
							<?php endif; ?>
								
							</div>
						</div>
					</div>
			</ol>