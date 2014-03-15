    <?php
      $tags = mysqli_query($mysqli, "SELECT tag FROM tags ORDER BY tag");
        
      define('COLS', 6); // number of columns
      $col = 0; // number of the last column filled       
      echo '<table>';
      echo '<tr>';
      while($row = mysqli_fetch_array($tags)) 
      {
        $col++; 
    ?> 
        <td><input type="checkbox" name="tag" value="<?= $row['tag'] ?>" class="tag-checkbox" id="<?= $row['tag'] ?>"><label for="<?= $row['tag'] ?>"><?= $row['tag'] ?></label></td>
    <?php
        if ($col == COLS) // have filled the last row
        {  
          $col = 0; 
          echo '</tr><tr>'; // start a new one
        }
      }
      echo '</tr>';
      echo '</table>';
    ?>
