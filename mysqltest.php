<?php
require_once 'connection.php';
//how do I hide this from evil browsers

//mysqli_query($mysqli,"INSERT INTO images (path) VALUES ('gelform')");

$result = mysqli_query($mysqli,"SELECT * FROM images_tags WHERE tag = 'Technology'");

while($row = mysqli_fetch_array($result))
  {
  echo "<p>" . $row['images_id'] . "</p>";
}
echo "success!!";

// $image = mysqli_query($mysqli,"SELECT * FROM images WHERE id = '" . $result . "'");

$image = mysqli_query($mysqli,"SELECT * FROM images JOIN images_tags ON images.id = images_tags.images_id WHERE images_tags.tag = 'technology'");

while($img = mysqli_fetch_array($image))

     echo "<img src=\"/pldr/uploads/" . $img['fileName'] . "\">";

echo "second success!!!!";

mysqli_close($mysqli);

?>



<!--
| 2exarfs.gif                                        | Angry      |
| 2exarfs.gif                                        | Animated   |
| 473.gif                                            | Technology |
| 4tsH8n.gif                                         | Bizarre    |
| 4tsH8n.gif                                         | Celebrate  |
| BackAndReady.gif                                   | Celebrate  |
| black-books-computer-chick.gif                     | Technology |
| ChuckNorrisThumbsUp.gif                            | Approval   |
| DogAuckerman.gif                                   | Dogs       |
| Doppleganger.gif                                   | TwinPeaks  |
| image.jpg                                          | Bizarre    |
| image.jpg                                          | Celebrate  |
| Internet Pizza.gif                                 | Animated   |
| Internet Pizza.gif                                 | Approval   |
| Internet Pizza.gif                                 | Funny      |
| KeanuWoah.gif                                      | Surprise   |
| reggie2.gif                                        | Funny      |
| SpaceDog.gif                                       | Dogs       |
| SuspiciousCat.gif                                  | Cats       |
| TakeMyMoney.gif                                    | Futurama   |
| The-Guitar-Army-Of-The-Future-In-Idiocracy-Gif.gif | Animated   |
| The-Guitar-Army-Of-The-Future-In-Idiocracy-Gif.gif | Celebrate  |
| tumblr_m3mmsgdlKR1qg6rkio1_500.gif                 | Angry      |
| tumblr_m3mmsgdlKR1qg6rkio1_500.gif                 | Animated   |
| tumblr_m3mmsgdlKR1qg6rkio1_500.gif                 | Bizarre    |
| tumblr_m3mmsgdlKR1qg6rkio1_500.gif                 | Funny      |
| tumblr_me9yevrk4C1r4d4yjo1_400.gif                 | Bizarre    |
| TwinLlamas.gif                                     | TwinPeaks  |
| typing-Bruce.gif                                   | Technology |
| WheresChippy.gif                                   | Bizarre    |

-->
