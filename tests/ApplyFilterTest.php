
<?php
use PHPUnit\Framework\TestCase;

include 'ApplyFilterUtils.php';
global $vars;
$vars = array();



class ApplyFilterTest extends TestCase
{
	public function init_courses() {
		$course1 = array (
			"Course ID" => 123,
			"Course Code" => "CSE",
			"Course Number" => 123,
		);
		$course2 = array (
			"Course ID" => 125,
			"Course Code" => "APY",
			"Course Number" => 329,
		);
		$course3 = array (
			"Course ID" => 126,
			"Course Code" => "CSE",
			"Course Number" => 323,
		);
		return array($course1, $course2, $course3);
	}
	public function setup_courses() {
		$courses = $this->init_courses();
		global $vars;
		$vars["courses"] = $courses;
	}
	public function test_filter_by_course_id()
    {
		global $vars;
		$this->setup_courses();
		apply_filter("courses", 'course_id_filter_123');
		$this->assertSame(1, count($vars["courses"]));
    }
	public function test_filter_by_course_code()
    {
		global $vars;
		$this->setup_courses();
		apply_filter("courses", 'course_code_filter_CSE');
		$this->assertSame(2, count($vars["courses"]));
    }
	public function test_filter_by_course_number()
    {
		global $vars;
		$this->setup_courses();
		apply_filter("courses", 'course_number_filter_323');
		$this->assertSame(1, count($vars["courses"]));
    }
}

?>
