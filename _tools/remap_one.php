<?php
function remap_one($data, $keys) {
    /**
     * Given a dict, this returns a new dict with remapped keys.
     * If the argument is null, returns null.
     */
    if ($data === null) return $data;
    $result = array();
    foreach ($keys as $old => $new) $result[$new] = $data[$old];
    return $result;
}
?>