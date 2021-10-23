<?php
    require "../../helpers/db_connection.php";
    require "../../helpers/functions.php";
    require "../../helpers/validator.php";
    require "../../helpers/checklogin.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title = clear_input($_POST['title']);

        $errors = [];

        # validate title
        if(validate($title,"is_empty")) {
            $errors['title'] = 'required field';
        }
        # in case ther is any error
        if(count($errors) > 0) {
            $_SESSION['message'] = $errors;
        } else {
        #in case no errors:
            $sql = "INSERT INTO roles (`title`) VALUES ('$title')";
            $op  = mysqli_query($con,$sql);
          
            if($op) {
                $_SESSION['message'] = ['Data Inserted'];
                header('Location: index.php');
                exit();
            } else {
                $message = 'Error try again';
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

                                $txt = "Dashboard / Create Role";
                                print_messages($txt);   
                            ?>
                             </li>
                        </ol>


                        
    <div class="container">
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">



            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Role Title">
            </div>


         

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

                       
                
                        
                    </div>
                </main>
                <?php 
                    require "../layouts/footer.php";
                ?>