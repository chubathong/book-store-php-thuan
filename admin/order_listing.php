<!--trang invoice-->
<title>Admin Page | Hoá đơn</title>
<?php
include 'header.php';
$config_name = "product";
$config_title = "products";

if (!empty($_SESSION['current_user'])) {
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION[$config_name.'_filter'] = $_POST;
        header('Location: '.$config_name.'_listing.php');exit;
    }
    if(!empty($_SESSION[$config_name.'filter'])){
        $where = "";
        foreach ($_SESSION[$config_name.'filter'] as $field => $value) {
            if(!empty($value)){
                switch ($field) {
                    case 'name':
                    $where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : "`".$field."` LIKE '%".$value."%'";
                    break;
                    default:
                    $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                    break;
                }
            }
        }
        extract($_SESSION[$config_name.'filter']);
    }
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 5;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($con, "SELECT * FROM `orders` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($con, "SELECT * FROM `orders`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $orders = mysqli_query($con, "SELECT * FROM `orders` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $orders = mysqli_query($con, "SELECT * FROM `orders` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
    ?>
    <div class="main-content">
        <h1>Danh sách hoá đơn</h1>
        <div class="listing-items">
            
            <div class="total-items">
                <?php /*
                  <span>Có tất cả <strong><?=$totalRecords?></strong> <?=$config_title?> trên <strong><?=$totalPages?></strong> trang</span> */ ?>
            </div>
            <ul>
                <li class="listing-item-heading">
                    <div class="listing-prop listing-id">ID</div>
                    <div class="listing-prop listing-name">Người nhận</div>
                    <div class="listing-prop listing-address">Địa chỉ</div>
                    <div class="listing-prop listing-phone">Số điện thoại</div>
                    <div class="listing-prop listing-button">
                        In
                    </div>
                    <div class="listing-prop listing-time">Ngày tạo</div>
                    <div class="clear-both"></div>
                </li>
                <?php  while ($row = mysqli_fetch_array($orders)) { ?>
                <li>
                    <div class="listing-prop listing-id"><?=$row['id']?></div>
                    <div class="listing-prop listing-name"><?=$row['name']?></div>
                    <div class="listing-prop listing-address"><?=$row['address']?></div>
                    <div class="listing-prop listing-phone"><?=$row['phone']?></div>
                    <div class="listing-prop listing-button">
                        <a href="order_printing.php?id=<?=$row['id']?>" target="_blank">Print</a>
                    </div>
                    <div class="listing-prop listing-time"><?=date('d/m/Y', $row['created_time'])?></div>
                    <div class="clear-both"></div>
                </li>
                <?php  } ?>
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