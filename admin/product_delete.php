<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>Delete product</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect_db.php';
                $result = mysqli_query($con, "DELETE FROM `product` WHERE `id` = " . $_GET['id']);
                if (!$result) {
                    $error = "Cannot delete the product.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h2>Notification</h2>
                        <h4><?= $error ?></h4>
                        <a href="./product_listing.php">Product list</a>
                    </div>
        <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h2>Product deleted successfully</h2>
                        <a href="./product_listing.php">Product list</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>