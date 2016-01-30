<?php

  include_once 'db.php';
  $response = array();
   $db = new DbConnect();
  if($_SERVER['REQUEST_METHOD']=='POST'){
    //Getting values
    $username = $_POST['email'];
    $password = $_POST['password'];
    //$username = 'ksh@gmail.com';
    //$password = 'a';
//echo "hi";
    //Creating sql query
    $sql = "SELECT * FROM customer WHERE (email='$username' || phnum = '$username') AND passwd='$password'";
    echo "hello";
    //importing dbConnect.php script



    //executing query
    $result = mysqli_query($db->getDb(),$sql);

    //fetching result
    $check = mysqli_fetch_array($result);
    //echo $check;
    //if we got some result
    if(isset($check)){
      //displaying success
      //echo "success";
      $response["success"] = 1;
      echo json_encode($response);
    }else{
      //displaying failure
      //echo "failure";
      $response["success"] = 0;
      $response["message"] = "No products found";
      echo json_encode($response);
    }
  }
?>
