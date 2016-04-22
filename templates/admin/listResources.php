<?php include "templates/includes/header.php" ?>
 
  <div class="row about-text">
    <div class="col-xs-6" class="text-left">
      <p>You are logged in as:<br> <b><?php echo htmlspecialchars( $_SESSION['username']) ?> </b></p>
    </div>

    <div class="col-xs-6" class="text-right">
      <a href="admin.php?action=logout">Log out</a><br>
      <a href="admin.php?action=newResource">Add a New Resource</a><br>
    </div>

  </div>


 
  <div class="row about-text">
    <div class="col-xs-12">
      <h3><?php echo $results['pageTitle']?></h3>
    </div>
  </div>

 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>


<div class="table-wrap">
  <table class="about-text">
    <tr>
      <th>id</th>
      <th>title</th>
      <th>summary</th>
      <th>url</th>
      <th>category</th>
      <th>is_featured</th>
      <th>position</th>
    </tr>

    <?php foreach ( $results['resources'] as $resource ) { ?>
      <tr onclick="location='admin.php?action=editResource&amp; resourceId=<?php echo $resource->id?>'">
        <td> <?php echo $resource->id ?> </td>
        <td> <?php echo $resource->summary ?> </td>
        <td> <?php echo $resource->title ?> </td>
        <td> <?php echo $resource->url ?> </td>
        <td> <?php echo $resource->category ?> </td>
        <td> <?php echo $resource->is_featured ?> </td>
        <td> <?php echo $resource->position ?> </td>
      </tr>
    <?php } ?>

  </table> 
</div>
 
<?php include "templates/includes/footer.php" ?>
