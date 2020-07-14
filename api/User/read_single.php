<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/DB.php';
  include_once '../../models/User.php';

  $database = new DB();
  $db = $database->connect();

  // Instantiate blog post object
  $user = new User($db);

  // Get ID
  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $user->read_single();

  // Create array
  $user_arr = array(
    'id' => $user->id,
    'name' => $user->name,
    'age' => $user->age,
    'email' => $user->email,
    'contact' => $user->contact,
    'updated_at' => $user->updated_at,
    'created_at' => $user->created_at
  );

  // Make JSON
  print_r(json_encode($user_arr));

?>