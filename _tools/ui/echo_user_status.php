<?php

//Displays a user's status
//$data = association array of result from 'staff_activity'
function echo_user_status($data){
    if (count($data) === 0) return;
    

    echo '<h3>Currently working:</h3>';
    echo 'Class: ';

    //hacky way to display one row but the way the $data is created, this is the quickest
    foreach($data as $row){
        echo $row['Prefix'];
        echo $row['Number'] . ".<br>";
        if($row['Is location a link'] == 1){
            echo "At an online location: ";

            $link = $row['Location'];

            if(strcmp(substr($link,0, 4), "http") !== 0){
                $link = "https://" . $link;
            } 

            echo "<a href='" . $link . "'>" . $link . "</a>";
            
        } else {

            echo "At a physical location: ";
            echo $row['Location'] . "<br>";
        }
    }
}
?>


