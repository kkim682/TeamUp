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
            $sql = "select * from `course_list` where user_id='".$rows[7]."' order by course_year desc, course_term desc, course_section desc";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a class="item" href="">'; //link to course page
                    echo '    <div class="content">';
                    echo '        <div class="header">';
                    echo $row['course_name'].' '.$row['course_section'];
                    echo '        </div>';
                    echo '        <div class="description">';
                    echo $row['course_description'].
                        '<br>'.ucfirst($row['course_term']).' '.$row['course_year'].
                        '<br>'.$row['team_size'].' Members';
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
