<?php 
    require "db/accountManagement.php";
    require "include/session.php";

    if (isset($_SESSION['email'])) {
        $GLOBALS['account_manager'] = $_SESSION['account_manager'];
        $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
    } else {
        header('Location:index.php');
    }
?>
<?php
include "include/common.php";

    function save($nameArr, $dayArr, $timeArr) {
        if (isset($_POST['save'])) {
            $days = determine_days($dayArr, $timeArr);
            if ($GLOBALS['account_manager']->updateInfo($_POST[$nameArr[0]], $_POST[$nameArr[1]], $_POST[$nameArr[2]], $_POST[$nameArr[3]], 
                $_POST[$nameArr[5]], $_POST[$nameArr[6]], $days)) {
                echo "success";
            } else {
                echo "failure";
            }
            unset($_POST['save']);
        }
    }

save($nameArr, $dayArr, $timeArr);
?>
<?php 
    include "site/header.php";
    include "site/sidebar.php";
?>
<div class="ui container main-wrapper">
    <h2>My Account</h2>
    <p>Please update your profile and click "Save" when you are finished.</p>
    <form method="POST" class="ui form sub-wrapper">
       <div class="ui error message"></div>
        <div class="field">
            <label>Name</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="firstname" placeholder="First Name" value="<?php echo $rows[0];?>">
                </div>
                <div class="field">
                    <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $rows[1];?>">
                </div>
            </div>
        </div>
        <div class="field">
            <label>Email</label>
            <input type="text" name="email" placeholder="Email" value="<?php echo $rows[2];?>">
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" value="">
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <input type="password" name="password" placeholder="Confirm Password" value="">
        </div>
        <div class="two fields">
            <div class="field">
                <label>School Code</label>
                <input type="text" name="school" placeholder="School Code" value="<?php echo $rows[4];?>">
            </div>
            <div class="field">
                <label>I am a...</label>
                <select class="ui fluid disabled dropdown" name="usertype">
                <option value="student" <?php if ($rows[5] == "student") { echo "selected='selected'"; }?>>Student</option>
                <option value="professor" <?php if ($rows[5] == "professor") { echo "selected='selected'"; }?>>Professor</option>  
                </select>
            </div>
        </div>
        <!--TODO: Place user's schedule-->        
        <div class="grouped fields">
            <label>Availability</label>
            <table class="ui basic padded center aligned table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Morning</th>
                        <th>Afternoon</th>
                        <th>Evening</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    for ($i=0; $i<count($dayArr);$i++){
                        echo "<tr><td>".$dayArr[$i]."</td>";
                        for ($j=0; $j <count($timeArr); $j++){
                            if (strpos($rows[6], ($dayArr[$i].$timeArr[$j]))!== false) {
                                echo "<td><div class='ui fitted checkbox'><input type='checkbox' name='".($dayArr[$i].$timeArr[$j])."' checked><label></label></div></td>";
                            } else {
                                echo "<td><div class='ui fitted checkbox'><input type='checkbox' name='".($dayArr[$i].$timeArr[$j])."'><label></label></div></td>";
                            }
                        }
                        echo "</tr>";
                    }    
                ?>
                </tbody>
            </table>                                                                                                             
        </div>
        <div class="actions">
            <input class="ui primary right floated button" type="submit" value="Save" name="save">
            <input class="ui button right floated cancel" type="reset" value="Cancel">
        </div>
    </form>

</div>

<?php include "site/footer.php";?>
