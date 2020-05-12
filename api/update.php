<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  $post->name = $data->name;
  $post->age = $data->age;
  $post->stdd = $data->std;

  // Update student
  if($post->update()) {
    echo json_encode(
      array('message' => 'student data Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'student data Not Updated')
    );
  }

