<?php
// require ('database.php');

class Profile{

    


function insertProduct($req, $files) {
    $con = Database::getConnection();
    // Extract form fields
    $menuname = $req['menuname'];
    $category = $req['category'];
    $price = $req['price'];

    // Handle image upload  
    $targetDir = "uploaded_image/"; // Relative path to the directory where images will be uploaded
    $fileName = basename($files["menu_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow certain file formats
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($imageFileType, $allowTypes)) {
        // Check if the directory exists, if not create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Upload file to server
        if (move_uploaded_file($files["menu_image"]["tmp_name"], $targetFilePath)) {
            // Insert product data into the database
            try {
                $sql = "INSERT INTO tbl_menu 
                        (menuname, category, price, menu_image)
                        VALUES 
                        (:menuname, :category, :price, :menu_image)";

                $stmt = $con->prepare($sql);
                $stmt->bindParam(':menuname', $menuname);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':menu_image', $fileName);
                $stmt->execute();

                echo "The product has been inserted successfully.";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
    }
}

      

 // Ensure you include the correct path to your Database class file

function StaffCreateAccount($req) {
    $con = Database::getConnection(); // Get the database connection

    $fname = $req['fname'];
    $lname = $req['lname'];
    $address = $req['address'];
    $username = $req['username'];
    $password = $req['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare and execute the first SQL statement
        $sql = "INSERT INTO `tbl_staffinformation` (fname, lname, address) VALUES (:fname, :lname, :address)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':address', $address);
        $stmt->execute();

        // Prepare and execute the second SQL statement
        $sql = "INSERT INTO `tbl_login` (username, password) VALUES (:username, :password)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        // Success alert and redirection
        echo "<script>alert('Inserted Successfully'); window.location.href='StaffCreateAccount.php';</script>";
        exit(); // Ensure no further code is executed after redirection



    } catch (PDOException $e) {
        // Output a JavaScript snippet to trigger an alert for error
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}





//  function GetAllEvents(){
//     $con = Database::getConnection();
//     try {
//         $sql = "SELECT * FROM `tbl_events` ORDER BY id";
//         $stmt = $con->prepare($sql);
//         $stmt->execute();

//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }
// }

//  function GetAllApprovedEvents(){
//     $con = Database::getConnection();
//     try {
//         $sql = "SELECT * FROM `tbl_approvedevents` ORDER BY id";
//         $stmt = $con->prepare($sql);
//         $stmt->execute();

//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }
// }





//  function ApproveProduct($product_id){
//     $con = Database::getConnection();

//     try {
//         // Fetch product details from tbl_products
//         $sql = "SELECT * FROM tbl_events WHERE id = $product_id";
//         $result = $con->query($sql);
//         $product = $result->fetch(PDO::FETCH_ASSOC);

//         if ($product) {
//             // Insert product details into tbl_deletedproducts
//             $sql = "INSERT INTO tbl_approvedevents
//                     (name, date, timefrom, timeto, venue)
//                     VALUES
//                     ('{$product['name']}', '{$product['date']}', '{$product['timefrom']}', '{$product['timeto']}','{$product['venue']}')";
//             $con->exec($sql);

//             $sql = "DELETE FROM tbl_events WHERE id = $product_id";
//             $con->exec($sql);
//         } else {
//             echo "";
//         }
//     } catch(PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }
// }




}

?>