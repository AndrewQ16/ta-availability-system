<?php
function echo_table($data) {
    /**
     * Echoes a list of dicts as a HTML table.
     * If the list is empty, prints nothing
     */
    if (count($data) === 0) return;

    // Open table
    echo '<table>';

    // Print table headers
    $headers = array_keys($data[0]);
    echo '<tr>';
    foreach ($headers as $hdr) echo '<th>' . $hdr . '</th>';
    echo '</tr>';

    // Print table data
    foreach ($data as $row) {
      echo '<tr>';
      foreach ($headers as $hdr) echo '<td>' . strval($row[$hdr]) . '</td>';
      echo '</tr>';
    }

    // Close table
    echo '</table>';
}
?>