<?php
  require_once('./../admin/php/connect_db.php');
  connect_base_de_datos();

  class User {
    function __construct($namefunction){
      $this->$namefunction();
    }
    private function loginFB(){
      $id = $_POST['id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $date = date('Y-m-d H:i:s');
      $query = "SELECT idUser FROM user WHERE idUser = '$id'";
      $result = mysql_query($query) or die(mysql_error());
      if(mysql_num_rows($result)==0){
        $query = "INSERT INTO user (idUser, firstNameUser, lastNameUser, emailUser, passwordUser, lastConnection) VALUES ('$id','$first_name','$last_name','$email','$password', '$date')";
        $result = mysql_query($query) or die(mysql_error());
      }else{
        $query = "SELECT idUser FROM user WHERE idUser = '$id' AND passwordUser = '$password'";
        $result = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result)==0){
          $query = "UPDATE user SET passwordUser = '$password', lastConnection = '$date' WHERE idUser = '$id'";
          $result = mysql_query($query) or die(mysql_error());
        }else{
          $query = "UPDATE user SET lastConnection = '$date' WHERE idUser = '$id'";
          $result = mysql_query($query) or die(mysql_error());
        }
      }
      session_start();
      $_SESSION['idUser'] = $id;
    }
    private function logoutFB(){
      session_start();
      session_destroy();
    }
    private function verifyEmail(){
      $email = $_POST['email'];
      $query = "SELECT idUser FROM user WHERE emailUser = '$email'";
      $result = mysql_query($query) or die(mysql_error());
      echo mysql_num_rows($result);
    }
  }
  $namefunction = $_POST['namefunction'];
  new user($namefunction);
?>
