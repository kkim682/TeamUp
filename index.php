<?php
require "include/session.php";
require "db/accountManagement.php";
require "include/common.php";
error_reporting(E_ALL); ini_set('display_errors', '1');

$GLOBALS['account_manager'] = new AccountManager;

    function handleLogin() { //returns message if wrong, else return nothing
        if (isset($_POST['loginEmail'])) {
            if ($_POST['loginEmail'] == "" || $_POST['loginPassword'] == "") {
                $error_msg = "Either email or password is missing"; //already validated on client-side
            } else {
                if (!$GLOBALS['account_manager']->login($_POST['loginEmail'], $_POST['loginPassword'])) {
                    return "Invalid email or password";
                } else {
                    $_SESSION['email'] = $_POST['loginEmail'];
                    $_SESSION['account_manager'] = $GLOBALS['account_manager'];
                    header('Location:courses.php'); 
                    return;
                } 
            }
            unset($_POST['loginEmail']);
        }
    }

    function handleRegister($nameArr, $dayArr, $timeArr) {
        if (isset($_POST[$nameArr[0]])) {
            if ($GLOBALS['account_manager']->verifyEmail($_POST[$nameArr[2]]) == 0) { //Email check needs to be done client side
                $days=determine_days($dayArr, $timeArr);
                $GLOBALS['account_manager']->register($_POST[$nameArr[0]], $_POST[$nameArr[1]], $_POST[$nameArr[2]],
                $_POST[$nameArr[3]], $_POST[$nameArr[5]], $_POST[$nameArr[6]], $days);
            } else {
                echo "Duplicate Email"; //Error message needs to be generated client side
            }
            for ($i = 0; $i < sizeof($nameArr); $i++) {
                unset($_POST[$nameArr[$i]]);
            }
        }
    }

if (isset($_SESSION['email'])) {
    header('Location:courses.php');
}

handleRegister($nameArr, $dayArr, $timeArr);
$error_msg = handleLogin();

include "site/header.php";
?>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
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
            <input id="loginEmail" type="text" name="loginEmail" placeholder="Email">
        </div>
        <div class="field">
            <label>Password</label>
            <input id="loginPassword" type="password" name="loginPassword" placeholder="Password">
        </div>
        <div id="myDiv"></div>
        <div class="actions">
            <input class="ui right floated primary button" type="submit" id="login" value="OK">
            <input class="ui right floated cancel button" type="button" value="Cancel">
        </div>
    <script>
        $("#login-form").on('submit', function(event){
            /*
             * do ajax logic  -> $.post is a shortcut for the basic $.ajax function which would automatically set the method used to being post
             * $.get(), $.load(), $.post() are all variations of the basic $.ajax function with parameters predefined like 'method' used in the ajax call (get or post)
             * i mostly use the $.ajax function so i'm not to sure extending the $.post example with an addition .error() (as Kristof Claes mentions) function is allowed
             */
            var div = document.getElementById('myDiv');
            div.innerHTML = "";
            var loginEmail = $('#loginEmail').val()
            var loginPassword = $('#loginPassword').val()
            var result = "";
            function ajaxCall() {
                var temp = "";
                $.ajax({
                    url:'include/ajax.php',
                    type:'POST',
                    async: false,
                    data: {loginEmail:loginEmail, loginPassword:loginPassword},
                    success: function(response){
                        temp = response;
                    },
                    error: function(response){
                        //as far as i know, this function will only get triggered if there are some request errors (f.e: 404) or if the response is not in the expected format provided by the dataType parameter
                        alert("no connection to DB");
                    }
                })
                return temp;
            }
            result = ajaxCall();
            if (result == "invalid") {
                var div = document.getElementById('myDiv');
                div.innerHTML = "<div class='ui negative message'>Invalid email or password</div>";
                return false;
            }
        })
    </script>
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
        
        <div class="grouped fields">
            <label>Availability</label>
            <div class="ui info message">
                <p>Please indicate a day(s) you are available for group meetings.<br>You can update this information later.</p>
            </div>
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
                            echo "<td><div class='ui fitted checkbox'><input type='checkbox' name='".$dayArr[$i].$timeArr[$j]."'><label></label></div></td>";
                        }
                        echo "</tr>";
                    }    
                ?>
                </tbody>
            </table>                                                                                                             
        </div>
       
        <div class="actions">
            <input class="ui primary right floated button" type="submit" value="OK">
            <input class="ui right floated cancel button" type="button" value="Cancel">
        </div>
    </form>
</div><?php include "site/footer.php";?>
