<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/student.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate student post object
  $post = new student($db);

  // Get ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get student
  $post->read_single();

  // Create array
  $post_arr = array(
    'id' => $post->id,
    'name' => $post->name,
    'age' => $post->age,
    'std' => $post->stdd,
  );

  // Make JSON
  print_r(json_encode($post_arr));