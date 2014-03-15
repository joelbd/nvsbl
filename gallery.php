<?php
require_once 'connection.php';
?>
<head>
  <title>N V S B L . n e t | gallery</title>
      <link rel="stylesheet" type="text/css" href="styly.css">
      <base href="http://nvsbl.net/">
      <script src="http://nvsbl.net/js/jquery-2.1.0.min.js"></script>
      <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
      <script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
</head>

<script>

$( window ).load(function() {
  $( '.tag-checkbox' ).click(function() {
    var checked_tags = '';
    var this_tag = $(this).attr('id');

    $('.tag-checkbox').each(function () {
      if ($(this).is(':checked')) {
        checked_tags = checked_tags + '.' + $(this).attr('id');
      }
    });

    $('.image').each(function () {
      $(this).css('display', 'none');
    });

    $('.image' + checked_tags).each(function () {
      $(this).css('display', 'inline');
    });
  });
});

</script>

<script type="text/javascript" charset="utf-8">

  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto({
    });
  });
</script>
    
<div class="content"> 
<?php
  include 'tag_table.php'
  ?>
</div>

<?php
  $images_and_tags = mysqli_query($mysqli,
      "SELECT images.fileName, images_tags.tag FROM images JOIN images_tags ON images.id = images_tags.images_id ORDER BY images.fileName"
  );

  $tags = "";
  $fileName = "";
  $nextFileName = "";

  while ($row = mysqli_fetch_array($images_and_tags)) {
    $fileName = $nextFileName;

    $nextFileName = $row['fileName'];
    $tag = $row['tag'];

    if ($fileName == $nextFileName) {
      $tags = $tags . " " . $tag;
    } else {
      if ($fileName != "") {
?>
      <a href="uploads/<?= $fileName ?>" rel="prettyPhoto" title="http://nvsbl.net/uploads/<?= $fileName ?>"><img src="thumbs/<?= $fileName ?>" class="image<?= $tags ?>" id="<?= $fileName ?>"/></a>
<?php
      }

      $tags = " " . $tag;
    }
  }
      // Then we also need to do the last one.
?>
      
      <a href="uploads/<?= $fileName ?>" rel="prettyPhoto" title="http://nvsbl.net/uploads/<?= $fileName ?>"><img src="thumbs/<?= $fileName ?>" class="image<?= $tags ?>" id="<?= $fileName ?>"/></a>
<?php
  mysqli_close($mysqli);
?>

