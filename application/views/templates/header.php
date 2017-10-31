<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Pursa.co Investments</title>

    <script src="http://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
    <!-- Icons -->
    <link href="node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/jquery/jquery-ui.css" rel="stylesheet">  
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  <script>
	  $( function() {
		$( "#datepicker" ).datepicker({
        showButtonPanel: true
    });
	  } );
	  </script>

    <!-- Main styles for this application -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<!--	<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/css/styl.css">	-->
	</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <!--<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>-->
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

       <!-- <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Settings</a>
            </li>
        </ul>-->
        <ul class="nav navbar-nav ml-auto">
            <!--<li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
            </li>
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">admin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>
                    <div class="dropdown-header text-center">
                        <strong>Settings</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-secondary">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>-->
			<?php if($this->session->userdata('logged_in')) : ?>
				<li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>
			<?php endif ?> 
        </ul>
        <button class="navbar-toggler aside-menu-toggler" type="button">☰</button>

    </header>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
				<?php if($this->session->userdata('logged_in')) : ?>
                <?php if ($this->session->userdata('user_type') == 'client'): ?>

                  <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'displays/my_investments'; ?>">Dashboard</a></li>
                  
                <?php endif ?>  
				<?php if ($this->session->userdata('user_type') == 'superadmin' || $this->session->userdata('user_type') == 'admin'): ?>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="<?php echo base_url(); ?>displays/dashboard"><i class="icon-puzzle"></i> Dashboard</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="<?php echo base_url(); ?>displays/users"><i class="icon-star"></i> Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>users/register"><i class="icon-calculator"></i> Register New Client </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>displays/investmentReports"><i class="icon-calculator"></i> Investment Reports </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>displays/profitReports"><i class="icon-calculator"></i> Profit Reports </a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>investments/investment"><i class="icon-pie-chart"></i> Investments</a>
                    </li>-->
					<?php if ($this->session->userdata('user_type') == 'superadmin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>users/create"><i class="icon-pie-chart"></i> Create Admin User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>investments/editPackages"><i class="icon-pie-chart"></i> Edit Packages</a>
                    </li>
					<?php endif ?>
					
				<?php endif ?>
				<?php endif ?>

                </ul>
            </nav>
        </div>
	<main class="main">
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
	  </div>

	<div class="container-fluid">
	