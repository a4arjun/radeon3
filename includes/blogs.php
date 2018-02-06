<?php
  try {

       $stmt = $db->query('SELECT postID, postTitle, postCover, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
       while($row = $stmt->fetch()){
        echo '<h2>'.$row['postTitle'].'</h2>';  // post title
        echo '<img class="img-resposive" width="240px" src="'.$row['postCover'].'">';
        echo '<p>'.$row['postDesc'].'</p>'; //description
        echo '<a href="view.php?page='.$row['postID'].'" class="btn btn-default">Read more &gt;&gt;</a><br/>';
            }

      } catch(PDOException $e) {
              echo $e->getMessage();
      }
?>