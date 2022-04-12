<!DOCTYPE html>
<!--
In hoá đơn / chi tiết hoá đơn
-->
<html>
    <head>
        <title>Chi tiết hoá đơn</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
        session_start();
        if (!empty($_SESSION['current_user'])) {
            include '../connect_db.php';
            $orders = mysqli_query($con, "SELECT orders.name, orders.address, orders.phone, orders.note, order_detail.*, product.name as product_name 
FROM orders
INNER JOIN order_detail ON Orders.id = order_detail.order_id
INNER JOIN product ON product.id = order_detail.product_id
WHERE orders.id = " . $_GET['id']);
            $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
        }
        ?>
        <div id="order-detail-wrapper">
            <div id="order-detail">
                <h1>Chi tiết hoá đơn</h1>
                <label>Người nhận: </label><span> <?= $orders[0]['name'] ?></span><br/>
                <label>Số điện thoại : </label><span> <?= $orders[0]['phone'] ?></span><br/>
                <label>Địa chỉ: </label><span> <?= $orders[0]['address'] ?></span><br/>
                <hr/>
                <h3>Danh sách mua</h3>
                <ul>
                    <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                        <li>
                        
                        <label><span class="item-name">Tên sản phẩm : </label><?= $row['product_name'] ?></span><br>
                        <label><span class="item-quantity">Số lượng : </label><?= $row['quantity'] ?> sản phẩm </span>
                            <br>                          
                            <label><span class="item listing-time">Ngày khỏi tạo : </label><?= date('d/m/Y', $row['created_time']) ?></span>
                        </li>
                        <?php
                        $totalMoney += ($row['price'] * $row['quantity']);
                        $totalQuantity += $row['quantity'];
                    }
                    ?>
                </ul>
                <hr/>
                <label>Tổng cộng số lượng :</label> <?= $totalQuantity ?><br>
                <label>Tổng cộng số tiền :</label> <?= number_format($totalMoney, 0, ",", ".") ?> đ
                <p><label>Ghi chú: </label><?= $orders[0]['note'] ?></p>
            </div>
        </div>
    </body>
</html>