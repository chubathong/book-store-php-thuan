<!DOCTYPE html>
<!--
đăng nhập tài khoản
-->
<html>
    <head>
        <title> Admin's page</title>
        <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fahasa | Log in</title>

        <style>
            .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #user_login form{
                width: 200px;
                margin: 40px auto;
            }
            #user_login form input{
                margin: 5px 0;
            }
        </style>
    </head>

    <body class="hold-transition login-page">
        <?php
        session_start();
        include '../connect_db.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con, "Select `id`,`username`,`fullname` from `user` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
            if (!$result) {
                $error = mysqli_error($con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
            }
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div id="login-notify" class="box-content">
                    <h1>Notification</h1>
                    <h4><?= !empty($error) ? $error : "The information is not correct" ?></h4>
                    <a href="./index.php">Go back</a>
                </div>
                <?php
                exit;
            }
            ?>
        <?php } ?>
        <?php if (empty($_SESSION['current_user'])) { ?>
            <div id="user_login" class="box-content">
            <div class="card-body login-card-body">
                <h1>Sign-in the account</h1>
                <form action="./index.php" method="Post" autocomplete="off">
                    <label>Username</label></br>
                    <input type="text" name="username" value="" /><br/>
                    <label>Password</label></br>
                    <input type="password" name="password" value="" /></br>
                    <br>
                    <input type="submit" class="btn btn-info" value="sign-in" />
                </form>
            </div>
            </div>
            <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            ?>
            <div id="login-notify" class="box-content">
                Hello <?= $currentUser['fullname'] ?><br/>
                <a href="./product_listing.php">Product management</a><br/>
                <a href="./edit.php">Change the password</a><br/>
                <a href="./logout.php">Sign-out</a>
                
            </div>
        <?php } ?>

    </body>
</html>