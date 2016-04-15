<?php
$db_user = 'root';
$db_pass = 'Genesee1!';
$db_name = 'C2C';
$db_host = 'localhost';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
	printf("Connection to the database failed: %s/n", $mysqli -> connect_error);
	exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$feedback_message = $_POST['message'];
$feedback_submit_date = date("Y-m-d H:i:s");

$stmt = $mysqli->prepare("INSERT INTO feedback (name, email, feedback_message, feedback_submit_date) 
		VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssss', $name, $email, $feedback_message, $feedback_submit_date);


if (!$stmt->execute()) {
    echo 'Error :(  ';	
} else {
    mysqli_close($mysqli);
    header("Location:http://localhost/~brianna.vay/C2C/contact.php");
}
?>