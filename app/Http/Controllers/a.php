<?php 
    
  include_once 'config.php';
  
  $name =$_POST['name'];
  $lastname =$_POST['lastname'];
  $email =$_POST['email'];
  $phone =$_POST['phone'];
  $comment =$_POST['comment'];

  
  $sql = "INSERT INTO vartotojai (ID, name, lastname, email, phone, comment) VALUES ('$name', '$lastname', '$email', '$phone', '$comment')";

  if(mysqli_query($conn, $sql)){
    header('Location: ' . $_SERVER['HTTP_REFERER'] );
  }
  else{
    echo 'something went wrong';
  }

?>