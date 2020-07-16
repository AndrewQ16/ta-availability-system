<?php
use PHPUnit\Framework\TestCase;

if (!function_exists('list_active_staff')) include "../_tools/db/list_active_staff.php";
if (!function_exists('create_staff_activity')) include "../_tools/db/create_staff_activity.php";



class ListActiveStaffTest extends TestCase
{
	
	public function is_staff_active($email, $course, $active_staff) {
		foreach($active_staff as $activity) {
			if(($activity["user_email"] == $email) && ($activity["course_id"] == $course)) {
				return true;
			}
		}
		return false;
	}
	
	public function test_check_known_active()
    {
					
		create_staff_activity(6,4,1,"Davis, 3rd Floor", null);
		$staff = list_active_staff();
		$result = $this->is_staff_active("sachalma@buffalo.edu", 6, $staff);
		$this->assertSame(true, $result);
    }
	
	public function test_check_known_unactive()
    {
		create_staff_activity(6,4,0,"Davis, 3rd Floor", null);
		$staff = list_active_staff();
		$result = $this->is_staff_active("sachalma@buffalo.edu", 6, $staff);
		$this->assertSame(false, $result);
    }
}

?>
