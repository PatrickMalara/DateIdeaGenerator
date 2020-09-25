<?php

include 'connect.php';

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

$query = "UPDATE `dates` SET `downvotes`=`downvotes`+1 WHERE `id` = ?";
$stmt = $conn->prepare($query);
$params = [$id];
$success = $stmt->execute($params);
if(!$success){
    echo "Query did not work";
}

$query = "SELECT downvotes FROM dates WHERE id = ?";

$stmt = $conn->prepare($query);
$success = $stmt->execute($params);

if($success){
    while($row = $stmt->fetch()){
        echo $row['downvotes'];
    }
}

?>