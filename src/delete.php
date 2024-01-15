<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<form action="db.php" method="post" id="del">
    <?php
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> prepare('select * from salon inner join category on salon.category_id=category.category_id where salon_id=?');
        $sql -> execute([$_GET['id']]);
        foreach($sql as $row){
            echo '’     ', $row['salon_name'], ' ’を削除しますか？';
        }
        echo '<input type="hidden" name="id" value=', $_GET['id'], '>';
    ?>
    <input type="hidden" name="db" value="delete">
</form>
<button type="button" onclick="location.href='list.php'">戻る</button>
<button form="del">削除する</button>
<?php require 'footer.php'; ?>