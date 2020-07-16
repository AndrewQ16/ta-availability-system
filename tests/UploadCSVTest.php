<?php
use PHPUnit\Framework\TestCase;

if (!function_exists('register_staff_from_csv')) include "../_tools/register_staff_from_csv.php";
if (!function_exists('list_courses_and_staff')) include "../_tools/db/list_courses_and_staff.php";
if (!function_exists('get_user_by_email')) include "../_tools/db/get_user_by_email.php";
if (!function_exists('cascade_delete_user')) include "../_tools/db/cascade_delete_user.php";
if (!function_exists('delete_course_staff')) include "../_tools/db/delete_course_staff.php";




class UploadCSVTest extends TestCase
{
	
	public function destroy() {
		$uid = get_user_by_email("pbeasley@dmifflin.com")["uid"];
		delete_course_staff(2, $uid);
		cascade_delete_user($uid);
		$uid = get_user_by_email("kmalone@dmifflin.com")["uid"];
		delete_course_staff(2, $uid);
		cascade_delete_user($uid);
		$uid = get_user_by_email("jlevinson@dmifflin.com")["uid"];
		delete_course_staff(2, $uid);
		cascade_delete_user($uid);
	}
	
	public function check_exists($arr, $kvs) {
		foreach($arr as $row) {
			$found = true;
			foreach ($kvs as $key => $value) {
				if($row["$key"] !== $value) {
					$found = false;
				}
			}
			if($found) {
				return true;
			}
		}
		return false;
	}
	
	public function test_valid_csv()
    {
		$file = "../data/test_data.csv";
		register_staff_from_csv($file, 2);
		$course_staff = list_courses_and_staff();
		
		$kvs = array (
			"user_email" => "pbeasley@dmifflin.com",
			"user_name" => "Pam Beasley"
		);
		$result = $this->check_exists($course_staff, $kvs);
		$this->assertSame(true, $result);
		
		$kvs = array (
			"user_email" => "kmalone@dmifflin.com",
			"user_name" => "Kevin Malone"
		);
		$result = $this->check_exists($course_staff, $kvs);
		$this->assertSame(true, $result);
		
		$kvs = array (
			"user_email" => "jlevinson@dmifflin.com",
			"user_name" => "Jan Levinson"
		);
		$result = $this->check_exists($course_staff, $kvs);
		$this->assertSame(true, $result);
		
		$this->destroy();
	}
	
	public function test_bad_row()
    {
		$file = "../data/test_data.csv";
		register_staff_from_csv($file, 2);
		$course_staff = list_courses_and_staff();
		
		$kvs = array (
			"user_name" => "Bad51 Email"
		);
		$result = $this->check_exists($course_staff, $kvs);
		$this->assertSame(false, $result);
		
		$this->destroy();
    }
}

?>
