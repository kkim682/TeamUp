<?php include "site/header.php";
require "db/accountManagement.php" ?>

<?php 
$account_manager = new AccountManager;

//TO DO: Remove error messages for input type validation, except invalid login credentials
$error_condition = False;
$registerList = array('firstname', 'lastname', 'email', 'password', 'confirmpassword', 'school', 'usertype');
if (isset($_POST[$registerList[0]])) {
    for ($i = 0; $i < count($registerList); $i++) {
        if ($_POST[$registerList[$i]] == "") {
            $error_condition = True;
            if (!isset($error_msg)) {
                $error_msg = "";
            }
            $error_msg = $error_msg . " " . $registerList[$i];
        }
    }
    if (!$error_condition) {
        if ($_POST[$registerList[3]] != $_POST[$registerList[4]]) {
            $error_msg = "Password does not match";
        } else {
            $account_manager->register($_POST[$registerList[0]], $_POST[$registerList[1]], $_POST[$registerList[2]], $_POST[$registerList[3]], $_POST[$registerList[5]], $_POST[$registerList[6]]);
        }
    }
}

if (isset($_POST['loginEmail'])) {
    if ($_POST['loginEmail'] == "" || $_POST['loginPassword'] == "") {
        $error_msg = "Either email or password is missing";
    } else {
        if (!$account_manager->login($_POST['loginEmail'], $_POST['loginPassword'])) {
            $error_msg = "Invalid email or password";
        } else {
           header('Location: account.php');  //TO DO: start session; change location to teams.php (once implemented)
        } 
    }
}

?>

<div class="ui container">
    <div class="ui borderless huge menu">
        <a class="header item topbar" id="logo" href="index.php"><img src="img/logo.png" alt="Logo" style="height:40px; width: auto"></a>
        <a class="item"> About </a>
        <a class="item"> Features </a>
        <a class="item"> Contact </a>
        <div class="right menu">
            <div class="item" id="signUp-bttn">
                <div class="ui big basic yellow button">Sign Up</div>
            </div>
            <div class="item" id="login-bttn">
                <div class="ui big basic button">Login</div>
            </div>
        </div>
    </div>
</div>
<div class="hero">
    <div class="ui text container">
        <div id="banner-content">
            <h1>FIND THE PERFECT TEAMMATES.</h1>
            <p>TeamUp helps students find teammates on skills, interests, and availability.</p>
        </div>
        <img id="banner-img" src="img/landing/banner-img.svg" alt="Banner image">
        <div class="item" id="getStarted-bttn">
            <div class="ui big yellow button">Get Started</div>
        </div>
    </div>
</div>

<!--login modal-->
<div class="ui mini modal" id="login-modal">
    <i class="close icon"></i>
    <div class="header">
        Login
    </div>
    <form method="POST" class="ui form" id="login-form">
        <div class="ui error message"></div>
        <div class="field">
            <label>Email</label>
            <input type="text" name="loginEmail" placeholder="Email">
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="loginPassword" placeholder="Password">
        </div>

        <!--TO DO: Validate login info without refreshing page (AJAX?)-->
        <!--TO DO: Reset all forms upon closing modals-->
        <?php if (isset($error_msg)) {
            echo "<div class='ui negative message'>".$error_msg."</div>";
        }?>

        <div class="actions">
            <input class="ui right floated primary button" type="submit" id="login" value="OK">
            <input class="ui right floated cancel button" type="button" value="Cancel">
        </div>

    </form>
</div>

<!--register modal-->
<div class="ui small modal" id="signUp-modal">
    <i class="close icon"></i>
    <div class="header">
        Sign Up
    </div>
    <form method="POST" class="ui form" id="signUp-form">

        <div class="ui error message"></div>
        <div class="field">
            <label>Name</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="firstname" placeholder="First Name">
                </div>
                <div class="field">
                    <input type="text" name="lastname" placeholder="Last Name">
                </div>
            </div>
        </div>
        <div class="field">
            <label>Email</label>
            <input type="text" name="email" placeholder="Email">
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <input type="password" name="confirmpassword" placeholder="Confirm Password">
        </div>
        <div class="two fields">
            <div class="field">
                <label>School Code</label>
                <input type="text" name="school" placeholder="School Code">
            </div>
            <div class="field">
                <label>I am a...</label>
                <select class="ui fluid dropdown" name="usertype">
                <option value="student">Student</option>
                <option value="professor">Professor</option>  
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
                    <input type="checkbox" name="mon">
                    <label>Monday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="tues">
                    <label>Tuesday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="wed">
                    <label>Wednesday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="thur">
                    <label>Thursday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox checkbox">
                    <input type="checkbox" name="fri">
                    <label>Friday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox checkbox">
                    <input type="checkbox" name="sat">
                    <label>Saturday</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox checkbox">
                    <input type="checkbox" name="sun">
                    <label>Sunday</label>
                </div>
            </div>
        </div>

        <div class="actions">
            <input class="ui primary right floated button" type="submit" value="OK">
            <input class="ui right floated cancel button" type="button" value="Cancel">
        </div>
    </form>
</div>

<?php include "site/footer.php"; ?>
