<div class="pusher">
    <!--course page-->
    <?php
        $sql = "select * from `course_list` where course_code='".$_GET["code"]."' order by course_year desc, course_term desc, course_section desc";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
        <div class="ui container main-wrapper" id="coursePage">
            <h2>
                <?php echo $row['course_name']?>
            </h2>
            <p>
                <?php echo $row['course_description']." / ".$row['course_term']." ".$row['course_year']?>
            </p>
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
                <div class="ui link items" id="sub-wrapper">
                    <a class="item">
                        <div class="content">
                            <div class="header">
                                Ah Jin Noh
                            </div>
                        </div>
                    </a>
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
