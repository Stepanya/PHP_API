<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/DB.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();

  // Instantiate user object
  $user = new User($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $user->name = $data->name;
  $user->age = $data->age;
  $user->email = $data->email;
  $user->contact = $data->contact;

  // Create user
  if($user->create()) {
    echo json_encode(
      array('message' => 'User Added')
    );
  } else {
    echo json_encode(
      array('message' => 'User Not Added')
    );
  }
?>