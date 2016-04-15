<?php include "templates/includes/header.php" ?>

<div class="container-fluid">
		<div class="row">
			<a href="#learn-anchor">
				<div class="col-md-4 three" id="learn">
					<h3>Learn</h3>
					<p>start with the basics</p>
				</div>
			</a>

			<a href="#practice-anchor">
				<div class="col-md-4 three" id="practice">
					<h3>Practice</h3>
					<p>as much as you possibly can</p>
				</div>
			</a>
			
			<a href="#else-anchor">
				<div class="col-md-4 three" id="else">
					<h3>. . . and everything else</h3>
					<p>check out this other cool stuff</p>
				</div>
			</a>
		</div>



		<div id="main-learn">
	  		<a name="learn-anchor"></a>
			<div class="row">
		  		<div class="col-md-12 main-text">
		  			<h2>Learn</h2>
		  			<h3><b>Get started today</b></h3>
		  		</div>
		  	</div>

		  	<div class="row">
				<?php 
				foreach ( $results['learn'] as $learnTile ) { ?>
								<div class="col-md-3 col-xs-6 featured">
								    <a href=".?action=viewResource&amp;resourceId= <?php echo($learnTile->id)?> ">
								        <img src="https://cdn-images-1.medium.com/max/2000/1*eAkVW2LFAd9pKdL-8hBQ1A.png" class="thumbnail img-responsive">
								    </a>
					  			</div>
				<?php } ?>
			</div>
			<div class="row">
	  			<div class= "col-md-12 see-all">
	  				<a href="./?action=seeAll"><button class="btn btn-primary">See All </button></a>
	  			</div>
	  		</div>
	  	</div>

	  	<div id="main-practice">
	  		<a name="practice-anchor"></a>
			<div class="row">
		  		<div class="col-md-12 main-text">
		  			<h2>Practice</h2>
		  			<h3>you just have to do it</h3>
		  		</div>
		  	</div>
		  	
		  	<div class="row">
		  		<?php 
				foreach ( $results['practice'] as $practiceTile ) { ?>
								<div class="col-md-3 col-xs-6 featured">
								    <a href=".?action=viewResource&amp;resourceId= <?php echo($practiceTile->id)?> ">
								        <img src="https://qph.is.quoracdn.net/main-qimg-96dbea649bbfb7478fe7e93f8a4ff7ba?convert_to_webp=true" class="thumbnail img-responsive">
								    </a>
					  			</div>
				<?php } ?>
			</div>
	  		<div class="row">
	  			<div class= "col-md-12 see-all">
	  				<a href="./?action=seeAll"><button class="btn btn-primary">See All </button></a>
	  			</div>
	  		</div>
	  	</div>

	  	<div id="main-else">
			<div class="row">
		  		<div class="col-md-12 main-text">
		  			<h2>. . . and everything else</h2>
		  			<h3><b>some text here</b></h3>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="row">
		  		<?php 
				foreach ( $results['else'] as $elseTile ) { ?>
								<div class="col-md-3 col-xs-6 featured">
								    <a href=".?action=viewResource&amp;resourceId= <?php echo($elseTile->id)?> ">
								        <img src="img/newbie.png" class="thumbnail img-responsive">
								    </a>
					  			</div>
				<?php } ?>
			</div>
	  		<div class="row">
	  			<div class= "col-md-12 see-all" id="bottom">
	  				<a href="./?action=seeAll"><button class="btn btn-primary">See All </button></a>
	  				<a name="else-anchor"></a>
	  			</div>
	  		</div>
	  	</div>
</div>

<?php include "templates/includes/footer.php" ?>