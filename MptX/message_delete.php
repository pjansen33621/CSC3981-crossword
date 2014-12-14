<?php


$messageID = $_GET['id'];

$query = "DELETE FROM messages
WHERE id = '$messageID'";
$db->exec($query);

include('myaccount.php');