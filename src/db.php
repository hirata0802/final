<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo = new PDO($connect, USER, PASS);
    if($_POST['db'] == 'register'){
        //サロン名が同じとき
        $sql=$pdo->prepare('select * from salon where salon_name=?');
        $sql->execute([$_POST['name']]);
        if(!empty($sql->fetchAll())){
            $_SESSION['newSalon'] = [
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'prefecture' => $_POST['prefecture'],
                'city' => $_POST['city'],
                'address' => $_POST['address'],
                'apartment' => $_POST['apartment'],
                'link' => $_POST['link'],
                'category' => $_POST['category']
            ];
            header('Location: ./register.php?db=register');
            exit();
        }else{
            $sql=$pdo->query('select max(salon_id) from salon');
            foreach($sql as $row){
                $maxid = $row['max(salon_id)'];
            }
            $maxid++;
            $sql=$pdo->prepare('insert into salon values (?,?,?,?,?,?,?,?,?)');
            $sql->execute([
                $maxid,
                $_POST['name'],
                $_POST['phone'],
                $_POST['prefecture'],
                $_POST['city'],
                $_POST['address'],
                $_POST['apartment'],
                $_POST['link'],
                $_POST['category']
            ]);
            $db = 'register';
        }
    }else if($_POST['db'] == 'category'){
        //カテゴリ名があるとき
        $sql=$pdo->prepare('select * from category where category_name=?');
        $sql->execute([$_POST['category']]);
        if(!empty($sql->fetchAll())){
            $_SESSION['newCategory'] = $_POST['category'];
            header('Location: ./category.php?db=category');
            exit();
        }else{
            $sql=$pdo->query('select max(category_id) from category');
            foreach($sql as $row){
                $maxid = $row['max(category_id)'];
            }
            $maxid++;
            $sql=$pdo->prepare('insert into category values (?,?)');
            $sql->execute([
                $maxid,
                $_POST['category']
            ]);
            $db = 'category';
        }
    }
    
    else if($_POST['db'] == 'update'){
        $sql=$pdo->prepare('update salon set salon_name=?, phone=?, prefectures=?, city=?, address=?, apartment=?, link=?, category_id=? where salon_id=?');
        $sql->execute([
            $_POST['name'],
            $_POST['phone'],
            $_POST['prefecture'],
            $_POST['city'],
            $_POST['address'],
            $_POST['apartment'],
            $_POST['link'],
            $_POST['category'],
            $_POST['id']
        ]);
        $db = 'update';
    }else if($_POST['db'] == 'delete'){
        $sql=$pdo->prepare('delete from salon where salon_id=?');
        $sql->execute([$_POST['id']]);
        $db = 'delete';
    }
    header('Location: ./message.php?db='.$db);
    exit();
?>