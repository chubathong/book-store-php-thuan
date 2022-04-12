<!DOCTYPE html>
<!--
danh muc sản phẩm
-->
<html>
<head>
<title>Danh mục</title>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/icomoon.css">

</head>
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/nhasach.jpg');" >
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center mb-4">
            <h1 class="mb-2 bread" style="color: cyan;">Danh mục sản phẩm</h1>
          </div>
        </div>
      </div>
</section>
    <!-- menu -->
<?php
  require_once('header.php');
?>
<section> 
    
  
    <style>
        body{
            font-family: arial;
        }
        .container{
            width: 1200px;
            margin: 0 auto;
        }
        h1{
            text-align: center;
        }
        .product-items{
            padding: 30px;
       
           
        }
        .product-item{
            float: left;
            width: 23%;
            margin: 1%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            line-height: 26px;
        }
        .product-item label{
            font-weight: bold;
        }
        .product-item p{
            margin: 0;
            line-height: 26px;
            max-height: 52px;
            overflow: hidden;
        }
        .product-price{
            color: red;
            font-weight: bold;
        }
        .product-img{
            padding: 5px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
           
        }
        .product-item img{
            max-width: 100%;
        }
        .product-item ul{
            margin: 0;
            padding: 0;
            border-right: 1px solid #ccc;
        }
        .product-item ul li{
            float: left;
            width: 33.3333%;
            list-style: none;
            text-align: center;
            border: 1px solid #ccc;
            border-right: 0;
            box-sizing: border-box;
        }
        .clear-both{
            clear: both;
    
        }
        a{
            text-decoration: none;
        }
        .buy-button{
            text-align: right;
            margin-top: 10px;
        }
        .buy-button a{
            background: #444;
            padding: 5px;
            color: #fff;
        }
        #pagination{
            text-align: right;
            margin-top: 15px;
        }
        .page-item{
            border: 1px solid #ccc;
            padding: 5px 9px;
            color: #000;
        }
        .current-page{
            background: #000;
            color: #FFF;
        }
        #wrapper-product{
            border: 1px solid #ccc;
        }
        #product-search{
            margin: 0 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
            float: left;
        }
        #sort-box{
            float: right;
            margin-right: 45px;
            line-height: 24px;
            height: 24px;
        }
    </style>
</section>

<section>

<?php
    include './connect_db.php';
    $category = $_GET['category'];
    if($category == 0) {
        $products = mysqli_query($con,'select * from product');
    } else {
    $products = mysqli_query($con,'select * from product where category_id = '.$category);
    }
?>
<br><br>

<section>
       
            <h1>Danh sách sản phẩm</h1>
            <div class="product-items">
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <div class="product-item">
                        <div class="product-img">
                            <a href="product_detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['image'] ?>" title="<?= $row['name'] ?>" /></a>
                        </div>
                        <strong><a href="product_detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></strong><br/>
                        <label>Price: </label><span class="product-price"><?= number_format($row['price'], 0, ",", ".") ?> đ</span><br/>
                        
                        <div class="buy-button">
                          <a href="product_detail.php?id=<?= $row['id'] ?>">Buy</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="clear-both"></div>
              
            </div>
       
</section>        
<?php
  require_once('footer.php');
?>
</html>