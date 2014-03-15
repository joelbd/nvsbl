
-- DROP TABLE `images_tags`;
-- DROP TABLE `images`;
-- DROP TABLE `tags`;

CREATE TABLE `images` (
  `id` varchar(32) NOT NULL,  -- MD5
  `fileName` varchar(100) NOT NULL,
  `fileType` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `tags` (
  `tag` varchar(100) NOT NULL,
  PRIMARY KEY (`tag`)
) ENGINE=InnoDB;

CREATE TABLE `images_tags` (
  `tag` varchar(100) NOT NULL,
  `images_id` varchar(32) NOT NULL,
  PRIMARY KEY (`tag`,`images_id`),
  KEY `images_id` (`images_id`,`tag`),
  CONSTRAINT `fk_images` FOREIGN KEY (`images_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_tags` FOREIGN KEY (`tag`) REFERENCES `tags` (`tag`) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO tags (`tag`) VALUES ('Angry');
INSERT INTO tags (`tag`) VALUES ('Animated');
INSERT INTO tags (`tag`) VALUES ('Approval');
INSERT INTO tags (`tag`) VALUES ('Bizarre');
INSERT INTO tags (`tag`) VALUES ('Cats');
INSERT INTO tags (`tag`) VALUES ('Celebrate');
INSERT INTO tags (`tag`) VALUES ('Dogs');
INSERT INTO tags (`tag`) VALUES ('Funny');
INSERT INTO tags (`tag`) VALUES ('Futurama');
INSERT INTO tags (`tag`) VALUES ('Surprise');
INSERT INTO tags (`tag`) VALUES ('Technology');
INSERT INTO tags (`tag`) VALUES ('TwinPeaks');



 <?php
          $tags = mysqli_query($mysqli, "SELECT tag FROM tags ORDER BY tag");
            
          define('COLS', 3); // number of columns
          $col = 0; // number of the last column filled
            
          echo '<table>';
          echo '<tr>';

          while($row = mysqli_fetch_array($tags)) 
          {
            $col++;  
            echo "\n<td><input type=\"checkbox\" name=\"tag\" value=\"" . "{$row['tag']}" . "\" id=\"" . "{$row['tag']}" . "\">" . "{$row['tag']}" . "</td>";
            if ($col == COLS) // have filled the last row
            {  
              $col = 0; 
              echo '</tr><tr>'; // start a new one
            }
          }
            
          echo '</tr>';
          echo '</table>';
     
        ?>
