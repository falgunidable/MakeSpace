<?php
include_once 'connect.php'; 
if(isset($_POST['submit'])){

    $category = $_POST['category'];
    $type = $_POST['subcat'];
    $subcategory = $_POST['subsubcat'];
    $title = $_POST['title'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $userid= $_POST['userid'];
    
    $uploadsDir = $_SERVER['DOCUMENT_ROOT']."/makespace/uploads/";
    $allowedFileType = array('jpg','png','jpeg');

    $sql = "INSERT INTO `item_desc`(`category`, `type`, `sub_cat`, `title`, `item_condition`, `price`, `brand`, `userid`) VALUES ('$category', '$type', '$subcategory', '$title','$condition','$price','$brand','$userid')";
    if (mysqli_query($db, $sql)) {
    // Velidate if files exist
    if (!empty(array_filter($_FILES['fileUpload']['name']))) {
        
        // Loop through file items
        foreach($_FILES['fileUpload']['name'] as $id=>$val){
            // Get files upload path
            $fileName        = $_FILES['fileUpload']['name'][$id];
            $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
            $targetFilePath  = $uploadsDir . $fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadOk = 1;
            if(in_array($fileType, $allowedFileType)){
                    if(move_uploaded_file($tempLocation, $targetFilePath)){
                        $sqlVal = "('".$fileName."')";
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "File coud not be uploaded."
                        );
                    }
                
            } else {
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Only .jpg, .jpeg and .png file formats allowed."
                );
            }

            // Add into MySQL database
            if(!empty($sqlVal)) {
                
                    $sql1 = "SELECT itemid FROM `item_desc` ORDER BY itemid DESC LIMIT 1";
                    $result = mysqli_query($db, $sql1);
                    $row = mysqli_fetch_assoc($result);
                    $itemid = $row['itemid'];
                $insert = $db->query("INSERT INTO imageupload(image, itemid) VALUES ('$fileName','$itemid')");
                if($insert) {
                    $response = array(
                        "status" => "alert-success",
                        "message" => "Files successfully uploaded."
                    );
                    echo '<script>
                    alert("You have uploaded item Successfully");
                    window.location.href="../Profile/profile.php";
                    </script>';
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Files coudn't be uploaded due to database error."
                    );
                }
            
            }
        }} else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }
    } else {
        // Error
        echo '<script>alert("Select a file to upload");</script>';
        $response = array(
            "status" => "alert-danger",
            "message" => "Please select a file to upload."
        );
    }
} 
?>