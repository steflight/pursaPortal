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
                                <i class="fa fa-align-justify"></i> <h2><strong>Investments Statistics</strong></h2>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Total Invested</th>
                                            <th>Number</th>
                                            <th>Running</th>
                                            <th>Completed</th>
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
                                <i class="fa fa-align-justify"></i> <h2><strong>Profits Statistics</strong></h2>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Total Profits</th>
                                            <th>Pending</th>
                                            <th>Due</th>
                                            <th>Paid</th>
                                            <th>Next PayDay</th>
											<th>2nd Next PayDay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
										$totalProfits =  0;
										$profitsCount = 0;
										$profitsPaid = 0;
										$profitsDue = 0;
										$totaldate1 = 0;
										$totaldate2 = 0;
										$i = 0;
										$date1 = "";
										$date2 = "";

									 ?>
									<?php if ($profits === FALSE): ?>
										
										<h3>No Profits</h3>
									<?php else: ?>
									
									<?php foreach($profits as $profit) : ?>
                                        
										<?php 


											$totalProfits = $totalProfits + $profit['amount'];

											if($i == 0 && time()<$profit['datestamp']) {$date1 = $profit['datestamp']; $i++;}
											if($i != 0 && $date1 != $profit['datestamp'] && $date2 == "") {$date2 = $profit['datestamp'];}
											if($date1 == $profit['datestamp']) {$totaldate1 = $totaldate1 + $profit['amount'];}
											if($date2 == $profit['datestamp']) {$totaldate2 = $totaldate2 + $profit['amount'];}
											if ($profit['validity'] == 1) {
												// echo "test";
												$profitsCount = $profitsCount + $profit['amount'];
											}
											if ($profit['validity'] == 0) {
												// echo "test";
												$profitsPaid = $profitsPaid + $profit['amount'];
											}
											if ($profit['validity'] == -1) {
												// echo "test";
												$profitsDue = $profitsDue + $profit['amount'];
											}
											
										?>
                                            
									<?php endforeach; ?>

									<?php endif ?>
									<tr>
										
                                        <td><strong><?php echo number_format($totalProfits, 0, ',', ' ');  ?> F</strong></td>
                                        <td><strong><?php echo $profitsCount; ?></strong></td>
                                        <td><strong><?php echo $profitsDue; ?></strong></td>
                                        <td><strong><?php echo $profitsPaid; ?></strong></td>
										<td><strong><?php if($date1 != "") { ?><a href="<?php echo base_url().'displays/profitReports/'.date('d-m-Y', $date1); ?>"><?php echo date('d-m-Y', $date1); ?></a><?php } ?></strong></td>
										<td><strong><?php if($date2 != "") { ?><a href="<?php echo base_url().'displays/profitReports/'.date('d-m-Y', $date2); ?>"><?php echo date('d-m-Y', $date2); ?></a><?php } ?></strong></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
					</div>
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> <h2><strong>Packages Overview</strong></h2>
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
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Investments Reports
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
												<th>Contract Date</th>
												<th>Amount</th>
                                                <th>Package</th>
                                                <th>Duration</th>
                                                <th>Interest</th>
												<th>Monthly Dividend</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if ($investments === FALSE): ?>

											<h3>No Investments</h3>
										<?php else: ?>
											
										<?php foreach($investments as $investment) : 
											$client_info = $this->display_model->get_user($investment['client_id']); ?>
											<tr>
												<td><?php echo $client_info['name']; ?></td>
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
                                    <i class="fa fa-align-justify"></i> Profits Reports
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
												<th>Amount</th>
                                                <th>Duration</th>
                                                <th>Due Date</th>
												<th>Status</th>
												<th>VISA Card No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $total = 0; if ($profits === FALSE): ?>

											<h3>No PROFIT</h3>
										<?php else: ?>
											
										<?php foreach($profits as $profit) : 
											$client_info = $this->display_model->get_user($profit['client_id']); ?>
                                            <tr>
												<td><?php echo $client_info['name']; ?></td>
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
												<td><?php echo $client_info['visacard']; $total = $total + $profit['amount'];?></td>
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
					</div>
				</div>
						
					
