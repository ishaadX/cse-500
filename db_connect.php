<?php


//connection of mySQL database by using PHP code
 
 
 $db_host="localhost";
 $db_username="root";
 $db_pass="";
 $db_name="test";


 $connection = mysql_connect($db_host,$db_username,$db_pass) 
 or
 die (  "database connection failed" . mysql_error());
 
 
 
 //selection of database name
 
 $db_select = mysql_select_db($db_name,$connection) 
 or 
 die("No database found");
 
 //echo "Successfully connected to your database";
 

?>











