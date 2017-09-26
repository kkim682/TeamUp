<?php
        $sql = "select * from `course_list` where course_id='".$_GET['course_id']."' order by course_year desc, course_term desc, course_section desc";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $numStudents = $account_manager->getNumRows("registered_student_list", "course_id", $_GET['course_id']);
?>
    <div class="pusher">
        <!--course page-->
        <div class="ui container main-wrapper" id="coursePage">
            <h2>
                <?php echo $row['course_name'].": ".$row['course_description']?>
                <div class="ui icon top left pointing dropdown button">
                    <i class="wrench icon"></i>
                    <div class="menu">
                        <div class="item" id="infoCourse-bttn">Course Information</div>
                        <div class="item" id="deleteCourse-bttn">Drop</div>
                    </div>
                </div>
            </h2>
            <div class="ui top attached tabular menu" id="list-selection">
                <a class="item active" data-tab="teams">Teams (2)</a>
                <a class="item" data-tab="students">Students (<?php if($numStudents) {echo $numStudents;} else {echo '0';} ?>)</a>
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
                <div class="ui link items" id="sub-wrapper">
                    <?php $account_manager->getStudentList($_GET['course_id']); ?>
                </div>
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


    <!--view course information modal-->
    <?php
        $row = $account_manager->retrieveCourseInfoById($_GET['course_id']);
    ?>
    <div class="ui mini modal" id="infoCourse-modal">
        <i class="close icon"></i>
        <div class="header">
            Course information
        </div>
        <form method="POST" class="ui form" id="infoCourse-form">
            <div class="ui info message">
                <p>Your course code is: <b><?php echo $row['course_code']?></b>
                </p>
            </div>
            <div class="ui error message"></div>
            <div class="field">
                <label>Course Name</label>
                <p>
                    <?php echo $row['course_name'].' '.$row['course_section']?>
                </p>
            </div>
            <div class="field">
                <label>Course Description</label>
                <p>
                    <?php echo $row['course_description']?>
                </p>
            </div>
            <div class="field">
                <label>Term</label>
                <?php echo $row['course_term'].' '.$row['course_year']?>
            </div>
            <div class="field">
                <label>Instructor</label>
                <p>
                    <?php
                        $sql = "select first_name, last_name, email from account where id='".$row['user_id']."'";
                        $result = mysqli_query($conn, $sql);
                        $instructor = mysqli_fetch_assoc($result);
                        echo $instructor['first_name'].' '.$instructor['last_name'];
                    ?>
                </p>
            </div>

            <div class="actions">
                <input class="ui right floated button" type="submit" value="Close">
            </div>
        </form>
    </div>


    <!--delete confirmation-->
    <div class="ui tiny modal" id="deleteCourse-modal">
        <div class="ui header">
            Drop a Course
        </div>
        <div class="content">
            <p>Are you sure you want to drop <b><?php echo $row['course_name'].': '.$row['course_description'];?></b>?</p>
        </div>
        <div class="actions">
            <input class="ui right floated negative button" type="submit" value="Drop">
            <input class="ui right floated cancel button" type="button" value="Cancel">
        </div>
    </div>
