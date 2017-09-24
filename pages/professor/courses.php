<?php
    require "db/db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
    function handleCreateCourse($rows) {
        require "db/db.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if (!$conn) {
            die('Could not connect; '.mysql_error());
        }
        $existence = mysqli_query($conn, "desc `".$rows[2]."_course_list`");
        if (!$existence) {
            $sql = "CREATE TABLE `".$rows[2]."_course_list` (".
                "`code` varchar(12) NOT NULL,".
                "`courseName` varchar(10) NOT NULL,".
                "`courseDescription` varchar(255) NOT NULL,".
                "`year` YEAR(4) NOT NULL,".
                "`term` enum('Spring', 'Summer', 'Fall') NOT NULL,".
                "`section` varchar(1) NOT NULL,".
                "`teamSize` enum('1', '2', '3', '4', '5') NOT NULL,".
                "PRIMARY KEY (`code`),".
                "UNIQUE KEY (`courseName`, `year`, `term`)".
                ")ENGINE=innodb DEFAULT CHARSET=utf8;";
            $retval = mysqli_query($conn, $sql);
            // confirm creation
            if (!$retval) {
                var_dump(!$retval);
            }
        }
        if ($existence) {
            $sql = "select `courseCode` from `".$rows[2]."_course_list` where courseName='".$_POST['courseName'].
                "' and year='".$_POST['year']."' and term='".$_POST['term']."'";
            $existence = mysqli_query($conn, $sql);
            if (!$existence) {
                $insert = "INSERT INTO `".$rows[2]."_course_list` VALUES ('".
                    strtoupper($_POST['courseCode'])."','".
                    strtoupper($_POST['courseName'])."','".
                    ucwords($_POST['courseDescription'])."','".
                    $_POST['year']."','".
                    $_POST['term']."','".
                    strtoupper($_POST['section'])."','".
                    $_POST['teamSize']."')";
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
            unset($_POST['courseCode']);
            unset($_POST['courseName']);
            unset($_POST['courseDescription']);
            unset($_POST['year']);
            unset($_POST['term']);
            unset($_POST['section']);
            unset($_POST['teamSize']);
        }
        $conn->close();
    }
if (isset($_POST['courseCode'])) {
    handleCreateCourse($rows);
}
?>

    <div class="pusher">
        <!--courseList-->
        <?php //include("courseList.php"); ?> <!--TODO: Display below code when a course is clicked-->

        <!--course page-->
        <!--TODO: replace data-->
        <div class="ui container" id="main-wrapper">
            <h2>CS 1332</h2>
            <p> Data Structure / Fall 2017 / 10 Students</p>
            <div class="ui top attached tabular menu" id="list-selection">
                <a class="item active" data-tab="teams">Teams (2)</a>
                <a class="item" data-tab="students">Students (123)</a>
            </div>
            <!--Teams tab-->
            <div class="ui bottom attached tab segment active" data-tab="teams">
                <div class="ui link items" id="sub-wrapper">
                    <a class="item team">
                        <div class="content">
                            <div class="header">
                                Team Up
                            </div>
                            <div class="description">
                                <b>4/5 Members</b>
                                <br> A Web-based Team Formaton Tool
                            </div>
                        </div>
                    </a>
                    <a class="item team">
                        <div class="content">
                            <div class="header">
                                Team Name
                            </div>
                            <div class="description">
                                <b>#/Max Capacity Members</b>
                                <br> Project Description
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--Student tab-->
            <div class="ui bottom attached tab segment" data-tab="students">
                <p>student</p>
            </div>
        </div>
    </div>

    <!--sidebar-->
    <div class="ui sidebar very wide right vertical menu" id=infoSidebar>
        <div class="item" style="text-align:center;">
            <h3>
                TeamUp
            </h3>
        </div>
    </div>
