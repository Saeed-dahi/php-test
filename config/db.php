<?php
//make database connection
$con = mysqli_connect("localhost", "root", "", "erp");


//check if there was any error with conncetion
if (!$con) {
  die("Connection Error");
}