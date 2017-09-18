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
    <!--Course page for professors-->

    <div class="ui container" id="main-wrapper">
        <h2>My Courses</h2>
        <a class="ui primary button" id="newCourse-bttn">
                <div class="header">
                    Create a new course
                </div>
        </a>
        <div class="ui link items" id="sub-wrapper">

        <?php
            //$sql = "select `courseName`,`courseDescription`,".
            //    "`year`,`term`,`section`,`teamSize` from topic";
            $sql = 'select * from `'.$rows[2].'_course_list`';
            $result = mysqli_query($conn, $sql);
            $existence = mysqli_query($conn, "desc `".$rows[2]."_course_list`");
            if ($existence) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a class="item" href="">'; //link to course page
                    echo '    <div class="content">';
                    echo '        <div class="header">';
                    echo $row['courseName'].' '.$row['section'];
                    echo '        </div>';
                    echo '        <div class="description">';
                    echo $row['courseDescription'].
                        '<br>'.ucfirst($row['term']).' '.$row['year'].
                        '<br>'.$row['teamSize'].' Members';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</a>'; 
                }
            }
        ?>
        </div>
    </div>


    <div class="ui mini modal" id="newCourse-modal">
        <i class="close icon"></i>
        <div class="header">
            Create a New Course
        </div>
        <form method="POST" class="ui form" id="newCourse-form">
            <div class="ui error message"></div>
            <div class="field">
                <label>Course Name</label>
                <input type="text" name="courseName" placeholder="ex) CS3312">
            </div>
            <div class="field">
                <label>Course Description</label>
                <input type="text" name="courseDescription" placeholder="ex) Project Implementation">
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Term</label>
                    <select class="ui fluid dropdown" name="term">
                    <option value="Fall">Fall</option>
                    <option value="Spring">Spring</option>
                    <option value="Summer">Summer</option>                    
                </select>
                </div>
                <div class="field">
                    <label>Year</label>
                    <select class="ui fluid dropdown" name="year">
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                </select>
                </div>
            </div>
                <div class="field">
                    <label>Section (Optional)</label>
                    <input type="text" name="section" placeholder="ex) A">
                </div>
            
            <div class="field">
                <label>Team Size</label>
                <select class="ui fluid dropdown" name="teamSize">
                    <?php 
                        for ($i=1; $i<6; $i++) {
                            echo "<option value='".$i."'>".$i." people</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="field">
                <label>Course Code</label>
                <input type="text" name="courseCode" id="courseCode" placeholder="ex) <?php echo $rows[0].$rows[1]  ?>">
            </div>

            <div class="actions">
                <input class="ui right floated primary button" type="submit" value="OK">
                <input class="ui right floated cancel button" type="button" value="Cancel">
            </div>
        </form>
    </div>
    <!--create a new course modal-->
    <!--will see if there's public API for this -->
