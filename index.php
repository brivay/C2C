<?php 
require_once ( "config.php" );

//It's good programming practice to check that user-supplied values, such as query string parameters, form post values and cookies, actually exist before attempting to use them. Not only does it limit security holes, but it prevents the PHP engine raising "undefined index" notices as your script runs.
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

//the switch block looks at the action parpamter in the url to determine which action to perform (display the archive, or view a resource). if none is set, displays homepage
switch ( $action ) {
  case 'seeAll':
    seeAll();
    break;
  case 'viewResource':
    viewResource();
    break;
  default:
    homepage();
}

function homepage() {
  $results = array();

  $learnData = Resource::getHomePageTiles( 'learn' );
  $practiceData = Resource::getHomePageTiles( 'practice' );
  $elseData = Resource::getHomePageTiles( 'else' );
  
  $results['learn'] = $learnData;
  $results['practice'] = $practiceData;
  $results['else'] = $elseData;
  $results['pageTitle'] = "Couch To Code";
  require_once ( "templates/homepage.php" );
}




 


//displays a list of all the articles in the database.
//stores the results, along with the page title, in a $results associative array so the template can display them in the page. 
//it includes the template file to display the page.
function seeAll() {
  $results = array();
  $data = Resource::getList();
  $results['resources'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Resource Archive | Couch To Code";
  require( $TEMPLATE_PATH . "/archive.php" );
}
 

//It retrieves the ID of the resource to display from the resourceId URL parameter
//retrievs the Resource object with the Resource class's getById() method
function viewResource() {
  if ( !isset($_GET["resourceId"]) || !$_GET["resourceId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $results['resource'] = Resource::getById( (int)$_GET["resourceId"] );
  $results['pageTitle'] = $results['resource']->title . " | Couch To Code";
  require( $TEMPLATE_PATH . "/viewResource.php" );
}
 
?>
