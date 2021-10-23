<?php

require "helpers/db_connection.php";
require "helpers/functions.php";
require "helpers/validator.php";


  if($_SERVER['REQUEST_METHOD']=="POST") {

    $email  = clear_input($_POST['email']);
    $pass   = clear_input($_POST['password']);

    $errors = []; 

    
    # email validation 
    if(validate($email,"is_empty")) {
      $errors["email"] = "email required";
    }elseif(!validate($email,"is_email")) {
      $errors["email"] = " email invalid";
    }
    # password validation 
    if(validate($pass,"is_empty")) {
        $errors["password"] = "password required";
    }


     #if there any errors
     if(count($errors) > 0) {

          foreach($errors as $k => $v) {
            echo "*".$v."<br>";
          }

      
       } else {

          $pass = md5($pass);
          $sql  = "select * from users where email = '$email' and password = '$pass'";
          $op   = mysqli_query($con,$sql);

          if(mysqli_num_rows($op) == 1) {

            $data = mysqli_fetch_assoc($op);
            $_SESSION['user'] = $data;
            if($_SESSION['user']['role_id'] == 1) {
              header('Location: '.url("index.php"));
            } elseif($_SESSION['user']['role_id'] == 2) {
              header('Location: '.url("index.php"));
            } else {
              header('Location: '.url("player.php"));
            }




          } else {
            echo "Wrong email or password!";
          }


       }





  }


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

    <title>Log In</title>
    <style> 
        body {
            margin: 0;
            padding: 0;
            background: url("images/3.jpg");
            background-size: cover;      
            font-family:sans-serif;
        }   
        body,
.signin {
  background-color: #d3d3d3;
  font-family: 'Montserrat', sans-serif;
  color: #fff;
  font-size: 14px;
  letter-spacing: 1px;
}

.login {
  position: relative;
  height: 560px;
  width: 405px;
  margin: auto;
  padding: 60px 60px;
  background: url(https://picsum.photos/id/1004/5616/3744) no-repeat   center center #505050;   
  background-size: cover;
  box-shadow: 0px 30px 60px -5px #000;
}

form {
  padding-top: 80px;
}

.active {
  border-bottom: 2px solid #1161ed;
}

.nonactive {
  color: rgba(255, 255, 255, 0.2);
}

h2 {
  padding-left: 12px;
  font-size: 22px;
  text-transform: uppercase;
  padding-bottom: 5px;
  letter-spacing: 2px;
  display: inline-block;
  font-weight: 100;
}

h2:first-child {
  padding-left: 0px;
}

span {
  text-transform: uppercase;
  font-size: 12px;
  opacity: 0.4; 
  display: inline-block;
  position: relative;
  top: -65px;
  transition: all 0.5s ease-in-out;
}

.text {
  border: none;
  width: 89%;
  padding: 10px 20px;
  display: block;
  height: 15px;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 255, 255, 0);
  overflow: hidden;
  margin-top: 15px;
  transition: all 0.5s ease-in-out;
}

.text:focus {
  outline: 0;
  border: 2px solid rgba(255, 255, 255, 0.5);
  border-radius: 20px;
  background: rgba(0, 0, 0, 0);
}

.text:focus + span {
  opacity: 0.6;
}

input[type="text"],
input[type="password"] {
  font-family: 'Montserrat', sans-serif;
  color: #fff;
}



input {
  display: inline-block;
  padding-top: 20px;
  font-size: 14px;
}

h2,
span,
.custom-checkbox {
  margin-left: 20px;
}

.custom-checkbox {
  -webkit-appearance: none;
  background-color: rgba(255, 255, 255, 0.1);
  padding: 8px;
  border-radius: 2px;
  display: inline-block;
  position: relative;
  top: 6px;
}

.custom-checkbox:checked {
  background-color: rgba(17, 97, 237, 1);
}

.custom-checkbox:checked:after {
  content: '\2714';
  font-size: 10px;
  position: absolute;
  top: 1px;
  left: 4px;
  color: #fff;
}

.custom-checkbox:focus {
  outline: none;
}

label {
  display: inline-block;
  padding-top: 10px;
  padding-left: 5px;
}

.signin {
  background-color: #1161ed;
  color: #FFF;
  width: 100%;
  padding: 10px 20px;
  display: block;
  height: 39px;
  border-radius: 20px;
  margin-top: 30px;
  transition: all 0.5s ease-in-out;
  border: none;
  text-transform: uppercase;
}

.signin:hover {
  background: #4082f5;
  box-shadow: 0px 4px 35px -5px #4082f5;
  cursor: pointer;
}

.signin:focus {
  outline: none;
}

hr {
  border: 1px solid rgba(255, 255, 255, 0.1);
  top: 85px;
  position: relative;
}

 a {

  text-decoration: none;
  color: #fff;
} 

    </style>
</head>
<body>
        
<div class="login">
  <h2 class="active"><a href="login.php">Log in</a></h2>
  <h2 class="active"><a href="index.php">Home</a></h2>  
  <h2 class="active"><a href="logup.php">Log Up</a></h2>
  
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "post">
   
    

    <input type="email" class="text" name="email">
     <span>email</span>

    <br>
    
    <br>

    <input type="password" class="text" name="password">
    <span>password</span>
    <br>

    <input type="checkbox" id="checkbox-1-1" class="custom-checkbox" />
    <label for="checkbox-1-1">Keep me Signed in</label>
    
    <button class="signin" type = "submit">
      Sign In
    </button>


    <hr>

    
  </form>

</div>
</body>
</html>