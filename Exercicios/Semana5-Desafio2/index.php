
<?php
 echo '1 ';
 for($i = 0; $i <= 100; $i++)
 {
     $div = 0;
      
     for($j = $i; $j >= 1; $j--)
     {
         if (($i % $j) == 0) {
             $div++;
         }
     }
     
     if ($i == 43){
        echo '<br>';
     }
     if ($div == 2)
     {
         echo $i . ' ';
     }
 }
 