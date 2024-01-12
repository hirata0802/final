<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<form action="db.php" method="post">
    <?php
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> prepare('select * from salon inner join category on salon.category_id=category.category_id where salon_id=?');
        $sql -> execute([$_GET['id']]);
        foreach($sql as $row){
            $address = $row['prefectures'].$row['city'].$row['address'].$row['apartment'];
            echo 'このサロンを削除しますか？';
            echo $row['salon_name'];
            echo $row['category_name'];
            echo $row['phone'];
            echo $address;
        }
        echo '<input type="hidden" name="id" value=', $_GET['id'], '>';
    ?>
    <input type="hidden" name="db" value="delete">
    <button>削除する</button>
</form>
<button type="button" onclick="location.href='list.php'">戻る</button>
<?php require 'footer.php'; ?>