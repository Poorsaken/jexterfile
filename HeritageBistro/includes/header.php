<?php
include './classes/Database.php';
session_start();
$DB = new Database();
$DB->connectDB();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Heritage Bistro Restaurant Management System</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
</head>
<body>
    <div class="row w-100" id="mainBody">
<?php
?>