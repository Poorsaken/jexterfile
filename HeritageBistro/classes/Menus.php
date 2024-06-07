<?php
class Menus
{
    function addMenu($data, $file, $destination = '')
    {
        global $con;

        $menu_name = $data['menu_name'];
        $description = $data['description'];
        $price = $data['price'];
        $category = $data['category'];

        $target_dir = $_SERVER['DOCUMENT_ROOT'] . './jexterfile/HeritageBistro/uploaded_image/';

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
                    $sql = "INSERT INTO tbl_menus (menu_name, description, price, category, image) VALUES (:menu_name, :description, :price, :category, :image)";
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

    function displayMenu()
    {
        global $con;

        $sql = "SELECT * FROM tbl_menus ORDER BY id";

        $stmt = $con->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }
    function getMenuById($id) {
        global $con;
    
        $sql = "SELECT * FROM tbl_menus WHERE id = :id";
    
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }

    function updateMenu($data)
    {
        global $con;

        $menu_id = $data['menu_id']; // Assuming you have a field for menu_id in your form
        $menu_name = $data['menu_name'];
        $description = $data['description'];
        $price = $data['price'];
        $category = $data['category'];

        try {
            $sql = "UPDATE tbl_menus SET menu_name = :menu_name, description = :description, price = :price, category = :category WHERE id = :menu_id";
            $stmt = $con->prepare($sql);
            $stmt->execute([
                ':menu_id' => $menu_id,
                ':menu_name' => $menu_name,
                ':description' => $description,
                ':price' => $price,
                ':category' => $category
            ]);
            echo '<script>alert("Menu updated successfully!");</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


}
?>