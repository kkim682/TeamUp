<?php
        $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
?>
    <!--Course page for professors-->

    <div class="ui container" id="main-wrapper">
        <h2>My Courses</h2>
        <a class="ui primary yellow button" id="newCourse-bttn">
            <div class="content">
                <div class="header">
                    Create a new course
                </div>
            </div>
        </a>
        <div class="ui link items" id="sub-wrapper">

            <!------TODO: dynamically pull course list/info------>
            <a class="item" href="">
                <!--link to "course page"-->
                <div class="content">
                    <div class="header">
                        TeamUp
                    </div>
                    <div class="description">
                        CS3312 <br> 5 Members <br> A Team-formation Tool
                    </div>
                </div>
            </a>
            <!-------------------------------------------------->
        </div>
    </div>


    <!--create a new course modal-->
    <!--will see if there's public API for this -->
    <div class="ui mini modal" id="newCourse-modal">
        <i class="close icon"></i>
        <div class="header">
            Create a New Course
        </div>
        <form class="ui form" id="newCourse-form">
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
                    <select class="ui fluid dropdown" name="Term">
                    <option value="fall">Fall</option>
                    <option value="spring">Spring</option>
                    <option value="summer">Summer</option>                    
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
                <input type="text" name="courseCode" placeholder="ex) <?php echo $rows[0].$rows[1]  ?>">
            </div>

            <div class="actions">
                <input class="ui right floated primary button" type="submit" value="OK">
                <input class="ui right floated cancel button" type="button" value="Cancel">
            </div>
        </form>
    </div>
