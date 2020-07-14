<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DB.php';
include_once '../../models/User.php';

$db = new DB;
$db = $db->connect();

$user = new User($db);

$result = $user->read();

$num = $result->rowCount();

if ($num > 0) {
	$users_arr = array();
	$users_arr['data'] = array();

	while ($row = $result->fetch()) {
		extract($row);

		$user_item = array(
			'id' => $id,
			'name' => $name,
			'age' => $age,
			'email' => $email,
			'contact' => $contact,
			'updated_at' => $updated_at,
			'created_at' => $created_at
		);

		// push to Data

		array_push($users_arr['data'], $user_item);
	}

	// return to JSON and output

	echo json_encode($users_arr);
} else {
	echo json_encode(
		array('message' => 'No users found.')
	);
}

?>