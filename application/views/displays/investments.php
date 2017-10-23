<div class="col-md-8 col-md-offset-2">
	<h1><?= $title;?></h1>
	
	<?php foreach($investmens as $investment) : ?>
		<div class="row">
			<div class="well">
				
			    <h3>Amount: <?php echo $investment['amount'];  ?></h3>

			    <p>Package: <?php echo $investment['package_type'];  ?></p>

			    <p> Validity: <?php 
			    	if ($investment['validity'] === TRUE) {
			    		
			    		echo "TRUE";

			    	} else{

			    		echo "FALSE";

			    	}
			    	
			    	?></p>

				<a class="btn btn-info" href="<?php echo base_url(); ?>investments/topup/<?php echo $investment['id']; ?>">Edit Investment</a>
				<a class="btn btn-info" href="<?php echo base_url(); ?>investments/new/<?php echo $investment['id']; ?>">New Investment</a>

			</div>
		</div>

	<?php endforeach; ?>
	
</div>