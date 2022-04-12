
<!DOCTYPE html>

<head>
<title>Trang chủ</title>
<link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/icomoon.css">
</head>
    <!-- menu -->
    <div class=" bg-black top"><!--bao het background -->
        <div class="container">
           
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md d-flex ">
                            <div><span class="icon-phone2" style="color: black; font-size: xx-large;"></span></div>&nbsp;
                            <span class="text" style="color: black; font-size: large;">0996924890</span>
                        </div>
                        <div class="col-md d-flex ">
                            <div><span class="icon-paper-plane" style="color:black; font-size: xx-large;"></span></div> &nbsp;
                            <span class="text" style="color: black; font-size: large; " >fahasa@email.com</span>
                        </div>
                        <br>
                        <div>    
                                                   
                            <p><span style="color: black; font-size: large;">Giờ mở cửa :</span> <span style="color: black; font-size: large;">Thứ 2 đến thứ 7</span>
                            <br> <span style="color: black; font-size: large;">Từ 9:00 AM Đến 10:00 PM</span></p>
                            </a>                              
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light">
        <div class="container">
           <div >
             <a href="index.php" title="Fahasa"><img src="images/fahasalogo.png" style="width: 200px;"></a>
           </div>
         <ul class="navbar-nav" style="margin-right: 300px;">
         <li class="nav-item"><a href="index.php?action=home" class="p-2 nav-link">
         <span style="color: black; font-size:x-large" title="Trang chủ">Trang chủ</span>
         </a></li>
                <li class="nav-item"><a href="about.php?category=0" class="p-2 nav-link"><span style="color: black; font-size: x-large;" title="giới thiệu">Giới thiệu</span></a></li>
                <li class="nav-item dropdown">
                    <a class="p-2 nav-link" href="category.php?category=0"><span style="color: black; font-size: x-large;" title="Danh mục">Danh mục</span></a>
                    
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  style="color: cyan;" href="category.php?category=1">Khoa học</a>
                        <a class="dropdown-item" style="color: cyan;" href="category.php?category=2">Âm nhạc</a>
                        <a class="dropdown-item" style="color: cyan;" href="category.php?category=3">Mĩ thuật</a>
                        <a class="dropdown-item" style="color: cyan;" href="category.php?category=4">Tình yêu</a>
                        <a class="dropdown-item" style="color: cyan;" href="category.php?category=5">Đồ ăn</a>
                    </div>
                    <li class="nav-item"><a href="contact.php?category=0" class="p-2 nav-link"><span style="color: black; font-size: x-large;" title="tương tác">Tương tác</span></a></li>
                </li>

 
                
            </ul>
            
        </div>
    </nav>

<?php
   if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "home":
                require_once("home.php");
                break;
        }
    } else {
        require_once("home.php");
    }

    ?>

<footer class="ftco-footer ftco-bg-dark ">
        <div class="container">
            <div class="row">
                <div>
                 
                    <h2 style="color: whitesmoke;">Fahasa.com</h2><br>
                    <h1 style="color: whitesmoke;">Địa chỉ : Lầu 5, 387-389 Hai Bà Trưng Quận 3 TP HCM</h1>
                           <strong style="color: cyan"> Truy cập nhà sách</strong>
                            <a href="https://www.twitter.com/"><span class="icon-twitter"></span></a>
                            <a href="https://www.facebook.com/"><span class="icon-facebook"></span></a>
                            <a href="https://www.instagram.com/"><span class="icon-instagram"></span></a>
                            <a href="https://www.youtube.com/"><span class="icon-youtube"></span></a>                       
                    </div>
                
                
                
                    <div>
                    <br>
                        <h2 style="color: whitesmoke;">Open Hours</h2>
                        <ul style="margin-left:-40px;">
                            <li class="d-flex"><span style="color: whitesmoke;">Monday:</span>&nbsp;<span style="color: whitesmoke;">9:00 - 22:00</span></li>
                            <li class="d-flex"><span style="color: whitesmoke;">Tuesday:</span>&nbsp;<span style="color: whitesmoke;">9:00 - 22:00</span></li>
                            <li class="d-flex"><span style="color: whitesmoke;">Wednesday:</span>&nbsp;<span style="color: whitesmoke;">9:00 - 22:00</span></li>
                            <li class="d-flex"><span style="color: whitesmoke;">Thursday:</span>&nbsp;<span style="color: whitesmoke;">9:00 - 22:00</span></li>
                            <li class="d-flex"><span style="color: whitesmoke;">Friday:</span>&nbsp;<span style="color: whitesmoke;">9:00 - 22:00</span></li>
                            <li class="d-flex"><span style="color: whitesmoke;">Saturday:</span>&nbsp;<span style="color: whitesmoke;">10:00 - 20:00</span></li>
                            <li class="d-flex"><span style="color: whitesmoke;">Sunday:</span>&nbsp;<span style="color: whitesmoke;"> 10:00 - 20:00</span></li>
                        </ul>
                    </div>
                

<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div>&nbsp;<br>
                        <h2 style="color: whitesmoke;">Company</h2>
                        
                         <a href="about.php?category=0">About us</a><br>
                         
                        
                </div>

            </div>
        </div>
</footer>
    <!-- end footer -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="js/main.js"></script>
    
</html>