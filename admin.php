<?php
require_once ( "config.php" );
//start a user session - track weither the user logged in or not
session_start()
$action = isset( $GET['action'] ) ? $_GET['action'] : "";
$username = isset ( $_SESSION['username'] ) ? $_SESSION['username'] : "";

//inspect $username to see if the session contained a value for the username key, which we use to signify that the user is logged in. If $username's value is empty — and the user isn't already trying to log in or out — then we display the login page and exit immediately.
if ( $action != "login" && $action != "logout" && !$username) {
	login();
	exit;
}

//it calls the appropriate function based on the value of the action URL parameter. The default action is to display the list of resources in the CMS.
switch ( $action ) {
	case 'login':
		login();
		break;
	case 'logout':
		logout();
		break;
	case 'newResource':
		newResource();
		break;
	case 'editResource':
		editResource();
		break;
	case 'deleteResource':
		deleteResource();
		break;
	default:
		listResources();
}

function login() {
	$results = array();
	$results['pageTitle'] = "Admin Login | Couch To Code";

	if ( isset( $_POST['login'] ) ) {
		//user has posted the login form: aptempt to log the user in 

		if ( $_POST['username'] == $ADMIN_USERNAME && $_POST['password'] == $ADMIN_PASSWORD ) {
			//Login Sucessfull: create session and redirect to the admin homepage
			//session key is set to the admin username
			$_SESSION['username'] = $ADMIN_USERNAME;
			header( "Location: admin.php" );
		} else {
			//Login failed: display error message to user
			$results['errorMessage'] = "NOPE!";
			require ( TEMPLATE_PATH . "/admin/loginForm.php" );
		}
	} else {
		//user has not posted the login form yet: display the form
		require ( TEMPLATE_PATH . "/admin/loginForm.php" );
	}
}

function logout() {
	//simply removes the username session key and redirects
	unset( $_SESSION['username'] );
	header( "Loaction: admin.php" );
}

function newResource() {
	$results = array();
	$results['pageTitle'] = "New Resource";
	$results['formAction'] = "newResource";

	if ( isset( $_POST['saveChanges'] ) ) {
		//user has posted the article edit form: save the new article
		$resource = new Resource;
		$resource->storeFormValues( $_POST );
		$resource->insert();
		header( "Location: admin.php?status=changesSaved" );
	} elseif ( isset( $_POST['cancel'] ) ) {
		//User has cancelled their edits: return to the article list
		header( "Loaction: admin.php" );
	} else {
		//If the user has not posted the "new article" form yet then the function creates a new empty Article object with no values, then uses the editArticle.php template to display the article edit form using this empty Article object.
		//user has not posted the article edit form yet: display the form
		$results['resource'] = new Resource
		require( TEMPLATE_PATH . "/admin/editResource.php" );
	}
}


function editResource() {
 
  $results = array();
  $results['pageTitle'] = "Edit Resource";
  $results['formAction'] = "editArticle";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the article changes
 
    if ( !$resource = Resource::getById( (int)$_POST['resourceId'] ) ) {
      header( "Location: admin.php?error=resourceNotFound" );
      return;
    }
 
    $resource->storeFormValues( $_POST );
    $resource->update();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['resource'] = Resource::getById( (int)$_GET['resourceId'] );
    require( TEMPLATE_PATH . "/admin/editResource.php" );
  }
 
}

function deleteResource() {
 
  if ( !$resource = Resource::getById( (int)$_GET['resourceId'] ) ) {
    header( "Location: admin.php?error=resourceNotFound" );
    return;
  }
 
  $resource->delete();
  header( "Location: admin.php?status=resourceDeleted" );
}
 
 
function listResources() {
  $results = array();
  $data = Resource::getList();
  $results['resources'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Resources";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "resourceNotFound" ) $results['errorMessage'] = "Error: Resource not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/listResources.php" );
}
 

?>