<?php

class AccountManager {

	function register($first_name, $last_name, $email, $password, $school, $user) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);	    
	    $insert = "INSERT INTO `account`(`first_name`, `last_name`, `email`, `password`, `school`,`user`) VALUES ('$first_name','$last_name','$email','$password','$school','$user')";
	    $conn->query($insert);
	    $conn->close();
	}

	function login($username, $password) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);	    
	    $select = "SELECT `password` FROM `account` WHERE `email`='$username'";
	    $row = $conn->query($select);
	    if ($row->num_rows == 0) {
	    	return False;
	    } else {
	    	while($row = $result->fetch_assoc()) {
	            $temp = $row['password'];
        	}
        	echo $temp;
        	return True;
	    }
	    $conn->close();
	}

}

?>