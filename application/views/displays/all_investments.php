			    <?php //$user_info = $this->display_model->get_user($user);
				//echo $user_info['name'].' | '.$user_info['email'].' | '.$user_info['number'].' | '.$user_info['visacard'].' | ';
				
				?>	
				<!--div class="row"> 
				<div class="col-lg-6">
				<span class="user-info"><strong>Name: </strong><?php //echo $user_info['name']; ?></span></br>
				<span class="user-info"><strong>Email:</strong> <?php //echo $user_info['email']; ?></span></br>
				<span class="user-info"><strong>Phone Number:</strong> <?php //echo $user_info['number']; ?></span></br>
				</div>
				<div class="col-lg-6">
				<span class="user-info"><strong>VISA CARD NUMBER:</strong> <?php //echo $user_info['visacard']; ?></span></br>
				<?php //if ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') { ?>
				<span class="user-info"><a class="btn btn-info" href="<?php //echo base_url(); ?>investments/new/<?php //echo $user; ?>">New Investment</a></span>
				<?php //} ?>				</div>

			</div-->
					
				<div class="row">
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> <h2><strong>Grand Investments Statistics</strong></h2>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Grand Investment</th>
                                            <th>Investments Count</th>
                                            <th>Investments Pending </th>
                                            <th>Investments Completed</th>
                                            <!-- <th>Date</th> -->
											<!-- <th>Status</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
										$totalInvestment =  0;
										$investmentcount = 0;
										$investmentsCompleted = 0;
										$investmentsPending = 0;

									 ?>
									<?php if ($investments === FALSE): ?>
										
										<h3>No Investments</h3>
									<?php else: ?>
									
									<?php foreach($investments as $investment) : ?>
                                        
										<?php 


											$totalInvestment = $totalInvestment + $investment['amount'];

											if ($investment['validity'] === FALSE) {

												$investmentsCompleted++;
											}

											$investmentcount++;
											$investmentsPending = $investmentcount - $investmentsCompleted;
										?>
                                            
									<?php endforeach; ?>

									<?php endif ?>
									<tr>
										
                                        <td><strong><?php echo number_format($totalInvestment, 0, ',', ' ');  ?> F</strong></td>
                                        <td><strong><?php echo $investmentcount; ?></strong></td>
                                        <td><strong><?php echo $investmentsPending; ?></strong></td>
                                        <td><strong><?php echo $investmentsCompleted; ?></strong></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
					</div>
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> <h2><strong>Grand Profits Statistics</strong></h2>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Grand Profits</th>
                                            <th>Profits Count</th>
                                            <th>Profits Due</th>
                                            <th>Profits Paid</th>
                                            <!-- <th>Date</th> -->
											<!-- <th>Status</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
										$totalProfits =  0;
										$profitsCount = 0;
										$profitsPaid = 0;
										$profitsDue = 0;

									 ?>
									<?php if ($profits === FALSE): ?>
										
										<h3>No Profits</h3>
									<?php else: ?>
									
									<?php foreach($profits as $profit) : ?>
                                        
										<?php 


											$totalProfits = $totalProfits + $profit['amount'];

											if (!$profit['validity']) {
												// echo "test";
												$profitsPaid++;
											}

											$profitsCount++;
											$profitsDue = $profitsCount - $profitsPaid;
										?>
                                            
									<?php endforeach; ?>

									<?php endif ?>
									<tr>
										
                                        <td><strong><?php echo number_format($totalProfits, 0, ',', ' ');  ?> F</strong></td>
                                        <td><strong><?php echo $profitsCount; ?></strong></td>
                                        <td><strong><?php echo $profitsDue; ?></strong></td>
                                        <td><strong><?php echo $profitsPaid; ?></strong></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
					</div>
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> <h2><strong>Grand Package Overview</strong></h2>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Premium</th>
                                            <th>Business</th>
                                            <th>Starter </th>
                                            <!-- <th>Investments Completed</th> -->
                                            <!-- <th>Date</th> -->
											<!-- <th>Status</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
										$premium =  0;
										$business = 0;
										$starter = 0;
										// $investmentsPending = 0;

									 ?>
									<?php if ($investments === FALSE): ?>
										
										<h3>No Packages to show</h3>
									<?php else: ?>
									
									<?php foreach($investments as $investment) : ?>
                                        
										<?php 


											$totalInvestment = $totalInvestment + $investment['amount'];

											if ($investment['package_type'] == 'premium') {

												$premium++;
											} elseif ($investment['package_type'] == 'business') {
												
												$business++;
											} else{

												$starter++;
											}

											
										?>
                                            
									<?php endforeach; ?>

									<?php endif ?>
									<tr>
										
                                        <!-- <td><strong><?php echo number_format($totalInvestment, 0, ',', ' ');  ?> F</strong></td> -->
                                        <td><strong><?php echo $premium; ?></strong></td>
                                        <td><strong><?php echo $business; ?></strong></td>
                                        <td><strong><?php echo $starter; ?></strong></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> Investments Reports
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Package</th>
                                            <th>Duration</th>
                                            <th>Date</th>
											<th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if ($investments === FALSE): ?>

										<h3>No Investments</h3>
									<?php else: ?>
										
									<?php foreach($investments as $investment) : ?>
                                        <tr>
                                            <td><strong><?php echo number_format($investment['amount'], 0, ',', ' ');  ?> F</strong></td>
                                            <td><strong><?php echo $investment['package_type'];  ?></strong></td>
                                            <td><strong><?php echo $investment['duration'].' Ms';  ?></strong></td>
											<td><strong><?php echo date( 'd-m-Y', strtotime($investment['starting_date']));  ?></strong></td>
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

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> Profits Reports
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Duration</th>
                                            <th>Date</th>
											<th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if ($profits === FALSE): ?>

										<h3>No PROFIT</h3>
									<?php else: ?>
										
									<?php foreach($profits as $profit) : ?>
                                        <tr>
                                            <td><strong><?php echo number_format($profit['amount'], 0, ',', ' ');  ?> F</strong></td>
                                            <td><strong><?php echo $profit['duration'].' Ms';  ?></strong></td>
											<td><strong><?php echo date('d-m-Y', strtotime($profit['due_date']));  ?></strong></td>
                                            <td>
											<?php if(($profit['validity'] == 1) && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin')) { ?>
												<a href="<?php echo base_url(); ?>investments/paidprofit/<?php echo $profit['id'].'/'.$profit['client_id']; ?>"><span class="badge badge-warning">Pending</span></a>
											<?php } else if($profit['validity'] == 1) { ?>
												<span class="badge badge-warning">Pending</span>
											<?php } else if ($profit['validity'] == 0 && $this->session->userdata('user_type') == 'superadmin') { ?>
												<a href="<?php echo base_url(); ?>investments/unpaidprofit/<?php echo $profit['id'].'/'.$profit['client_id']; ?>"><span class="badge badge-success">Paid</span></a>
											<?php } else { ?>
												<span class="badge badge-success">Paid</span>
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
						
					
