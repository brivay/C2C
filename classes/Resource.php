<?php
//this class handels the nitty gritty of storing articles in the DB and retrieving them. 
// with this script it will be easy for our script to create, update, retrieve, and delete articles
// Technically, this type of class — which contains properties that map directly to the corresponding database fields, as well as methods for storing and retrieving records from the database — follows an object-oriented design pattern known as active record.

// require_once ( "./config.php" ); //generates an error if file can't be found

class Resource {
	//declae properties of the class
	public $id = null;
	public $title = null;
	public $summary= null;
	public $url = null;
	public $content = null;
	public $category = null;
	public $is_free = null; //????
	public $is_featured = null;
	public $is_favorite = null;
	public $date_created = null;
	
	//set properties from supplied array (set paramets accociated with properties)
	//called automatically by the PHP engine whenever a new Article object is created.
	public function __construct( $data ) {
		//associate the property values

    if ( isset ( $data['id'] ) ) $this->id = (int) $data['id'];
    // if ( isset ( $data['id'] ) ) $this->id = 7;

		if ( isset ( $data['title'] ) ) $this->title = $data['title'];
		if ( isset ( $data['summary'] ) ) $this->summary = $data['summary'];
		if ( isset ( $data['url'] ) ) $this->url = $data['url'];
		if ( isset ( $data['content'] ) ) $this->content = $data['content'];
		if ( isset ( $data['category'] ) ) $this->category = $data['category'];
		if ( isset ( $data['is_free'] ) ) $this->is_free = (int) $data['is_free'];
		if ( isset ( $data['is_featured'] ) ) $this->is_featured = (int) $data['is_featured'];
		if ( isset ( $data['is_favorite'] ) ) $this->is_favorite = (int) $data['is_favorite'];
		// if ( isset ( $data['date_created'] ) ) $this->date_created = (int) $data['date_created'];
		if ( isset ( $data['date_created'] ) ) $this->date_created = date("Y-m-d H:i:s");

		//$this->propertyName means: "The property of this object that has the name "$propertyName"
	}

  public static function getHomePageTiles( $type ) {
    global $DB_HOST;
    global $DB_NAME;
    global $DB_USERNAME;
    global $DB_PASSWORD;

    $conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );
    if (mysqli_connect_errno()) {
      printf("Connection to the database failed: %s/n", $mysqli -> connect_error);
      exit();
    }

    $sql = "SELECT * FROM resources WHERE category = ? AND is_featured = 1 ORDER BY position ASC LIMIT 4;";
    if ($st = $conn->prepare( $sql )) {
        $st->bind_param( "s", $type );
        $st->execute();
        $list = array();
        $meta = $st->result_metadata(); 
        while ($field = $meta->fetch_field()) { 
          $params[] = &$row[$field->name]; 
        } 
        call_user_func_array(array($st, 'bind_result'), $params);            
        while ($st->fetch()) { 
          $resource = new Resource( $row );
          $list[] = $resource;
        } 

        $conn = null;
        // print_r($list);

        return $list;

    } else {
        printf("Errormessage: %s\n", $conn->error);
    }
  }

  public static function getList() {
    global $DB_HOST;
    global $DB_NAME;
    global $DB_USERNAME;
    global $DB_PASSWORD;

    $conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );
    if (mysqli_connect_errno()) {
      printf("Connection to the database failed: %s/n", $mysqli -> connect_error);
      exit();
    }

    $sql = "SELECT * FROM resources ORDER BY id DESC;";
    if ($st = $conn->prepare( $sql )) {
        // $st->bind_param( "s", $type );
        $st->execute();
        $list = array();
        $meta = $st->result_metadata(); 
        while ($field = $meta->fetch_field()) { 
          $params[] = &$row[$field->name]; 
        } 
        call_user_func_array(array($st, 'bind_result'), $params);            
        while ($st->fetch()) { 
          $resource = new Resource( $row );
          $list[] = $resource;
        } 

        $conn = null;
        // print_r($list);

        return $list;

    } else {
        printf("Errormessage: %s\n", $conn->error);
    }
  }



	//set the object properties using the edit form post value in the supplied array
	//accociate the form post values
	//stores a supplied array of data in the object's properties.
	//can handle data in the format that is submitted via our New Article and Edit Article forms
	//The purpose of this method is simply to make it easy for our admin scripts to store the data submitted by the forms. All they have to do is call storeFormValues(), passing in the array of form data.
  public function storeFormValues ( $params ) {
    $this->__construct( $params );
  }



    //returns a resource object matching the given id
    //conencts, retrievs the matching resource record and stores it in a new resource object
    //to enable the method to be called w/o needing an object, add static keyword - this allows the method to be called directly without specifiying on object (typically you call a method on an object - but this method returns a new object...)
// public static function getById ( $id ) {
//     $conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );
//     $sql = "SELECT * FROM resources WHERE id = ?"; //:id is a placeholder. secure.
//     $st = $conn->prepare( $sql );
//     $st->bind_param( 'i', $id );
//     $st->execute();
//     $row = $st->fetch();
//     $conn = null;
//     if ( $row ) return new Resource( $row );
// }


  	//inserts the current Resource object into the DB and sets it ID property
  	//adds a new article record to the articles table, using the values stored in the current Article object
public function insert() {
  global $DB_HOST;
  global $DB_NAME;
  global $DB_USERNAME;
  global $DB_PASSWORD;
  
  // Does the Article object already have an ID?
  if ( !is_null( $this->id ) ) trigger_error ( "Resource::insert(): Attempt to insert an Resource object that already has its ID property set (to $this->id).", E_USER_ERROR );

  // Insert the Resource
  $conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );
  if (mysqli_connect_errno()) {
      printf("Connection to the database failed: %s/n", $mysqli -> connect_error);
      exit();
  } 

  $sql = "INSERT INTO resources ( title, url, summary, content, category, is_free, is_featured, position, is_favorite, date_created ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
  $st = $conn->prepare ( $sql );
  $st->bind_param( 'sssssiiiis', $this->title, $this->url, $this->summary, $this->content, $this->category, $this->is_free, $this->is_featured, $this->position, $this->is_favorite, date("Y-m-d") );
  $st->execute();
  // $this->id = $conn->insert_id;
      // $this->id = $conn->lastInsertId(); PDO
      // $conn = null;

  // $sql = "INSERT INTO `resources` (`id`, `title`, `url`, `summary`, `content`, `category`, `is_free`, `is_featured`, `position`, `is_favorite`, `date_created`) VALUES (NULL, 'hip', 'hip', 'hip', 'hip', 'else', '1', '1', '5', '0', '2016-04-21');";
  // $conn->query($sql);
  //     $this->id = $conn->insert_id;
  //     // $this->id = $conn->lastInsertId(); PDO
  //     // $conn = null;
}



  	//updates teh current recource in the DB
public function update() {
  		//Does the Resource object have an id?
    if ( is_null( $this->id ) ) trigger_error ("Resource::update(): Attempt to update an Resource object that does not have its ID property set.", E_USER_ERROR );

		//Update the Resource
    $conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );
    $sql = "UPDATE resources SET title=:?, summary=?, url=?, content=?, category=?, is_free=?, is_featured=?, is_favorite=?, date_created=? WHERE id = ?";
    $st = $conn->prepare ( $sql );
    $st->bind_param( 'sssssiiisi', $this->title, $this->summary, $this->url, $this->content, $this->category, $this->is_free, $this->is_featured, $this->is_favorite, date("Y-m-d H:i:s"), $this->id );

    $st->execute();
    $conn = null;
}

  	//Delete the current resource for the DB
public function delete() {
  		//Does the Resource object have an id?
    if ( is_null( $this->id ) ) trigger_error ("Resource::update(): Attempt to update an Resource object that does not have its ID property set.", E_USER_ERROR );

		//Delete the Resource
    $conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );
    $st = $conn->prepare ( "DELETE FROM resources WHERE id = ? LIMIT 1" );
    $st->bind_param( 'i', $this->id );
    $st->execute();
    $conn = null;
}

} //class
?>