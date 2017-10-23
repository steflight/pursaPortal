
<?php if (validation_errors()): ?>
	<div class="alert alert-danger text-capitalize">
		<?php echo validation_errors(); ?>
	</div>
<?php endif ?>

<!-- <h1 class="title text-center"><?= $title; ?></h1> -->
<h1 class="title text-center">Welcome <?php echo $this->session->userdata('client_name'); ?></h1>
<h1 class="title text-center"><?php echo $this->session->userdata('client_decoded'); ?></h1>

<?php echo form_open('confirmation/codex'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			
			<div class="form-group">
				<?php if($this->session->flashdata('code_input')): ?>
		        	<?php echo '<p class="alert alert-info text-capitalize">'.$this->session->flashdata('code_input').'</p>'; ?>
		      	<?php endif; ?>

		      	<?php if($this->session->flashdata('code_error')): ?>
		        	<?php echo '<p class="alert alert-danger text-capitalize">'.$this->session->flashdata('code_error').'</p>'; ?>
		      	<?php endif; ?>
				<label><h3>CODE</h3></label>
				<input type="text" class="form-control input-lg" name="code" placeholder="CODE">
			</div>

			

			
			<button type="submit" class="btn btn-primary btn-block">Validate</button>
		</div>
	</div>
<?php echo form_close(); ?>