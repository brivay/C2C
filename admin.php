<?php
require_once ( "config.php" );
//start a user session - track weither the user logged in or not
session_start();

$action = ( $_GET['action'] );
var_dump($action);

$username = isset ( $_SESSION['username'] ) ? $_SESSION['username'] : "";

//inspect $username to see if the session contained a value for the username key, which we use to signify that the user is logged in. If $username's value is empty — and the user isn't already trying to log in or out — then we display the login page and exit immediately.
if ( $action != "login" && $action != "logout" && !$username) {
	// print_r("not log in/log out, no session username");
	login();
	exit;
}

//calls the appropriate function based on action URL param
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

	if(isset($_POST['login'])) {
		global $logins;
		//check and assign submitted username and password to new variable
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';

		//check username and password existence in defined array
		if (isset($logins[$username]) && $logins[$username] == $password) {
			//success: set session variables and redirect to protected page
			$_SESSION['username']=key($logins);
			header("Location: admin.php");
		} else {
			//unsucessful attempt: set error message
			$results['errorMessage'] = "NOPE!";
			require ( "templates/admin/loginForm.php" );
		}
	} else {
		//user has not posted the login form yet: display the form
		require ( "templates/admin/loginForm.php" );
	}
}



function logout() {
 	unset( $_SESSION['username'] );
	header( "Location: admin.php?action=login" );
}


function listResources() {
  	$results = array();
  	$data = Resource::getList();
  	$results['resources'] = $data;
  	$results['pageTitle'] = "Admin | All Resources";
 
  	if ( isset( $_GET['error'] ) ) {
    	if ( $_GET['error'] == "resourceNotFound" ) $results['errorMessage'] = "Error: Resource not found.";
  	}
 
  	if ( isset( $_GET['status'] ) ) {
    	if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    	if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  	}
 
  	require( "templates/admin/listResources.php" );
}


function newResource() {
	$results = array();
	$results['pageTitle'] = "Admin | New Resource";
	$results['formAction'] = "newResource";

	if ( isset( $_POST['saveChanges'] ) ) {
		//user has posted the article edit form: save the new article
		// print_r($_POST);
		$resource = new Resource( $_POST );
		// $resource->storeFormValues( $_POST );
		$resource->insert();
		header( "Location: admin.php?status=changesSaved" );
	} elseif ( isset( $_POST['cancel'] ) ) {
		//User has cancelled their edits: return to the article list
		header( "Location: admin.php?action=login" );
	} else {
		//If the user has not posted the "new article" form yet then the function creates a new empty Article object with no values, then uses the editArticle.php template to display the article edit form using this empty Article object.
		//user has not posted the article edit form yet: display the form
		$results['resource'] = new Resource('');
		require( "templates/admin/editResource.php" );
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

// function deleteResource() {
 
//   if ( !$resource = Resource::getById( (int)$_GET['resourceId'] ) ) {
//     header( "Location: admin.php?error=resourceNotFound" );
//     return;
//   }
 
//   $resource->delete();
//   header( "Location: admin.php?status=resourceDeleted" );
// }
 
 
 

?>