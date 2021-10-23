






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Register</title>
    <style>
        /* Required for full background image */

html,
body,
header,
.view {
  height: 100%;
}

@media (max-width: 740px) {
  html,
  body,
  header,
  .view {
    height: 1000px;
  }
}
@media (min-width: 800px) and (max-width: 850px) {
  html,
  body,
  header,
  .view {
    height: 650px;
  }
}

.top-nav-collapse {
  background-color: #3f51b5 !important;
}

.navbar:not(.top-nav-collapse) {
  background: transparent !important;
}

@media (max-width: 991px) {
  .navbar:not(.top-nav-collapse) {
    background: #3f51b5 !important;
  }
}

.rgba-gradient {
  background: -webkit-linear-gradient(45deg, rgba(0, 0, 0, 0.7), rgba(72, 15, 144, 0.4) 100%);
  background: -webkit-gradient(linear, 45deg, from(rgba(0, 0, 0, 0.7), rgba(72, 15, 144, 0.4) 100%)));
  background: linear-gradient(to 45deg, rgba(0, 0, 0, 0.7), rgba(72, 15, 144, 0.4) 100%);
}

.card {
  background-color: rgba(126, 123, 215, 0.2);
}

.md-form label {
  color: #ffffff;
}

h6 {
  line-height: 1.7;
}
    </style>
</head>
<body>
    
<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
    <div class="container">
      <a class="navbar-brand" href="#">
        <strong>Chess Academy</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logup.php">Log up</a>
          </li>
        </ul>
        
          <div class="md-form mt-0">
           
          </div>
     
      </div>
    </div>
  </nav>
  <!-- Navbar -->
  <!-- Full Page Intro -->
  <div class="view" style="background-image: url('http://mdbootstrap.com/img/Photos/Others/images/91.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
      <!-- Content -->
      <div class="container">
        <!--Grid row-->
        <div class="row mt-5">
          <!--Grid column-->
          <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left">
            <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">Sign up right now! </h1>
            <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
            <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">
            <?php 
    require "./helpers/db_connection.php";
    require "./helpers/validator.php";

    #fetch roles
    $sql = "select * from roles where id > 1";
    $role_data_op = mysqli_query($con,$sql);
    #fetch data
    $sql2 = "select email from users";
    $data_op = mysqli_query($con,$sql2);
    $data_arr = mysqli_fetch_assoc($data_op);
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
       # data cleaning 
       $name   = clear_input($_POST['name']);
       $email  = clear_input($_POST['email']);
       $pass   = clear_input($_POST['password']);
       $nat    = clear_input($_POST['nationality']);
       $role   = clear_input($_POST['roles_id']);
       
       # validation
       $errors = []; 

       # name validation 
       if(validate($name,"is_empty")) {
           $errors["name"] = "required";
       }elseif(!validate($name,"is_string")) {
           $errors["name"] = "must be a string";
       }

        # email validation 
        if(validate($email,"is_empty")) {
            $errors["email"] = "required";
        }elseif(!validate($email,"is_email")) {
            $errors["email"] = "invalid";
        }while($data2 = mysqli_fetch_assoc($data_op)) {
          if(in_array($email,$data2)) {
            $errors["email"] = " is used from another person";
            break;
          }
        }
        # password validation 
        if(validate($pass,"is_empty")) {
            $errors["password"] = "required";
        }elseif(validate($pass,"is_short",6)) {
            $errors["password"] = "is short";
        }
         # nationality validation 
         if(validate($nat,"is_empty")) {
            $errors["nationality"] = "required";
        }elseif(!validate($nat,"is_string")) {
            $errors["nationality"] = "incorrect";
        }

         # role validation 
         if(validate($role,"is_empty")) {
            $errors["role"] = "required";
        }elseif(!validate($role,"is_int")) {
            $errors["role"] = "invalid";
        }

        #if there any errors
        if(count($errors) > 0) {
            foreach($errors as $k => $v) {
                echo "<div style='color:white;background-color:#767bc2; width:300px'>*".$k." ".$v."</div><br>";
            } 
        }else {
            # code...
            $pass = md5($pass);
            
            $sql2  = "insert into users (name,email,password,nationality,role_id)values ('$name','$email','$pass','$nat',$role)";
                      
            $op = mysqli_query($con,$sql2);
           
            if($op) {
                header('Location: index.php');
            }



        }





    }

?>
              
            
            </h6>
            <a class="btn btn-outline-white wow fadeInLeft" data-wow-delay="0.3s">Learn more</a>
          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">
            <!--Form-->
            <div class="card wow fadeInRight" data-wow-delay="0.3s">
              <div class="card-body">
                <!--Header-->
                <div class="text-center">
                  <h3 class="white-text">
                    <i class="fa fa-user white-text"></i> Register:</h3>
                  <hr class="hr-light">
                </div>
                <!--Body-->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class = "md-form"
                method = "post">
                <div class="md-form">
                  <i class="fa fa-user prefix white-text active"></i>
                  <input type="text" id="form3" class="white-text form-control" name = "name">
                  <label for="form3" class="active">Your name</label>
                </div>
                <div class="md-form">
                  <i class="fa fa-envelope prefix white-text active"></i>
                  <input type="email" id="form2" class="white-text form-control" name = "email">
                  <label for="form2" class="active">Your email</label>
                </div>
                <div class="md-form">
                  <i class="fa fa-lock prefix white-text active"></i>
                  <input type="password" id="form4" class="white-text form-control" name = "password">
                  <label for="form4">Your password</label>
                </div>
                <div class="md-form">
                  <i class="fa fa-lock prefix white-text active"></i>
                  <input type="text" id="form4" class="white-text form-control" name = "nationality">
                  <label for="form4">Your nationality</label>
                </div>
                <div class="md-form">
                  <i class="fa fa-lock prefix white-text active"></i>
                  <label for="form4">Your Role</label>

                  <select name="roles_id" >
                  <!-- showing the fetched data  -->
                  <?php while($data = mysqli_fetch_assoc($role_data_op)) {?>
                       <option value="<?php echo $data['id']?>"> <?php echo $data['title']?> </option>
                   <?php } ?>

                  </select>
                  
                </div>
                <div class="text-center mt-4">
                  <button class="btn btn-indigo" type = "submit">Sign up</button>
                </form>
                  <hr class="hr-light mb-3 mt-4">
                  <div class="inline-ul text-center d-flex justify-content-center">
                    <a class="p-2 m-2 tw-ic">
                      <i class="fa fa-twitter white-text"></i>
                    </a>
                    <a class="p-2 m-2 li-ic">
                      <i class="fa fa-linkedin white-text"> </i>
                    </a>
                    <a class="p-2 m-2 ins-ic">
                      <i class="fa fa-instagram white-text"> </i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!--/.Form-->
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Content -->
    </div>
    <!-- Mask & flexbox options-->
  </div>
  <!-- Full Page Intro -->
</header>
</body>
</html>