<?php
  include_once 'db.php';
    $db = new DbConnect();
$response = array();



$data1 = '{"products":[{"Item_id":"1","quantity":"10"},{"Item_id":"3","quantity":"20"},{"Item_id":"5","quantity":"10"}],"totalprice":100, "cust_id":2}';
//echo $data;
echo "\n\n";

$manage = json_decode($data1);

//$jsonRS = var_dump($manage,true);
//echo $jsonRS->products->Item_id;

//echo $jsonRS['products']['Item_id'][0];
$i =0;
$product = array();
foreach ($manage->products as $manag) {



            $product[$i][0] = "{$manag->Item_id}";
            $product[$i][1] = "{$manag->quantity}";
            ++$i;

        // push single product into final response array
        array_push($response["products"], $product);


//echo $product["Item_id"];
//echo $product["quantity"];

//echo "{$manag->Item_id}\n";
//echo "{$manag->quantity}\n";
}

//echo "price";
$totalprice = "{$manage->totalprice}";
//echo "cust_id";
$cust_id = "{$manage->cust_id}";





  //$cust_id = '9';
  //$totalprice = '100'
  //$item_id = '6';
  //$quantity = '2';
$time = date("Y-m-d H:i:s");
//echo "$time";
  $query = "insert into order_t (cust_id, time, totalprice, status) values ('$cust_id', '$time', '$totalprice', '0' ) ";
  $inserted = mysqli_query($db->getDb(), $query);
//echo "first query executed";




  $query = "select order_id from order_t where (time = '$time' and cust_id = '$cust_id' and totalprice = $totalprice) ";
  $result1 = mysqli_query($db->getDb(), $query);
  //$order_id_1[] = mysqli_fetch_array($order_id_temp);
  //echo "order_id from query \n\n\n";
  $num = mysqli_num_rows($result1);
  //echo "number";
  //echo "$num";
//while($order_id_1[] = mysqli_fetch_array($order_id_temp)){
$order_id_1=mysqli_fetch_array($result1);
//should not contain all rows
//echo "order id.....";
print_r($order_id_1['order_id']);
//echo sizeof($order_id_1);
$oID = 0;
for ($i=0; $i <= sizeof($order_id_1); $i++) {
  //# code...
  $oID = $oID * 10;
  //print_r($order_id_1['order_id'][$i]);
  $oID=$oID + $order_id_1['order_id'][$i];
}
//echo "oooidid";
//echo "$oID";

//echo "......srre";
//$query = "insert into orderDetail (order_id, Item_id,quantity,time) values ('$order_id_1['order_id']',$Item_id, $quantity,'$time') ";
 // $inserted = mysqli_query($db->getDb(), $query);

//echo "now what";

for ($i=0; $i < count($product); $i++) {
  # code...
  //echo $product[$i][0];
  //echo $product[$i][1];
  $poda = $product[$i][0];

  $poda2 = $product[$i][1];
//$query = "insert into orderDetail (order_id, item_id,quantity,time) values (".'$oID'.",".'$product[$i][0]'.",".'$product[$i][1]'.",".'$time'.") ;";
$query1="INSERT INTO `puneet`.`orderDetail` (order_id, item_id, quantity, time) VALUES ('$oID', '$poda', '$poda2', '$time');";
//echo $query1;
//echo "\n";
$inserted = mysqli_query($db->getDb(), $query1);
//echo "run......yayyy";

}


?>
