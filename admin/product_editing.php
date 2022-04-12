<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ?  "Sửa sản phẩm" : "Thêm sản phẩm" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {    
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    //nếu ko nhập tên sản phẩm
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    }
                    //kiểm tra ảnh xem có đc up lên hay chưa
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (!isset($image) && !empty($_POST['image'])) {
                        $image = $_POST['image'];
                    }
                    if (!isset($quantity) && !empty($_POST['quantity'])) {
                        $quantity = $_POST['quantity'];
                    }
                    if (!isset($author) && !empty($_POST['author'])) {
                        $author = $_POST['author'];
                    }
 
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Edit the product
                            $result = mysqli_query($con, "UPDATE `product` SET `name` = '" . $_POST['name'] . "',`image` =  '" . $image . "'
                            , `price` = " . str_replace('.', '', $_POST['price']) . ",`author` =  '" . $_POST['author'] . "'
                            , `created_time` = " . time() . ",`last_updated` = " . time() . ",`category_id` = '".$_POST['category_id']."' WHERE `product`.`id` = " . $_GET['id']);
                        } else { //Add the product
                            $result = mysqli_query($con, "INSERT INTO `product` (`id`, `name`, `image` , `author`, `price`, `created_time`, `last_updated`, `category_id`) VALUES (NULL,'" . $_POST['name'] . "','" . $image . "','" . $author . "'," . str_replace('.', '', $_POST['price']) . ", " . time() . "," . time() . ",'". $_POST['category_id']."');");
                        }

                        if (!$result) { //If the error occurs
                            $error = "An error occurred during execution.";
                        } 
                    }
                } else {
                    $error = "You have not entered product information.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Update successful" ?></div>
                    <a href = "product_listing.php">Back to product list</a>
                </div>
                <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = " . $_GET['id']);
                    $product = $result->fetch_assoc();
                   
                }
                ?>
        <form id="editing-form" method="POST"
            action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"
            enctype="multipart/form-data">
            <input type="submit" title="Lưu sản phẩm" value="" />
            <div class="clear-both"></div>
            <div class="wrap-field">
                <label>Category: </label>
                <?php $results = mysqli_query($con, 'select * from category'); ?>
                <select name="category_id" style="width: 170px;">
                    <?php while ($categories = mysqli_fetch_array($results)) { ?>
                    <option value="<?= (!empty($categories['category_id']) ? $categories['category_id'] : "") ?>">
                        <?= $categories['name'] ?></option>
                    <?php } ?>
                </select>
                <div class="clear-both"></div>
            </div>
            <br>
            <div class="wrap-field">
                <label>Product Name: </label>
                <input type="text" name="name" value="<?= (!empty($product) ? $product['name'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="wrap-field">
                <label>Price: </label>
                <input type="text" name="price"
                    value="<?= (!empty($product) ? number_format($product['price'], 0, ",", ".") : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="wrap-field">
                <label>Author: </label>
                <input type="text" name="author" value="<?= (!empty($product) ? $product['author'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="wrap-field">
                <label>Image: </label>
                <div class="right-wrap-field">
                    <?php if (!empty($product['image'])) { ?>
                    <img src="../<?= $product['image'] ?>" /><br />
                    <input type="hidden" name="image" value="<?= $product['image'] ?>" />
                    <?php } ?>
                    <input type="file" name="image" />
                </div>
        </form>
        <div class="clear-both"></div>

    <?php } ?>
        </div>
    </div>

    <?php
   
}
include './footer.php';
?>
