
<?php
  include_once "db_connect.php";
?>



<?php

 
 
 //insert data into login table
 
 
 $calname=$_POST['name'];
 $calldate = $_POST['date'];
 $calldes=$_POST['des'];
    
   if(strlen($calname)>0 && strlen($calldate)>0 &&  strlen($calldes)>0){ 
  $sql = "INSERT INTO caltbl(calName,calDesc,calDate)
          VALUES ('$calname','$calldes','$calldate')";  
    
   $query = mysql_query($sql);
   if($query){
    echo "Thank you for signing up.Enjoy";
    
   } 
   else
   echo "sorry.there is an error for signing up.please try again later.";
    
    }
    else
  echo "please fill up all the fields.";
    
?>
                
            </div>
            <div class="col col13 no_margin_right">
                
            </div>
            <div class="cleaner"></div>
        </div>
    </div>
     
    
    <div id="templatemo_footer_wrapper">
        <div id="templatemo_footer">
            Copyright © 2013 <a href="shaadjoe7@gmail.com"> | Designed by <strong>shaad</strong>
        </div>
    </div>
</div>
</body>
</html>
