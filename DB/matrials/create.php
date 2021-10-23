<?php
    require "../../helpers/db_connection.php";
    require "../../helpers/functions.php";
    require "../../helpers/validator.php";
    require "../../helpers/checklogin.php";

   

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
      }elseif(!validate($desc,"is_string")) {
          $errors["description"] = "description must be a string";
      }elseif(validate($desc,"is_long",300)) {
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

           
       } 
       else {
           # code...
           $added_by = $_SESSION['user']['id'];
           
           $sql  = "insert into matrials (title,description,image,url,added_by)values ('$title','$desc','$final_name','$url',$added_by)";
                     
           $op = mysqli_query($con,$sql);
          
           if($op) {
              
            
               $_SESSION['message'] = ["matrial created"];
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

                                $txt = "Dashboard / Create Matrial";
                                print_messages($txt);   
                            ?>
                             </li>
                        </ol>


                        
    <div class="container">
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">



            
        <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea name="description" id="" cols="80" rows="5"></textarea>
            </div>

           


            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control"  >
            </div>



             
            <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" name="url" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Name">
            </div>

    


         

            <button type="submit" class="btn btn-primary">Create</button>
        </form>

                       
                
                        
                    </div>
                </main>
                <?php 
                    require "../layouts/footer.php";
                ?>