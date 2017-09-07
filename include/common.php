<?php
    function determine_days() {
        $days = "";
        $foundDay = False;
        $dayList = array("mon", "tues", "wed", "thur", "fri", "sat", "sun");
        for ($i = 0; $i < sizeof($dayList); $i++) {
            if (isset($_POST[$dayList[$i]])) {
                if (!$foundDay) {
                    $days = $days . $dayList[$i];
                    $foundDay = True;
                } else {
                    $days = $days . "," . $dayList[$i];
                }
            }
        }
        return $days;
    }
?>