<?php

$mysqli=mysqli_connect("localhost","substand_nvsbl","XXX","substand_nvsbl");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
