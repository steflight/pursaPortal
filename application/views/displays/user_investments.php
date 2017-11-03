			    <?php $user_info = $this->display_model->get_user($user);
				//echo $user_info['name'].' | '.$user_info['email'].' | '.$user_info['number'].' | '.$user_info['visacard'].' | ';
				
				?>	
				
				<div class="row"> 
					<div class="col-lg-6">
					<span class="user-info"><strong>Name: </strong><?php echo $user_info['name']; ?></span></br>
					<span class="user-info"><strong>Email:</strong> <?php echo $user_info['email']; ?></span></br>
					<span class="user-info"><strong>Phone Number:</strong> <?php echo $user_info['number']; ?></span></br>
					</div>
					<div class="col-lg-6">
					<span class="user-info"><strong>VISA CARD NUMBER:</strong> <?php echo $user_info['visacard']; ?></span></br>
					<?php if ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') { ?>
					<span class="user-info"><a class="btn btn-info" href="<?php echo base_url(); ?>investments/new_investment/<?php echo $user; ?>">New Investment</a></span>
					<?php } ?>				</div>
				</div>
							<div class="row">
								<div class="col-lg-12">
		                            <div class="card">
		                                <div class="card-header">
		                                    <i class="fa fa-align-justify"></i> <strong>Client Information</strong>
		                                </div>
		                                <div class="card-body">
		                                    <table class="table">
		                                        <thead>
		                                            <tr>
														<?php $profitsReceived = 0;
															$profitRunning = 0;
															$profitsDue = 0;
														?>
		                                                <?php
															if($profits){
																foreach($profits as $profit) :
																	if($profit['validity'] == 0) {$profitsReceived = $profitsReceived + $profit['amount'];}
																	if($profit['validity'] == 1) {$profitRunning = $profitRunning + $profit['amount'];}
																	if($profit['validity'] == -1) {$profitsDue = $profitsDue + $profit['amount'];}
																endforeach;
															}
														?>
														<th>Total Invested</th>
		                                                <th>Number of Packages</th>
		                                                <th>Profits Received</th>
		                                                <th>Profits Running</th>
														<th>Profits Due</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
												<?php 
													$totalInvestment =  0;
													$totalpackages = 0;

												 ?>
												<?php if ($investments === FALSE): ?>
													
													<h3>No Investments</h3>
												<?php else: ?>
												
												<?php foreach($investments as $investment) : ?>
		                                            
													<?php 
														$totalInvestment = $totalInvestment + $investment['amount'];
														$totalpackages++;
													?>
		                                                
												<?php endforeach; ?>

												<?php endif ?>
												<tr>
													
	                                                <td><strong><?php echo number_format($totalInvestment, 0, ',', ' ');  ?> F</strong></td>
	                                                <td><strong><?php echo $totalpackages; ?></strong></td>
													<td><strong><?php echo $profitsReceived; ?></strong></td>
													<td><strong><?php echo $profitRunning; ?></strong></td>
													<td><strong><?php echo $profitsDue; ?></strong></td>
	                                            </tr>
		                                        </tbody>
		                                    </table>

		                                </div>
		                            </div>
								</div>

							</div>
					<div class="row">
						<div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> <?php echo $user_info['name']; ?>'s Investments
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Contract Date</th>
												<th>Amount</th>
                                                <th>Package</th>
                                                <th>Duration</th>
                                                <th>Interest</th>
												<th>Monthly Dividend</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if ($investments === FALSE): ?>

											<h3>No Investments</h3>
										<?php else: ?>
											
										<?php foreach($investments as $investment) : ?>
                                            <tr>
                                                <td><strong><?php echo date( 'd-m-Y', strtotime($investment['starting_date']));  ?></strong></td>
												<td><strong><?php echo number_format($investment['amount'], 0, ',', ' ');  ?> F</strong></td>
                                                <td><strong><?php echo $investment['package_type'];  ?></strong></td>
                                                <td><strong><?php echo $investment['duration'].' Months';  ?></strong></td>
												<td><strong><?php echo $investment['interest'].'%';  ?></strong></td>
												<td><strong><?php echo (($investment['interest']*$investment['amount'])/100).' F';  ?></strong></td>
                                                <td>
												<?php if($investment['validity'] == 1) { ?>
                                                    <span class="badge badge-success">Active</span>
												<?php } else { ?>
													<span class="badge badge-warning">Pending</span>
												<?php } ?>
                                                </td>
                                            </tr>
										<?php endforeach; ?>
										<?php endif ?>
                                        </tbody>
                                    </table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> <?php echo $user_info['name']; ?>'s Profits
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Amount</th>
                                                <th>Duration</th>
                                                <th>Due Date</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $total = 0; if ($profits === FALSE): ?>

											<h3>No PROFIT</h3>
										<?php else: ?>
											
										<?php foreach($profits as $profit) : ?>
                                            <tr>
                                                <td><strong><?php echo number_format($profit['amount'], 0, ',', ' ');  ?> F</strong></td>
                                                <td><strong><?php echo $profit['duration'].' Ms';  ?></strong></td>
												<td><strong><?php echo date('d-m-Y', strtotime($profit['due_date']));  ?></strong></td>
                                                <td>
												<?php if(($profit['validity'] == 1) && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin')) { ?>
													<a href="<?php echo base_url(); ?>investments/paidprofit/<?php echo $profit['id'].'/'.$user; ?>"><span class="badge badge-warning">Pending</span></a>
												<?php } else if($profit['validity'] == 1) { ?>
													<span class="badge badge-warning">Pending</span>
												<?php } else if ($profit['validity'] == 0 && $this->session->userdata('user_type') == 'superadmin') { ?>
													<a href="<?php echo base_url(); ?>investments/unpaidprofit/<?php echo $profit['id'].'/'.$profit['client_id']; ?>"><span class="badge badge-success">Paid</span></a>
												<?php } else { ?>
													<span class="badge badge-success">Paid</span>
												<?php }  $total = $total + $profit['amount'];?>
                                                </td>
                                            </tr>
										<?php endforeach; ?>
										<?php endif ?>
                                        </tbody>
                                    </table>
									<span style="float: right"><strong>TOTAL: <?php echo number_format($total, 0, ',', ' ');; ?> FCFA</strong></span>

                                </div>
                            </div>
						</div>
					</div>

