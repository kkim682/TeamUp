<?php
    require "db/db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
    if (isset($_POST['courseCode'])) {
        $courseInfo = $account_manager->retrieveCourseInfoByCode($_POST['courseCode']);
        $account_manager->handleJoinCourse($courseInfo[0], $rows[7], $courseInfo[3], $courseInfo[4]);
        unset($_POST['courseCode']);
    }

    if (isset($_GET['course_id'])) {
        include "coursePage.php";
    } else {
        include "courseList.php";
    }
?>

   
  

