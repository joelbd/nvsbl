<?php
//print_r($_FILES);
require_once 'connection.php';

define("THUMB_MAX_HEIGHT", 120);

$fileName = $_FILES["file1"]["name"];
$fileTmpLoc = $_FILES["file1"]["tmp_name"];
$fileType = $_FILES["file1"]["type"];
$fileSize = $_FILES["file1"]["size"];
$fileErrorMsg = $_FILES["file1"]["error"];

if (!$fileTmpLoc) {
    echo "ugh... pick a file before clicking upload...";
    mysqli_close($mysqli);
    exit();
}

$image_type = exif_imagetype($fileTmpLoc);

$fileExt = "";
if ($image_type == IMAGETYPE_GIF) {
    $fileExt = ".gif";
} elseif ($image_type == IMAGETYPE_JPEG) {
    $fileExt = ".jpg";
} elseif ($image_type == IMAGETYPE_PNG) {
    $fileExt = ".png";
} else {
    unlink($fileTmpLoc);
    echo "don't come round here with that shit";
    mysqli_close($mysqli);
    exit();
} 

$md5hash = md5_file($fileTmpLoc);
$new_fileName = substr($md5hash, 0,7) . $fileExt;
$filePath = "uploads/$new_fileName";
$thumbPath = "thumbs/$new_fileName";

$duplicates = mysqli_query($mysqli, "SELECT * FROM images WHERE id = '$md5hash'");

$foundDuplicate = FALSE;
while($row = mysqli_fetch_array($duplicates)) {
  $foundDuplicate = TRUE;
}

if ($foundDuplicate) {
    echo "$fileName is already here.";
    mysqli_close($mysqli);
    exit();
}

if (!move_uploaded_file($fileTmpLoc, $filePath)) {
    echo "Upload fucking failed!";
    mysqli_close($mysqli);
    exit();
}

// Create thumbs and previews

function downsample($original_image_path, $image_type, $new_image_path, $max_height) {
    $image = new Imagick($original_image_path);

    if ($image_type == IMAGETYPE_GIF) {
        $image = $image->coalesceImages();
    }

    $image->thumbnailImage(0, $max_height);
    $image->writeImage($new_image_path);

    $image->destroy();
}
//downsample($filePath, $image_type, $thumbPath, THUMB_MAX_WIDTH, THUMB_MAX_HEIGHT);
//downsample($filePath, $image_type, $previewPath, PREVIEW_MAX_WIDTH, PREVIEW_MAX_HEIGHT);
downsample($filePath, $image_type, $thumbPath, THUMB_MAX_HEIGHT);

mysqli_query($mysqli, "INSERT INTO images (id, fileName, fileType) VALUES ('$md5hash', '$new_fileName', $image_type)");

foreach ($_POST as $tag => $value) {
    mysqli_query($mysqli, "INSERT INTO images_tags (tag, images_id) VALUES ('$tag', '$md5hash')");
}

echo "$fileName is fucking uploaded";

// imagedestroy($image);

mysqli_close($mysqli);

?>
