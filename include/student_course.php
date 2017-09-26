<?php
//This page is for ajax use only
require("../db/accountManagement.php");
$account_manager = new AccountManager;
if (isset($_POST['courseCode'])) {
    $courseInfo = $account_manager->retrieveCourseInfoByCode($_POST['courseCode']);
    echo $courseInfo;
}
?>