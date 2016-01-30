<?php

include_once 'db.php';
  $db = new DbConnect();
  $response = array();
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $order_id = $_POST['order_id'];

    $result = mysqli_query($db->getDb(), "UPDATE order_t SET status =1 where order_id = '$order_id'");
    $response["success"] = 1;
    echo json_encode($response);
}
else{
$response["success"] = 0;
    $response["message"] = "No orders found";

    // echo no users JSON
    echo json_encode($response);
}

?>
