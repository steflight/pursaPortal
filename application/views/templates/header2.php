<html>
	<head>
		<title>Pursa</title>
		<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="http://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
	</head>
	<body>
	<nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Pursa</a>
        </div>
        <div id="navbar">
          
          <ul class="nav navbar-nav navbar-right">

          <?php if(!$this->session->userdata('logged_in')) : ?>

            <li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
            
          <?php endif; ?>

          <?php if($this->session->userdata('logged_in')) : ?>
                <?php if ($this->session->userdata('user_type') == 'client'): ?>

                  <li><a href="<?php echo base_url().'displays/my_investments'; ?>">Details</a></li>
                  
                <?php endif ?>
            <?php if ($this->session->userdata('user_type') == 'superadmin' || $this->session->userdata('user_type') == 'admin'): ?>
                <li><a href="<?php echo base_url(); ?>displays">Details</a></li>
                <li><a href="<?php echo base_url(); ?>displays/users">Add Investment</a></li>
                <li><a href="<?php echo base_url(); ?>users/register">Register Client</a></li>
                <li><a href="<?php echo base_url(); ?>investments/investment">Investment</a></li>
              <?php if ($this->session->userdata('user_type') == 'superadmin'): ?>

                <li><a href="<?php echo base_url(); ?>users/create">Create User</a></li>
                
              <?php endif ?>
              
            <?php endif ?>
                <li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>

          <?php endif; ?>

          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <!-- Flash messages -->
      <?php if($this->session->flashdata('user_registered')): ?>
        <?php echo '<p class="alert alert-success text-capitalize">'.$this->session->flashdata('user_registered').'</p>'; ?>
      <?php endif; ?>

       <?php if($this->session->flashdata('code_check')): ?>
        <?php echo '<p class="alert alert-info text-capitalize">'.$this->session->flashdata('code_check').'</p>'; ?>
      <?php endif; ?>

       <?php if($this->session->flashdata('amount_error')): ?>
        <?php echo '<p class="alert alert-danger text-capitalize">'.$this->session->flashdata('amount_error').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_invalid_details')): ?>
        <?php echo '<p class="alert alert-danger text-capitalize">'.$this->session->flashdata('user_invalid_details').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('login_failed')): ?>
        <?php echo '<p class="alert alert-danger text-capitalize">'.$this->session->flashdata('login_failed').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_loggedin')): ?>
        <?php echo '<p class="alert alert-success text-capitalize">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
      <?php endif; ?>

       <?php if($this->session->flashdata('user_loggedout')): ?>
        <?php echo '<p class="alert alert-success text-capitalize">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
      <?php endif; ?>
