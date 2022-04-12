<?php
require_once 'connect_db.php';
if (isset($_POST['buttonSave'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];
  mysqli_query($con, 'insert into contact(username, email, phone, message) values("'.$username.'", "'.$email.'", "'.$phone.'", "'.$message.'")');
  header('Location:contact.php?category=0');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tương tác</title>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/icomoon.css">
    
</head>

<body>
  
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/nhasach.jpg');" data-stellar-background-ratio="0.5">
      
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center mb-4">
            <h1 class="mb-2 bread" style="color: cyan;">Contact</h1>
          </div>
        </div>
      </div>
</section>

    <!-- menu -->
<?php
  require_once('header.php');
?>
		

    <form  method="post">
				<div class="row d-flex align-items-stretch no-gutters">
					<div class="col-md-6 pt-5 px-2 pb-2 p-md-5 order-md-last">
						<h2 class="h4 mb-2 mb-md-5 font-weight-bold">Contact Us</h2>
						<form action="#">
              <div class="form-group">
                <input type="text"  class="form-control" placeholder="Your Name" name="username">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email" name="email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Phone" name="phone">
              </div>
              <div class="form-group">
                <textarea  cols="30" rows="7" type="text" class="form-control" placeholder="Message" name="message"></textarea>
              </div>
              <div class="col-4">
            <button type="submit" class="btn py-3 px-4 btn-info" name="buttonSave" value="save">Send</button>
          </div>
            </form>
					</div>
					<div class="mt-5 col-md-6 d-flex align-items-stretch" >
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4805356702686!2d106.6840421152164!3d10.77445996217523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f24912c888b%3A0xcbfc5f29ce5cb7ff!2zMzI0IE5ndXnhu4VuIMSQw6xuaCBDaGnhu4N1LCBQaMaw4budbmcgNSwgUXXhuq1uIDMsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1598346067609!5m2!1svi!2s" width="750" height="450" frameborder="0" style="border:0;"  aria-hidden="false" tabindex="0"></iframe>
				</div>
			</div>
      </form>
      

		
    <!-- footer -->
    <?php
  require_once('footer.php');
?>
</body>

</html>	
      