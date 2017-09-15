<?php 
    require "db/accountManagement.php";
    require "include/session.php";

    if (isset($_SESSION['email'])) {
        $account_manager = $_SESSION['account_manager'];
        $rows = $account_manager->retrieveAccountInfo($_SESSION['email']);
    } else {
        header('Location:index.php');
    }
    include "site/header.php";
    include "site/sidebar.php";
?>

<!--Note: This page is rough-->
<div class="ui container" id="main-wrapper">
    <h2>My Teams</h2>
    <!--TODO: dynamically pull teams list/info-->
    <div class="ui link items" id="sub-wrapper">

        <a class="item" href="">
            <!--link to "course page"-->
            <div class="content">
                <div class="header">
                    Team Name
                </div>
                <div class="description">
                    Course Name <br> # Members <br> Project Description

                </div>
            </div>
        </a>
        
        <a class="item" href="">
            <div class="content">
                <div class="header">
                    TeamUp
                </div>
                <div class="description">
                    CS3312 <br> 5 Members <br> A Team-formation Tool
                </div>
            </div>
        </a>
    </div>
</div>
