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
    <title>新規登録</title>
</head>
<body>
    <form action="db.php" method="post">
    <?php
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> prepare('select * from salon inner join category on salon.category_id = category.category_id where salon.salon_id=?');
        $sql -> execute($_GET['id']);

        foreach($sql as $row){
            echo '<input type="text" name="name" placeholder="サロン名" value="', $row['salon_name'], '" required>';
            echo '<select name="category" required>';
            echo '<option value="">カテゴリ</option>';
            echo '<option value="', $row['category_id'], '">', $row['category_name'], '</option>';
            echo '</select>';
            echo '<input type="tel" name="phone" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号(ハイフンなし)"  value="', $row['phone'], '"required>';
            echo '<input type="text" name="post" id="zipcode" placeholder="郵便番号(ハイフンなし)" value="', $row['post_number'], '" required>';
            echo '<button type="button" id="search">住所検索</button>';
            echo '<input type="text" name="prefecture" id="prefecture" placeholder="都道府県" value="', $row['prefectures'], '" required>';
            echo '<input type="text" name="city" id="city" placeholder="市区町村" value="', $row['city'], '" required>';
            echo '<input type="text" name="address" id="address" placeholder="番地" value="', $row['address'], '" required>';
            echo '<input type="text" name="apartment" placeholder="建物名・部屋番号" value="', $row['apartment'], '">';
        }
        ?>
    </form>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/add.js"></script>
</body>
</html>