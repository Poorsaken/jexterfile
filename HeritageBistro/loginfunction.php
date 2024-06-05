<?php 
session_start();
include('./classes/database.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: logins.php?error=Username is required!");
        exit();
    } elseif (empty($password)) {
        header("Location: logins.php?error=Password is required!");
        exit();
    }

    $con = Database::getConnection(); // Get the database connection

    $sql = "SELECT * FROM tbl_login WHERE username = :username";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['username'] === $username && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];       
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Location: AdminDashboard.php");
            exit();
        } else {
            header("Location: loginform.php?error=Incorrect username or password");
            exit();
        }
    } else {
        header("Location: loginform.php?error=Incorrect username or password");
        exit();
    }
} else {
    header("Location: loginform.php");
    exit();
}
