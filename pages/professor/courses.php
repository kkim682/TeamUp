<?php
    require "db/db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
    if (isset($_POST['courseCode'])) {
        $account_manager->handleCreateCourse($rows[7], $_POST['courseCode'], $_POST['courseName'], $_POST['courseDescription'], $_POST['year'], $_POST['term'], $_POST['section'], $_POST['teamSize']);
        unset($_POST['courseCode']);
        unset($_POST['courseName']);
        unset($_POST['courseDescription']);
        unset($_POST['year']);
        unset($_POST['term']);
        unset($_POST['section']);
        unset($_POST['teamSize']);
    }
?>
    
<?php
    if (isset($_GET['course_id'])) {
        include "coursePage.php";
    } else {
        include "courseList.php";
    }
?>
