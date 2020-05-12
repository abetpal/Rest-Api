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

  // student post query
  $result = $post->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any student
  if($num > 0) {
    // Post array
    $posts_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'name' => $name,
        'age' => $age,
        'std' => $stdd
      );

      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No student
    echo json_encode(
      array('message' => 'No student Found')
    );
  }
