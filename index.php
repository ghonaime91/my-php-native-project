
<?php
     require "./helpers/db_connection.php";
     require "./helpers/validator.php";

     
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
     # data cleaning 
     $name     = clear_input($_POST['name']);
     $email    = clear_input($_POST['email']);
     $message  = clear_input($_POST['message']);
          
     # validation
     $errors = []; 

     # name validation 
     if(validate($name,"is_empty")) {
         $errors["name"] = "required";
     }elseif(!validate($name,"is_string")) {
         $errors["name"] = "must be a string";
     }

      # email validation 
      if(validate($email,"is_empty")) {
          $errors["email"] = "required";
      }elseif(!validate($email,"is_email")) {
          $errors["email"] = "invalid";
      }
      
       # message validation 
       if(validate($message,"is_empty")) {
          $errors["message"] = "required";
      }elseif(validate($message,"is_long",300)) {
          $errors["message"] = "too long";
      }

      #if there any errors
      if(count($errors) > 0) {
          foreach($errors as $k => $v) {
              echo "*".$k." ".$v."<br>";
          } 
      }else {
          # code...
          
          $sql  = "INSERT INTO `contact_us`( `name`, `email`, `message`) VALUES ('$name','$email','$message')";
          $op   = mysqli_query($con,$sql);
          
          if($op) {
              header('Location: index.php');
          } else {
               echo "Error Try Again";
          }
          mysqli_close($con);
      }





  }

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Chess Academy</title>
	<!--



    -->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="team" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
<body>

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.php" class="navbar-brand">Chess Academy</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                         <li><a href="#home" class="smoothScroll">Home</a></li>
                         <li><a href="#feature" class="smoothScroll">Mession</a></li>
                         <li><a href="#about" class="smoothScroll">About us</a></li>
                         <li><a href="logup.php" class="smoothScroll">Log Up</a></li>
                         <li><a href="login.php" class="smoothScroll">Log In</a></li>
                         <li><a href="#contact" class="smoothScroll">Contact</a></li>
                         
                    <ul class="nav navbar-nav navbar-right">
                         <!-- <li><a href="#">Say hello - <span>info@soft.co</span></a></li> -->
                    </ul>
               </div>

          </div>
     </section>


     <!-- FEATURE -->
     <section id="home" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-3 col-md-6 col-sm-12">
                         <div class="home-info">
                              <h3>online chess academy</h3>
                              <h1>We help you to master chess online!</h1>
                              <form action="logup.php"  class="online-form">
                                   <input type="email" name="email" class="form-control" placeholder="Enter your email" required="">
                                   <button type="submit" class="form-control">Get started</button>
                              </form>
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- FEATURE -->
     <section id="feature" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h1>What will you learn </h1>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a href="#tab01" aria-controls="tab01" role="tab" data-toggle="tab">Openings</a></li>

                              <li><a href="#tab02" aria-controls="tab02" role="tab" data-toggle="tab">Middle games</a></li>

                              <li><a href="#tab03" aria-controls="tab03" role="tab" data-toggle="tab">End games</a></li>
                         </ul>

                         <div class="tab-content">
                              <div class="tab-pane active" id="tab01" role="tabpanel">
                                   <div class="tab-pane-item">
                                        <h2>The most famous Openings</h2>
                                        <p>Nam feugiat a ante sollicitudin luctus. Quisque eget placerat massa. Ut quis ligula ornare, pellentesque velit eget, vestibulum est. Donec pretium tristique elit eget sodales. Pellentesque posuere.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>Detailed Explanation</h2>
                                        <p>Aliquam massa massa, consectetur non mattis fringilla, sodales ac turpis. Morbi ac felis sagittis, faucibus mauris vitae, placerat mauris.</p>
                                   </div>
                              </div>


                              <div class="tab-pane" id="tab02" role="tabpanel">
                                   <div class="tab-pane-item">
                                        <h2>Most of the famous poses</h2>
                                        <p>Nam maximus elit a metus luctus, a faucibus magna mattis. Ut malesuada viverra iaculis. Nunc euismod sit amet neque a tincidunt.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>Videos</h2>
                                        <p>Maecenas maximus velit lorem, quis pharetra turpis fringilla id. Vestibulum tempor facilisis efficitur. Sed nec nisi sit amet nibh pellentesque elementum.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>Games</h2>
                                        <p>In viverra ipsum ornare sapien rhoncus ullamcorper. Vivamus vitae risus ac mi vehicula sagittis. Nulla dictum magna sit amet pharetra aliquam.</p>
                                   </div>
                              </div>

                              <div class="tab-pane" id="tab03" role="tabpanel">
                                   <div class="tab-pane-item">
                                        <h2>PGN files</h2>
                                        <p>Mauris rutrum est at fringilla pulvinar. Nam ligula urna, lobortis non scelerisque vel, molestie eu massa. Nullam mattis elit at tortor accumsan.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>Images</h2>
                                        <p>Quisque ullamcorper sem quis sapien cursus efficitur. Sed id sodales ipsum. Morbi eleifend tempus erat sit amet vehicula. Nulla at posuere tellus, non mattis erat. Nulla id massa gravida.</p>
                                   </div>
                              </div>
                         </div>

                    </div>

                    <div class="col-md-6 col-sm-6">
                         <div class="feature-image">
                              <img src="images/feature-mockup.png" class="img-responsive" alt="Thin Laptop">                             
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- ABOUT -->
     <section id="about" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-3 col-md-6 col-sm-12">
                         <div class="section-title">
                              <h1>Professional Team for you</h1>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb">
                              <img src="images/team-image1.jpg" class="img-responsive" alt="Andrew Orange">
                              <div class="team-info team-thumb-up">
                                   <h2>Andrew Orange</h2>
                                   <small>Training plan developer</small>
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb">
                              <div class="team-info team-thumb-down">
                                   <h2>Catherine Soft</h2>
                                   <small>Fide Master</small>
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</p>
                              </div>
                              <img src="images/team-image2.jpg" class="img-responsive" alt="Catherine Soft">
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb">
                              <img src="images/team-image3.jpg" class="img-responsive" alt="Jack Wilson">
                              <div class="team-info team-thumb-up">
                                   <h2>Jack Wilson</h2>
                                   <small>Grand master</small>
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</p>
                              </div>
                         </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- TESTIMONIAL -->
     <section id="testimonial" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <div class="testimonial-image"></div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="testimonial-info">
                              
                              <div class="section-title">
                                   <h1>What People Say</h1>
                              </div>

                              <div class="owl-carousel owl-theme">
                                   <div class="item">
                                        <h3>Vestibulum tempor facilisis efficitur. Sed nec nisi sit amet nibh pellentesque elementum. In viverra ipsum ornare sapien rhoncus ullamcorper.</h3>
                                        <div class="testimonial-item">
                                             <img src="images/tst-image1.jpg" class="img-responsive" alt="Michael">
                                             <h4>Michael</h4>
                                        </div>
                                   </div>

                                   <div class="item">
                                        <h3>Donec pretium tristique elit eget sodales. Pellentesque posuere, nunc id interdum venenatis, leo odio cursus sapien, ac malesuada nisl libero eget urna.</h3>
                                        <div class="testimonial-item">
                                             <img src="images/tst-image2.jpg" class="img-responsive" alt="Sofia">
                                             <h4>Muhammed</h4>
                                        </div>
                                   </div>

                                   <div class="item">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</h3>
                                        <div class="testimonial-item">
                                             <img src="images/tst-image3.jpg" class="img-responsive" alt="Monica">
                                             <h4>Aly</h4>
                                        </div>
                                   </div>
                              </div>

                         </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- PRICING -->
     <section id="pricing" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h1>Start Now</h1>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h2>Openings</h2>
                             </div>
                             <div class="pricing-info">
                                   <p>e4 Openings</p>
                                   <p>d4 Openings</p>
                                   <p>King's indian attack opening</p>
                                   <p>c4 English Opening</p>
                                   <p>Modern openings</p>
                             </div>
                             <div class="pricing-bottom">
                                  
                                   <a href="login.php" class="section-btn pricing-btn">Openings page</a>
                             </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h2>Middle games</h2>
                             </div>
                             <div class="pricing-info">
                                   <p>Strategies</p>
                                   <p>Tactics</p>
                                   <p>Traps</p>
                                   <p>Squares</p>
                                   <p>Pawns structurs</p>
                             </div>
                             <div class="pricing-bottom">
                                   
                                   <a href="login.php" class="section-btn pricing-btn">Middle page</a>
                             </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h2>End games</h2>
                             </div>
                             <div class="pricing-info">
                                   <p>King and pawn endgames</p>
                                   <p>Knight and pawn endings</p>
                                   <p>Bishop and pawn endings</p>
                                   <p>Bishops on opposite colors</p>
                                   <p>Rook and pawn endings</p>
                             </div>
                             <div class="pricing-bottom">
                                   
                                   <a href="login.php" class="section-btn pricing-btn">End page</a>
                             </div>
                         </div>
                    </div>
                    
               </div>
          </div>
     </section>   


     <!-- CONTACT -->
     <section id="contact" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-1 col-md-10 col-sm-12">
                         <form id="contact-form" role="form" 
                         action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                              <div class="section-title">
                                   <h1>Say hello to us</h1>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                   <input type="text" class="form-control" placeholder="Full name" name="name" required="">
                              </div>
                              <div class="col-md-4 col-sm-4">
                                   <input type="email" class="form-control" placeholder="Email address" name="email" required="">
                              </div>
                              <div class="col-md-4 col-sm-4">
                                   <input type="submit" class="form-control" name="send message" value="Send Message">
                              </div>
                              <div class="col-md-12 col-sm-12">
                                   <textarea class="form-control" rows="8" placeholder="Your message" name="message" required=""></textarea>
                              </div>
                         </form>
                    </div>

               </div>
          </div>
     </section>       


     <!-- FOOTER -->
     <footer id="footer" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="copyright-text col-md-12 col-sm-12">
                         <div class="col-md-6 col-sm-6">
                              <p>Copyright &copy; 2021 Ahmed Ghonaime - Design:
                				<a rel="nofollow" href="https://www.linkedin.com/in/ahmed-mohammed-ghonaime-7631b81a9/">My LinkedIn</a></p>
                         </div>

                         <div class="col-md-6 col-sm-6">
                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

               </div>
          </div>
     </footer>


     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>