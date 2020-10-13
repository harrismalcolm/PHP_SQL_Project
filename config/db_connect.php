<?php 

  // Connect to database
  $conn = mysqli_connect('localhost', 'mac', 'test1234', 'used_bikes');
  
  // check connection
  if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
  }

?>