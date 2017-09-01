<?php 
    include "site/header.php";
    include "site/sidebar.php";
?>

<!--TO DO: Pull user's information in the fields-->
<div class="ui container" id="editProfile">
    <h1>My Account</h1>
    <p>Please update your profile and click "Save" when you are finished.</p>
    <form class="ui form" id="editProfile-form">
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
        <div class="ui primary right floated button">Save</div>
        <div class="ui button right floated cancel">Cancel</div>
        <!--TO DO: validate inputs and update user information.-->
    </div>

</div>

<?php include "site/footer.php";?>
