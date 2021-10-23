<?php
   require "../../helpers/db_connection.php";
   require "../../helpers/functions.php";
   require "../../helpers/validator.php";
   require "../../helpers/checklogin.php";

   # fetch the data
    $sql = "select * from contact_us";
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

                                $txt = "Dashboard / Contact us";
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($data = mysqli_fetch_assoc($op)) {?>
                                            <tr>
                                                <td><?php echo $data['id'];?></td>
                                                <td><?php echo $data['name'];?></td>
                                                <td><?php echo $data['email'];?></td>
                                                <td><?php echo $data['message'];?></td>
                                               
                                                <td>
                                                <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                               
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