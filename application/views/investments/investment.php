
<?php if (validation_errors()): ?>
	<div class="alert alert-danger text-capitalize">
		<?php echo validation_errors(); ?>
	</div>
<?php endif ?>

<?php echo form_open('investments/investment'); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Register a New Investment</strong>
                                    <small>Form</small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
											<div class="form-group">
												<!-- <h3>Deposite</h3> -->
												<label>Invested Amount:</label>
												<input type="number" class="form-control" name="amount" placeholder="Number">
											</div>
											<div class="form-group">
											  <label for="payout-timeframe">Payouts:</label>
											  <select class="form-control" name="payout" id="payout-timeframe">
												<option value="monthly">Monthly</option>
											  </select>
											</div>
											<div class="form-group">
											  <label for="contract-timeframe">Contract Duration:</label>
											  <select class="form-control" name="duration" id="contract-timeframe">
												<option> </option>
												<option value="0">Starter</option>
												<option value="3">3 Months</option>
												<option value="6">6 Months</option>
												<option value="12">12 Months</option>
											  </select>
											</div>
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