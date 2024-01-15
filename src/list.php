<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php
    if(isset($_GET['db'])){
        if(strcmp($_GET['db'], "register") == 0){
            echo 'サロンを登録しました。';
        }else if(strcmp($_GET['db'], "update") == 0){
            echo 'サロンを更新しました。';
        }else if(strcmp($_GET['db'], "delete") == 0){
            echo 'サロンを削除しました。';
        }
    }
?>
<a href="register.php" class="btn-new">新規登録</a>
<table>
    <tr>
        <th>サロン名</th><th>リンク</th><th>カテゴリ</th><th>電話番号</th><th>住所</th><th></th><th></th>
    </tr>
    <?php
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> query('select * from salon inner join category on salon.category_id=category.category_id');
        foreach($sql as $row){
            $address = $row['prefectures'].$row['city'].$row['address'].$row['apartment'];
            echo '<tr>';
            echo '<td>', $row['salon_name'], '</td>';
            echo '<td>', $row['link'], '</td>';
            echo '<td>', $row['category_name'], '</td>';
            echo '<td>', $row['phone'], '</td>';
            echo '<td>', $address, '</td>';
            echo '<td><a href="update.php?id=', $row['salon_id'], '" class="btn-upd">更新</a></td>';
            echo '<td><a href="delete.php?id=', $row['salon_id'], '" class="btn-del">削除</a></td>';
            echo '</tr>';
        }
    ?>
<?php require 'footer.php'; ?>