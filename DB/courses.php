
<?php 
require "../helpers/db_connection.php";
require "../helpers/functions.php";
require "../helpers/validator.php";
require "../helpers/checklogin.php";


#fetch player name 
$player_name = $_SESSION['user']['name'];

#fetch matrials
$sql = "select matrials.*,users.name from matrials join users on matrials.added_by = users.id ";
$op  = mysqli_query($con,$sql);

?>


<!DOCTYPE html>
<html>

<head>
    <title>Courses</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        body {
            background-color:lightblue;
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
            <h1>Our Courses </h1>
            <br>
            <h3>Welcome <?php echo $player_name;?></h3>
            <br>
            <a href="logout.php">Logout</a>

            <!-- Searching form -->
            <div style="display:inline;padding-left:500px;">
                <form style="display:inline;" action="result.php"method="GET">
                <input type="submit" value ="Search">
                <input type="text" name="search">
                </form>
            </div>
            
            <div style="padding-left:950px"><a href="player.php" >My Courses</a></div>

        

            <!-- <a href="logout.php">LogOut</a> -->



        </div>

        <!-- PHP code to read records will be here -->



        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Course title</th>
                <th>Brief</th>
                <th>Image</th>
                <th>By Master</th>
                <th>action</th>
            </tr>
            
            <?php while($data = mysqli_fetch_assoc($op)) {?>
            <tr>    
                <td><?php echo $data['id'];?></td>
                <td><?php echo $data['title'];?></td>
                <td><?php echo $data['description'];?></td>
                <td><?php echo "<img src = matrials/uploads/".$data['image']." width = 150px>";?></td>
                <td><?php echo $data['name']?></td>
                <td><a href='enroll.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Enroll</a></td>
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
