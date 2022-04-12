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

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/nhasach.jpg');">   
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div>
            <h1 class="mb-2 bread" style="color: cyan;">GIỎ HÀNG</h1>
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

        <?php
        include './connect_db.php';
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $error = false;
        $success = false;
        if (isset($_GET['action'])) {

            function update_cart($add = false) {
                foreach ($_POST['quantity'] as $id => $quantity) {
                    if ($quantity == 0) {
                        unset($_SESSION['cart'][$id]);
                    } else {
                        if ($add) {
                            $_SESSION['cart'][$id] += $quantity;
                        } else {
                            $_SESSION['cart'][$id] = $quantity;
                        }
                    }
                }
            }

            switch ($_GET['action']) {
                case "add":
                    update_cart(true);
                    header('Location: ./cart.php');
                    break;
                case "delete":
                    if (isset($_GET['id'])) {
                        unset($_SESSION['cart'][$_GET['id']]);
                    }
                    header('Location: ./cart.php');
                    break;
                case "submit":
                    if (isset($_POST['update_click'])) { //Update the quantity
                        update_cart();
                        header('Location: ./cart.php');
                    } elseif (isset($_POST['continue_click'])) {
                        header('Location: ./category.php?category=0');
                    }   
                        elseif ($_POST['order_click']) { //Đặt hàng sản phẩm
                        if (empty($_POST['name'])) {
                            $error = "Please input your fullname";
                        } elseif (empty($_POST['phone'])) {
                            $error = "Please input your phone number";
                        } elseif (empty($_POST['address'])) {
                            $error = "Please input the address";
                        } elseif (empty($_POST['quantity'])) {
                            $error = "Empty cart";
                        }
                        if ($error == false && !empty($_POST['quantity'])) { //execute for cart
                            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `id` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                            $total = 0;
                            $orderProducts = array();
                            while ($row = mysqli_fetch_array($products)) {
                                $orderProducts[] = $row;
                                $total += $row['price'] * $_POST['quantity'][$row['id']];
                            }
                            $insertOrder = mysqli_query($con, "INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `note`, `total`, `created_time`, `last_updated`) VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $_POST['note'] . "', '" . $total . "', '" . time() . "', '" . time() . "');");
                            $orderID = $con->insert_id;
                            $insertString = "";
                            foreach ($orderProducts as $key => $product) {
                                $insertString .= "(NULL, '" . $orderID . "', '" . $product['id'] . "', '" . $_POST['quantity'][$product['id']] . "', '" . $product['price'] . "', '" . time() . "', '" . time() . "')";
                                if ($key != count($orderProducts) - 1) {
                                    $insertString .= ",";
                                }
                            }
                            $insertOrder = mysqli_query($con, "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_time`, `last_updated`) VALUES " . $insertString . ";");
                            $success = "Đặt hàng thành công. Cảm ơn !";
                            
                            unset($_SESSION['cart']);
                        }
                    }
                    break;
            }
        }
        if (!empty($_SESSION['cart'])) {
            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `id` IN (" . implode(",", array_keys($_SESSION['cart'])) . ")");
        }

        ?>
        <div class="container">
            <?php if (!empty($error)) { ?> 
                <div id="notify-msg">
                    <?= $error ?>. <a href="javascript:history.back()">Quay lại</a>
                </div>
            <?php } elseif (!empty($success)) { ?>
                <div id="notify-msg" style="text-align:center">
                    <?= $success ?>. <br><a href="category.php?category=0">Tiếp tục mua</a>
                </div>
            <?php } else { ?>
                <p style="text-align:right"><h1>Giỏ hàng</h1><p>
                <form id="cart-form" action="cart.php?action=submit" method="POST">
                    <table style="width:100%;height:300px ;text-align:center" border="2"  >
                        <tr>
                            <th class="product-number">Number</th>
                            <th class="product-name">Product Name</th>
                            <th class="product-img">Image</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="total-money">Cost</th>
                            <th class="product-delete">Remove</th>
                        </tr>
                        <?php
                        if (!empty($products)) {
                            $total = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($products)) {
                                ?>
                                <tr>
                                    <td class="product-number"><?= $num++; ?></td>
                                    <td class="product-name"><?= $row['name'] ?></td>
                                    <td class="product-img"><img src="<?= $row['image'] ?>" with="250" height="200"/></td>
                                    <td class="product-price"><?= number_format($row['price'], 0, ",", ".") ?></td>
                                    <td class="product-quantity"><input type="text" value="<?= $_SESSION['cart'][$row['id']] ?>" name="quantity[<?= $row['id'] ?>]" style="text-align:center"/></td>
                                    <td class="total-money"><?= number_format($row['price'] * $_SESSION['cart'][$row['id']], 0, ",", ".") ?></td>
                                    <td class="product-delete"><a href="cart.php?action=delete&id=<?= $row['id'] ?>">Xoá</a></td>
                                </tr>
                                <?php
                                $total += $row['price'] * $_SESSION['cart'][$row['id']];
                            }
                            ?>
                            <tr id="row-total">
                                <td class="product-number">&nbsp;</td>
                                <td class="product-name">Total</td>
                                <td class="product-img">&nbsp;</td>
                                <td class="product-price">&nbsp;</td>
                                <td class="product-quantity">&nbsp;</td>
                                <td class="total-money"><?= number_format($total, 0, ",", ".") ?> &nbsp; VND</td>
                                <td class="product-delete"></td>
                            </tr>
                            <?php
                        }
                        ?>  
                    </table>
                    <br>
                    <div id="form-button" style="text-align:right">
                        <input type="submit" name="update_click" value="Cập nhật" /> &nbsp;
                        <input type="submit" name="continue_click" value="Tiếp tục mua hàng" />
                    </div>
                    <hr>
                    <h2>THÔNG TIN GIAO HÀNG</h2>
                    <div><label>Người nhận:</label>&nbsp;&nbsp;
                    <input type="text" name="name" /></div>
                    <div><label>Số điện thoại: </label>&nbsp;<input type="text" name="phone" /></div>
                    <div><label>Địa chỉ: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="address" /></div>
                    <div ><label>Ghi chú: </label><br><textarea name="note" cols="50" rows="7" ></textarea></div><br>
                    <input type="submit" name="order_click" value="Xác nhận" />
                </form>
            <?php } ?>
        </div>
        <?php
           require_once('footer.php');
        ?>
    </body>
</html>