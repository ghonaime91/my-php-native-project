<?php
    require "../../helpers/db_connection.php";
    require "../../helpers/functions.php";
    require "../../helpers/validator.php";
    require "../../helpers/checklogin.php";
    #fetching the roles
    $sql     = "SELECT * FROM roles";
    $op_role = mysqli_query($con,$sql);
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
          $errors["name"] = "name required";
      }elseif(!validate($name,"is_string")) {
          $errors["name"] = "name must be a string";
      }

       # email validation 
       if(validate($email,"is_empty")) {
           $errors["email"] = "email required";
       }elseif(!validate($email,"is_email")) {
           $errors["email"] = " email invalid";
       }while($data2 = mysqli_fetch_assoc($data_op)) {
        if(in_array($email,$data2)) {
          $errors["email"] = "email is used from another person";
          break;
        }
    }
       # password validation 
       if(validate($pass,"is_empty")) {
           $errors["password"] = "password required";
       }elseif(validate($pass,"is_short",6)) {
           $errors["password"] = "password is short";
       }
        # nationality validation 
        if(validate($nat,"is_empty")) {
           $errors["nationality"] = "nationality required";
       }elseif(!validate($nat,"is_string")) {
           $errors["nationality"] = "nationality incorrect";
       }

        # role validation 
        if(validate($role,"is_empty")) {
           $errors["role"] = "role required";
       }elseif(!validate($role,"is_int")) {
           $errors["role"] = "role invalid";
       }

       #if there any errors
       if(count($errors) > 0) {

           $_SESSION['message'] = $errors;

           
       } else {
           # code...
           $pass = md5($pass);
           
           $sql2  = "insert into users (name,email,password,nationality,role_id)values ('$name','$email','$pass','$nat',$role)";
                     
           $op = mysqli_query($con,$sql2);
          
           if($op) {
              
            
               $_SESSION['message'] = ["user created"];
               header('Location: index.php');
               exit();

           } else {

                $_SESSION['message'] = ["error try again"];

           }


        }

        

    } 


    require "../layouts/header.php";
    require "../layouts/topnav.php";

?>



    




        <div id="layoutSidenav">

            <?php
            
                require "../layouts/sidenav.php";
            
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                            <?php

                                $txt = "Dashboard / Create User";
                                print_messages($txt);   
                            ?>
                             </li>
                        </ol>


                        
    <div class="container">
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">



            
        <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Nationality</label>
                <input type="text" name="nationality" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name">
            </div>



            <div class="form-group">
                <label for="exampleInputPassword1">Role</label>
                <select  name="roles_id" class="form-control" >
                 <?php 
                    while($data = mysqli_fetch_assoc($op_role)){ 
                 ?>
                 
                 <option value="<?php echo $data['id'];?>">  <?php echo $data['title']; ?>  </option>

                 <?php } ?>
            </select>   
            </div>
    


         

            <button type="submit" class="btn btn-primary">Create</button>
        </form>

                       
                
                        
                    </div>
                </main>
                <?php 
                    require "../layouts/footer.php";
                ?>