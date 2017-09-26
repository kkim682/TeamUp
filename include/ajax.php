<?php
require "../db/accountManagement.php";
if(isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])) {
    $username =  $_POST["loginEmail"];
    $password = $_POST['loginPassword'];
    if ($username != "" && $password != "") {
    	$account_manager = new AccountManager;
    	if (!$account_manager->login($_POST['loginEmail'], $_POST['loginPassword'])) {
            echo "invalid";
        }
    }
}
?>