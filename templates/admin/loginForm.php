<?php include "templates/includes/header.php" ?>


	<form action="admin.php?action=login" method="post">
        <input type="hidden" name="login" value="true" />
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <li>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
          </li>
 
          <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
          </li>
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="login" value="Login" />
        </div>
 
      </form>


<?php include "templates/includes/footer.php" ?>


<!-- 
This page contains the admin login form, which posts back to admin.php?action=login. It includes a hidden field, login, that our login() function from Step 6 uses to check if the form has been posted. The form also contains an area for displaying any error messages (such as an incorrect username or password), as well as username and password fields and a "Login" button. 
-->
