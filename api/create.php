<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $post->name = $data->name;
  $post->age = $data->age;
  $post->stdd = $data->std;

  // Create student
  if($post->create()) {
    echo json_encode(
      array('message' => 'student data Created')
    );
  } else {
    echo json_encode(
      array('message' => 'student data Not Created')
    );
  }

