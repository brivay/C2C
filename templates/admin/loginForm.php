<?php include "templates/includes/header.php"; ?>


<form action="http://localhost/~brianna.vay/C2CGitHub/admin.php" method="post" name="Login_Form">
	<?php if(isset($results['errorMessage'])) { ?>
	<div class="row about-text alert-danger">
		<div class="col-md-12 col-xs-12 text-center">
			<?php echo $results['errorMessage']; ?>
		</div>
	</div>
	<?php } ?>

	<div class="row about-text">	
		<div class="col-md-12 col-xs-12 text-center">
			<h2>Couch to Code Admin</h2>
		</div>
	</div>

	<div class="row feedback-form about-text admin-login">
		<div class="col-md-12 col-xs-12">
			<input name="username" type="text" class="form" required="required" placeholder="Username"/>
			<input name="password" type="password" class="form" required="required" placeholder="Password"/>

		</div>
	</div>


	<div class="row">
		<div class="col-md-12 col-xs-12 ">
        	<button type="submit" id="login" name="login" value="Login" class="send-button about-text">Sign In</button>
    	</div>
    </div>

</form>

<?php include "templates/includes/footer.php" ?>
