
<?php if (validation_errors()): ?>
	<div class="alert alert-danger text-capitalize">
		<?php echo validation_errors(); ?>
	</div>
<?php endif ?>

<h1 class="title text-center"><?= $title; ?></h1>

<?php echo form_open('investments/new_investment'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			

			<div class="form-group">
				<!-- <h3>Deposite</h3> -->
				<label>Deposite Amount:</label>
				<input type="number" class="form-control" name="amount" placeholder="Number">
			</div>

			<div class="form-group">
			  <label for="payout-timeframe">Payouts:</label>
			  <select class="form-control" name="payout" id="payout-timeframe">
			    <option> </option>
			    <option value="weekly">Weekly</option>
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

			
			<button type="submit" class="btn btn-primary btn-block">Next</button>
		</div>
	</div>
<?php echo form_close(); ?>