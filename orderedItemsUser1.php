<?php
  include_once 'db.php';
  $db = new DbConnect();
  $finalResult = array();

    //$cust_id = '2';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $cust_id = $_POST['cust_id'];

$result = mysqli_query($db->getDb(), "select order_id, totalprice, time, status FROM order_t WHERE cust_id = '$cust_id' ");
$row_cnt = mysqli_num_rows($result);

//echo $row_cnt;

$order_id_1 = array();
while($order_id_1 = mysqli_fetch_array($result))
{
  /*echo $order_id_1["order_id"];
  echo $order_id_1["totalprice"];
  echo $order_id_1["time"];
  echo $order_id_1["status"];*/
  $temp = $order_id_1["order_id"];
  //echo "temp";
  //echo $temp;
  $result1 = mysqli_query($db->getDb(), "select order_id, item_id, itemname, quantity from Item NATURAL JOIN (select order_id, item_id, quantity, totalprice, cust_id, status,time from order_t NATURAL JOIN orderDetail where order_id = '$temp') as X ");
  $row_cnt = mysqli_num_rows($result1);
//echo "row count";
//echo $row_cnt;
$response["order_id"] = $order_id_1["order_id"];
$response["totalprice"] = $order_id_1["totalprice"];
$response["time"] = $order_id_1["time"];
$response["status"] = $order_id_1["status"];
$response["details"] = array();
  while ($row = mysqli_fetch_array($result1)) {
        // temp user array

            $product = array();
            $product["item_id"] = $row["item_id"];
            $product["itemname"] = $row["itemname"];
            $product["quantity"] = $row["quantity"];

        // push single product into final response array
        array_push($response["details"], $product);
    }
    array_push($finalResult, $response);
}
echo json_encode($finalResult);
}
else{
  //echo 'error';
  $finalResult["success"] = 0;
  $finalResult["message"] = "ERROR!";
  echo json_encode($response);
}
//select order_id, item_id, itemname, status, time from Item NATURAL JOIN order_t where order_id = '5'
?>
