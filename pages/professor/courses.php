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


    <!--course list-->

    <div class="ui container main-wrapper" id="courseList">
        <h2>My Courses</h2>
        <a class="ui primary button" id="createCourse-bttn">
            <div class="header">
                Create a new course
            </div>
        </a>
        <div class="ui link items" id="sub-wrapper">

        <?php
            $sql = "select * from `course_list` where user_id='".$rows[7]."' order by course_year desc, course_term desc, course_section desc";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a class="item course">'; //link to course page
                    echo '    <div class="content">';
                    echo '        <div class="header">';
                    echo $row['course_name'].' '.$row['course_section'];
                    echo '        </div>';
                    echo '        <div class="description">';
                    echo $row['course_description'].
                        '<br>'.ucfirst($row['course_term']).' '.$row['course_year'].
                        '<br>'.$row['team_size'].' Members';
                        '<br>'.'# Students'; //Add number of students registered for the course
                    echo '        </div>';
                    echo '    </div>';
                    echo '</a>'; 
                }
            } else {
                echo 'no course';
            }
        ?>
        </div>
    </div>

    <div class="ui mini modal" id="createCourse-modal">
        <i class="close icon"></i>
        <div class="header">
            Create a New Course
        </div>
        <form method="POST" class="ui form" id="createCourse-form">
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




    <div class="pusher">
        <!--course page-->
        <!--TODO: replace data-->
        <div class="ui container main-wrapper" id="coursePage" style="display:none">
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
