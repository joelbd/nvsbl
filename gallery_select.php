<?php

require_once 'connection.php';

$images_and_tags = mysqli_query($mysqli,
    "SELECT images.fileName, tags.tag FROM images JOIN tags ON images.id = tags.images_id ORDER BY images.fileName"
);

$images_by_tag = array();

while ($row = mysqli_fetch_array($images_and_tags)) {
    $fileName = $row['fileName'];
    $filePath = "pldr/uploads/$fileName";
    $tag = $row['tag'];

    // if ($images_by_tag[$tag])
}

// {
//     "Animated": ["pldr/uploads/Internet Pizza.gif"],
//     "Approval": ["pldr/uploads/Internet Pizza.gif"],
//     "Funny": ["pldr/uploads/Internet Pizza.gif", "pldr/uploads/reggie2.gif"]
// }

mysqli_close($mysqli);

?>
