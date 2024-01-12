<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<?php
    if(isset($_GET['db'])){
        if($_GET['db'] == 'register'){
            echo 'サロンを登録しました。';
        }else if($_GET['db'] == 'update'){
            echo 'サロンをアップデートしました。';
        }else if($_GET['db'] == 'delete'){
            echo 'サロンを削除しました。';
        }
    }
?>
<button type="button" onclick="location.href='register.php'">新規登録</button>
<table border="1">
    <tr>
        <th>サロン名</th><th>カテゴリ</th><th>電話番号</th><th>住所</th><th></th><th></th>
    </tr>
    <?php
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> query('select * from salon inner join category on salon.category_id=category.category_id');
        foreach($sql as $row){
            $address = $row['prefectures'].$row['city'].$row['address'].$row['apartment'];
            echo '<tr>';
            echo '<td>', $row['salon_name'], '</td>';
            echo '<td>', $row['category_name'], '</td>';
            echo '<td>', $row['phone'], '</td>';
            echo '<td>', $address, '</td>';
            echo '<td><a href="update.php?id=', $row['salon_id'], '">更新</a></td>';
            echo '<td><a href="delete.php?id=', $row['salon_id'], '">削除</a></td>';
            echo '</tr>';
        }
    ?>
<?php require 'footer.php'; ?>