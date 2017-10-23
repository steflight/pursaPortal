<?php if (validation_errors()): ?>
	<div class="alert alert-danger text-capitalize">
		<?php echo validation_errors(); ?>
	</div>
<?php endif ?>

<?php echo form_open('users/edit'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="title text-center"><?= $title; ?></h1>
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
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</div>
	</div>
<?php echo form_close(); ?>
