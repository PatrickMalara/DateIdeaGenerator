<?php
include 'connect.php';

$dateTitle = filter_input(INPUT_POST, "dateTitle", FILTER_SANITIZE_SPECIAL_CHARS);
$dateAddress = filter_input(INPUT_POST, "dateAddress", FILTER_SANITIZE_SPECIAL_CHARS);
$dateLongitude = filter_input(INPUT_POST, "dateLongitude", FILTER_SANITIZE_SPECIAL_CHARS);
$dateLatitude = filter_input(INPUT_POST, "dateLatitude", FILTER_SANITIZE_SPECIAL_CHARS);
$dateDesc = filter_input(INPUT_POST, "dateDesc", FILTER_SANITIZE_SPECIAL_CHARS);
$dateCategory = filter_input(INPUT_POST, "dateCategory", FILTER_SANITIZE_SPECIAL_CHARS);

$query = "INSERT INTO `dates`(`id`, `title`, `category`, `desc`, `upvotes`, `downvotes`, `latitude`, `longitude`, `address`) VALUES (NULL, ?, ?, ?, 0, 0, ?, ?, ?) ";
$stmt = $conn->prepare($query);
$params = [$dateTitle, $dateCategory, $dateDesc, $dateLatitude, $dateLongitude, $dateAddress];
$success = $stmt->execute($params);
if(!$success){
    echo "Failed to add the date.";
}
else {
    echo "Date added!";
}

?>