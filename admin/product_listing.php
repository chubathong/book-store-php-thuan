<!--trang product-->
<title>Admin Page | Sản phẩm</title>
<?php
include 'header.php';
$config_name = "product";
$config_title = "products";

//tim kiem san pham
if (!empty($_SESSION['current_user'])) {
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION['product_filter'] = $_POST;
        header('Location: product_listing.php');exit;
    }
    if(!empty($_SESSION['product_filter'])){
        $where = "";
        foreach ($_SESSION['product_filter'] as $field => $value) {
            if(!empty($value)){
                switch ($field) {
                    case 'name':
                    $where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : " `".$field."` LIKE '%".$value."%'";
                    break;
                    default:
                    $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                    break;
                }
            }
        }
        extract($_SESSION['product_filter']);
    }
 // phân trang   
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($con, "SELECT * FROM `product` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($con, "SELECT * FROM `product`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $products = mysqli_query($con, "SELECT * FROM `product` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $products = mysqli_query($con, "SELECT * FROM `product` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);

?>
    <div class="main-content">
        <h1>List <?=$config_title?></h1>
        <div class="listing-items">
            <div class="buttons">
            <a href="./product_editing.php">Add product</a>
            </div>
            <div class="listing-search">
                <form id="<?=$config_name?>-search-form" action="<?=$config_name?>_listing.php?action=search" method="POST">
                    <fieldset>
                        <legend>Search <?=$config_title?>:</legend>
                        ID: <input type="text" name="category_id" value="<?=!empty($category_id)?$category_id:""?>" />
                        Name <?=$config_title?>: <input type="text" name="name" value="<?=!empty($name)?$name:""?>" />
                        <input type="submit" value="Tìm" />
                    </fieldset>
                </form>
            </div>
            <div class="total-items">
                <span>Have <strong><?=$totalRecords?></strong> <?=$config_title?> on <strong><?=$totalPages?></strong> pages</span>
            </div>
            <ul>
                <li class="listing-item-heading">
                    <div class="listing-prop listing-img">Images</div>
                    <div class="listing-prop listing-name">Name <?=$config_title?></div>
                    <div class="listing-prop listing-button">
                        Delete
                    </div>
                    <div class="listing-prop listing-button">
                        Fix
                    </div>
                    <div class="listing-prop listing-button">
                        Copy
                    </div>
                    <div class="listing-prop listing-time">Created</div>
                    <div class="listing-prop listing-time">Category</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <li>
                        
                        <div class="listing-prop listing-img"><img src="../<?= $row['image'] ?>" alt="<?= $row['name'] ?>" title="<?= $row['name'] ?>" /></div>
                        <div class="listing-prop listing-name"><?= $row['name'] ?></div>
                        <div class="listing-prop listing-button">
                            <a href="./product_delete.php?id=<?= $row['id'] ?>">Delete</a>
                        </div>
                        <div class="listing-prop listing-button">
                            <a href="./product_editing.php?id=<?= $row['id'] ?>">Fix</a>
                        </div>
                        <div class="listing-prop listing-button">
                            <a href="./<?=$config_name?>_editing.php?id=<?= $row['id'] ?>&task=copy">Copy</a>
                        </div>
                        <div class="listing-prop listing-time"><?= date('d/m/Y', $row['created_time']) ?></div>
                        <div class="listing-prop listing-time"><?= $row['category_id'] ?></div>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <?php
            include './pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
    <?php
}
include './footer.php';
?>