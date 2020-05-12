<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/student.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate student post object
  $post = new student($db);

  // Get raw student data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id = $data->id;

  // Delete student
  if($post->delete()) {
    echo json_encode(
      array('message' => 'Student data Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'student data Not Deleted')
    );
  }

