<?php

$nameArr = array('firstname', 'lastname', 'email', 'password', 'confirmpassword', 'school', 'usertype');
$dayArr=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
$timeArr=array('Morning','Afternoon','Evening');

    function determine_days($dayArr, $timeArr) {
        $days = "";
        $foundDay = False;
        for ($i=0; $i<count($dayArr);$i++){
            for ($j=0; $j <count($timeArr); $j++){
                if (isset($_POST[$dayArr[$i].$timeArr[$j]])) {
                    if (!$foundDay) {
                        $days = $days . $dayArr[$i].$timeArr[$j];
                        $foundDay = True;
                    } else {
                        $days = $days . "," . $dayArr[$i].$timeArr[$j];
                    }
                    unset($_POST[$dayArr[$i].$timeArr[$j]]);
                }            
            }
        }    
        return $days;
    }
?>