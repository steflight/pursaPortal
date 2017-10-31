				<div class="row">	
					<?php $i = 0; foreach($packages as $package) { 
						$i++;
						$interests = $this->investment_model->getinterests($package['id']); ?>	
						<div class="col-lg-6">
                            <div class="card">
								<form method="post" action="<?php echo base_url(); ?>investments/editPackages/<?php echo $package['id']; ?>">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> <?php echo $package['name']; ?>
                                </div>
                                <div class="card-body">
                                    Min. Amount: <input class="form-control" type="text" name="min" value="<?php echo $package['minimum_amount']; ?>"></br>
									<?php foreach($interests as $interest) { ?>
										<?php echo $interest['contract_duration']; ?> Months Percentage: <input class="form-control" type="text" name="<?php echo $interest['contract_duration']; ?>mths" value="<?php echo $interest['percentage']; ?>"></br>
									<?php } ?>
                                </div>
								<div class="card-footer">
									<button class="btn btn-sm btn-primary" type="submit">Save</button>
								</div>
								</form>
                            </div>
						</div>
						<?php if ($i == 2) { ?>
							</div><div class="row">
						<?php } ?>
					<?php } ?>
				</div>
