<?php 
    require "db/accountManagement.php";
    require "include/session.php";

    if (isset($_SESSION['email'])) {
        $account_manager = $_SESSION['account_manager'];
        $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
    } else {
        header('Location:index.php');
    }
?>
<?php
$saveList = array('firstname', 'lastname', 'email', 'password', 'confirmpassword', 'school', 'usertype');
include "include/common.php";

    if (isset($_POST['save'])) {
        $days = determine_days();
        if ($account_manager->updateInfo($_POST[$saveList[0]], $_POST[$saveList[1]], $_POST[$saveList[2]], $_POST[$saveList[3]], 
            $_POST[$saveList[5]], $_POST[$saveList[6]], $days)) {
            echo "success";
        } else {
            echo "failure";
        }
    }

?>
<?php 
    include "site/header.php";
    include "site/sidebar.php";
?>
<div class="ui container" id="editProfile">
    <h1>My Account</h1>
    <p>Please update your profile and click "Save" when you are finished.</p>
    <form method="POST" class="ui form" id="editProfile-form">
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
                <select class="ui fluid dropdown" name="usertype">
                <option value="student" <?php if ($rows[5] == "student") { echo "selected='selected'"; }?>>Student</option>
                <option value="professor" <?php if ($rows[5] == "professor") { echo "selected='selected'"; }?>>Professor</option>  
                </select>
            </div>
        </div>
                <!--TODO: Add Schedule field for days/hours; Will use basic checkboxes for now-->
        <div class="grouped fields">
            <label>Availability</label>
            <div class="ui message">
                <p>Please indicate a day(s) you are available for group meetings.<br>You can update this information later.</p>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="mon" <?php if (strpos($rows[6], 'mon') !== false) { echo "checked";}?>>
                    <label>Monday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="tues" <?php if (strpos($rows[6], 'tues') !== false) { echo "checked";}?>>
                    <label>Tuesday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="wed" <?php if (strpos($rows[6], 'wed') !== false) { echo "checked";}?>>
                    <label>Wednesday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="thur" <?php if (strpos($rows[6], 'thur') !== false) { echo "checked";}?>>
                    <label>Thursday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox checkbox">
                    <input type="checkbox" name="fri" <?php if (strpos($rows[6], 'fri') !== false) { echo "checked";}?>>
                    <label>Friday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox checkbox">
                    <input type="checkbox" name="sat" <?php if (strpos($rows[6], 'sat') !== false) { echo "checked";}?>>
                    <label>Saturday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox checkbox">
                    <input type="checkbox" name="sun" <?php if (strpos($rows[6], 'sun') !== false) { echo "checked";}?>>
                    <label>Sunday</label>
                </div>
            </div>
        </div>
        <div class="actions">
            <input class="ui primary right floated button" type="submit" value="Save" name="save">
            <div class="ui button right floated cancel">Cancel</div>
        </div>
    </form>

</div>

<?php include "site/footer.php";?>
