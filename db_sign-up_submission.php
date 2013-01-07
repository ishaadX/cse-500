
<?php
  include_once "db_connect.php";
?>



<?php

 
 
 //insert data into login table
 
 
 $user_name=$_POST['user_name'];
 $email_id = $_POST['mail_id'];
 $password=$_POST['password'];
    
   if(strlen($user_name)>0 && strlen($email_id)>0 &&  strlen($password)>0){ 
  $sql = "INSERT INTO tbl_login(user_name,mail_id,password)
          VALUES ('$user_name','$email_id','$password')";  
    
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
                
            
