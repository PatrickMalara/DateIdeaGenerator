<?php
/* 
This file gets the entire table from the database, 
sorted alphabetically, creates an array of item objects,
 and outputs a JSON encoding of this array.Add ItemThis file
  receives POST parameters for a new item and inserts it into 
  the database
*/
include 'connect.php';
include 'dateModel.php';

$query = "SELECT * FROM dates";

$stmt = $conn->prepare($query);

$success = $stmt->execute();

if($success){
    //echo "way to go";
}

$dates = [];

//echo $row['item'];
while($row = $stmt->fetch()){
    $temp = new Date($row['id'], $row['title'], $row['category'], $row['desc'], $row['upvotes'], $row['downvotes'], $row['latitude'], $row['longitude'], $row['address']);
    array_push($dates, $temp);
}

echo json_encode($dates);
?>