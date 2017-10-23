<?php if (validation_errors()): ?>
	<div class="alert alert-danger text-capitalize">
		<?php echo validation_errors(); ?>
	</div>
<?php endif ?>

<?php echo form_open('confirmation/create_password'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="title text-center"><?= $title; ?></h1>
			
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" class="form-control" name="password2" placeholder="Confirm Password">
			</div>
			
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</div>
	</div>
<?php echo form_close(); ?>
