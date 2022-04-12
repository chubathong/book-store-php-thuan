<!DOCTYPE html>
<!--
đổi mật khẩu
-->
<html>
    <head>
        <title>Change the admin's info</title>
        <meta charset="UTF-8"> <!-- Mã hóa có độ dài thay đổi và sử dụng các đơn vị mã 8 bit.-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--viewport: hiển thị tương ứng với kích thước của từng thiết bị khác nhau-->
        <!--initial scale 
        thiết lập mức độ phóng ban đầu khi trang được trình duyệt tải lần đầu tiên,
         người dùng sẽ không thể zoom khi thuộc tính này có giá trị bằng 1.-->
        <style>
            .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #edit_user form{
                width: 200px;
                margin: 40px auto;
            }
            #edit_user form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        include '../connect_db.php';
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])
            ) {
                $userResult = mysqli_query($con, "Select * from `user` WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
                if ($userResult->num_rows > 0) {
                    $result = mysqli_query($con, "UPDATE `user` SET `password` = MD5('" . $_POST['new_password'] . "'), `last_updated`=" . time() . " WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
                    if (!$result) {
                        $error = "Unable to access the account.";
                    }
                } else {
                    $error = "The password is incorrect.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Notification</h1>
                        <h4><?= $error ?></h4>
                        <a href="./edit.php">Change the password</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Update the account successfully" ?></h1>
                        <a href="./index.php">Back to the account</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>Please fulfill the information</h1>
                    <a href="./edit.php">Back to edit the account</a>
                </div>
                <?php
            }
        } else {
            session_start();
            $user = $_SESSION['current_user'];
            if (!empty($user)) {
                ?>
                <div id="edit_user" class="box-content">
                    <h1>Hello "<?= $user['fullname'] ?>". You are changing the account!</h1>
                    <form action="./edit.php?action=edit" method="Post" autocomplete="off">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <label>Old Password </label></br>
                        <input type="password" name="old_password"/></br>
                        <label>New Password </label></br>
                        <input type="password" name="new_password" /></br>
                        <br><br>
                        <input type="submit" value="Edit" />
                    </form>
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>
