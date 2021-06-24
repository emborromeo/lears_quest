<?php
//database configurations
define("DB_HOST","localhost");
define("DB_UNAME","root");
define("DB_PASS","");
define("DB_DNAME","game_builder");

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_HOST,DB_UNAME,DB_PASS,DB_DNAME);

// Check connection
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
