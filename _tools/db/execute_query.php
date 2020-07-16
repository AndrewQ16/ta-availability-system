<?php
include "mysql_connection.php";

function execute_query() {
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
     * execute_query('SELECT * FROM some_table WHERE foo = ? AND two = ?', 'si', 'bar', 2);
     */
    global $conn;
    $stmt = $conn->prepare(func_get_arg(0));
    if (func_num_args() > 1) $stmt->bind_param(...array_slice(func_get_args(), 1));
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
?>