<?php
    include "con_db.php";
    
    function fetchImage($conn, $id) {
        $sql = "SELECT PHOTO FROM cms_home_promotions WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($photo);
            $stmt->fetch();
            return "data:image;base64," . base64_encode($photo);
        }
        return null;
    }
    
    $promoImage = fetchImage($conn, 1);
    $promoImage2 = fetchImage($conn, 2);
    $promoImage3 = fetchImage($conn, 3);
    $promoImage4 = fetchImage($conn, 4);
    $promoImage5 = fetchImage($conn, 5);
    
 

 function updatePhoto($conn, $photoField, $id) {
        if (isset($_FILES[$photoField]['tmp_name'])) {
            $photoTmpPath = $_FILES[$photoField]['tmp_name'];
            $photoSize = $_FILES[$photoField]['size'];
    
            if ($photoSize > 0 && $photoSize <= 1048576) {
                $photoData = addslashes(file_get_contents($photoTmpPath));
    
                $sql = "UPDATE cms_home_promotions SET PHOTO = '$photoData' WHERE ID = $id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<script>alert("Image inserted successfully!");</script>';
                    echo '<meta http-equiv="refresh" content="0">';
                } else {
                    echo "Error updating profile photo!";
                }
            } elseif ($photoSize > 1048576) {
                echo '<script>alert("Compress the image into 1MB or less.");</script>';
            }
        }
    }
    
    if (isset($_POST['submit'])) {
        updatePhoto($conn, 'photo', 1);
    } elseif (isset($_POST['submit2'])) {
        updatePhoto($conn, 'photo2', 2);
    } elseif (isset($_POST['submit3'])) {
        updatePhoto($conn, 'photo3', 3);
    } elseif (isset($_POST['submit4'])) {
        updatePhoto($conn, 'photo4', 4);
    } elseif (isset($_POST['submit5'])) {
        updatePhoto($conn, 'photo5', 5);
    } else {
    }

?>