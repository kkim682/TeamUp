<?php

class AccountManager {

	function register($first_name, $last_name, $email, $password1, $school, $user) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);

	    //Hash should be implemented here
	    $insert = "INSERT INTO `account`(`first_name`, `last_name`, `email`, `password`, `school`,`user`) VALUES ('$first_name','$last_name','$email','$password1','$school','$user')";
	    $conn->query($insert);
	    $conn->close();
	}

	function login($username1, $password1) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);	    
	    $select = "SELECT `password` FROM `account` WHERE `email`='$username1'";
	    $row = $conn->query($select);
	    if ($row->num_rows == 0) {
	    	//echo "FALSE";
	    	return False;
	    } else {
	    	while($temp_row = $row->fetch_assoc()) {
	            $new_row = $temp_row['password'];
        	}
        	//Hash should be returned / implemented here
        	return $password1 == $new_row;
	    }
	    $conn->close();
	}

}?>