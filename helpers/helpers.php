<?php
function display_errors($errors){
  $display ='<ul class="bg-warning">';
  foreach($errors as $error){
    $display .='<li class="text-danger">'.$error.'</li>';
  }
  $display .= '</ul>';
  return $display;
}
function  sanitize($dirty){
  return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function money($number){
	return '$'.number_format($number,2);
}

//admin
function login($user_id){
	$_SESSION['SBAdmin'] = $user_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE admin SET last_login = '$date' WHERE id = '$user_id'");
	$_SESSION['success_flash'] = 'You have successfully logged in';
	header('Location: index.php');
}

function is_logged_in(){
	if(isset($_SESSION['SBAdmin']) && $_SESSION['SBAdmin'] > 0){
		return true;
	}
		return false;
	}


function login_error_redirect($url = 'login.php'){
	$_SESSION['error_flash'] = 'You must login to access the page!';
	header('Location: ' .$url);
}
function permission_error_redirect($url = 'index.php'){
	$_SESSION['error_flash'] = 'You do not have permission to access that page!';
	header('Location: ' .$url);
}


function has_permission($permission = 'admin'){
	global $user_data;
		$permissions = explode(',', $user_data['permissions']);
		if (in_array($permission, $permissions,true)) {
			return true;

		}
		 return false;
	}
//lecturar function
	function lectlogin($lecturar_id){
	$_SESSION['LECturar'] =  $lecturar_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE lecturar SET last_login = '$date' WHERE id = '$lecturar_id'");
	$_SESSION['success_flash'] = 'You have successfully logged in';
	header('Location: index.php');
}

function is_lectlogged_in(){
	if(isset($_SESSION['LECturar']) && $_SESSION['LECturar'] > 0){
		return true;
	}
		return false;
	}


function lectlogin_error_redirect($url = 'login.php'){
	$_SESSION['error_flash'] = 'You must login to access the page!';
	header('Location: ' .$url);
}
function lectpermission_error_redirect($url = 'index.php'){
	$_SESSION['error_flash'] = 'You do not have permission to access that page!';
	header('Location: ' .$url);
}


function has_permission_lect($permission = 'lecturar'){
	global $lecturar_data;
		$permissions = explode(',', $lecturar_data['permissions']);
		if (in_array($permission, $permissions,true)) {
			return true;

		}
		 return false;
	}

	
	// student function check
	function studentlogin($student_id){
	$_SESSION['STuser'] = $student_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE student SET last_login = '$date' WHERE id = '$student_id'");
	$_SESSION['success_flash'] = 'You have successfully logged in';
	header('Location: dashboard.php');
}

function is_Slogged_in(){
	if(isset($_SESSION['STuser']) && $_SESSION['STuser'] > 0){
		return true;
	}
		return false;
	}


function stdlogin_error_redirect($url = 'login.php'){
	$_SESSION['error_flash'] = 'You must login to access the page!';
	header('Location: ' .$url);
}
// function Vpermission_error_redirect($url = 'visitorlogin.php'){
// 	$_SESSION['error_flash'] = 'You do not have permission to access that page!';
// 	header('Location: ' .$url);
// }

// function has_permissionVisitor($permissions = 'visitor'){
// 	global $visitor_data;
// 		$permissioned = explode(',', $visitor_data['permissioned']);
// 		if (in_array($permissions, $permissioned,true)) {
// 			return true;

// 		}
// 		 return false;
// 	}

//   function has_permissionfpi($permissions = 'fpi'){
//   	global $visitor_data;
//   		$permissioned = explode(',', $visitor_data['permissioned']);
//   		if (in_array($permissions, $permissioned,true)) {
//   			return true;

//   		}

//   		 return false;
//   	}
//     function Fpipermission_error_redirect($url ='index.php'){
//     	$_SESSION['error_flash'] = 'Page for Computer Science Student FPI Only!';
//       header("Location: ".$url);
//     	return false;
//     }



	function pretty_date($date){
		return date("M d, Y h:i A", strtotime($date));
	}
	function pretty_dates($dates){
		return date("M d, Y ", strtotime($dates));
	}
	function pretty_datee($dates){
		return date(" h:i A ", strtotime($dates));
	}

	function get_category($child_id){
		global $db;
		$id = sanitize($child_id);
		$sql = "SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child'
			FROM categories c
			INNER JOIN categories p
			ON c.parent = p.id
			WHERE c.id = '$id'";
		$query = $db->query($sql);
		$category = mysqli_fetch_assoc($query);
		return $category;
	}

   function sizeToarray($string){
     $sizeArray = explode(',',$string);
     $returnArray = array();
     foreach ($sizesArray as $size) {
       $s = explode(':',$size);
       $returnArray[] = array('size' => $s[0], 'quantity' => $s[1]);
     }
     return $returnArray;
   }

   function sizesToString(){
    $sizeString = '';
    foreach ($sizes as $size) {
      $sizeString .= $size['size'].':'.$size['quantity'].',';
      $trimmed = rtrim($sizeString, ',');
      return $trimmed;
    }
   }





  ?>
