<?php
    require "db/db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
?>
    <!--course list-->

    <div class="ui container main-wrapper" id="courseList">
        <h2>My Courses</h2>
        <a class="ui primary button" id="joinCourse-bttn">
            <div class="header">
                Join a Course
            </div>
        </a>
        <div class="ui link items" id="sub-wrapper">
          
           <!--Pull course info-->
            <a class="item course">
                <div class="content">
                    <div class="header">
                        Course Name
                    </div>
                    <div class="description">
                        Course Description <br> Semester <br> Instructor
                    </div>
                </div>
            </a>

        </div>
    </div>

    <div class="ui mini modal" id="joinCourse-modal">
        <i class="close icon"></i>
        <div class="header">
            Join a New Course
        </div>
        <form method="POST" class="ui form" id="joinCourse-form">
            <div class="ui error message"></div>
            <div class="ui info message">
                <p>Please write a course code provided by your instructor.</p>
            </div>
            <div class="field">
                <label>Course Code</label>
                <input type="text" name="courseCode" id="courseCode">
            </div>

            <div class="actions">
                <input class="ui right floated primary button" type="submit" value="OK">
                <input class="ui right floated cancel button" type="button" value="Cancel">
            </div>
        </form>
    </div>