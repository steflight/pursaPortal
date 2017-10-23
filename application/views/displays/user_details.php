<div class="col-md-6 col-md-offset-3">
	


	<h1 class="text-center"><?= $title;?></h1>
	

	<h2>Client Details</h2>
	<table class="table table-hover table-bordered">
 		<tr>
		  <td><strong>Name</strong></td>
		  <td><?php echo $this->session->userdata('name'); ?></td>
		</tr>

		<tr>
		  <td><strong>Number</strong></td>
		  <td><?php echo $this->session->userdata('number'); ?></td>
		</tr>
		<tr>
		  <td><strong>Email</strong></td>
		  <td><?php echo $this->session->userdata('email'); ?></td>
		</tr>
		
	</table>

	<h2>Investment Details</h2>
	<table class="table table-hover table-bordered">
 		<tr>
		  <td><strong>Issue Date</strong></td>
		  <td><?php  echo $this->session->userdata('client_issue_date'); ?></td>
		</tr>

		<tr>
		  <td><strong>Investment</strong></td>
		  <td><?php echo $this->session->userdata('client_amount'); ?> FCFA</td>
		</tr>

		<tr>
		  <td><strong>Package</strong></td>
		  <td><strong class="text-capitalize"><?php echo $this->session->userdata('client_package'); ?></strong></td>
		</tr>

		<tr>
		  <td><strong>Duration</strong></td>
		  <td><?php echo $this->session->userdata('client_duration'); ?> months</td>
		</tr>

		<tr>
		  <td><strong>Payout</strong></td>
		  <td><?php echo $this->session->userdata('client_payout'); ?></td>
		</tr>

		<tr>
		  <td><strong>Starting Date</strong></td>
		  <td><?php echo $this->session->userdata('client_start_date'); ?></td>
		</tr>

		<tr>
		  <td><strong>First Payout Date</strong></td>
		  <td><?php echo $this->session->userdata('client_first_payout'); ?></td>
		</tr>

		<tr>
		  <td><strong>Last Payout Date</strong></td>
		  <td><?php echo $this->session->userdata('client_last_payout'); ?></td>
		</tr>

	</table>


	<div class="col-md-4 col-md-offset-4">
		<a href="<?php echo base_url(); ?>" class="btn btn-block btn-primary">Back</a>
	</div>
</div>