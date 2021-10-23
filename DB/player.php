
<?php 
require "../helpers/db_connection.php";
require "../helpers/checklogin.php";

#fetch courses
$player_name = $_SESSION['user']['name'];
$player_id = $_SESSION['user']['id'];

$sql = "select * from users inner join courses on users.id = courses.player_id
inner join matrials on courses.matrial_id = matrials.id where player_id = $player_id";
$op  = mysqli_query($con,$sql);

?>


<!DOCTYPE html>
<html>

<head>
    <title>My Courses</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        body {
            background-color:#9aa9ad;
            font-weight:bold;
        }
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>My Courses </h1>
            <br>
            <h3>Welcome <?php echo $player_name;?></h3>
            <br>
            <a href="logout.php">Logout</a>
            <div style="padding-left:950px"><a href="courses.php" >Our Courses</a></div>
            

        

            <!-- <a href="logout.php">LogOut</a> -->



        </div>

        <!-- PHP code to read records will be here -->



        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>Course id</th>
                <th>Course title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Course page</th>
                <th>action</th>
            </tr>
            
            <?php while($data = mysqli_fetch_assoc($op)) {?>
            <tr>    
                <td><?php echo $data['matrial_id'];?></td>
                <td><?php echo $data['title'];?></td>
                <td><?php echo $data['description'];?></td>
                <td><?php echo "<img src = matrials/uploads/".$data['image']." width = 150px>";?></td>
                <td><?php echo "<a href=".$data['url']." target='_blank'>Go to course page</a>"?></td>
                <td><a href='cancel.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Cancel</a></td>
            </tr>
             <?php }?>   

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
