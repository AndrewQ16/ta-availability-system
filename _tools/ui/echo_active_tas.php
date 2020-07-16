<?php
if (!function_exists('echo_user_avatar')) include "echo_user_avatar.php";
function echo_active_tas($data, $root) {
    /**
     * Echoes a list of dicts as a HTML table.
     * If the list is empty, prints nothing
     */
    if (count($data) === 0) return;

    // Open table
    echo '<table border = "1px">';

    // Print table headers
    $headers = array("Name", "Course", "Location", "End Time", "Profile Pic");
    echo '<tr>';
    foreach ($headers as $hdr) echo '<th>' . $hdr . '</th>';
    echo '</tr>';

    // Print table data
    foreach ($data as $row) {
		$course =strval($row["course_prefix"])." ".strval($row["course_number"]);
		echo '<tr>';
		echo '<td>' . strval($row["user_name"]) . '</td>';
    echo '<td>' . $course . '</td>';
    
    $link = $row["location"];
    if($row["is_location_link"] == 1){
      if(strcmp(substr($row["location"],0, 4), "http") !== 0){
        $link = "https://" . $link;
      } 
      echo '<td><a href=\'' . $link . '\'>' ."Office Hours Link" . '</a>'; 
    } else {
      echo '<td>' . strval($link) . '</td>';  
    }
		
    

    
    echo '<td>' . strval($row["end_time"]) . '</td>';
		echo '<td>';
		echo_user_avatar($root, $row["user_id"], $max_width="50px", $max_height="50px");
		echo '</tr>';
    }
    // Close table
    echo '</table>';

}
?>