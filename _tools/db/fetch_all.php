<?php
if (!function_exists('execute_query')) include "execute_query.php";

function fetch_all() {
    /**
     * Executes a MySQL query and returns the result rows.
     * Rows will be an an array of associative arrays if successful.
     * 
     * Args are as follows:
     * $arg0 : Parameterized query
     * $arg1 : Parameter types
     * $arg2..N: Parameters
     * 
     * ex:
     * fetch_all('SELECT * FROM some_table WHERE foo = ? AND two = ?', 'si', 'bar', 2);
     */
    $result = call_user_func_array('execute_query', func_get_args());
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>