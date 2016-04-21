<?php include "templates/includes/header.php" ?>

      <div class="row about-text">
        <div class="col-xs-6" class="text-left">
            <p>You are logged in as:<br> <b><?php echo htmlspecialchars( $_SESSION['username']) ?> </b></p>
        </div>

        <div class="col-xs-6" class="text-right">
          <a href="admin.php?action=logout">Log out</a><br>
          <a href="admin.php">See All Resources</a>
        </div>
      </div>
 
      <div class="row about-text">
        <div class="col-xs-12">
          <h3><?php echo $results['pageTitle']?></h3>
        </div>
      </div>
 
      <form action="admin.php?<?php echo $results['formAction']?>" method="post" class="about-text">
        <!-- <input type="hidden" name="id" value="<?php echo $results['resource']->id ?>"/> -->
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 <!-- THIS IS WHERE I LEFT OFF -->
        <div class="row>
          <div class="col-xs-12">
            <label for="title">Title: </label>
            <input type="text" name="title"  id="title" placeholder="Title" class="admin-form" required autofocus style=" width:30em;" value="<?php echo htmlspecialchars( $results['resource']->title )?>" />
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <label for="url">URL: </label>
            <input type="url" name="url"  id="url" placeholder="URL" class="admin-form" required autofocus style=" width:30em;" value="<?php echo htmlspecialchars( $results['resource']->url )?>" />
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <label for="summary">Summary:</label>
            <textarea name="summary" id="summary" placeholder="Summary" class="admin-form" required style="height: 5em; width:30em;"><?php echo htmlspecialchars( $results['resource']->summary )?></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <label for="summary">Content:</label>
            <textarea name="content" id="content" placeholder="Content" class="admin-form" required style="height: 10em; width:30em;"><?php echo htmlspecialchars( $results['resource']->content )?></textarea>
          </div>
        </div>

        <!-- CAN I CHANGE THIS TO A DROPDOWN? -->
        <div class="row">
          <div class="col-xs-12">
            <label for="category">Category: </label>
            <input type="text" name="category"  id="category" placeholder="Category (Learn, Practice, Else)" class="admin-form" required autofocus style=" width:30em;" value="<?php echo htmlspecialchars( $results['resource']->category )?>" />
          </div>
        </div>

        <!-- CAN I CHANGE THIS TO A CHECKBOX? -->
        <div class="row">
          <div class="col-xs-12">
            <label for="is_free">is_free?: </label>
            <input type="number" name="is_free"  id="is_free"  placeholder="0=no, 1=yes" max="1" min="0" class="admin-form" required autofocus style=" width:15em;" value="<?php echo htmlspecialchars( $results['resource']->is_free )?>" />
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <label for="is_featured">is_featured?: </label>
            <input type="number" name="is_featured"  id="is_featured"  placeholder="0=no, 1=yes" max="1" min="0" class="admin-form" required autofocus style=" width:15em;" value="<?php echo htmlspecialchars( $results['resource']->is_featured )?>" />

            <label for="position">position: </label>
            <input type="number" name="position"  id="position"  placeholder="position" min="0" class="admin-form" required autofocus style=" width:15em;" value="<?php echo htmlspecialchars( $results['resource']->position )?>" />
          </div>
        </div>

        <!-- <div class="row ">
          <div class="col-xs-12">
            <label for="is_favorite">is_favorite?: </label>
            <input type="number" name="is_favorite"  id="is_favorite"  placeholder="0=no, 1=yes" max="1" min="0" class="admin-form" required autofocus style=" width:15em;" value="<?php echo htmlspecialchars( $results['resource']->is_favorite )?>" />
          </div>
        </div> -->

        <div class="row">
          <div class="col-xs-12">
            <label for="is_favorite"> is_favorite?: </label>

    
            <!-- CHECK TO MAKE SURE THE RADIO BUTTON IS POPULATED WITH THE SQL VALUE WHEN EDITING -->

            <input type="radio" name="is_favorite" id="favoriteyes" required value="1" <?php if (($results['resource']->is_favorite) == 1) { echo 'checked';} ?> /> Yes
            <input type="radio" name="is_favorite" id="favoriteno"  required value="0" <?php if (($results['resource']->is_favorite) == 0) { echo 'checked';} ?> /> No

            <?php echo ($results['resource']->is_favorite == '1')?'checked':''?>
            
          </div>
        </div>







        <!-- DO I NEED ANYTHING FOR DATE? -->

 
        <div>
          <input type="submit" name="saveChanges" value="Save Changes"class="send-button remove-margin"/>
          <input type="submit" formnovalidate name="cancel" value="Cancel" class="send-button remove-margin"/>
        </div>
 
      </form>
 
<?php if ( $results['resource']->id ) { ?>
      <p><a href="admin.php?action=deleteResource&amp;resourceId=<?php echo $results['resource']->id ?>" onclick="return confirm('Delete This Resource?')">Delete This Article</a></p>
<?php } ?>
 
<?php include "templates/includes/footer.php" ?>