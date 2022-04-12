<title>Admin Page | Tương tác</title>
<?php
require_once '../connect_db.php';
include 'header.php';

$result = mysqli_query($con, 'select * from contact');

?>
<head>
   <title>Contact client</title>
</head>
<h1>Contact client</h1>
<table border="1" style="width: 900px; height: 400px;">
    <tr>
        <th>Id</th>
        <th>Người dùng</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th>Nội dung</th>
   
    </tr>
    <?php while ($contact = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?= $contact['id'] ?></td>
            <td><?= $contact['username'] ?></td>
            <td><?= $contact['email'] ?></td>
            <td><?= $contact['phone'] ?></td>
            <td><?= $contact['message'] ?></td>
            
        </tr>
    <?php } ?>
</table>
<?php
 include 'footer.php';
?>
