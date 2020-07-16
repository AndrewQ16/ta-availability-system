<?php
function echo_dropdown_options($arr,$key,$arg1 = null,$arg2 = null) {
	foreach ($arr as $row) {
		$keyval = $row["$key"];
		$val = $arg1 == null ? $row : $row["$arg1"];
		$val = $arg2 == null ? $val : $val . " " . $row["$arg2"];
		echo "<option value='$keyval'>$val</option>";
	}
}
?>
