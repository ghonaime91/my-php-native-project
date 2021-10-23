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

    $sql      = "select * from matrials where id = $id";
    $op       = mysqli_query($con,$sql);
    $matrial_data = mysqli_fetch_assoc($op);
     
   

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
              # data cleaning 
      $title = clear_input($_POST['title']);
      $desc  = clear_input($_POST['description']);
      $url   = clear_input($_POST['url']);


      
      # validation
      $errors = []; 

      # title validation 
      if(validate($title,"is_empty")) {
          $errors["title"] = "titls required";
      }elseif(!validate($title,"is_string")) {
          $errors["title"] = "title must be a string";
      }

  # desc validation 
      if(validate($desc,"is_empty")) {
          $errors["description"] = "description required";
      }elseif(!validate($title,"is_string")) {
          $errors["description"] = "description must be a string";
      }elseif(validate($title,"is_long",300)) {
        $errors["description"] = "description is too long";
    }
       
    # image process
    if(!empty($_FILES['image']['name'])) {
        $img_tmp  = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_type = $_FILES['image']['type'];

        $allowed_ext  = ['jpeg','jpg','png'];
        $arr_img_type = explode('/',$img_type);
        if(in_array($arr_img_type[1],$allowed_ext)) {
            $final_name = rand(1,50).time().".".$arr_img_type[1];
            $final_path = "./uploads/".$final_name;
            move_uploaded_file($img_tmp,$final_path);
        } else {
            $errors['image'] = "invalid extension";
        }

    } else {
        $errors['image'] = "image required";
    }
    
    # url validation 
    if(validate($url,"is_empty")) {
        $errors["url"] = "url required";
    }elseif(!validate($url,"is_url")) {
        $errors["url"] = "url is invalid";
    }
  
         #if there any errors
         if(count($errors) > 0) {
  
             $_SESSION['message'] = $errors;
  
             
         } else {
             # code...
            
             
             $sql2  = "update matrials set title = '$title', description = '$desc', image = '$final_name' , url = '$url' ,added_by = 3 where id = $id";
                       
             $op2 = mysqli_query($con,$sql2);
            echo mysqli_error($con);
            
             if($op) {
                 $_SESSION['message'] = ["matrial updated"];
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

                                $txt = "Dashboard / Update matrial";
                                print_messages($txt);
                            
                            ?>    
                            
                             </li>
                        </ol>


                        
    <div class="container">
        
        <form action="edit.php?id=<?php echo $matrial_data['id']?>" method="post" enctype="multipart/form-data">


                    
        <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name" value = <?php echo $matrial_data['title']; ?> >
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea name="description" id="" cols="80" rows="5"><?php echo $matrial_data['description']; ?></textarea>
            </div>

           


            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control"  >
                <br>
                <img src="uploads/<?php echo $matrial_data['image'];?>" width="150">
            </div>

            <input type="hidden" value = "<?php echo $matrial_data['image'];?>" name = "oldimage">

             
            <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" name="url" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name" value = <?php echo $matrial_data['url']; ?> >
            </div>

    


         

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

                       
                
                        
                    </div>
                </main>
                <?php 
                    require "../layouts/footer.php";
                ?>