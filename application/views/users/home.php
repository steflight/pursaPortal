
<h1 class="text-center text-capitalize">Welcome To Pursa <?php echo $this->session->userdata('user_type'); ?> </h1>
	
	<?php if(!$this->session->userdata('logged_in')) : ?>

		<h3 class="alert alert-info text-center"> You <strong>must</strong> login to gain your access limits.</h3>

    <?php endif; ?>

	<?php if($this->session->userdata('logged_in')) : ?>
			
		

		<h3 class="alert alert-info text-center text-capitalize">Welcome <strong><?php echo $this->session->userdata('name'); ?></strong></h3>
			
          <?php if($this->session->userdata('user_type') === "superadmin"): ?>
				<h4 class="text-center">
					
					Only the <strong>Super Admin Can See This</strong>

				</h4>
		  <?php endif; ?> 


		   <?php if($this->session->userdata('user_type') === "admin"): ?>
				<h4 class="text-center">
					
					Only the <strong>Admin Can See This</strong>

				</h4>
		  <?php endif; ?>

		   <?php if($this->session->userdata('user_type') === "client"): ?>
				<h4 class="text-center">
					
					Only the <strong>Client Can See This</strong>

				</h4>
		  <?php endif; ?> 

			

    <?php endif; ?>

		

		 