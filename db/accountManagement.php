<?php

class AccountManager {

	function register($first_name, $last_name, $email, $password1, $school, $user, $days) {
		require("db.php");
	    $conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $first_name = $conn->real_escape_string($first_name);
	    $last_name = $conn->real_escape_string($last_name);
	    $email = $conn->real_escape_string($email);
	    $password1 = $conn->real_escape_string($password1);
	    $school = $conn->real_escape_string($school);
	    $user = $conn->real_escape_string($user);
	    $days = $conn->real_escape_string($days);
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
	    $username1 = $conn->real_escape_string($username1);
	    $password1 = $conn->real_escape_string($password1);
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
	    $email = $conn->real_escape_string($email);
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
	    $email = $conn->real_escape_string($email);
	    $result = $conn->query("SELECT first_name, last_name, email, password, school, user, days, id FROM account WHERE email = '$email';");
	    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
	        for ($i = 0; $i < sizeof($row); $i++) {
	            $rows[] = $row[$i];
	        }
	    }
	    return $rows;
	    $result->close();
	    $conn->close();
	}

	function updateInfo($first_name, $last_name, $email, $password1, $school, $user, $days) {
		require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        return False;
	    }
	    $first_name = $conn->real_escape_string($first_name);
	    $last_name = $conn->real_escape_string($last_name);
	    $email = $conn->real_escape_string($email);
	    $password1 = $conn->real_escape_string($password1);
	    $school = $conn->real_escape_string($school);
	    $user = $conn->real_escape_string($user);
	    $days = $conn->real_escape_string($days);
	   	$hash = password_hash($password1, PASSWORD_DEFAULT);
		$update = "UPDATE `account` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`password`='$hash',`school`='$school',`user`='$user',`days`='$days' WHERE `email`='$email';";
        $conn->query($update);
        return True;
        $conn->close();
	}
    
    function handleCreateCourse($user, $code, $name, $description, $year, $term, $section, $teamSize) {
        require "db/db.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if (!$conn) {
            die('Could not connect; '.mysql_error());
        }
        $sql = "select `course_id` from `course_list` where user_id='".$user.
            ".course_name='".$name.
            "' and course_year='".$year."' and course_term='".$term.
            "' and course_section".$section."'";
        $existence = mysqli_query($conn, $sql);
        if (!$existence) {
            $insert = "INSERT INTO `course_list` (`user_id`, `course_name`, `course_year`, `course_term`, `course_section`, `team_size`, `course_description`, `course_code`) VALUES ('".
                $user."','".
                strtoupper($name)."','".
                $year."','".
                $term."','".
                strtoupper($section)."','"
                .$teamSize."','".
                ucwords($description)."','".
                strtoupper($code)."')";
            $result = mysqli_query($conn, $insert);
            // confirm insertion
            if (!$result) {
                // echo "Fail to create a course";
            } else {
                // echo "success";
            }
        } else {
            echo "duplicate course exists";
        }
        $conn->close();
    }

    function handleJoinCourse($courseId, $userId, $year, $term) {
        require "db/db.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if (!$conn) {
            die('Could not connect; '.mysql_error());
        }
        $sql = "select `register_id` from `registered_student_list` where course_id='".$courseId."' and user_id='".$userId.
            "' and year='".$year."' and course_term='".$term."'";
        $existence = mysqli_query($conn, $sql);
        if (!$existence) {
            $insert = "INSERT INTO `registered_student_list` (course_id, user_id, year, term) VALUES ('".$courseId."','".$userId."','".$year."','".$term."')";
            $result = mysqli_query($conn, $insert);
            if (!$result) {
                return false;
            }
        } else {
            echo "already registered";
        }
        $conn->close();
    
    }
    
    function retrieveCourseInfoByCode($courseCode) {
		require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $result = $conn->query("SELECT * FROM course_list WHERE course_code = '$courseCode';");
	    if (!$result) {
            return false;
        }
	    return mysqli_fetch_array($result);
	    $result->close();
	    $conn->close();
	}
    
    function retrieveCourseInfoById($courseId) {
		require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $result = $conn->query("SELECT * FROM course_list WHERE course_id = '$courseId';");
	    if (!$result) {
            return false;
        }
	    return mysqli_fetch_array($result);
	    $result->close();
	    $conn->close();
	}
    
    function getNumRows($table, $colm, $value) {
		require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
	    $sql = "SELECT count(*) FROM ".$table." where ".$colm."='".$value."'";
        $result = $conn->query($sql);
	    if (!$result) {
            return false;
        }
        $row = mysqli_fetch_array($result);
        return $row['count(*)'];
	    $result->close();
	    $conn->close();
	}

    function getStudentList($courseId) {
		require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
        $sql = "select u.first_name, u.last_name ".
            "from account as u inner join registered_student_list as r ".
            "on r.user_id=u.id where r.course_id='".$courseId."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a class="item">';
                echo '  <div class="content">';
                echo '      <div class="header">';
                echo $row['first_name']." ".$row['last_name'];
                echo '      </div>';
                echo '  </div>';
                echo '</a>';
            }
        } else {
                echo '<div class="header"> There are no students in this course. </div>';
        }
    }
    
    function getCourseList($sql) {
		require('db.php');
		$conn = new mysqli($servername, $username, $password, $dbname);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a class="item course" href="?course_id='.$row['course_id'].'">'; //link to course page
                echo '    <div class="content">';
                echo '        <div class="header">';
                echo $row['course_name'].' '.$row['course_section'];
                echo '        </div>';
                echo '        <div class="description">';
                echo $row['course_description'].'<br>'.ucfirst($row['course_term']).' '.$row['course_year'];
                if (array_key_exists('first_name', $row)) {
                    echo '<br>'.$row['first_name']." ".$row['last_name'];
                }
                echo '<br>'.$this->getNumRows("registered_student_list", "course_id", $row['course_id']).' Students';
                echo '        </div>';
                echo '    </div>';
                echo '</a>'; 
            }
        } else {
            echo 'no course';
        }
    }
}?>
