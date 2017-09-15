<?php
if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 1) {
        session_destroy();
        header('location:index.php');   
    }
}
?>
<div class="ui sidebar inverted vertical menu">
    <img class="ui tiny circular image centered" src="img/default.jpg" style="margin: 25px auto 15px auto" alt="Placeholder default profile photo">
    <div class="item" style="text-align:center;">
        <h3>
            <a href="account.php"> <?php echo $rows[0].' '.$rows[1];?></a>
        </h3>
    </div>
    <a class="item" style="text-align:center;" href="teams.php"> My Teams </a>
    <a class="item" style="text-align:center;" href="courses.php"> My Courses </a>
    <a class="item" style="text-align:center;" href="account.php"> My Account </a>
    <a class="item" style="text-align:center;" href="?logout=1"> Logout </a>
</div>

<div class="pusher">
    <div class="ui container">
        <div class="ui borderless menu">
            <button id="menu" class="ui icon button topbar sidemenu"><i class="sidebar icon"></i></button>
            <a class="header item topbar" id="logo"
                <?php if (isset($_SESSION['email'])) {
                    echo('href="teams.php"');
                } else {
                    echo('href="index.php"');
                }?>
                ><img src="img/logo.png" alt="sd" style="height:40px; width: auto"></a>
        </div>

    </div>
