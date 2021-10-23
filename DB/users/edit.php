<?php
    require "../../helpers/db_connection.php";
    require "../../helpers/functions.php";
    require "../../helpers/validator.php";
    require "../../helpers/checklogin.php";

    # id validataion

    $id = $_GET['id'];

    if(!validate($id,"is_int")) {
        $message = "Invalid id";
        $_SESSION['message'] = [$message];
        header('Location: index.php');
    }

    # fetching the old users data

    $sql      = "select * from users where id = $id";
    $op       = mysqli_query($con,$sql);
    $old_data = mysqli_fetch_assoc($op);
     
     # fetching the old roles data

    $sql2       = "SELECT * FROM roles";
    $op2        = mysqli_query($con,$sql2);
   
    

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        # data cleaning 
        $name   = clear_input($_POST['name']);
        $email  = clear_input($_POST['email']);
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
            
             
             $sql3  = "update users set name = '$name', email = '$email', nationality = '$nat' , role_id = $role where id = $id";
                       
             $op3 = mysqli_query($con,$sql3);
            
             if($op) {
                 $_SESSION['message'] = ["user updated"];
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

                                $txt = "Dashboard / Update User";
                                print_messages($txt);
                            
                            ?>    
                            
                             </li>
                        </ol>


                        
    <div class="container">
        
        <form action="edit.php?id=<?php echo $old_data['id']?>" method="post" enctype="multipart/form-data">


    
        <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name" value = <?php echo $old_data['name'];?>  >
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" 
                    value = <?php echo $old_data['email']; ?> >
            </div> 

            

            <div class="form-group">
                <label for="exampleInputEmail1">Nationality</label>
                <input type="text" name="nationality" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name"  value = <?php echo $old_data['nationality'];?> >
            </div>



            <div class="form-group">
                <label for="exampleInputPassword1">Role</label>
                <select  name="roles_id" class="form-control" >
                 <?php 
                    while($data  = mysqli_fetch_assoc($op2)){ 
                 ?>
                 
                 <option value="<?php echo $data['id'];?>" <?php if($data['id'] == $old_data['role_id']){echo "selected";}?>>  <?php echo $data['title']; ?>  </option>

                 <?php } ?>
            </select>   
            </div>
    


         

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

                       
                
                        
                    </div>
                </main>
                <?php 
                    require "../layouts/footer.php";
                ?>