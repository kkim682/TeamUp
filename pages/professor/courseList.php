<div class="ui container main-wrapper" id="courseList">
    <h2>My Courses</h2>
    <a class="ui primary button" id="createCourse-bttn">
        <div class="header">
            Create a new course
        </div>
    </a>
    <div class="ui link items" id="sub-wrapper">

        <?php
            $sql = "select * from `course_list` where user_id='".$rows[7]."' order by course_year asc, course_term asc, course_section asc";
            $account_manager->getCourseList($sql);
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
                        for ($i=2; $i<6; $i++) {
                            echo "<option value='".$i."'>".$i." people</option>";
                        }
                    ?>
                </select>
        </div>
        <div class="field">
            <label>Course Code</label>
            <input type="text" name="courseCode" id="courseCode" placeholder="ex) <?php echo $rows[0].$rows[1]  ?>">
        </div>

        <div id="myDiv"> </div>

        <script>
        $("#createCourse-form").on('submit', function(event){
            var div = document.getElementById('myDiv');
            div.innerHTML = "";
            var courseCode = $('#courseCode').val();
            var result = "";
            function ajaxCall() {
                var temp = "";
                $.ajax({
                    url:'../include/student_course.php',
                    type:'POST',
                    async: false,
                    data: {courseCode:courseCode},
                    success: function(response){
                        temp = response;
                    },
                    error: function(response){
                        alert("no connection to DB");
                    }
                })
                return temp;
            }
            result = ajaxCall();
            if (result === "") {
            } else {
                div.innerHTML = "<div class='ui negative message'>Duplicate Course Code</div>";
                return false;
            }
        })

        </script>

        <div class="actions">
            <input class="ui right floated primary button" type="submit" value="OK">
            <input class="ui right floated cancel button" type="button" value="Cancel">
        </div>
    </form>
</div>
