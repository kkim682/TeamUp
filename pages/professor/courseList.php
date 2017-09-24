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
                        '<br>'.'# Students'; //Add number of students registered for the course
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