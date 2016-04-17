<?php include "templates/includes/header.php" ?>
 
      <div>
        <h2>Widget News Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
      </div>
 
      <h1>All Articles</h1>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
 
      <table>
        <tr>
          <th>Publication Date</th>
          <th>Article</th>
        </tr>
 
<?php foreach ( $results['resources'] as $resource ) { ?>
 
        <tr onclick="location='admin.php?action=editResource&amp;resourceId=<?php echo $resource->id?>'">
          <td>
            <?php echo $resource->title?>
          </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><a href="admin.php?action=newResource">Add a New Resource</a></p>
 
<?php include "templates/includes/footer.php" ?>
