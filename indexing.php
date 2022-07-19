<?php
     include('config.php');
     $sql1="SELECT * FROM games";
     $res1=mysqli_query($conn,$sql1);
     if(!$res1)
     {
         echo "error ".mysqli_error($conn);
     }


     while($row=mysqli_fetch_assoc($res1))
     {
         $sound=" ";
         if($row['title']!=null)
         {
              $words=explode(" ",$row['title']);
              foreach($words as $word)
              {
                 $sound.=metaphone($word)." ";
              }
         }
         if($row['lyrics']!=null)
         {
             $words=explode(" ",$row['lyrics']);
             foreach($words as $word)
             {
                $sound.=metaphone($word)." ";
             }
         }
         $id=$row['id'];
         $sql2="UPDATE games SET indexing='$sound' WHERE id=$id";
         $res2=mysqli_query($conn,$sql2);
         if(!$res2)
         {
             echo mysqli_error($conn);
         }
     }
 ?>
