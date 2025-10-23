<?php
session_start();
require_once __DIR__ . "/models/images.php";


$image = new Images();

if (!isset($_SESSION['errors'])) {
    $_SESSION['errors'] = [];
}

foreach($_FILES['profileImage']['name'] as $key => $file) {
 

    $imageSize = $_FILES['profileImage']['size'][$key];
    $tmpName   = $_FILES['profileImage']['tmp_name'][$key];
    $fileName  = $_FILES['profileImage']['name'][$key];


    if ($_FILES['profileImage']['error'][$key] !== UPLOAD_ERR_OK) {
        $_SESSION['errors'][] = "Error uploading file: $fileName.";
        continue;
    }

    if(!$image ->isValidSize($imageSize)) {
       $_SESSION['errors'][] = "$fileName is too large (max 30MB).";
        continue;
    } 

    

    $imageType = pathinfo($fileName, PATHINFO_EXTENSION);
    if(!$image->isValidExtension($imageType)) {
         $_SESSION['errors'][] = " $fileName has invalid extension ($imageType)."; 
        continue;
    } 

    $imageInfo = @getimagesize($tmpName);
    if ($imageInfo === false) {
        $_SESSION['errors'][] = "$fileName is not a valid image file or could not be read.";
        continue;
    }

    list($width, $height) = $imageInfo;
    if(!$image->isValidDimensions((int)$width, (int)$height)) {
        $_SESSION['errors'][] = "$fileName exceeds allowed dimensions (max 1920x1024).";
        continue;
    }

    $randomName = $image->generateRandomName('jpg');
    if (!is_dir('./uploads') ) {
        mkdir('./uploads', 0755, true);
    }

    $image->upload($tmpName, $randomName, "uploads");


    $connection = mysqli_connect("localhost", "root", "root", "php23", 8889);

}

if (empty($_SESSION['errors'])) {
    $_SESSION['success'] = "All images uploaded successfully!";
}

header("Location: images.php");
exit;
?>
