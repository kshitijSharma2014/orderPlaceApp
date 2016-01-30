<?php
//echo "ksh";

include_once 'db.php';

    $db = new DbConnect();

$response = array();
  // get a product from products table

    $result = mysqli_query($db->getDb(),"SELECT Item_id, itemname, price, picurl FROM Item where isAvailable = '1' ");

$row_cnt = mysqli_num_rows($result);

//echo $row_cnt;


if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();

    while ($row = mysqli_fetch_array($result)) {
        // temp user array
$product = array();
            $product["Item_id"] = $row["Item_id"];
            $product["itemname"] = $row["itemname"];
            $product["price"] = $row["price"];
            $product["picurl"] = $row["picurl"];

        // push single product into final response array
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}
?>
