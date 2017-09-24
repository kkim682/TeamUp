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
    
    if ($rows[5]=='professor') {
        include "pages/professor/courses.php";
    } else if ($rows[5]=='student') {
        include  "pages/student/courses.php";
    } else {
        echo "invalid usertype";
    }
    include "site/footer.php";
?>
