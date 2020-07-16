<?php
function remap_all($data, $keys) {
    /**
     * Given an array of dicts, this returns
     * a new array of dicts, where the keys
     * are renamed according to $keys.
     * 
     * ex:
     * $data = array(
     *   array("foo" => 123, "bar" => 456, "baz" => 789),
     *   array("foo" => 'hello', "bar" => 'world', "baz" => null),
     * );
     * $keys = array("foo" => "baba", "bar" => "loo");
     * remap_all($data, $keys) returns array(
     *   array("baba" => 123, "loo" => 456),
     *   array("baba" => 'hello', "loo" => 'world'),
     * );
     */
    $result = array();
    foreach ($data as $row) {
        $mapping = array();
        foreach ($keys as $old => $new) {
            $mapping[$new] = $row[$old];
        }
        array_push($result, $mapping);
    }
    return $result;
}
?>