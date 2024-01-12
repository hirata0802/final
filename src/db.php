<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect, USER, PASS);
    if($_POST['db'] == 'register'){
        $sql=$pdo->query('select max(salon_id) from salon');
        $maxid=$sql+1;
        $sql=$pdo->prepare('insert into salon values (?,?,?,?,?,?,?,?');
        $sql -> execute([
            $maxid,
            $_POST['name'],
            $_POST['phone'],
            $_POST['prefecture'],
            $_POST['city'],
            $_POST['address'],
            $_POST['apartment'],
            $_POST['category']
        ]);
        header('Location: ./register.php?db="register"');
        exit();
        //サロン名が同じとき
        /*$sql = $pdo -> query('select * from salon');
        foreach($sql as $row){
            if($row["salon_name"] == $_POST["salon_name"]){
                
            }
        }*/
    }else if($_POST['db'] == 'update'){
        $sql=$pdo->prepare('update salon set salon_name=?, phone=?, prefectures=?, city=?, address=?, apartment=?, category=? where salon_id=?');
        $sql -> execute([
            $_POST['name'],
            $_POST['phone'],
            $_POST['prefecture'],
            $_POST['city'],
            $_POST['address'],
            $_POST['apartment'],
            $_POST['category'],
            $_POST['id']
        ]);
        header('Location: ./update.php?db="update"');
        exit();
    }else if($_POST['db'] == 'delete'){
        $sql = $pdo -> prepare('delete from salon where salon_id=?');
        $sql -> execute($_POST['salon_id']);
        header('Location: ./delete.php?db="delete"');
        exit();
    }

?>