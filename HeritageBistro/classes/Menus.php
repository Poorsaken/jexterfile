<?php
class Menus
{
    // ADDING NEW MENU
    function addMenu($data, $file, $destination = '')
    {
        global $con;

        $menu_name = $data['menu_name'];
        $description = $data['description'];
        $price = $data['price'];
        $category = $data['category'];

        $target_dir = $_SERVER['DOCUMENT_ROOT'] . './JEXTERDIAYKA/jexterfile/HeritageBistro/uploaded_image/';

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image = basename($file['name']);
        $target_file = $target_dir . $image;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        $allowedFormats = ["jpg", "jpeg", "png", "webp"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG, and WEBP files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                try {
                    $sql = "INSERT INTO tbl_menus (menu_name, description, price, category, status, image) VALUES (:menu_name, :description, :price, :category, 1, :image)";
                    $stmt = $con->prepare($sql);
                    $stmt->execute([
                        ':menu_name' => $menu_name,
                        ':description' => $description,
                        ':price' => $price,
                        ':category' => $category,
                        ':image' => $image
                    ]);
                    echo '<script>alert("Menu added successfully!");</script>';
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, your file was not uploaded.";
        }
    }
    // DISPLAY MENU WITH THE STATUS OF 1 WHICH IS ACTIVE
    function displayMenu()
    {
        global $con;

        $sql = "SELECT * FROM tbl_menus WHERE status = 1 ORDER BY id";

        $stmt = $con->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }


    //DISPLAY COUNT IN CATEGORY
function countByCategory($category) {
    global $con; // Assuming $con is your PDO connection object

    $sql = "SELECT COUNT(*) FROM tbl_menus WHERE category = :category";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchColumn(); // Fetch the count directly
}



    // DISPLAY THE SPECIFIC DATA OF THAT ID
    function getMenuById($id)
    {
        global $con;

        $sql = "SELECT * FROM tbl_menus WHERE id = :id";

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }
    // UPDATING THE MENU WITHOUT CHANGIN THE IMAGE
    function updateMenu($id, $menu_name, $category, $price, $description)
    {
        global $con;

        $sql = "UPDATE tbl_menus SET menu_name = :menu_name, category = :category, price = :price, description = :description WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':menu_name', $menu_name);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    // THIS IS FOR DELETING WHICH MEANS JUST UPDATING THE STATUS TO 0 WHICH IS DELETED
    function deleteMenu($id) {
        global $con;

        $sql = "UPDATE tbl_menus SET status = 0 WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>