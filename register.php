<?php
include_once 'db.php';
$db = new DbConnect();
  $response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $phnum = $_POST['phnum'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];

    //$name = 'kshitij sharma';
    //$phnum = '9662035550';
    //$address = 'qwerty';
    //$email = 'ksh1@gmail.com';
    //$passwd = 'qwerty';

    if($name == '' || $phnum == '' || $address == '' || $email == '' || $passwd == '' ){
      //echo 'please fill all values';
    }else{
      $sql = "SELECT * FROM customer WHERE (email='$email' || phnum = '$phnum')";

      $check = mysqli_fetch_array(mysqli_query($db->getDb(),$sql));

      if(isset($check)){
        //echo 'username or email already exist';
      }else{
        $sql = "INSERT INTO customer (name,phnum,address,email,passwd,active,isAdmin,time) VALUES('$name','$phnum','$address','$email','$passwd','1','0',NOW())";
        if(mysqli_query($db->getDb(),$sql)){
          //echo 'successfully registered';
          $response["success"] = 1;
          echo json_encode($response);
        }else{
          //echo 'oops! Please try again!';
          $response["success"] = 0;
          $response["message"] = "No products found";
          echo json_encode($response);
        }
      }
    }
}else{
  //echo 'error';
  $response["success"] = 0;
  $response["message"] = "ERROR!";
  echo json_encode($response);
}
?>
