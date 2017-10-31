<?php if (validation_errors()): ?>
	<div class="alert alert-danger text-capitalize">
		<?php echo validation_errors(); ?>
	</div>
<?php endif ?>

<?php echo form_open('users/register'); ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Register New Investor</strong>
                                    <small>Form</small>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-12">

											<div class="form-group">
												<label>Name</label>
												<input type="text" class="form-control" name="name" placeholder="Name">
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" class="form-control" name="email" placeholder="Email">
											</div>
											<div class="form-group">
												<label>Phone</label>
												<input type="number" class="form-control" name="number" placeholder="Number">
											</div>
											<div class="form-group">
												<label>Username</label>
												<input type="text" class="form-control" name="username" placeholder="Username">
											</div>
											
											<div class="form-group">
												<label>VISA Card Number</label>
												<input type="text" class="form-control" name="visacard" placeholder="Visa Card Number">
											</div>
											<?php if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin' )): ?>
												<div class="form-group">
													<div class="radio">
													  <label>
														<input type="radio" name="user_type" id="user" value="client" checked>
														Register Client account
													  </label>
													</div>
									
												</div>
											<?php endif ?>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
								</div>

							</div>
						</div>
					</div>
<?php echo form_close(); ?>
