<?php

class AccountManager {

	function register($first_name, $last_name, $email, $password1, $school, $user, $days) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $hash = password_hash($password1, PASSWORD_DEFAULT);
	    $insert = "INSERT INTO `account`(`first_name`, `last_name`, `email`, `password`, `school`, `user`, `days`) VALUES ('$first_name','$last_name','$email','$hash','$school','$user','$days')";
	    $conn->query($insert);
	    $conn->close();
	}

	function login($username1, $password1) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $select = "SELECT `password` FROM `account` WHERE `email`='$username1'";
	    $row = $conn->query($select);
	    if ($row->num_rows == 0) {
	    	//echo "FALSE";
	    	return False;
	    } else {
	    	while($temp_row = $row->fetch_assoc()) {
	            $new_row = $temp_row['password'];
        	}
        	return password_verify($password1, $new_row);
	    }
	    $row->close();
	    $conn->close();
	}

	function verifyEmail($email) {
	    require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $result = $conn->query("SELECT * FROM account WHERE email = '$email';");
	    return $result->num_rows;
	    $result->close();
	    $conn->close();
	}

	function retrieveAccountInfo($email) {
		require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $result = $conn->query("SELECT first_name, last_name, email, password, school, user, days FROM account WHERE email = '$email';");
	    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
	        for ($i = 0; $i < sizeof($row); $i++) {
	            $rows[] = $row[$i];
	        }
	    }
	    return $rows;
	    $result->close();
	    $conn->close();
	}

}?>