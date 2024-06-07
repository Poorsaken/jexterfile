<?php
class Accounts
{
    function checkUser($input)
    {
        global $con;
        global $_USERID;
        global $_NOTIFICATIONS;
        $password = '';
        $username = '';
        if (isset($input['username'])) {
            $username = $input['username'];
        }
        if (isset($input['password'])) {
            $password = md5($input['password']);
        }
        try {
            $sql = "SELECT * FROM tbl_accounts WHERE username = :username AND password = :password";
            $statement = $con->prepare($sql);
            $statement->execute([
                ':username' => $username,
                ':password' => $password
            ]);
            $resultx = $statement->fetch(PDO::FETCH_BOTH);
            $nums = $statement->rowCount();
            if ($nums <= 0) {
                $_NOTIFICATIONS = 'Invalid Login. Please check your login credentials.';
                echo '<script>alert("Invalid Login. Please check your login credentials.");</script>';
                return 0;
            } else {
                $account = 'Login Successful';
                $sessid = md5($resultx['id']);
                $userid = $resultx['id'];

                $_SESSION['sessid'] = $sessid;
                $_SESSION['userid'] = $userid;
                $_SESSION['username'] = $resultx['username'];

                header("Location:index.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function displayUsers()
    {
        global $con;
        $sql = "SELECT * FROM tbl_users ORDER BY id";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }
    //ADD NEW USERS WITH IMAGE
    function addUsers($data)
    {
        global $con;

        // Retrieve user data
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $username = $data['username'];
        $password = $data['password'];
        $role = $data['role'];

        try {
            // Insert user data into the tbl_users table
            $sql = "INSERT INTO `tbl_accounts` VALUES (0, '$first_name', '$last_name', '$username', MD5('$password'), $role)";
            $con->exec($sql);
            echo '<script>alert("Sign up successful!");</script>';
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}

?>