<?php
    const SERVER = 'mysql220.phy.lolipop.lan';
    const DBNAME = 'LAA1518091-final';
    const USER = 'LAA1518091';
    const PASS = 'Pass0802';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧</title>
</head>
<body>
    <button type="button">新規登録</button>';
    <table>
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
        echo '<td><button onclick="location.href=`update.php?id=', $row['salon_id'], '`">更新</button></td>';
        echo '<td><button onclick="location.href=`delete.php?id=', $row['salon_id'], '`">削除</button></td>';
        echo '</tr>';
    }
?>
</body>
</html>