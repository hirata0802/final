<?php
    const SERVER = 'mysql220.phy.lolipop.lan';
    const DBNAME = 'LAA1518091-final';
    const USER = 'LAA1518091';
    const PASS = 'Pass0802';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<?php
    if(isset($_POST['salon_id'])){
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> prepare('delete from salon where salon_id=?');
        $sql -> execute($_POST['salon_id']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除</title>
</head>
<body>
<form action="delete.php" method="post">
<?php
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo -> prepare('select * from salon inner join category on salon.category_id=category.category_id where salon_id=?');
    $sql -> execute($_GET['id']);
    foreach($sql as $row){
        $address = $row['prefectures'].$row['city'].$row['address'].$row['apartment'];
        echo 'このサロンを削除しますか？';
        echo $row['salon_name'];
        echo $row['category_name'];
        echo $row['phone'];
        echo $address;
    }
    echo '<button>削除する</button>';
?>
</form>
<button type="button" onclick="location.href='list.php'">戻る</button>
</body>
</html>