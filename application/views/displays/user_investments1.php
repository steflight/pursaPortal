			    <?php $user_info = $this->display_model->get_user($user);
				echo $user_info['name'].' | '.$user_info['email'].' | '.$user_info['number'].' | '.$user_info['visacard'].' | ';
				
				?>
				<?php if ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') { ?>
				<a class="btn btn-info" href="<?php echo base_url(); ?>investments/new/<?php echo $user; ?>">New Investment</a>
				<?php } ?>


				<?php if ($investments === FALSE): ?>

					<h3>No Investments</h3>
				<?php else: ?>
					
				<?php foreach($investments as $investment) : ?>

						<div class="row">
							<div class="well alert-info">
								
							    <h4>Amount: <strong><?php echo $investment['amount'];  ?> FCFA</strong></h4>

							    <p class="text-capitalize">Package: <strong><?php echo $investment['package_type'];  ?></strong></p>
								<p class="text-capitalize">Duration: <strong><?php echo $investment['duration'].' Months';  ?></strong></p>
							    


								    	
								

							    <p> Validity: 
							    	<strong>

							    		<?php 
							    		if ($investment['validity'] == 1) {
							    		
								    		echo "Active";

								    	} else{

								    		echo "Not Active";

								    	}
								    	
								    	?>
								    		
								    </strong>
								</p>

								<!--<a class="btn btn-info" href="<?php //echo base_url(); ?>investments/topup/<?php //echo $investment['id']; ?>">TopUp Investment</a>-->
								

							</div>
						</div>
				<?php endforeach; ?>

				<?php endif ?>
				
				PROFITS OF THE CLIENT
				
				<?php if ($profits === FALSE): ?>

					<h3>No Profits</h3>
				<?php else: ?>
					
				<?php foreach($profits as $profit) : ?>

						<div class="row">
							<div class="well alert-info">
								
							    <h4>Amount: <strong><?php echo $profit['amount'];  ?> FCFA</strong></h4>

							    <p class="text-capitalize">Due Date <strong><?php echo $profit['due_date'];  ?></strong></p>

							    


								    	
								

							    <p> Status: 
							    	<strong>

							    		<?php 
							    		if ($profit['validity'] == 1) {
							    		
								    		echo "Pending Payment";

								    	} else{

								    		echo "Paid";

								    	}
								    	
								    	?>
								    		
								    </strong>
								</p>
								<?php if (($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') && $profit['validity'] == 1 ) { ?>
								<a class="btn btn-info" href="<?php echo base_url(); ?>investments/paidprofit/<?php echo $profit['id'].'/'.$user; ?>">Mark as Paid</a>
								<?php } ?>

							</div>
						</div>
				<?php endforeach; ?>

				<?php endif ?>
