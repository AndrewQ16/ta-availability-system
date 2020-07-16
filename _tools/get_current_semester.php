<?php
$semesters = array(
	1 => array("01","25","05","16"),
	2 => array("05","26","08","14"),
	3 => array("08","31","12","22"),
	4 => array("01","04","01","22")
);
function get_current_semester() {
	global $semesters;
	$date = date("Y-m-d");
	$year = date('Y');
	foreach($semesters as $semester => $sched) {
		$start = "$year-$sched[0]-$sched[1]";
		$end = "$year-$sched[2]-$sched[3]";
		if($date >= $start && $date <= $end) {
			return $semester;
		}
	}
	return null;
}

?>
