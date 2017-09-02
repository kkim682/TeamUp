<?php

class AccountManager {

	function register($first_name, $last_name, $email, $password, $school, $user) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);	    
	    $insert = "INSERT INTO `account`(`first_name`, `last_name`, `email`, `password`, `school`,`user`) VALUES ('$first_name','$last_name','$email','$password','$school','$user')";
	    $conn->query($insert);
	    $conn->close();
	}

}

?>