<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="style.css">
<div class ="h1_style">
  <h1>WORLD OF GAMES</h1>
</div>
<div class = "search">
  <form action="SearchAlgo.php" method="post">
    <input type="text" name="search_query" class="search_input" placeholder="Search">
    <input type="submit" name="search" class="btn">
  </form>
</div>

</body>
<?php

      if(isset($_POST['search_query']))
      {

          include('config.php');   //establish connection
          echo $_POST['search_query']."<br>";
          $query= $_POST['search_query'];
          //sepaerating words and appending the metaphone of
          //each words with a space
          $search=explode(" ",$query);
          $search_string="";
          foreach($search as $word)
          {
               $search_string.=metaphone($word)." ";
          }
          echo $search_string."<br>";
          $sql="SELECT * FROM tb_lyrics WHERE indexing like '%$search_string%'";
          $res=mysqli_query($conn,$sql);
          if(!$res)
          {
              echo mysqli_error($conn);
          }

          if(mysqli_num_rows($res)>0)
          {
              while($row=mysqli_fetch_assoc($res))
              {
                   ?>
                   <h2><?=$row['title']?></h2>
                   <h3><?=$row['lyrics'] ?></h3>
                   <a href="<?=$row['url'] ?>"><?=$row['url'] ?></a>
                   <?php
              }
          }

          if(mysqli_num_rows($res)==0)
          {
              $count=0;
              $words=explode(" ",$query);
              foreach ($words as $word)
              {
                  $mword=metaphone($word);
                  $sql="SELECT * FROM tb_lyrics WHERE indexing like '%$mword%'";
                  $res=mysqli_query($conn,$sql);
                  if(!$res)
                  {
                      echo mysqli_error($conn);
                  }
                  if(mysqli_num_rows($res)>0)
                  {
                    while($row=mysqli_fetch_assoc($res))
                    {
                         $count++;
                         ?>
                         <h2><?=$row['title']?></h2>
                         <h3><?=$row['lyrics'] ?></h3>
                         <a href="<?=$row['url'] ?>"><?=$row['url'] ?></a>
                         <?php
                    }
                  }
              }
              if($count==0)
              {
                   echo "no search results found :(";
              }
          }
      }

    ?>
</body>
</html>
