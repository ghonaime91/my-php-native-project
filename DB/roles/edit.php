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

    # fetching the old data
    $sql      = "SELECT * FROM roles WHERE id = $id";
    $op       = mysqli_query($con,$sql);
    $old_data = mysqli_fetch_assoc($op);  



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
            $sql = "UPDATE  roles SET title = '$title' WHERE id = $id";
            $op  = mysqli_query($con,$sql);
          
            if($op) {
                $_SESSION['message'] = ['Data Updated'];
                header('Location: index.php');
                exit();
            } else {
                $_SESSION['message'] = ['Error try again'];
            }    

            
        }
        

        mysqli_close($con);

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

                                $txt = "Dashboard / Update Role";
                                print_messages($txt);
                            
                            ?>    
                            
                             </li>
                        </ol>


                        
    <div class="container">
        
        <form action="edit.php?id=<?php echo $old_data['id']?>" method="post" enctype="multipart/form-data">



            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" value = "<?php echo $old_data['title'];?>" placeholder="Enter Role Title">
            </div>


         

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

                       
                
                        
                    </div>
                </main>
                <?php 
                    require "../layouts/footer.php";
                ?>