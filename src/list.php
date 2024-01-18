<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <section class="main">
        <nav>
            <ul>
                <li class="menu_title"><h1>Salon List</h1></li>
                <li class="menu_btn"><a href="register.php" class="btn-new">新規登録</a></li>
            </ul>
        </nav>
        <form action="list.php" method="post">
            <input type="text" class="search-name" name="nameSearch" placeholder="サロン名で探す">
            <label class="search-category">
                <select name="categorySearch">
                <?php
                    echo '<label class="gray">';
                    echo '<option value="" hidden>カテゴリで探す</option>';
                    echo '</label>';
                    $pdo = new PDO($connect, USER, PASS);
                    $sql = $pdo -> query('select * from category');
                    foreach($sql as $row){
                        echo '<option value="', $row['category_id'], '">', $row['category_name'], '</option>';
                    }
                ?>
                </select>
            </label><br>
            <button><a class="btn-search">　検索　</a></button><br>
        </form>
        <?php
            $pdo = new PDO($connect, USER, PASS);
            $sql='select * from salon inner join category on salon.category_id=category.category_id where 1=1';
            $contains=[];
            if(!empty($_POST['nameSearch'])){
                $sql.=' and salon.salon_name like ?';
                $contains[]=$_POST['nameSearch'];
            }
            if(!empty($_POST['categorySearch'])){
                $sql.=' and salon.category_id = ?';
                $contains[]=$_POST['categorySearch'];
            }
            $sql.=' order by salon.category_id';
            $result=$pdo->prepare($sql);
            $result->execute($contains);
            $count=$result->rowCount();
            if($count > 0){
                echo '<table>';
                echo '<tr>';
                echo '<th>サロン名</th><th>Instagram</th><th>カテゴリ</th><th>電話番号</th><th>住所</th><th></th><th></th>';
                echo '</tr>';
                foreach($result as $row){
                    $address = $row['prefectures'].$row['city'].$row['address'].$row['apartment'];
                    echo '<tr>';
                    echo '<td>', $row['salon_name'], '</td>';
                    echo '<td><a href="https://www.instagram.com/', $row['link'], '/" class="insta">', $row['link'], '</a></td>';
                    echo '<td>', $row['category_name'], '</td>';
                    echo '<td>', $row['phone'], '</td>';
                    echo '<td>', $address, '</td>';
                    echo '<td><a href="update.php?id=', $row['salon_id'], '" class="a-upd">更新</a></td>';
                    echo '<td><a href="delete.php?id=', $row['salon_id'], '" class="a-del">削除</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
            }else{
                echo '<p>検索結果がありません。</p>';
            }
        ?>
    </section>
</body>
<?php require 'footer.php'; ?>