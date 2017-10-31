			    <?php //$client_info = $this->display_model->get_user($profit['client_id']);
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
                                    <i class="fa fa-align-justify"></i> Profits Reports
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
												<th>Amount</th>
                                                <th>Duration</th>
                                                <th>Date</th>
												<th>Status</th>
												<th>VISA Card No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if ($profits === FALSE): ?>

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
												<td><?php echo $client_info['visacard']; ?></td>
                                            </tr>
										<?php endforeach; ?>
										<?php endif ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
						</div>
					</div>
