<?php
  try {
        $stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate, postDesc FROM blog_posts WHERE postID = :postID');
        $stmt->execute(array(':postID' => $_GET['page']));
        $row = $stmt->fetch();
            {
              
            }

            } catch(PDOException $e) {
                              echo $e->getMessage();
                            }

        $stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate, postDesc FROM blog_posts WHERE postID = :postID');
        $stmt->execute(array(':postID' => $_GET['page']));
        $row = $stmt->fetch();

        if($row['postID'] == ''){
                          header('Location: ./index.php');
                          exit;
              }

        $blog_title = $row['postTitle'];
        $blog_content = $row['postCont'];
        $blog_date = $row['postDate'];
        $blog_description = $row['postDesc'];
?>
