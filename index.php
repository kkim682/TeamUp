<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title> Team Up</title>
    <link rel="stylesheet" type="text/css" href="lib/semantic/semantic.css">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="lib/semantic/semantic.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>

<body>
    <div class="ui container">
        <div class="ui borderless huge menu">
            <a class="header item topbar" href="index.php"><img src="img/logo.png" alt="sd" style="height:40px; width: auto"></a>
            <a class="item"> About </a>
            <a class="item"> Features </a>
            <a class="item"> Contact </a>
            <div class="right menu">
                <div class="item" id="signup">
                    <div class="ui basic yellow button">Sign up</div>
                </div>
                <div class="item" id="login">
                    <div class="ui basic button">Login</div>
                </div>
            </div>
        </div>
    </div>
    <div class="landing-wrapper">
    </div>

    <!--login modal-->
    <div class="ui mini modal login">
        <i class="close icon"></i>
        <div class="header">
            Login
        </div>
        <form class="ui form login-form">
            <div class="field">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
            </div>
        </form>
        <div class="actions">
            <div class="ui button cancel">Cancel</div>
            <div class="ui primary button">OK</div>
            <!--TO DO: validate inputs and proceed to dashboard.php-->
        </div>
    </div>

    <!--register modal-->
    <div class="ui small modal signup">
        <i class="close icon"></i>
        <div class="header">
            Sign Up
        </div>
        <form class="ui form signup-form">
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
                <input type="password" name="password" placeholder="Confirm Password">
            </div>
            <div class="two fields">
                <div class="field">
                    <label>School Code</label>
                    <input type="text" name="school" placeholder="School Code">
                </div>
                <div class="field">
                    <label>I am a...</label>
                    <select class="ui fluid dropdown">
                <option value="student">Student</option>
                <option value="professor">Professor</option>  
                    </select>
                </div>
            </div>
        </form>
        <div class="actions">
            <div class="ui button cancel">Cancel</div>
            <div class="ui primary button">OK</div>
            <!--TO DO: validate inputs, complete registration, and proceed to dashboard.php-->
        </div>
    </div>

</body>

</html>
