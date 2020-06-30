<?php
   $hostname = "localhost";
   $username = "root";
   $password = "gokpras123";
   $db_name  = "crud-relation-example";

   $koneksi = mysqli_connect($hostname, $username, $password, $db_name) or trigger_error(mysqli_error($koneksi), E_USER_NOTICE);
?>
