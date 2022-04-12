<?php session_start(); ?>
<html>
    <head>
        <title>Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/icomoon.css">
    </head>

    <body>
 <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg8.jpg');">   
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div>
            <h1 class="mb-2 bread" style="color: cyan;">Chi tiết sản phẩm</h1>
          </div>
        </div>
      </div>
      
</section>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light">
        <div class="container">
           <div >
           <a href="index.php" title="Fahasa"><img src="images/fahasalogo.png" style="width: 400px;"></a>
           </div>
            
        </div>
    </nav>


    <body>
        <?php
        include './connect_db.php';
        $result = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = ".$_GET['id']);
        $product = mysqli_fetch_assoc($result);
        ?>
        <div class="container">
            <h2>Chi tiết sản phẩm</h2>
            <div id="product-detail">
                <div id="product-img">
                    <img src="<?=$product['image']?>" />
                </div>
                <div id="product-info">
                    <h1><?=$product['name']?></h1>
                    <label>Giá: </label><span class="product-price"><?= number_format($product['price'], 0, ",", ".") ?> VND</span><br/>
                    <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                        <input type="text" value="1" name="quantity[<?=$product['id']?>]" size="2" /><br/>
                        <input type="submit" value="Mua" />
                    </form>
                </div>              
            </div>
        </div>
        
        <?php
           require_once('footer.php');
        ?>
    </body>
</html>