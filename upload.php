<!DOCTYPE html>
<?php
require_once 'connection.php';
?>
<head>
  <title>N V S B L . n e t | upload</title>
    <link rel="stylesheet" type="text/css" href="styly.css">
    <base href="http://nvsbl.net/">
    <style>
      a {
          text-decoration: none;
        }
    </style>
    <script src="http://nvsbl.net/js/jquery-2.1.0.min.js"></script>

<script>
function _(el){
    return document.getElementById(el);
}
function uploadFile(){
    var file = _("file1").files[0];
    var formdata = new FormData();
    formdata.append("file1", file);

    var checkboxes = document.getElementsByName("tag");
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            formdata.append(checkboxes[i].value, checkboxes[i].value);
        }
    }

    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "file_upload_parser.php");
    ajax.send(formdata);
}
function progressHandler(event){
    _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 0;
}
function errorHandler(event){
    _("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
    _("status").innerHTML = "Upload Aborted";
}
</script>
</head>
<body link="#787878" vlink="#787878" alink="#787878"> 
  <div class="upload">  
    <div class="content">    
        <h2><img src="img/site/upload.png" alt="upload an image"></h2>
        <form id="upload_form" enctype="multipart/form-data" method="post">
        <input type="file" name="file1" id="file1">
        <input type="button" value="Upload File" onclick="uploadFile()"><br>
        <progress id="progressBar" value="0" max="100" style="width:700px;"></progress><br>
        <?php
          include 'tag_table.php'
        ?>  
      
        <h3 id="status"></h3>
      <p id="loaded_n_total"></p>
      </form><br>
    <a href="gallery.php">Gallery</a></div>
  </div>
<?php
  mysqli_close($mysqli);
?>
</body>
</html>
