<?php
    if(isset($_POST["submit"])){

      require "connect_db.php";
      require "userModel.php";

      $email = $_POST["email"];
      $password = $_POST["password"];
      $repeatPassword = $_POST["repeatPassword"];

      
      

      if ($password  === $repeatPassword) {
        $account = new userModel();
        $account->set_connection($conn);
        $account->set_data($email,$password,$repeatPassword);
        $result = $account->insert();

        if($result){
          echo "<script>if(confirm('สมัครสำเร็จ')){document.location.href='index.php'};</script>";
        }else{
          echo "<script>if(confirm('อีเมลนี้มีผู้ใช้งานแล้ว')){document.location.href='register.php'};</script>";
          
        }
        exit();
      }
      else {
        echo "<script>if(confirm('รหัสผ่านไม่ตรงกัน')){document.location.href='register.php'};</script>";
      }

      
      
      
      

    
  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    
    <form method="post">
      <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" required>
        
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" autofocus required maxlength = "50" minlength = "6">

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="repeatPassword" id="repeatPassword" autofocus required maxlength = "50" minlength = "6">
        
        <hr>

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" name="submit" class="registerbtn">Register</button>
      </div>

      <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
      </div>
    </form>
</body>
</html>

