<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <section class="main">
    <nav>
        <ul>
            <li><h1>Salon List</h1></li>
            <li><a href="register.php" class="btn-new">新規登録</a></li>
        </ul>
    </nav>
    <table>
        <tr>
            <th>サロン名</th><th>Instagram</th><th>カテゴリ</th><th>電話番号</th><th>住所</th><th></th><th></th>
        </tr>
        <?php
            $pdo = new PDO($connect, USER, PASS);
            $sql = $pdo -> query('select * from salon inner join category on salon.category_id=category.category_id');
            foreach($sql as $row){
                $address = $row['prefectures'].$row['city'].$row['address'].$row['apartment'];
                echo '<tr>';
                echo '<td>', $row['salon_name'], '</td>';
                echo '<td><a href="https://www.instagram.com/', $row['link'], '/" >', $row['link'], '</a></td>';
                echo '<td>', $row['category_name'], '</td>';
                echo '<td>', $row['phone'], '</td>';
                echo '<td>', $address, '</td>';
                echo '<td><a href="update.php?id=', $row['salon_id'], '" class="btn-upd">更新</a></td>';
                echo '<td><a href="delete.php?id=', $row['salon_id'], '" class="btn-del">削除</a></td>';
                echo '</tr>';
            }
        ?>
    </section>
</body>
<?php require 'footer.php'; ?>