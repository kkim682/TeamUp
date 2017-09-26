<div class="ui container main-wrapper" id="courseList">
    <h2>My Courses</h2>
    <a class="ui primary button" id="joinCourse-bttn">
        <div class="header">
            Join a Course
        </div>
    </a>
    <div class="ui link items" id="sub-wrapper">

        <?php
            $sql = "select c.course_id, c.course_name, c.course_section, c.course_description, c.course_year, c.course_term, c.course_code, ".
                "u.first_name, u.last_name ".
                "from registered_student_list as r inner join course_list as c on r.course_id=c.course_id ".
                "inner join account as u on c.user_id=u.id ".
                "where r.user_id='".$rows[7]."' ".
                "order by c.course_year asc, c.course_term asc";
            $account_manager->getCourseList($sql);    
            ?>
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
