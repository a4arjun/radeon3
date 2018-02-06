<ul class="nav navbar-nav mr-auto">
  <li class="nav-item"><a class="nav-link" href="index.php#home">Home</a></li>
    <?php
      try {
        $stmt = $db->query('SELECT  pid,title FROM pages ORDER BY pid ASC');
        while($row = $stmt->fetch()){
           echo '<li class="nav-item"><a class="nav-link" href="page.php?page='.$row['pid'].'">'.$row['title'].'</a></li>';       
              }
          } catch(PDOException $e) {
              echo $e->getMessage();
              }
    ?>
</ul>