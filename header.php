<header>
<div class="bg-black top"><!--bao het background -->
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
                            <br> <span style="color: black; font-size: large;">Từ 9:00AM Đến 10:00PM</span></p>
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
         <li class="nav-item"><a href="index.php?action=home" class="p-2 nav-link"><span style="color: black; font-size: x-large;" title="Trang chủ">Trang chủ</span></a></li>
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
                </li>
                <li class="nav-item"><a href="contact.php?category=0" class="p-2 nav-link"><span style="color: black; font-size: x-large;" title="tương tác">Tương tác</span></a></li>
    
                
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
    }

?>
<?php


include './connect_db.php';
$category = $_GET['category'];
if($category == 0) {
    $products = mysqli_query($con,'select * from product');
} else {
$products = mysqli_query($con,'select * from product where category_id = '.$category);
}

?>
</header>