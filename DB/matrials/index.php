<?php
   require "../../helpers/db_connection.php";
   require "../../helpers/functions.php";
   require "../../helpers/validator.php";
   require "../../helpers/checklogin.php";

    #check privlege
    if($_SESSION['user']['role_id'] == 1) {
        $sql = "select matrials.*,users.name from matrials join users on matrials.added_by = users.id ";    
    } else {
        $id = $_SESSION['user']['id'];
        $sql = "select matrials.*,users.name from matrials join users on matrials.added_by = users.id where matrials.added_by = $id";
    }


   # fetch the data
    
    $op  = mysqli_query($con,$sql);






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

                                $txt = "Dashboard / List Matrials";
                                print_messages($txt);

                                ?> 
                            </li>
                        </ol>



                       
                
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Matrial Page</th>
                                                <th>Trainer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($data = mysqli_fetch_assoc($op)) {?>
                                            <tr>
                                                <td><?php echo $data['id'];?></td>
                                                <td><?php echo $data['title'];?></td>
                                                <td><?php echo $data['description'];?></td>
                                                <td><?php echo "<img src = uploads/".$data['image']." width = 150px>";?></td>
                                                <td><?php echo "<a href = ".$data['url']." target='_blank'>"."go to the course"."</a>";?></td>
                                                <td><?php echo $data['name'];?></td>
                                                <td>
                                                <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
                                                </td>
                                            </tr>   
                                            <?php }?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php 
                    require "../layouts/footer.php";
                ?>